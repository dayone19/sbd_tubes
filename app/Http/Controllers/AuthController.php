<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class AuthController extends Controller
{
    // Menampilkan halaman login
    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }

    // Memproses Login
    public function login(Request $request)
    {
        $request->validate([
            'login' => 'required|string',
            'password' => 'required|string',
        ]);

        // Cari user berdasarkan username atau email
        $user = User::where('email', $request->login)
            ->orWhere('username', $request->login)
            ->first();

        // Verifikasi password (mendukung bcrypt standar Laravel dan fallback SHA-256 untuk user bawaan)
        $isValid = false;
        if ($user) {
            if (str_starts_with($user->password, '$2y$') || str_starts_with($user->password, '$2a$') || str_starts_with($user->password, '$2b$')) {
                $isValid = Hash::check($request->password, $user->password);
            } else {
                $isValid = hash('sha256', $request->password) === $user->password;
            }
        }

        if ($isValid) {
            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Selamat datang kembali, ' . $user->username . '!');
        }

        // Jika salah, kembalikan dengan pesan error
        return back()->withErrors([
            'login' => 'Username/Email atau password salah.',
        ])->onlyInput('login');
    }

    // Menampilkan halaman signup (register)
    public function showSignupForm()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.signup');
    }

    // Memproses Signup (Register)
    public function signup(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:100|unique:users,username',
            'email' => 'required|string|email|max:150|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

        // Membuat user baru (secara otomatis di-hash oleh casts di model User)
        $user = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => $request->password,
        ]);

        return redirect('/login')->with('success', 'Pendaftaran berhasil! Silakan masuk menggunakan akun baru Anda.');
    }

    // Memproses Logout
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Anda telah berhasil keluar.');
    }
}
