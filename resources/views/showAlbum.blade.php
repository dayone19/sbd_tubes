@extends('layouts.app')

@section('title', isset($album) ? 'Album - ' . $album->title : 'Album')

@section('content')

<style>
    * {
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

    .page-wrapper {
        display: flex;
        max-width: 1300px;
        margin: 0 auto;
        gap: 0;
    }

    .main-content {
        flex: 1;
        padding: 0 0 20px 0;
        min-width: 0;
    }

    .show-more-credits {
        text-align: center;
        border-top: 1px solid #ddd;
        border-bottom: 1px solid #ddd;
        padding: 8px 0;
        font-size: 13px;
        color: #333;
        cursor: pointer;
        background: #fff;
        border: 1px solid #ddd;
    }

    .show-more-credits a {
        color: #333;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .show-more-credits a:hover {
        color: #0000ff;
    }

    .show-more-credits .arrow {
        font-size: 10px;
    }

    .versions-header {
        padding: 16px 0 8px 0;
    }

    .versions-header h2 {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 12px;
    }

        /* Filter section */
        .filter-section {
            padding: 0 0 10px 0;
        }

        .filter-label {
            font-size: 13px;
            color: #333;
            margin-bottom: 8px;
            margin-top: 8px;
        }

        .filter-title {
            font-size: 12px;
            color: #555;
            margin-bottom: 3px;
        }

        .filter-row {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
        }

    .filter-select {
        flex: 1;
        min-width: 150px;
        position: relative;
    }

    .filter-select select {
        width: 100%;
        padding: 6px 30px 6px 10px;
        font-size: 13px;
        color: #555;
        border: 1px solid #000;
        border-radius: none;
        background: #fff;
        appearance: none;
        -webkit-appearance: none;
        cursor: pointer;
        outline: none;
        height: 32px;              
        line-height: normal; 
        display: flex;
        align-items: center;
        position: relative;  
    }

        .filter-select select:hover {
            border-color: #aaa;
        }

    .filter-select::after {
        content: '▾';
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
        pointer-events: none;
        font-size: 12px;
    }

        /* Search barcode */
        .barcode-search {
            margin-top: 10px;
            position: relative;
        }

        .barcode-search input {
            width: 100%;
            padding: 7px 36px 7px 10px;
            font-size: 13px;
            border: 1px solid #000;
            border-radius: none;
            outline: none;
            color: #555;
        }

        .barcode-search input:focus {
            border-color: #aaa;
        }

        .barcode-search input::placeholder {
            color: #999;
        }

        .barcode-search .search-btn {
            position: absolute;
            right: 0;
            top: 0;
            bottom: 0;
            width: 36px;
            border: none;
            background: transparent;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #555;
            font-size: 14px;
        }

        .barcode-search .search-btn:hover {
            color: #333;
        }

        /* Versions table header */
    .versions-table-header {
        background: #e8e8e8;
        display: flex;
        align-items: center;
        padding: 8px 10px;
        margin-top: 16px;
    }

        .versions-count {
            flex: 1;
            font-size: 13px;
            color: #333;
        }

        .add-wantlist-btn {
            background: #333;
            color: #fff;
            border: none;
            padding: 7px 14px;
            font-size: 13px;
            cursor: pointer;
            border-radius: 3px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        .add-wantlist-btn:hover {
            background: #555;
        }

        .add-wantlist-btn .btn-arrow {
            font-size: 10px;
            border-left: 1px solid #666;
            padding-left: 6px;
            margin-left: 2px;
        }

        /* Table column headers */
    .table-col-headers {
        display: grid;
        grid-template-columns: 1fr 220px 120px 80px 40px;
        padding: 8px 10px;
        background: #e8e8e8;
        }

        .table-col-headers span {
            font-size: 12px;
            font-weight: bold;
            color: #333;
        }

        .col-year {
            display: flex;
            align-items: center;
            gap: 4px;
            cursor: pointer;
        }

        .col-year .sort-arrow {
            font-size: 10px;
            color: #666;
        }

        .col-view-toggle {
            display: flex;
            gap: 5px;
            justify-content: flex-end;
        }

        .view-btn {
            width: 26px;
            height: 26px;
            border: 1px solid #ccc;
            background: #fff;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 13px;
            color: #555;
            border-radius: 2px;
        }

        .view-btn.active {
            background: #555;
            color: #fff;
            border-color: #555;
        }

        /* Version rows */
        .version-row {
            display: grid;
            grid-template-columns: 1fr 220px 120px 80px 40px;
            padding: 12px 10px;
            border-bottom: 1px solid #eee;
            align-items: center;
            background: #fff;
        }


        .version-row:hover {
            background: #fafafa;
        }

        .version-row + .version-row {
            border-top: none;
        }

        .version-title-col {}

        .version-title {
            font-size: 13px;
            color: #0000ff;
            text-decoration: none;
            font-weight: normal;
        }

        .version-title:hover {
            text-decoration: underline;
        }

        .version-format {
            font-size: 12px;
            color: #555;
            margin-top: 2px;
        }

        .version-format em {
            font-style: italic;
            color: #c00;
        }



        .version-label {
            font-size: 13px;
        }

        .version-label a {
            color: #0000ff;
            text-decoration: none;
        }

        .version-label a:hover {
            text-decoration: underline;
        }

        .version-country {
            font-size: 13px;
            color: #333;
        }

        .version-year {
            font-size: 13px;
            color: #333;
        }

        .version-expand {
            background: none;
            border: none;
            cursor: pointer;
            font-size: 14px;
            color: #555;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: flex-end;
        }

        .version-expand:hover {
            color: #333;
        }

        /* Yellow left border on rows */
    .version-row-wrapper {
        border-right: 4px solid #f5a623;
        margin-bottom: 5px;
        background: #fff;
        margin: 6px 10px;
    }

    .version-list {
        background: #e8e8e8; 
        padding: 6px 0; 
    }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            width: 260px;
            flex-shrink: 0;
            padding: 0 0 20px 20px;
            height: 100%;
        }

        /* Video/media placeholder */
        .sidebar-media {
            margin-bottom: 16px;
        }

        .media-item {
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 12px;
        }

        .media-thumb {
            width: 60px;
            height: 60px;
            background: #000;
            flex-shrink: 0;
            position: relative;
            overflow: hidden;
        }

        .media-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            opacity: 0.8;
        }

        .media-progress {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: #555;
        }

        .media-progress-bar {
            height: 100%;
            background: #fff;
            width: 0%;
        }

        .media-time {
            position: absolute;
            bottom: 4px;
            left: 4px;
            font-size: 10px;
            color: #fff;
        }

        .media-info a {
            font-size: 13px;
            color: #0000ff;
            text-decoration: none;
            font-weight: bold;
        }

        .media-info a:hover {
            text-decoration: underline;
        }

        .sidebar-collapse-btn {
            display: block;
            text-align: center;
            color: #aaa;
            font-size: 18px;
            cursor: pointer;
            margin-top: 4px;
        }

        /* Lists section */
        .sidebar-section {
            margin-top: 12px;
        }

        .sidebar-section-header {
            display: flex;
            align-items: baseline;
            gap: 8px;
            margin-bottom: 8px;
        }

        .sidebar-section-header h3 {
            font-size: 14px;
            font-weight: bold;
            color: #333;
        }

        .sidebar-section-header a {
            font-size: 13px;
            color: #0000ff;
            text-decoration: none;
        }

        .sidebar-section-header a:hover {
            text-decoration: underline;
        }

        .list-item {
            font-size: 13px;
            line-height: 1.8;
            color: #333;
        }

        .list-item a {
            color: #0000ff;
            text-decoration: none;
        }

        .list-item a:hover {
            text-decoration: underline;
        }

        .view-more-lists {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 13px;
    color: #2a5bd7;
    text-decoration: none;
    transition: all 0.2s ease;
}

.view-more-lists::after {
    content: " →"; /* panah */
    font-size: 14px;
    transition: transform 0.2s ease;
}

.view-more-lists:hover {
    text-decoration: underline;
}

.view-more-lists:hover::after {
    transform: translateX(3px); /* animasi geser dikit */
}

        /* Ad placeholder */
        .sidebar-ad {
            margin-top: 20px;
            width: 220px;
            height: 220px;
            background: #1a1a2e;
            border-radius: 4px;
            overflow: hidden;
            position: relative;
        }

        .sidebar-ad img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .sidebar-ad-overlay {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,0.6);
            color: #fff;
            font-size: 13px;
            font-weight: bold;
            padding: 8px 10px;
            line-height: 1.3;
        }

        .sidebar-ad-badge {
            position: absolute;
            top: 6px;
            right: 6px;
            background: rgba(255,255,255,0.9);
            border-radius: 2px;
            width: 18px;
            height: 18px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 10px;
            color: #333;
        }

        .sidebar-ad-logo {
            position: absolute;
            top: 6px;
            left: 6px;
            background: #fff;
            border-radius: 2px;
            padding: 2px 5px;
            font-size: 10px;
            font-weight: bold;
            color: #333;
        }

        #video-sidebar-section {
        margin-top: 10px;
        border-top: none;
        padding-top: 15px;
        display: flex;
        flex-direction: column;
        max-height: 400px;
    }
    #video-sidebar-section .v-header {
        display: flex;
        gap: 8px; 
        align-items: center;
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd; 
    }
    #video-sidebar-section h2 { font-size: 13px; font-weight: bold; margin: 0; }
    
    .main-player {
    width: 100%;
    height: 220px; /* tambahin ini */
    background-color: #000;
    position: relative;
    display: flex;
    justify-content: center;
    align-items: center;
    margin-bottom: 10px;
    height: 250px;
}
    .main-player img { width: 100%; height: 100%; object-fit: cover; opacity: 0.8; }
    .play-btn-overlay {
        position: absolute;
        width: 50px;
        height: 35px;
        background: rgba(0,0,0,0.7);
        border-radius: 8px;
        display: flex;
        justify-content: center;
        align-items: center;
    }
    .play-btn-overlay::after {
        content: '';
        border-style: solid;
        border-width: 7px 0 7px 12px;
        border-color: transparent transparent transparent #fff;
    }

    .v-list {
    max-height: 200px;
    overflow-y: auto;

    flex: 1;          /* penting */
    min-height: 0;    /* SUPER penting buat scroll di flex */
}
    .v-item { display: flex; gap: 10px; padding: 5px 0; cursor: pointer; border-bottom: 1px solid #f0f0f0; }
    .v-item:hover { background: #f9f9f9; }
    .v-thumb { width: 100px; height: 60px; position: relative; flex-shrink: 0; }
    .v-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .v-time { position: absolute; bottom: 2px; right: 2px; background: #000; color: #fff; font-size: 10px; padding: 0 3px; }
    .v-title { font-size: 13px; color: #2a5bd7; line-height: 1.2; }

    /* Custom scrollbar untuk list video */
    .v-list::-webkit-scrollbar {
    width: 6px;
}

.v-list::-webkit-scrollbar-thumb {
    background: #ccc;
    border-radius: 10px;
}

.v-list::-webkit-scrollbar-thumb:hover {
    background: #999;
}

    .l-section { border-top: none; padding-top: 0px; }
    .l-section a { display: inline; font-size: 13px; margin-bottom: 3px; color: #2a5bd7; }
    .filter-box {
    display: flex;
    justify-content: space-between;
    padding: 8px 10px;
    background: white;
    border: 1px solid black; 
    border-radius: 0;        
    cursor: pointer;
    width: 200px;
}

.filter-item {
    padding: 6px 10px;
    border-radius: 5px;
    cursor: pointer;
}

.filter-item:hover {
    background: #f2f2f2;
}

.hidden {
    display: none;
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

        <div class="page-wrapper">

    <!-- ===== MAIN CONTENT ===== -->
    <div class="main-content">

        <!-- Show more credits -->
        <div class="show-more-credits">
            <a href="#">
                <span class="arrow">▾</span>
                Show more credits...
            </a>
        </div>

        <!-- Versions heading -->
        <div class="section-title">Versions</div>

        <!-- Filter by -->
        <div class="filter-section">
            <div class="filter-label">Filter by</div>
            <div class="filter-row">
                <div class="filter-select">
                    <div class="filter-title">Format</div>
                    <select>
                        <option value="">Find a format</option>
                        <option value="lp">LP</option>
                        <option value="cd">CD</option>
                        <option value="cassette">Cassette</option>
                    </select>
                </div>

                <div class="filter-select">
                    <div class="filter-title">Format</div>
                    <select>
                        <option value="">Find a label or comp...</option>
                        <option value="atlantic">Atlantic</option>
                        <option value="columbia">Columbia</option>
                    </select>
                </div>
                <div class="filter-select">
                    <div class="filter-title">Format</div>
                    <select>
                        <option value="">Find a country</option>
                        <option value="usa">USA</option>
                        <option value="europe">Europe</option>
                        <option value="uk">UK</option>
                    </select>
                </div>
                <div class="filter-select">
                    <div class="filter-title">Format</div>
                    <select>
                        <option value="">Find a year</option>
                        <option value="2026">2026</option>
                        <option value="2025">2025</option>
                        <option value="2024">2024</option>
                    </select>
                </div>
            </div>

            <!-- Barcode search -->
            <div class="barcode-search">
                <input type="text" placeholder="Search barcodes and other identifiers...">
                <button class="search-btn">&#128269;</button>
            </div>
        </div>

        <!-- Table header bar -->
        <div class="versions-table-header">
            <span class="versions-count">23 versions</span>
            <button class="add-wantlist-btn">
                Add to Wantlist
                <span class="btn-arrow">▾</span>
            </button>
        </div>

        <!-- Column headers -->
        <div class="table-col-headers">
            <span>Title, Format</span>
            <span>Label – Catalog Number</span>
            <span>Country</span>
            <span class="col-year">Year <span class="sort-arrow">▾</span></span>
            <span class="col-view-toggle">
                <button class="view-btn">&#9783;</button>
                <button class="view-btn active">&#9776;</button>
            </span>
        </div>

    <div class="version-list">
        <!-- Version Row 1 -->
        <div class="version-row-wrapper">
            <div class="version-row">
                <div class="version-title-col">
                    <div><a href="#" class="version-title">The Romantic</a></div>
                    <div class="version-format">LP, Album, Limited Edition, <em>Red Translucent</em></div>
                </div>
                <div class="version-label">
                    <a href="#">Atlantic</a> – 075678590511
                </div>
                <div class="version-country">USA &amp; Europe</div>
                <div class="version-year">2026</div>
                <button class="version-expand">▾</button>
            </div>
        </div>

        <!-- Version Row 2 -->
        <div class="version-row-wrapper">
            <div class="version-row">
                <div class="version-title-col">
                    <div><a href="#" class="version-title">The Romantic</a></div>
                    <div class="version-format">LP, Album, <em>White</em></div>
                </div>
                <div class="version-label">
                    <a href="#">Atlantic</a> – 075678590511
                </div>
                <div class="version-country">Europe</div>
                <div class="version-year">2026</div>
                <button class="version-expand">▾</button>
            </div>
        </div>
    </div>
    </div>
    </div>
</div>

    <!-- end .album-left -->

    <!--  RIGHT COLUMN -->
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

        
                    <div id="video-sidebar-section">
                <div class="v-header">
                    <h2>Videos (6)</h2>
                    <a href="#" class="small">Edit</a>
                </div>

                <div class="main-player" id="mainPlayer">
                    <img src="https://via.placeholder.com/400x225/222/fff?text=BRUNO+MARS+VIDEO" id="currentThumb">
                    <div class="play-btn-overlay"></div>
                </div>

                <div class="v-list">
                    <div class="v-item" onclick="changeVideo('https://via.placeholder.com/400x225/111/fff?text=FULL+ALBUM', 'Full Album')">
                        <div class="v-thumb">
                            <img src="https://via.placeholder.com/100x60/333/fff?text=Play">
                            <span class="v-time">45:10</span>
                        </div>
                        <div class="v-title"><b>Bruno Mars - The Romantic (Full Album)</b></div>
                    </div>

                    <div class="v-item" onclick="changeVideo('https://via.placeholder.com/400x225/444/fff?text=MUSIC+VIDEO', 'Official Video')">
                        <div class="v-thumb">
                            <img src="https://via.placeholder.com/100x60/555/fff?text=Play">
                            <span class="v-time">3:45</span>
                        </div>
                        <div class="v-title"><b>Bruno Mars - The Romantic (Official Video)</b></div>
                    </div>
                </div>

                <div class="l-section">

    <!-- HEADER -->
    <div class="d-flex align-items-center mb-2">
        <h2 class="mb-0 me-2" style="font-size: 15px;">Lists</h2>
        <a href="#" class="small text-decoration-none" style="position: relative; top: 4px;">
            Add to List
        </a>
    </div>

    <hr class="my-2">

    <!-- LIST -->
    <div>
        <div><a href="#">listening log</a> by <a href="#">agasa</a></div>
        <div><a href="#">Albums/EPs I've Listened To</a> by <a href="#">DylanBryl</a></div>
        <div><a href="#">ren</a> by <a href="#">sirenzz</a></div>
        <div><a href="#">Albums I Really Want</a> by <a href="#">Britliz1960</a></div>
        <div><a href="#">.past - present - eternal.</a> by <a href="#">BubbleBuzz</a></div>
    </div>

    <hr class="my-2">

    <!-- FOOTER -->
    <a href="#" class="view-more-lists">View More List</a>
</div>

        
    </div>
    <!-- end .album-right -->

</div>

@endsection