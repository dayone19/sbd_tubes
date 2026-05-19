<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\UserProfile;

class SettingsController extends Controller
{
    // 1. Menampilkan halaman settings dengan membawa data user yang login
    public function index()
    {
        $user = Auth::user();
        // Load relasi profile, jika belum ada maka buat objek kosong agar tidak error di view
        $profile = $user->userProfile ?? new UserProfile();

        return view('settings.user', compact('user', 'profile'));
    }

    // 2. Menyimpan pengaturan profil umum & unggahan foto profil
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'real_name' => 'nullable|string|max:100',
            'profile' => 'nullable|string|max:1000',
            'geographic_location' => 'nullable|string|max:150',
            'home_page' => 'nullable|url|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Batas file foto 2MB
        ]);

        $imagePath = $user->userProfile->image ?? null;

        // Proses upload foto profil jika user mengunggah file baru
        if ($request->hasFile('image')) {
            // Hapus foto lama jika ada di server agar hemat memori
            if ($imagePath && file_exists(public_path('uploads/avatars/' . $imagePath))) {
                @unlink(public_path('uploads/avatars/' . $imagePath));
            }

            $file = $request->file('image');
            $fileName = time() . '_' . $user->user_id . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads/avatars'), $fileName);
            $imagePath = $fileName;
        }

        // Hubungkan ke tabel user_profiles menggunakan updateOrCreate
        UserProfile::updateOrCreate(
            ['user_id' => $user->user_id],
            [
                'real_name' => $request->real_name,
                'profile' => $request->profile,
                'geographic_location' => $request->geographic_location,
                'home_page' => $request->home_page,
                'image' => $imagePath,
            ]
        );

        return redirect()->back()->with('success', 'Pengaturan profil berhasil disimpan!');
    }

    // 3. Mengubah Email
    public function updateEmail(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'email' => 'required|email|max:150|unique:users,email,' . $user->user_id . ',user_id',
        ]);

        $user->update([
            'email' => $request->email,
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Email berhasil diubah! Silakan masuk kembali dengan email baru Anda.');
    }

    // 4. Mengubah Password
    public function updatePassword(Request $request)
    {
        $user = Auth::user();

        // Validasi current_password menggunakan Hash check bawaan, atau hash manual jika user lama
        $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|string|min:6|confirmed', 
        ]);

        // Cek password saat ini secara manual karena kita punya dual-verification (bcrypt & sha-256)
        $isCurrentPasswordValid = false;
        if (str_starts_with($user->password, '$2y$') || str_starts_with($user->password, '$2a$') || str_starts_with($user->password, '$2b$')) {
            $isCurrentPasswordValid = Hash::check($request->current_password, $user->password);
        } else {
            $isCurrentPasswordValid = hash('sha256', $request->current_password) === $user->password;
        }

        if (!$isCurrentPasswordValid) {
            return back()->withErrors(['current_password' => 'Password saat ini (Current Password) yang Anda masukkan salah.']);
        }

        // Simpan password baru
        $user->update([
            'password' => $request->password,
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Password berhasil diubah! Silakan masuk kembali dengan password baru Anda.');
    }

    // 5. Mengubah Username
    public function updateUsername(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'username' => 'required|string|max:100|unique:users,username,' . $user->user_id . ',user_id',
        ]);

        $user->update([
            'username' => $request->username,
        ]);

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')->with('success', 'Username berhasil diubah! Silakan masuk kembali dengan username baru Anda.');
    }

    // --- BAGIAN BUYER SETTINGS ---

    public function buyerIndex(Request $request)
    {
        // Mengambil data dari session (karena tidak ada tabel database khusus)
        $buyerSettings = $request->session()->get('buyer_settings', []);
        return view('settings.buyer', compact('buyerSettings'));
    }

    public function updateBuyerCurrency(Request $request)
    {
        $request->validate([
            'currency' => 'required|string',
        ]);

        $settings = $request->session()->get('buyer_settings', []);
        $settings['currency'] = $request->currency;
        $request->session()->put('buyer_settings', $settings);

        return redirect()->back()->with('success', 'Pengaturan mata uang (Currency) berhasil disimpan!');
    }

    public function updateBuyerShipping(Request $request)
    {
        // Validasi data pengiriman (sama seperti Discogs)
        $request->validate([
            'full_name' => 'required|string|max:150',
            'country' => 'required|string|not_in:Select your country',
            'address_1' => 'required|string|max:255',
            'address_2' => 'nullable|string|max:255',
            'city' => 'required|string|max:100',
            'region' => 'nullable|string|max:100',
            'postal_code' => 'required|string|max:20',
            'phone' => 'nullable|string|max:30',
            'paypal_email' => 'nullable|email|max:150',
            'policy' => 'accepted', // Wajib centang policy
        ]);

        $settings = $request->session()->get('buyer_settings', []);
        $settings['shipping'] = $request->except(['_token', 'policy']); // Simpan semua kecuali token & centang
        $request->session()->put('buyer_settings', $settings);

        return redirect()->back()->with('success', 'Informasi pengiriman (Shipping) berhasil disimpan!');
    }
}
