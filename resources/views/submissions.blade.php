@extends('layouts.app')

@section('content')

<style>
    .main-layout {
        display: flex;
        background-color: #f5f5f5;
        min-height: 100vh;
        font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;
    }
    /* SIDEBAR KIRI */
    .left-sidebar {
        width: 210px;
        background-color: #fff; /* Warna kuning khas Discogs */
        border-right: 1px solid #ccc;
    }
    .sidebar-title {
        font-size: 16px;
        font-weight: bold;
        padding: 8px;
        border-bottom: 1px solid #ccc;
        background-color: #f2f2c1;
    }
    .sidebar-item {
        background: #fff;
        padding: 8px 10px;
        border-bottom: 1px solid #ccc;
    }
    .sidebar-item a {
        color: #0645ad;
        text-decoration: none;
        font-size: 13px;
    }
    .sidebar-item .meta {
        font-size: 11px;
        color: #666;
        margin-top: 3px;
    }
    /* KONTEN UTAMA */
    .submission-container {
        flex: 1;
        padding: 20px 30px;
        background: #fff;
    }
    .header-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
    }
    .header-row h1 {
        font-size: 24px;
        margin: 0;
        font-weight: bold;
    }
    .add-release-btn {
        background-color: green;
        color: white;
        border: none;
        padding: 8px 15px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 14px;
        cursor: pointer;
    }
    /* Search Box */
    .search-wrapper {
        position: relative;
        width: 350px;
        margin-bottom: 25px;
    }
    .search-wrapper input {
        width: 100%;
        padding: 8px 30px 8px 10px;
        border: 1px solid #bbb;
        font-size: 15px;
    }
    .search-wrapper .icon {
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #666;
    }
    /* Found Bar */
    .found-bar {
        background: #ddd;
        padding: 8px 15px;
        font-weight: bold;
        font-size: 18px;
        border: 1px solid #ccc;
        border-bottom: none;
    }
    /* Info Grid (4 Kolom) */
    .info-grid {
        display: grid;
        grid-template-columns: repeat(4, 1fr);
        border: 1px solid #ccc;
        background: #fff;
    }
    .grid-column {padding: 15px;border-right: 1px solid #eee;}
    .grid-column:last-child { border-right: none; }
    .grid-column h3 {
        font-size: 16px;
        font-weight: bold;
        margin-top: 0;
        margin-bottom: 12px;
    }
    .grid-column a {
        display: block;
        color: #0645ad;
        text-decoration: none;
        font-size: 14px;
        margin-bottom: 8px;
    }
    .grid-column a span { color: #666; font-size: 13px; margin-left: 5px; }
    /* Bottom Grid (3 Kolom) */
    .bottom-grid {
        display: grid;
        grid-template-columns: 1.2fr 1fr 1fr;
        border: 1px solid #ccc;
        border-top: none;
        background: #fff;
    }
    .bottom-col {padding: 15px;border-right: 1px solid #eee;}
    .bottom-col:last-child { border-right: none; }
    .bottom-col h4 { font-size: 14px; margin-top: 0; margin-bottom: 10px; }
    .bottom-col a {
        display: block;
        color: #0645ad;
        text-decoration: none;
        font-size: 13px;
        margin-bottom: 5px;
    }
    .shortcut { font-size: 13px; margin-bottom: 4px; }
    .shortcut b { color: #800000; }
    .export-link {
        display: inline-block;
        margin-top: 20px;
        color: #0645ad;
        text-decoration: none;
        font-size: 13px;
    }
</style>

<div class="main-layout">
    <aside class="left-sidebar">
        <div class="sidebar-title">My Submissions</div>
        <div class="sidebar-item">
            <a href="#">Ariana Grande - Eternal Sunshine</a>
            <div class="meta">changed about 14 hours ago</div>
        </div>
    </aside>

    <main class="submission-container">
        <div class="header-row">
            <h1>Submissions</h1>
            <a href="/release/add">
                <button class="add-release-btn">Add a Release</button>
            </a>  
        </div>

        <div class="search-wrapper">
            <input type="text" placeholder="Search Submissions">
            <span class="icon">⌕</span>
        </div>

        <div class="found-bar">
            Found 20,979,326 submissions
        </div>

        <div class="info-grid">
            <div class="grid-column">
                <h3>Type:</h3>
                <a href="#">Release <span>(17,332,384)</span></a>
                <a href="#">Artist <span>(2,927,070)</span></a>
                <a href="#">Label <span>(717,116)</span></a>
                <a href="#">Master <span>(2,756)</span></a>
            </div>
            
            <div class="grid-column">
                <h3>Genre:</h3>
                <a href="#">Rock <span>(5,771,312)</span></a>
                <a href="#">Electronic <span>(4,000,101)</span></a>
                <a href="#">Pop <span>(3,642,320)</span></a>
                <a href="#">Folk, World, & Country <span>(2,377,902)</span></a>
                <a href="#">Jazz <span>(3,642,320)</span></a>
                <a href="#">Funk / Soul <span>(3,642,320)</span></a>
                <a href="#" style="color: #666; font-size: 12px; margin-top: 10px;">Show more</a>
            </div>

            <div class="grid-column">
                <h3>Style:</h3>
                <a href="#">Pop Rock <span>(855,183)</span></a>
                <a href="#">Vocal <span>(598,635)</span></a>
                <a href="#">House <span>(593,477)</span></a>
                <a href="#">Experimental <span>(550,027)</span></a>
                <a href="#">Punk <span>(855,183)</span></a>
                <a href="#">Alternative Rock <span>(598,635)</span></a>
                <a href="#" style="color: #666; font-size: 12px; margin-top: 10px;">Show more</a>
            </div>

            <div class="grid-column">
                <h3>More Filters:</h3>
                <a href="#">Format</a>
                <a href="#">Year</a>
                <a href="#">Country</a>
            </div>
        </div>

        <div class="bottom-grid">
            <div class="bottom-col">
                <h4>Other submissions to check:</h4>
                <a href="#">My Contributions</a>
                <a href="#">My Collection</a>
                <a href="#">Items I'm Selling</a>
                <a href="#">Friends' Submissions</a>
                <a href="#">Pending Release Merges</a>
                <a href="#">Release Recently Merged</a>
                <a href="#">Pending Release Removals</a>
                <a href="#">Releases Recently Removed</a>
            </div>

            <div class="bottom-col">
                <h4>Keyboard Shortcuts:</h4>
                <div class="shortcut"><b>n</b> : move to next submission</div>
                <div class="shortcut"><b>p</b> : move to previous submission</div>
                <div class="shortcut"><b>t</b> : move to top of history</div>
                <div class="shortcut"><b>f</b> : move to comment/vote form</div>
                <div class="shortcut"><b>s</b> : save submission / don't save</div>
            </div>

            <div class="bottom-col">
                <a href="#" class="export-link">Export My Contributions</a>
            </div>
        </div>
    </main>
</div>

@endsection