@extends('layouts.app')

@section('content')

<style>
*{ box-sizing:border-box;}
body{font-family:Arial, Helvetica, sans-serif;background:#fff;color:#111;}
.main{display:flex;padding:25px 10px;gap:30px;}
/* ===== CONTENT ===== */
.content{flex:1;}
.page-title{font-size:20px;font-weight:700;margin-bottom:20px;}
.page-desc{font-size:16px;margin-bottom:25px;line-height:1.5;}
/* ===== SETTINGS BOX ===== */
.settings-box{border:1px solid #d8d8d8;background:white;margin-bottom:25px;}
.section-header{background:#efefef;padding:8px 15px;font-size:18px;font-weight:bold;border-bottom:1px solid #d8d8d8;}
.section-content{padding:20px 16px;}
.form-group{margin-bottom:22px;}
.form-group label{display:block;font-size:14px;margin-bottom:8px;font-weight:bold;}
.checkbox{display:flex;align-items:flex-start;gap:10px;margin-top:10px;font-size:14px;}
.input-full{width:100%;max-width:470px;padding:8px;border:1px solid #999;font-size:15px;}
textarea.input-full{height:140px;resize:vertical;}
select{width:260px;padding:8px;border:1px solid #999;font-size:15px;background:white;}
.btn-light{background:#f8f8f8;border:1px solid #ccc;padding:6px 13px;cursor:pointer;border-radius:2px;color:#333;font-size:14px;}
.btn-blue{background:#336699;color:white;border:1px solid #2a5580;padding:6px 13px;cursor:pointer;border-radius:2px;font-size:14px;}
.btn-save{background: green;color:white;border:1px solid #28a745;padding:8px 15px;font-weight:bold;cursor:pointer;margin-top:15px;border-radius:3px;font-size:14px;}
.btn-blue:hover{ background:#2a5580;}
.btn-light:hover{background:#ececec;}
.btn-save:hover{background:#23913d;}
/* ===== PROFILE PHOTO ===== */
.profile-photo{width:180px;height:180px;background:#d7d7d7;border:1px solid #cfcfcf;overflow:hidden;display:flex;justify-content:center;align-items:center;}
/* ===== TEXT ===== */
.help-text{ font-size:14px; margin:18px 0 28px; line-height:1.6;}
.help-text a{color:#336699;text-decoration:none;}
.help-text a:hover{text-decoration:underline;}
.optional{font-style:italic;color:#666;font-weight:normal;margin-left:8px;}
.small-note{ font-size:13px; color:#666; margin-top:6px; font-style:italic;}
.email-info {font-size: 14px;margin-bottom: 15px;}
.email-info b {font-family: monospace;font-size: 15px;}
.instruction-text {font-size: 14px;margin-bottom: 15px;line-height: 1.5;}
.status-text {display: flex;align-items: center;gap: 8px;font-size: 16px;font-weight: bold;margin: 15px 0;}
.link-blue {color: #336699;text-decoration: none;}
.link-blue:hover {text-decoration: underline;}
</style>

<div class="main">

    @include('components.sidebarSet')

    <div class="content">

        <div class="page-title">
            User Profile Settings
        </div>

        <div class="page-desc">
            Set your timezone, browsing options, profile information,
            change your email address, or update your password.
        </div>

        <!-- NOTIFIKASI SUKSES / ERROR -->
        @if(session('success'))
            <div style="background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
                <strong>Sukses!</strong> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div style="background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; padding: 15px; margin-bottom: 20px; border-radius: 4px;">
                <strong>Perhatian!</strong> Harap perbaiki kesalahan berikut:
                <ul style="margin-bottom: 0; margin-top: 10px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- FORM 1: GENERAL & PROFILE SETTINGS -->
        <form action="{{ route('settings.user.profile') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="settings-box">

                <div class="section-header">
                    General settings
                </div>

                <div class="section-content">

                    <div class="form-group">
                        <label>Language</label>
                        <select name="language">
                            <option>English</option>
                            <option selected>Indonesia</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Time Zone</label>
                        <select name="timezone">
                            <option>(GMT-8) PST</option>
                            <option selected>(GMT+7) WIB</option>
                        </select>
                    </div>

                    <div class="checkbox">
                        <input type="checkbox" checked>
                        <span>
                            <b>Auto-save submissions</b> after I comment or vote
                        </span>
                    </div>

                </div>

                <div class="section-header">
                    Profile settings
                </div>

                <div class="section-content">

                    <h2 style="font-size:15px; margin-bottom:20px; font-weight:bold;">
                        Profile Photo
                    </h2>

                    <div style="margin-bottom:18px;">
                        <div class="profile-photo">
                            @if($profile->image)
                                <img src="{{ asset('uploads/avatars/' . $profile->image) }}" style="width:100%; height:100%; object-fit:cover;" alt="Avatar">
                            @else
                                <svg viewBox="0 0 24 24" fill="white" width="120" height="120"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
                            @endif
                        </div>

                        <div style="margin-top:15px; display:flex; gap:10px; align-items:center;">
                            <!-- Input File disembunyikan agar tampilan tombol tetap indah -->
                            <input type="file" name="image" id="avatar-input" style="display:none;" onchange="handleFileSelect(event)">
                            <button type="button" class="btn-light" onclick="document.getElementById('avatar-input').click()">
                                Upload Photo
                            </button>
                            <button type="button" class="btn-blue">
                                Use Gravatar
                            </button>
                        </div>

                        <!-- Kotak 'File selected' persis seperti web Discogs -->
                        <div id="file-selected-alert" style="display:none; margin-top:15px; background-color:#eef8ef; border-left:4px solid #008a00; padding:10px 15px; align-items:center; gap:10px;">
                            <svg width="20" height="20" viewBox="0 0 24 24" fill="#008a00">
                                <path d="M12 2C6.48 2 2 6.48 2 12s4.48 10 10 10 10-4.48 10-10S17.52 2 12 2zm-2 15l-5-5 1.41-1.41L10 14.17l7.59-7.59L19 8l-9 9z"/>
                            </svg>
                            <span style="color:#111; font-size:14px; margin-top: 1px;">File selected</span>
                        </div>
                    </div>

                    <div class="help-text">
                        Change your avatar at
                        <a href="#">Gravatar.com</a>.
                    </div>

                    <div class="help-text" style="margin-top:-10px;">
                        Tell the community a little about yourself.
                        This information will be displayed on
                        <a href="{{ route('user.profile') }}" class="link-blue">your profile page</a>.
                    </div>

                    <!-- REAL NAME -->
                    <div class="form-group">
                        <label>
                            Real Name
                            <span class="optional">optional</span>
                        </label>
                        <input type="text" name="real_name" class="input-full" value="{{ old('real_name', $profile->real_name) }}">
                    </div>

                    <!-- PROFILE BIO -->
                    <div class="form-group">
                        <label>
                            Profile
                            <span class="optional">optional</span>
                        </label>
                        <textarea name="profile" class="input-full">{{ old('profile', $profile->profile) }}</textarea>
                        <div>
                            <a href="#" style="font-size:14px; color: #336699; text-decoration: none;">
                                View formatting options
                            </a>
                        </div>
                    </div>

                    <!-- LOCATION -->
                    <div class="form-group">
                        <label>
                            Geographic Location
                            <span class="optional">optional</span>
                        </label>
                        <input type="text" name="geographic_location" class="input-full" value="{{ old('geographic_location', $profile->geographic_location) }}">
                    </div>

                    <!-- HOMEPAGE -->
                    <div class="form-group">
                        <label>
                            Home Page
                            <span class="optional">optional</span>
                        </label>
                        <input type="text" name="home_page" class="input-full" value="{{ old('home_page', $profile->home_page) }}">
                        <div class="small-note">
                            Must be either completely empty or a full,
                            valid URL including http://
                        </div>
                    </div>

                    <!-- SAVE PROFILE BUTTON -->
                    <button type="submit" class="btn-save">
                        Save settings
                    </button>

                </div>

            </div>
        </form>

        <!-- FORM 2: CHANGE EMAIL ADDRESS -->
        <div class="settings-box">
            <div class="section-header">Email address</div>
            <div class="section-content">
                <form action="{{ route('settings.user.email') }}" method="POST">
                    @csrf
                    <div class="email-info">
                        Your current e-mail address is <b>{{ $user->email }}</b>
                    </div>
                    <div class="instruction-text">
                        You will need to login again after changing your email address.
                    </div>

                    <div class="form-group">
                        <label>New email address</label>
                        <input type="email" name="email" class="input-full" required value="{{ old('email') }}">
                    </div>

                    <button type="submit" class="btn-blue">
                        Change my email address
                    </button>
                </form>
            </div>
        </div>

        <!-- FORM 3: CHANGE PASSWORD -->
        <div class="settings-box">
            <div class="section-header">Change Password</div>
            <div class="section-content">
                <form action="{{ route('settings.user.password') }}" method="POST">
                    @csrf
                    <div class="instruction-text">
                        Changing your password is <i>not required</i><br>
                        to change general or profile settings.
                    </div>
                    <div class="instruction-text">
                        You will need to login again after changing your password.
                    </div>

                    <div class="form-group">
                        <label>Current password</label>
                        <input type="password" name="current_password" class="input-full" required>
                    </div>

                    <div class="form-group">
                        <label>New password</label>
                        <input type="password" name="password" class="input-full" required>
                    </div>

                    <div class="form-group">
                        <label>Confirm new password</label>
                        <input type="password" name="password_confirmation" class="input-full" required>
                    </div>

                    <button type="submit" class="btn-save">
                        Change password
                    </button>
                </form>
            </div>
        </div>

        <!-- FORM 4: CHANGE USERNAME -->
        <div class="settings-box">
            <div class="section-header">Change Username</div>
            <div class="section-content">
                <form action="{{ route('settings.user.username') }}" method="POST">
                    @csrf
                    <div class="instruction-text">
                        Changing your username is not required to change general or profile settings. <br>
                        Changing your username means that your old username is no longer available for use by you or by anyone. <br>
                        You may change your username 3 more times. <br>
                        You will need to login again after changing your username. <br>
                    </div>
                    <div class="form-group">
                        <label>New username</label>
                        <input type="text" name="username" class="input-full" required value="{{ old('username') }}">
                    </div>
                    <button type="submit" class="btn-save">
                        Change username
                    </button>
                </form>
            </div>
        </div>

        <!-- 2FA SECTION (STATED ONLY) -->
        <div class="settings-box">
            <div class="section-header">Two-Factor Authentication</div>
            <div class="section-content">
                <div class="instruction-text">
                    Two-factor authentication (2FA) provides an extra layer of security to your Discogs account.
                </div>

                <div class="status-text">
                    Your current two-factor authentication status: 
                    <svg width="20" height="20" viewBox="0 0 24 24" fill="currentColor" style="margin-left: 5px;">
                        <path d="M12 17c1.1 0 2-.9 2-2s-.9-2-2-2-2 .9-2 2 .9 2 2 2zm6-9h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6h1.9c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm0 12H6V10h12v10z"/>
                    </svg>
                    2FA Disabled
                </div>

                <div class="instruction-text">
                    You can manage two-factor authentication and additional security features through your 
                    <a href="#" class="link-blue">Accounts dashboard</a>.
                </div>

                <button type="button" class="btn-save">
                    Manage 2FA status
                </button>
            </div>
        </div>
    </div>

</div>

<!-- Script untuk memunculkan kotak hijau saat file foto dipilih -->
<script>
function handleFileSelect(event) {
    var input = event.target;
    var alertBox = document.getElementById('file-selected-alert');
    if (input.files && input.files[0]) {
        alertBox.style.display = 'flex'; // Munculkan kotak hijau
    } else {
        alertBox.style.display = 'none'; // Sembunyikan jika batal
    }
}
</script>

@endsection