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
.input-full{width:100%;max-width:470px;padding:4px;border:1px solid #999;font-size:15px;}
textarea.input-full{height:140px;resize:vertical;}
select{width:260px;padding:8px;border:1px solid #999;font-size:15px;background:white;}
.btn-light{background:#f8f8f8;border:1px solid #ccc;padding:6px 13px;cursor:pointer;border-radius:2px;color:#333;font-size:14px;}
.btn-blue{background:#336699;color:white;border:1px solid #2a5580;padding:6px 13px;cursor:pointer;border-radius:2px;font-size:14px;}
.btn-save{background: green;color:white;border:1px solid #28a745;padding:8px 15px;font-weight:bold;cursor:pointer;margin-top:15px;border-radius:3px;font-size:14px;}
.btn-blue:hover{ background:#2a5580;}
.btn-light:hover{background:#ececec;}
.btn-save:hover{background:#23913d;}
/* ===== PROFILE PHOTO ===== */
.profile-photo{width:390px;height:390px;background:#d7d7d7;border:1px solid #cfcfcf;}
/* ===== TEXT ===== */
.help-text{ font-size:14px; margin:18px 0 28px; line-height:1.6;}
.help-text a{color:#336699;text-decoration:none;}
.help-text a:hover{text-decoration:underline;}
.optional{font-style:italic;color:#666;font-weight:normal;margin-left:8px;}
.small-note{ font-size:13px; color:#666; margin-top:6px; font-style:italic;}
.email-info {font-size: 14px;margin-bottom: 15px;}
.email-info b {font-family: monospace;font-size: 15px;}
.instruction-text {font-size: 14px;margin-bottom: 15px;line-height: 1.5;}
/* Untuk teks tebal di status 2FA */
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

        <div class="settings-box">

            <div class="section-header">
                General settings
            </div>

            <div class="section-content">

                <div class="form-group">
                    <label>Language</label>

                    <select>
                        <option>English</option>
                        <option>Indonesia</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Time Zone</label>

                    <select>
                        <option>(GMT-8) PST</option>
                        <option>(GMT+7) WIB</option>
                    </select>
                </div>

                <div class="checkbox">
                    <input type="checkbox" checked>

                    <span>
                        <b>Auto-save submissions</b> after I comment or vote
                    </span>
                </div>

            </div>

            <!-- PROFILE -->

            <div class="section-header">
                Profile settings
            </div>

            <div class="section-content">

                <h2 style="font-size:15px; margin-bottom:20px; font-weight:bold;">
                    Profile Photo
                </h2>

                <div style="margin-bottom:18px;">
                    <div class="profile-photo"></div>

                    <div style="margin-top:15px; display:flex; gap:10px;">
                        <button type="button" class="btn-light">
                            Upload Photo
                        </button>

                        <button type="button" class="btn-blue">
                            Use Gravatar
                        </button>
                    </div>
                </div>

                <div class="help-text">
                    Change your avatar at
                    <a href="#">Gravatar.com</a>.
                </div>

                <div class="help-text" style="margin-top:-10px;">
                    Tell the community a little about yourself.
                    This information will be displayed on
                    <a href="#" class="link-purple">your profile page</a>.
                </div>

                <!-- REAL NAME -->

                <div class="form-group">
                    <label>
                        Real Name
                        <span class="optional">optional</span>
                    </label>

                    <input type="text" class="input-full">
                </div>

                <!-- PROFILE -->

                <div class="form-group">
                    <label>
                        Profile
                        <span class="optional">optional</span>
                    </label>

                    <textarea class="input-full"></textarea>

                    <div>
                        <a href="#" style="font-size:14px;">
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

                    <input type="text" class="input-full">
                </div>

                <!-- HOMEPAGE -->

                <div class="form-group">
                    <label>
                        Home Page
                        <span class="optional">optional</span>
                    </label>

                    <input type="text" class="input-full">

                    <div class="small-note">
                        Must be either completely empty or a full,
                        valid URL including http://
                    </div>
                </div>

                <!-- SAVE -->

                <button type="submit" class="btn-save">
                    Save settings
                </button>

            </div>

        </div>

        <div class="settings-box">
            <div class="section-header">Email address</div>
            <div class="section-content">
                <div class="email-info">
                    Your current e-mail address is <b>gweh@gmail.com</b>
                </div>
                <div class="instruction-text">
                    You will need to login again after changing your email address.
                </div>
                <button type="button" class="btn-blue">
                    Change my email address
                </button>
            </div>
        </div>

        <div class="settings-box">
            <div class="section-header">Change Password</div>
            <div class="section-content">
                <div class="instruction-text">
                    Changing your password is <i>not required</i><br>
                    to change general or profile settings.
                </div>
                <div class="instruction-text">
                    You will need to login again after changing your password.
                </div>

                <div class="form-group">
                    <label>New password</label>
                    <input type="password" class="input-full">
                </div>

                <div class="form-group">
                    <label>Confirm new password</label>
                    <input type="password" class="input-full">
                </div>

                <button type="submit" class="btn-save">
                    Change password
                </button>
            </div>
        </div>

        <div class="settings-box">
            <div class="section-header">Change Username</div>
            <div class="section-content">
                <div class="instruction-text">
                    Changing your username is not required to change general or profile settings. <br>
                    Changing your username means that your old username is no longer available for use by you or by anyone. <br>
                    You may change your username 3 more times. <br>
                    You will need to login again after changing your username. <br>
                </div>
                <div class="form-group">
                    <label>New username</label>
                    <input type="text" class="input-full">
                </div>
                <button type="submit" class="btn-save">
                    Change username
                </button>
            </div>
        </div>

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

@endsection