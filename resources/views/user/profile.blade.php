@extends('layouts.app')

@section('content')

<style>
    body { font-family: Arial, sans-serif; background-color: #ffffff; color: #333; margin: 0; }
    /* Banner & Profile Section */
    .profile-banner { background-color: #272727; height: 160px; position: relative; }
    /* Tombol Upload Image di Banner */
    .upload-btn { position: absolute; right: 20px; top: 20px; background: rgba(255,255,255,0.9); padding: 5px 10px; border-radius: 4px; font-size: 12px; cursor: pointer; text-decoration: none; color: #333; display: flex; align-items: center; gap: 5px; }
    .profile-info-bar { background-color: #000; color: white; padding-left: 190px; height: 50px; display: flex; align-items: stretch; }
    .username { font-size: 22px; font-weight: bold; display: flex; align-items: center; margin-right: 20px; }
    /* Kotak Lists di sebelah username */
    .stat-box { background: #000; padding: 5px 15px; display: flex; flex-direction: column; align-items: center; justify-content: center; border-left: 1px solid #333; border-right: 1px solid #333; font-size: 12px; }
    .stat-box:hover { background: #1a1a1a; padding: 5px 15px; display: flex; flex-direction: column; align-items: center; justify-content: center; border-left: 1px solid #333; border-right: 1px solid #333; font-size: 12px; }
    .stat-box span { font-weight: bold; font-size: 14px; }
    .avatar-box { width: 150px; height: 150px; background-color: #ccc; border: 1px solid #ddd; position: absolute; bottom: -15px; left: 20px; z-index: 10; display: flex; justify-content: center; align-items: flex-end; overflow: hidden; }   
    /* Layout Utama */
    .container-custom { display: grid; grid-template-columns: 250px 1fr; gap: 40px; padding: 50px 20px; max-width: 1200px; margin: 0 auto; position: relative; }
    /* Tombol Settings */
    .settings-btn { position: absolute; right: 20px; top: 20px; border: 1px solid #ccc; background: #f9f9f9; padding: 5px 12px; border-radius: 4px; font-size: 13px; cursor: pointer; color: #333; text-decoration: none; }
    .sidebar h3 { border-bottom: 1px solid #eee; padding-bottom: 8px; font-size: 16px; margin-top: 25px; color: #000; }
    .sidebar p { font-size: 13px; color: #333; margin: 15px 0; }
    /* Table & Content */
    .main-content h2 { font-size: 20px; margin-bottom: 15px; border-bottom: none; }
    table { width: 100%; border-collapse: collapse; }
    th { background-color: #f4f4f4; text-align: left; padding: 10px; font-size: 13px; color: #666; font-weight: normal; }
    td { padding: 15px 10px; border-bottom: 1px solid #eee; font-size: 13px; }   
    .empty-msg { color: #333; }
    .links { color: #b01a8b; }
    .links a { color: #b01a8b; text-decoration: none; }
    .links a:hover { text-decoration: underline; }
</style>

<section class="profile-banner">
    <a href="{{ route('settings.user') }}" class="upload-btn">Upload Image</a>
    <div class="avatar-box" style="background: #333;">
        @if(auth()->check() && auth()->user()->userProfile && auth()->user()->userProfile->image)
            <img src="{{ asset('uploads/avatars/' . auth()->user()->userProfile->image) }}" style="width: 100%; height: 100%; object-fit: cover;" alt="Profile">
        @else
            <svg viewBox="0 0 24 24" fill="white" width="120" height="120"><path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/></svg>
        @endif
    </div>
</section>

<div class="profile-info-bar">
    <div class="username">{{ auth()->user()->username ?? 'Gweh' }}</div>
    <div href="/user/lists" class="stat-box" style="cursor: pointer;" onclick="window.location.href='/user/lists'">
        Lists
        <span>{{ auth()->check() ? auth()->user()->listModels()->count() : 0 }}</span>
    </div>
</div>

<div class="container-custom">
    <a href="{{ route('settings.user') }}" class="settings-btn">⚙ Settings</a>

    <aside class="sidebar">
    <p style="margin-top:0;">Joined on {{ \Carbon\Carbon::parse(auth()->user()->created_at)->format('F d, Y') }} </p>
        
        <h3><b>Releases</b></h3>
        <p>No releases</p>
        
        <h3><b>Marketplace</b></h3>
        <p>No seller rating</p>
        <p>No buyer rating</p>
    </aside>

    <main class="main-content">
        <h2><b>Recent Activity</b></h2>
        <table>
            <thead>
                <tr>
                    <th width="30%">Action</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="empty-msg">No recent activity?</td>
                    <td class="links">
                        <a href="#">Add a submission</a>, 
                        <a href="#">write a review</a>, or 
                        <a href="#">add releases to your collection or wantlist!</a>
                    </td>
                </tr>
            </tbody>
        </table>
    </main>
</div>

@endsection