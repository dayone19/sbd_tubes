@extends('layouts.app')

@section('title', isset($album) ? 'Album - ' . $album->title : 'Album')

@section('content')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: Arial, Helvetica, sans-serif;
        font-size: 13px;
        color: #333;
        background: #fff;
    }

    .album-wrapper {
        max-width: 1100px;
        margin: 20px auto;
        padding: 0 16px;
        display: flex;
        gap: 24px;
    }

    /* ── LEFT COLUMN ── */
    .album-left {
        flex: 1 1 0;
        min-width: 0;
    }

    /* Header */
    .album-header {
        display: flex;
        gap: 16px;
        align-items: flex-start;
        margin-bottom: 20px;
    }

    .album-cover-wrap {
        flex-shrink: 0;
        text-align: center;
    }

    .album-cover-wrap img {
        width: 160px;
        height: 160px;
        object-fit: cover;
        display: block;
        border: 1px solid #ccc;
    }

    .album-cover-wrap a {
        display: block;
        font-size: 11px;
        color: #0a71b3;
        margin-top: 4px;
        text-decoration: none;
    }

    .album-cover-wrap a:hover {
        text-decoration: underline;
    }

    .album-meta {
        flex: 1;
        padding-top: 4px;
    }

    .album-title {
        font-size: 22px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
        line-height: 1.2;
    }

    .album-title .artist-name {
        color: #0a71b3;
        text-decoration: none;
    }

    .album-title .artist-name:hover {
        text-decoration: underline;
    }

    .album-info-table {
        border: none;
        border-collapse: collapse;
    }

    .album-info-table td {
        padding: 2px 8px 2px 0;
        vertical-align: top;
        font-size: 13px;
    }

    .album-info-table td:first-child {
        color: #333;
        font-weight: normal;
        white-space: nowrap;
    }

    .album-info-table td a {
        color: #0a71b3;
        text-decoration: none;
    }

    .album-info-table td a:hover {
        text-decoration: underline;
    }

    /* Section divider */
    .section-title {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        border-bottom: 1px solid #ddd;
        padding-bottom: 4px;
        margin-bottom: 0;
        margin-top: 20px;
    }

    /* Tracklist */
    .tracklist {
        width: 100%;
        border-collapse: collapse;
        margin-top: 0;
    }

    .tracklist tr {
        border-bottom: 1px solid #e8e8e8;
    }

    .tracklist tr:last-child {
        border-bottom: none;
    }

    .tracklist td {
        padding: 3px 4px;
        font-size: 13px;
        color: #333;
    }

    /* Credits */
    .credits-grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 0;
        margin-top: 0;
    }

    .credit-item {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 8px;
        border-bottom: none;
    }

    .credit-item img {
        width: 60px;
        height: auto;
    }

    .credit-info a {
        color: #0a71b3;
        text-decoration: none;
        font-size: 13px;
        font-weight: bold;
        display: block;
    }

    .credit-info a:hover {
        text-decoration: underline;
    }

    .credit-info span {
        font-size: 12px;
        color: #666;
        display: block;
    }

    /* ── RIGHT COLUMN ── */
    .album-right {
        width: 280px;
        flex-shrink: 0;
    }

    /* Master Release box */
    .master-release-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 14px;
        font-weight: bold;
        color: #333;
        border-bottom: 1px solid #ddd;
        padding-bottom: 6px;
        margin-bottom: 8px;
    }

    .master-release-header .release-id {
        font-size: 12px;
        font-weight: normal;
        color: #555;
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .release-icon {
        width: 12px;
        height: 12px;
        background: #000;
        border-radius: 50%;
        display: inline-block;
        position: relative;
    }

    .release-icon::after {
        content: '';
        width: 4px;
        height: 4px;
        background: #fff;
        border-radius: 50%;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
    .master-release-links {
        font-size: 12px;
        margin-bottom: 12px;
    }

    .master-release-links a {
        color: #0a71b3;
        text-decoration: none;
        display: block;
        margin-bottom: 2px;
    }

    .master-release-links a:hover {
        text-decoration: underline;
    }

    /* For Sale */
    .for-sale-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border-bottom: 1px solid #ddd;
        padding-bottom: 6px;
        margin-bottom: 10px;
    }

    .for-sale-header span {
        font-size: 14px;
        font-weight: bold;
        color: #333;
    }

    .for-sale-header a {
        color: #0a71b3;
        font-size: 12px;
        text-decoration: none;
    }

    .for-sale-header a:hover {
        text-decoration: underline;
    }

    /* Release card */
    .release-card {
        display: flex;
        gap: 10px;
        margin-bottom: 12px;
    }

    .release-card img {
        width: 75px;
        height: 75px;
        object-fit: cover;
        border: 1px solid #ccc;
        flex-shrink: 0;
    }

    .release-card-info {
        font-size: 12px;
        line-height: 1.5;
    }

    .release-card-info .label {
        font-size: 10px;
        color: #888;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .release-card-info .title {
        font-size: 14px;
        font-weight: bold;
        color: #333;
    }

    .release-card-info .year {
        color: #555;
    }

    .release-card-info .formats a {
        color: black;
        text-decoration: none;
        font-size: 12px;
    }

    .release-card-info .formats a:hover {
        text-decoration: underline;
    }

    .release-card-info .formats span {
        color: #666;
    }

    .release-card-info .price-range {
        color: #333;
        font-size: 12px;
    }

    /* Shop button */
    .btn-shop {
        display: block;
        width: 100%;
        background: #2c8b2c;
        color: #fff;
        text-align: center;
        padding: 10px;
        font-size: 14px;
        font-weight: 400;
        border-radius: 20px;
        cursor: pointer;
        text-decoration: none;
        margin-bottom: 16px;
        border-radius: 2px;
    }

    .btn-shop:hover {
        background: #257025;
    }

    /* Statistics */
    .statistics-header {
        font-size: 14px;
        font-weight: bold;
        color: #333;
        border-bottom: 1px solid #ddd;
        padding-bottom: 6px;
        margin-bottom: 8px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr; /* 2 kolom */
        gap: 10px 20px;
        font-size: 12px;
    }

    .stat-pair {
        display: flex;
        justify-content: space-between;
        border-bottom: none;
        padding-bottom: 4px;
    }

    .stat-pair a {
        color: #0a71b3;
        text-decoration: none;
    }

    .stat-pair a:hover {
        text-decoration: underline;
    }

    .stats-grid .stat-label {
        color: #555;
    }

    .stats-grid .stat-value a {
        color: #0a71b3;
        text-decoration: none;
    }

    .stats-grid .stat-value a:hover {
        text-decoration: underline;
    }

    .stats-grid .stat-value {
        text-align: right;
        color: #555;
    }

    /* Share */
    .share-btn {
        display: inline-flex;
        align-items: center;
        gap: 5px;
        color: #0a71b3;
        font-size: 13px;
        text-decoration: none;
        border: none;
        background: none;
        cursor: pointer;
        padding: 0;

        margin-top: 10px; 
    }

    .share-btn:hover {
        text-decoration: underline;
    }

    .share-icon {
        width: 14px;
        height: 14px;
        fill: #0a71b3;
    }

    /* Videos */
    .videos-header {
        display: flex;
        align-items: center;
        gap: 6px;
        font-size: 14px;
        font-weight: bold;
        color: #333;
        border-bottom: 1px solid #ddd;
        padding-bottom: 6px;
        margin-bottom: 8px;
    }

    .videos-header .info-icon {
        width: 14px;
        height: 14px;
        border-radius: 50%;
        background: #999;
        color: #fff;
        font-size: 10px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        cursor: pointer;
    }

    .videos-header .edit-link {
        color: #0a71b3;
        font-size: 12px;
        font-weight: normal;
        text-decoration: none;
        margin-left: 0;
    }

    .videos-header .edit-link:hover {
        text-decoration: underline;
    }

    /* Video thumbnail */
    .video-thumb {
        position: relative;
        width: 100%;
        aspect-ratio: 16/9;
        background: #000;
        cursor: pointer;
        overflow: hidden;
    }

    .video-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        opacity: 0.8;
    }

    .video-thumb .play-btn {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 48px;
        height: 48px;
        background: rgba(255,255,255,0.9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .video-thumb .play-btn::after {
        content: '';
        border-left: 18px solid #333;
        border-top: 11px solid transparent;
        border-bottom: 11px solid transparent;
        margin-left: 4px;
    }

    .video-more-link {
        display: block;
        color: #0a71b3;
        font-size: 12px;
        text-decoration: none;
        margin-top: 6px;
    }

    .video-more-link:hover {
        text-decoration: underline;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .album-wrapper {
            flex-direction: column;
        }
        .album-right {
            width: 100%;
        }
        .credits-grid {
            grid-template-columns: 1fr 1fr;
        }
    }

    @media (max-width: 480px) {
        .credits-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="album-wrapper">

    <!-- ══════════════════════════════════════
         LEFT COLUMN
    ══════════════════════════════════════ -->
    <div class="album-left">

        <!-- Header: cover + meta -->
        <div class="album-header">
            <div class="album-cover-wrap">
               <img src="https://i.discogs.com/7OyH6ag4ze3_wbHt4uIxkLeqUlQDUgBHP0eL9oWGu8A/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTM2NjI4/NDIwLTE3NzIyOTE4/NzAtNTQ5Ny5qcGVn.jpeg" alt="Bruno Mars - The Romantic album cover" width="150" height="147" >
                <a href="#">More images</a>
            </div>
            <div class="album-meta">
                <div class="album-title">
                    <a href="#" class="artist-name">{{ $album->artist ?? 'Bruno Mars' }}</a>
                    &ndash; {{ $album->title ?? 'The Romantic' }}
                </div>
                <table class="album-info-table">
                    <tr>
                        <td>Genre:</td>
                        <td>
                            @if(isset($album->genres))
                                @foreach($album->genres as $genre)
                                    <a href="#">{{ $genre }}</a>@if(!$loop->last), @endif
                                @endforeach
                            @else
                                <a href="#">Funk / Soul</a>, <a href="#">Pop</a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Style:</td>
                        <td>
                            @if(isset($album->styles))
                                @foreach($album->styles as $style)
                                    <a href="#">{{ $style }}</a>@if(!$loop->last), @endif
                                @endforeach
                            @else
                                &nbsp;
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Year:</td>
                        <td><a href="#">{{ $album->year ?? '2026' }}</a></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Tracklist -->
        <div class="section-title">Tracklist</div>
        <table class="tracklist">
            @if(isset($album->tracks) && count($album->tracks))
                @foreach($album->tracks as $track)
                    <tr>
                        <td>{{ $track->title }}</td>
                    </tr>
                @endforeach
            @else
                <tr><td>Risk It All</td></tr>
                <tr><td>Cha Cha Cha</td></tr>
                <tr><td>I Just Might</td></tr>
                <tr><td>God Was Showing Off</td></tr>
                <tr><td>Why You Wanna Fight?</td></tr>
                <tr><td>On My Soul</td></tr>
                <tr><td>Something Serious</td></tr>
                <tr><td>Nothing Left</td></tr>
                <tr><td>Dance With Me</td></tr>
            @endif
        </table>

        <!-- Credits -->
        <div class="section-title" style="margin-top:20px;">
            Credits ({{ $album->credits_count ?? '57' }})
        </div>
        <div class="credits-grid">
            @if(isset($album->credits) && count($album->credits))
                @foreach($album->credits as $credit)
                    <div class="credit-item">
                        <img src="{{ $credit->photo ?? asset('images/default-person.jpg') }}" alt="{{ $credit->name }}">
                        <div class="credit-info">
                            <a href="#">{{ $credit->name }}</a>
                            <span>{{ $credit->role }}</span>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="credit-item">
                   <img src="https://i.discogs.com/ybMm_0uVnr36tXqpU8rivrlaIuTGe118KVYo0hZtwEM/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTQ3MjAw/OS0xMjA4NTQ2MjUz/LmpwZWc.jpeg" alt="Steve Tirpak" class="image_RSPxy" width="60px" height="40px">
                    <div class="credit-info">
                        <a href="#">Steven Tirpak*</a>
                        <span>Arranged By [Strings, Co]</span>
                    </div>
                </div>
                <div class="credit-item">
                    <img src="https://i.discogs.com/VohVwMYOWsSIs1sRFOLr6ATRfBRRv1uXHedPr9Pf2bo/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTIxMzI4/MC0xNTkxNDc3MDc2/LTc3MTEuanBlZw.jpeg" alt="Larry Gold" class="image_RSPxy" width="60px" height="40px">
                    <div class="credit-info">
                        <a href="#">Larry Gold</a>
                        <span>Arranged By [Strings]</span>
                    </div>
                </div>
                <div class="credit-item">
                    <img src="https://i.discogs.com/UYK3QABIA2glrBqrn4y_LtiCix9wNPPsQrWgl-x0Vt0/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTcyNDY4/NC0xNDM1OTE0MTg0/LTkzNzAuanBlZw.jpeg" alt="Glenn Fischbach" class="image_RSPxy" width="60px" height="40px">
                    <div class="credit-info">
                        <a href="#">Glenn Fischbach</a>
                        <span>Cello</span>
                    </div>
                </div>
                <div class="credit-item">
                    <img src="https://i.discogs.com/VohVwMYOWsSIs1sRFOLr6ATRfBRRv1uXHedPr9Pf2bo/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTIxMzI4/MC0xNTkxNDc3MDc2/LTc3MTEuanBlZw.jpeg" alt="Larry Gold" class="image_RSPxy" width="60px" height="40px">
                    <div class="credit-info">
                        <a href="#">Larry Gold</a>
                        <span>Conductor [Strings]</span>
                    </div>
                </div>
                <div class="credit-item">
                    <img src="https://i.discogs.com/4wV9jzZ8OX1L0NVY2utfB5uhHhD85DmErfF-IC7Q1OU/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTcwMTMx/OTItMTY0MzE0MTQ4/Ni0xNjIwLmpwZWc.jpeg" alt="Daniel Rodriguez (15)" class="image_RSPxy" width="60px" height="40px">
                    <div class="credit-info">
                        <a href="#">Daniel Rodriguez (15)</a>
                        <span>Congas</span>
                    </div>
                </div>
                <div class="credit-item">
                    <img src="https://i.discogs.com/ybMm_0uVnr36tXqpU8rivrlaIuTGe118KVYo0hZtwEM/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTQ3MjAw/OS0xMjA4NTQ2MjUz/LmpwZWc.jpeg" alt="Steve Tirpak" class="image_RSPxy" width="80px" height="40px">
                    <div class="credit-info">
                        <a href="#">Steven Tirpak*</a>
                        <span>Copyist</span>
                    </div>
                </div>
            @endif
        </div>

    </div>
    <!-- end .album-left -->

    <!-- ══════════════════════════════════════
         RIGHT COLUMN
    ══════════════════════════════════════ -->
    <div class="album-right">

        <!-- Master Release -->
        <div class="master-release-header">
            <span>Master Release</span>
            <span class="release-id">
                <span class="release-icon"></span>
                [m{{ $album->master_id ?? '4146559' }}]
            </span>
        </div>
        <div class="master-release-links">
            <a href="#">Edit Master Release</a>
            <span style="color:black;">Recently Edited</span>
        </div>

        <!-- For Sale -->
        <div class="for-sale-header">
            <span>For Sale</span>
            <a href="#">Sell a copy</a>
        </div>

        <div class="release-card">
            <img src="https://i.discogs.com/7OyH6ag4ze3_wbHt4uIxkLeqUlQDUgBHP0eL9oWGu8A/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTM2NjI4/NDIwLTE3NzIyOTE4/NzAtNTQ5Ny5qcGVn.jpeg" alt="Bruno Mars - The Romantic album cover" width="150" height="147" >
            <div class="release-card-info">
                <div class="label">Master Release</div>
                <div class="title">{{ $album->title ?? 'The Romantic' }}</div>
                <div class="year">{{ $album->year ?? '2026' }}</div>
                <div class="formats">
                    <a href="#"><u>Vinyl</u></a><span> • </span><a href="#"><u>CD</u></a><span> • </span><a href="#"><u>Cassette</u></a>
                </div>
                <div class="price-range">From $12 to $1,000</div>
            </div>
        </div>

        <a href="#" class="btn-shop">Shop {{ $album->listing_count ?? '414' }} Listings</a>

        <!-- Statistics -->
        <div class="statistics-header">Statistics</div>
        <div class="stats-grid">
            <div class="stat-pair">
                <div class="stat-label">Have:</div>
                <div class="stat-value"><a href="#">{{ $album->have_count ?? '9289' }}</a></div>
            </div>

            <div class="stat-pair">
                <div class="stat-label">Avg Rating:</div>
                <div class="stat-value">{{ $album->avg_rating ?? '4.7' }} / 5</div>
            </div>
            
            <div class="stat-pair">
                <div class="stat-label">Want:</div>
                <div class="stat-value"><a href="#">{{  $album->want_count ?? '1103' }}</a></div>
            </div>

            <div class="stat-pair">
                <div class="stat-label">Ratings:</div>
                <div class="stat-value"><a href="#">{{ $album->ratings_count ?? '1377' }}</a></div>
            </div>
        </div>

        <!-- Share -->
        <button class="share-btn">
            <svg class="share-icon" viewBox="0 0 24 24">
            <path path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"></path>
            <path d="M5 5h6v2H7v10h10v-4h2v6H5z"></path>
            </svg>Share
        </button>

        <!-- Videos -->
        <div class="videos-header">
            Videos ({{ $album->video_count ?? '6' }})
            <span class="info-icon">i</span>
            <a href="#" class="edit-link">Edit</a>
        </div>

        <div class="video-thumb">
            @if(isset($album->video_thumbnail))
                <img src="{{ $album->video_thumbnail }}" alt="Video thumbnail">
            @else
                <img src="{{ asset('images/default-video-thumb.jpg') }}" alt="Video thumbnail">
            @endif
            <div class="play-btn"></div>
        </div>

        <a href="#" class="video-more-link">{{ $album->artist ?? 'Bruno Mars' }} - {{ $album->title ?? 'The Romantic' }} (Full Album)</a>

    </div>
    <!-- end .album-right -->

</div>

@endsection