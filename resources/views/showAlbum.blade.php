@extends('layouts.app')

@section('title', isset($album) ? 'Album - ' . $album->title : 'Album')

@section('content')

<style>
    * {box-sizing: border-box;}
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
    .album-cover-wrap a:hover {text-decoration: underline;}
    .album-meta {flex: 1;padding-top: 4px;}
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
    .add-wantlist-btn:hover {background: #555;}
    .add-wantlist-btn .btn-arrow {
        font-size: 10px;
        border-left: 1px solid #666;
        padding-left: 6px;
        margin-left: 2px;
    }

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


        .sidebar-collapse-btn {
            display: block;
            text-align: center;
            color: #aaa;
            font-size: 18px;
            cursor: pointer;
            margin-top: 4px;
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
    max-height: 300px;
    overflow-y: auto;
    flex: 1;          /* penting */
    min-height: 150px; 
    margin-bottom:20px;   /* SUPER penting buat scroll di flex */
}
    .v-item { display: flex; gap: 10px; padding: 5px 0; cursor: pointer; border-bottom: 1px solid #f0f0f0; }
    .v-item:hover { background: #f9f9f9; }
    .v-thumb { width: 100px; height: 60px; position: relative; flex-shrink: 0; }
    .v-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .v-time { position: absolute; bottom: 2px; right: 2px; background: #000; color: #fff; font-size: 10px; padding: 0 3px; }
    .v-title { font-size: 13px; color: #2a5bd7; line-height: 1.2; }
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
.l-section a { display: inline; font-size: 13px; margin-bottom: 3px; color: #2a5bd7; }
.l-section { margin-top: 20px;font-size: 13px;}
.l-header {display: flex;align-items: center;margin-bottom: 8px;}
.l-header h2 {font-size: 14px;margin: 0;}
.l-list {display: flex; flex-direction: column;gap: 8px;}
.l-item {padding: 6px 0;border-bottom: 1px solid #eee;}
.l-item a {color: #2a5bd7;text-decoration: none;font-weight: 500;}
.l-item a:hover {text-decoration: underline;}
.l-meta {font-size: 12px;color: #777;}
.l-footer {margin-top: 8px;}
/* Reviews Section */
.reviews-title {
    font-size: 15px;
    font-weight: bold;
    color: #000;
    margin-top: 25px;
    padding-bottom: 10px;
    border-bottom: 1px solid #ccc;
    margin-bottom: 16px;
}
   .add-review-btn {
    display: inline-block;

    padding: 4px 10px;
    font-size: 12px;

    background-color: #f5f5f5;
    border: 1px solid #ccc;
    border-radius: 2px;

    cursor: pointer;
    color: #333;

    margin-bottom: 20px;
}
    .add-review-btn:hover {background-color: #e8e8e8;}
    .review-item {
    border-top: 1px solid #e0e0e0;
    padding: 10px 0;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    position: relative;
}
    .avatar {
    width: 48px;
    height: 48px;
    border-radius: 0;
    background-color: #c8c8c8;
    flex-shrink: 0;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;
}
    .avatar img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .avatar-icon {
      width: 100%;
      height: 100%;
      background: #bbb;
      display: flex;
      align-items: center;
      justify-content: center;
    }
 
    .avatar-icon svg {
      width: 30px;
      height: 30px;
      fill: #888;
    }
 
    .review-content {
      flex: 1;
    }
 
    .review-header {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 1px;
}
 
    .review-username {
      color: #1a73e8;
      font-weight: bold;
      font-size: 14px;
      text-decoration: none;
    }
 
    .review-date {
      color: #666;
      font-size: 13px;
    }
 
    .stars {
      display: flex;
      gap: 1px;
      margin-bottom: 6px;
    }
 
    .star {
      color: #e67e22;
      font-size: 18px;
    }
 
    .review-text {
    color: #333;
    font-size: 12px;
    line-height: 1.3;
    margin-bottom: 5px;
}
 
    .review-actions {
      display: flex;
      gap: 16px;
    }
 
    .action-link {
      color: #1a73e8;
      font-size: 13px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 4px;
      cursor: pointer;
    }
 
    .action-link:hover {
      text-decoration: underline;
    }
 
    .action-icon {
      font-size: 13px;
    }
 
    .dropdown-arrow {
      position: absolute;
      right: 0;
      top: 20px;
      color: #555;
      font-size: 12px;
      cursor: pointer;
    }
        
    .review-form-wrap {
    display: none;
    margin-bottom: 20px;
    margin-top: 20px;
  }

  .review-form-title {
    font-size: 15px;
    font-weight: bold;
    margin-bottom: 10px;
  }

  .review-textarea {
    width: 100%;
    height: 100px;
    padding: 8px 10px;
    font-size: 13px;
    border: 2px solid #4a90d9;
    border-radius: 8px;
    resize: vertical;
    outline: none;
    box-sizing: border-box;
    font-family: Arial, Helvetica, sans-serif;
  }

  .review-preview-box {
    display: none;
    margin-top: 6px;
  }

  .review-preview-label {
    font-size: 13px;
    font-weight: bold;
    margin-bottom: 4px;
  }

  .review-preview-text {
    border: 1px solid #ccc;
    padding: 8px 10px;
    font-size: 13px;
    color: #333;
    background: #fff;
    min-height: 30px;
  }

  .review-word-warning {
    display: none;
    margin-top: 6px;
    font-size: 12px;
    color: #555;
  }

  .review-word-warning em {
    font-style: italic;
  }

  .review-form-footer {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 10px;
  }

  .review-submit-btn {
    padding: 6px 16px;
    font-size: 13px;
    background: #ccc;
    color: #888;
    border: 1px solid #bbb;
    border-radius: 2px;
    cursor: not-allowed;
  }

  .review-submit-btn.active {
    background: #e8e8e8;
    color: #333;
    border-color: #ccc;
    cursor: pointer;
  }

  .review-help-link {
    color: #7b2d8b;
    font-size: 13px;
    text-decoration: none;
  }

  .review-help-link:hover {
    text-decoration: underline;
  }
  .review-menu {
    position: absolute;
    top: 10px;
    right: 0;
}

.menu-btn {
    background: none;
    border: none;
    cursor: pointer;
    font-size: 14px;
    color: #333;
}

.menu-dropdown {
    display: none;
    position: absolute;
    right: 0;
    top: 22px;
    width: 110px;
    background: #f3f3f3;
    border: 1px solid #cfcfcf;
    box-shadow: 0 2px 6px rgba(0,0,0,0.15);
    z-index: 999;
}

.menu-dropdown a {
    display: block;
    padding: 10px 12px;
    color: #000;
    text-decoration: none;
    font-size: 14px;
    border-bottom: 1px solid #ddd;
}

.menu-dropdown a:last-child {
    border-bottom: none;
}

.menu-dropdown a:hover {
    background: #e8e8e8;
}

.delete-link {
    color: #000;
}

.widget {
        font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Text', 'Helvetica Neue', sans-serif;
        background: #fff;
        width: 285px; 
        border-radius: 0;
        box-shadow: none; 
        overflow: hidden;
    }
 
    /* Header */
    .header {
      padding: 5px 10px 2px;
      border-bottom: 1px solid #e5e5e5;
    }
    .header span {
      font-size: 11px;
      font-weight: 600;
      color: #000;
    }

    .music-content {
        background: #f9f9f9;
        border-radius: 8px;
    }
 
    /* Apple Music Bar */
.music-bar {
  display: flex;
  align-items: center;
  justify-content: space-between;
  margin-top: 5px;
  padding: 7px 10px;
  background: #f9f9f9;
}

    .music-bar-left {
      display: flex;
      align-items: center;
      gap: 4px;
    }
    .music-bar-left span {
      font-size: 12px;
      font-weight: 500;
      color: #000;
      letter-spacing: -0.2px;
      margin-bottom: 4px;
    }
    .btn-signin {
      background: #f0f0f0;
      border: none;
      border-radius: 12px;
      padding: 3px 10px;
      font-size: 11px;
      font-weight: 400;
      color: #333;
      cursor: pointer;
    }
 
    /* Album Info */
    .album-info {
      display: flex;
      align-items: center;
      justify-content: space-between;
      padding: 10px;
      border-bottom: 1px solid #f0f0f0;
    }
    .album-info-left {
      display: flex;
      align-items: center;
      gap: 10px;
    }
    .album-art {
      width: 40px;
      height: 40px;
      border-radius: 4px;
      overflow: hidden;
      flex-shrink: 0;
      background: #3a3a3a;
    }
    .album-art img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
    .album-title {
      font-size: 12px;
      font-weight: 600;
      color: #000;
      line-height: 1.3;
    }
    .album-artist {
      font-size: 11px;
      color: #888;
      margin-top: 1px;
    }
    .btn-dots {
      background: none;
      border: none;
      cursor: pointer;
      padding: 4px;
      display: flex;
      align-items: center;
      justify-content: center;
    }
 
    /* Track List */
    .track {
      display: flex;
      align-items: center;
      padding: 7px 10px;
      border-bottom: 1px solid #f0f0f0;
    }
    .track-num {
      font-size: 11px;
      color: #aaa;
      width: 18px;
      text-align: right;
      margin-right: 12px;
      flex-shrink: 0;
    }
    .track-name {
      font-size: 12px;
      color: #000;
    }
    .track.dimmed .track-num,
    .track.dimmed .track-name {
      color: #ccc;
    }
 
    /* Play Button */
    .play-wrap {
      padding: 10px;
    }

    .btn-play {
      width: 100%;
      background: #FC3C44;
      border: none;
      border-radius: 8px;
      padding: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      cursor: pointer;
    }
    .btn-play span {
      color: #fff;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: -0.2px;
    }
 
    /* View in App */
    .view-app {
      text-align: center;
      padding: 0px 10px 10px;
    }
    .view-app a {
      color: #FC3C44;
      font-size: 12px;
      font-weight: 600;
      text-decoration: none;
    }
    .see {
      text-align: right;
      padding: 6px 0px 0px 0px;
      font-size: 9px ;
    }

    .footer {
  padding: 6px 10px 10px;
  text-align: right;
  background: #f9f9f9;
}

.footer span {
  font-size: 10px;
  color: #aaa;
}

.custom-btn{
    background:#e8e5dd !important;
    color:#000 !important;
    text-align:center;
    transition:0.2s;
}

.custom-btn:hover{
    background:#000 !important;
    color:#fff !important;
}

  /* Play Button */
    .play-wrap {padding: 10px;}
    .btn-play {
      width: 100%;
      background: #FC3C44;
      border: none;
      border-radius: 8px;
      padding: 10px;
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 6px;
      cursor: pointer;
    }
    .btn-play span {
      color: #fff;
      font-size: 13px;
      font-weight: 600;
      letter-spacing: -0.2px;
    }
    /* View in App */
    .view-app {text-align: center;padding: 0px 10px 10px;}
    .view-app a {
      color: #FC3C44;
      font-size: 12px;
      font-weight: 600;
      text-decoration: none;
    }
    .footer {
  padding: 6px 10px 10px;
  text-align: left;
  background: #f9f9f9;
}
.footer span {font-size: 10px;color: #aaa;}
.track .play-icon-hover {
    display: none;
    color: #FC3C44;
    font-size: 10px;
    width: 25px;
    text-align: center;}
.track:hover {background-color: #efefef; cursor: pointer;}
.track:hover .track-num { display: none;}
.track:hover .play-icon-hover { display: inline-block; }
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
               <img src="{{$album->image ?? 'https://via.placeholder.com/200'}}" alt = "{{$album->title}}" width="150" height="147" >
                <a href="#">More images</a>
            </div>
            <div class="album-meta">
                <div class="album-title">
                    @foreach($artists as $artist)
                     <a href="{{ route('show.artist', $artist->artist_id) }}" class="artist-name">{{ $artist->name }}</a>@if(!$loop->last), @endif
                    @endforeach
                    &ndash; {{ $album->title}}
                </div>
                <table class="album-info-table">
                    <tr>
                        <td>Genre:</td>
                        <td>
                            @foreach($genres as $genre)
                                    <a href="#">{{ $genre }}</a>@if(!$loop->last), @endif
                            @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Style:</td>
                        <td>
                            @if($styles->isNotEmpty())
                                @foreach($styles as $style)
                                    <a href="#">{{ $style }}</a>@if(!$loop->last), @endif
                                @endforeach
                            @else
                                &nbsp;
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <td>Year:</td>
                        <td><a href="#">{{ $album->year }}</a></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Tracklist -->
        <div class="section-title">Tracklist</div>
        <table class="tracklist">

                @foreach($tracks as $track)
                    <tr>
                        <td>{{ $track->title }}</td>
                        <td style="text-align:right; width:60px; color:#555;">
                           {{ \Carbon\Carbon::parse($track->duration)->format('i:s') ? ltrim(\Carbon\Carbon::parse($track->duration)->format('i:s'), '0') : '0:00' }}
                        </td>
                    </tr>
                @endforeach

        </table>

        <!-- Credits -->
        <div class="section-title" style="margin-top:20px;">
            Credits ({{ $credits_count }})
        </div>
        <div class="credits-grid">

                @foreach($credits as $credit)
                    <div class="credit-item">
                        <img src="{{ $credit->photo ?? asset('images/default-person.jpg') }}" alt="{{ $credit->name }}">
                        <div class="credit-info">
                            <a href="#">{{ $credit->name }}</a>
                            <span>{{ $credit->role }}</span>
                        </div>
                    </div>
                @endforeach

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
        <form method="GET" action="{{route('album.versions', $album->master_id) }}">
        <div class="filter-section">
            <div class="filter-label">Filter by</div>
            <div class="filter-row">
                <div class="filter-select">
                    <div class="filter-title">Format</div>
                    <select name="format">
                        <option value="">Find a format</option>
                        @foreach($formats as $f)
                        <option value="{{ $f }}">{{ $f }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="filter-select">
                    <div class="filter-title">Label</div>
                    <select name="label">
                        <option value="">Find a label</option>
                        @foreach($labels as $l)
                        <option value="{{ $l }}">{{ $l }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-select">
                    <div class="filter-title">Country</div>
                    <select name="country">
                        <option value="">Find a country</option>
                        @foreach($countries as $c)
                        <option value="{{ $c }}">{{ $c }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="filter-select">
                    <div class="filter-title">Year</div>
                    <select name="year">
                        <option value="">Find a year</option>
                        @foreach($years as $y)
                        <option value="{{ $y }}">{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <!-- Barcode search -->
            <div class="barcode-search">
                <input type="text" name="barcode" value="{{ request('barcode') }}" placeholder="Search barcodes and other identifiers...">
                <button type="submit" class="search-btn">&#128269;</button>
            </div>
        </div>
    </form>
        <!-- Table header bar -->
        <div class="versions-table-header">
            <span class="versions-count">{{ $versions->count() }} versions</span>
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
                <!-- GRID VIEW -->
                 <button class="view-btn" id="gridBtn"onclick="setGridView()">&#9783;</button>
                <!-- LIST VIEW -->
                 <button class="view-btn active"id="listBtn"onclick="setListView()">&#9776;</button>
            </span>
        </div>


    <div class="version-list">
        <!-- Version Row 1 -->
@foreach($versions as $index => $v)

<div class="version-row-wrapper">

    <div class="version-row">
        <div class="version-title-col" style="display:flex; gap:12px; align-items:flex-start;">
            <img src="{{ $album->image }}" alt="{{ $v->title }}" class="version-image" style="width:80px;height:80px;object-fit:cover;border:1px solid #ccc;display:none;">
            <div>
                <div><a href="#" class="version-title">{{ $v->title }}</a></div>
                <div class="version-format">{{ $v->format }}</div>
            </div>
        </div>

        <div class="version-label"><a href="#">{{ $v->label }}</a> – {{ $v->catalog_number }}</div>
        <div class="version-country">{{ $v->country }}</div>
        <div class="version-year">{{ $v->year }}</div>

        <button class="version-expand" onclick="toggleVersion({{ $index }})" id="btn{{ $index }}">▾</button>
    </div> <div class="version-detail" id="detail{{ $index }}" style="display:none; background:#f7f7f7; border-top:1px solid #ddd; padding:20px;">
        <div style="display:grid; grid-template-columns: 1fr 1fr 250px; gap:20px; align-items:start;">
            
            <div>
                <div><b>{{ $v->dropdown_stats->listing_count ?? 0 }} for sale</b> from €{{ number_format($v->dropdown_stats->lowest_price ?? 0, 2) }}</div>
                <button style="width:100%; background:#000; color:#fff; border:none; padding:14px; cursor:pointer; font-size:14px; border-radius:8px; margin-top:10px;">Shop this version</button>
                <div style="margin-top:20px; font-size:13px; color:#555;">
                    <div>Last Sold: <b>{{ $v->dropdown_stats->last_sold }}</b></div>
                    <div style="display:flex; justify-content:space-between; margin-top:15px;">
                        <div><div>€{{ number_format($v->dropdown_stats->lowest_price ?? 0, 2) }}</div><div style="color:#888; font-size:11px;">Lowest</div></div>
                        <div><div>€{{ number_format($v->dropdown_stats->median_price ?? 0, 2) }}</div><div style="color:#888; font-size:11px;">Median</div></div>
                        <div><div>€{{ number_format($v->dropdown_stats->highest_price ?? 0, 2) }}</div><div style="color:#888; font-size:11px;">Highest</div></div>
                    </div>
                </div>
            </div>

            <div style="font-size:14px;">
                <div style="display:flex; justify-content:space-around; text-align:center; margin-bottom:20px;">
                    <div><div style="color:#666; margin-bottom:5px;">Collected</div><b>{{ $v->dropdown_stats->have ?? 0 }}</b></div>
                    <div><div style="color:#666; margin-bottom:5px;">Wanted</div><b>{{ $v->dropdown_stats->want ?? 0 }}</b></div>
                </div>
                <div style="text-align:center; margin-top:25px;">Ratings <b>{{ $v->dropdown_stats->avg_rating ?? 0 }} / 5</b> ({{ $v->dropdown_stats->total_rating ?? 0 }})</div>
            </div>

            <div style="display:flex; flex-direction:column; gap:10px;">
                <button class="add-wantlist-btn custom-btn">Add to Collection</button>
                <button class="add-wantlist-btn custom-btn">Add to Wantlist</button>
                <button class="add-wantlist-btn custom-btn">Add to List</button>
                <div style="margin-top:20px; font-size:12px; color:#666;">Discogs ID: r{{ $v->release_id }} &nbsp; &nbsp;&nbsp; &nbsp; Recently Edited</div> 
            </div>

        </div> </div> </div> @endforeach
        </div>

    <div class="reviews-title">Reviews</div>
    <form action="{{ route('album.review', $album->master_id) }}" method="POST">
    @csrf
    <div id="reviewForm" class="review-form-wrap" style="display:block;">

    <textarea
        id="reviewInput"
        class="review-textarea"
        placeholder="Enter your comment"
        oninput="validasiReview(submit)"
        name="comment"
    ></textarea>

    <div id="previewBox" class="review-preview-box">
        <div class="review-preview-label">Preview</div>
        <div id="previewText" class="review-preview-text"></div>
    </div>

    <div id="wordWarning" class="review-word-warning">
        <span style="color:#cc0000; font-weight:bold;">&#9432;</span>
        <em id="warningText">At least 10 words must be entered.</em>
    </div>

    <div class="review-form-footer">
        <button type="submit" id="submitBtn" class="review-submit-btn" disabled>Submit</button>
        <a href="#" class="review-help-link">View Help</a>
    </div>
    </div>
    </form>
 
    @foreach($reviews as $review)
    <!-- Review 1 -->
    <div class="review-item">
        <div class="avatar">
        <div class="avatar-icon">
            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 12c2.7 0 4.8-2.1 4.8-4.8S14.7 2.4 12 2.4 7.2 4.5 7.2 7.2 9.3 12 12 12zm0 2.4c-3.2 0-9.6 1.6-9.6 4.8v2.4h19.2v-2.4c0-3.2-6.4-4.8-9.6-4.8z"/>
            </svg>
        </div>
        </div>
        <div class="review-content">
        <div class="review-header">
            <a href="#" class="review-username">{{ $review->username }}</a>
            <span class="review-date">{{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}</span>
        </div>
        <div class="stars" style="color: #e67e22; font-size: 16px; margin-bottom: 5px;">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $review->rating)
                <span>★</span> {{-- Bintang isi --}}
            @else
                <span style="color: #ccc;">★</span> {{-- Bintang kosong/abu-abu --}}
            @endif
        @endfor
        <span style="font-size: 12px; color: #666; margin-left: 5px;">({{ $review->rating }})</span>
        </div>

        <div class="review-reference">
            <em>
                referencing 
                <a href="{{ route('show.release', $review->release_id) }}">
                    {{ $review->release_title }}
                </a>
            </em>
        </div>

        <div class="review-actions">
            <a href="#" class="action-link"><span class="action-icon">↩</span> Reply</a>
            <a href="#" class="action-link"><span class="action-icon">🏷</span> Helpful</a>
        </div>

        <div class="review-text" id="reviewText{{ $review->review_id }}">
            {{ $review->comment }}
        </div>

        <!-- EDIT FORM -->
        <div id="editForm{{ $review->review_id }}" style="display:none; margin-top:10px;">
            <form action="{{ route('review.update', $review->review_id) }}" method="POST">
                @csrf
                @method('PUT')

                <textarea 
                    id="editInput{{ $review->review_id }}" 
                    name="comment" 
                    class="review-textarea" 
                    oninput="validasiReview('edit', {{ $review->review_id }})"
                >{{ $review->comment }}</textarea>

                <div class="review-preview-box" style="display:block; margin-top:10px;">
                    <div class="review-preview-label">Preview</div>
                    <div class="review-preview-text">
                        {{ $review->comment }}
                    </div>
                </div>

                <div class="review-form-footer">
                    <button type="submit" class="review-submit-btn active">
                        Save Changes
                    </button>

                    <a href="#" onclick="hideEditForm({{ $review->review_id }}); return false;" class="action-link">
                        Cancel
                    </a>

                    <a href="#" class="review-help-link">View Help</a>
                </div>
            </form>
        </div>

    </div>

    <div class="review-menu">
        <button class="menu-btn" onclick="toggleMenu(this)">
            ▼
        </button>

        <div class="menu-dropdown">
            <a href="#" onclick="showEditForm({{ $review->review_id }}); return false;">✎ Edit</a>
            <a href="#">⊘ Report</a>
            <form action="{{ route('review.delete', $review->review_id) }}"
                method="POST" onsubmit="return confirm('Delete this review?')">
                @csrf
                @method('DELETE')

                <button type="submit"
                        class="delete-link"
                        style="
                            background:none;
                            border:none;
                            width:100%;
                            text-align:left;
                            padding:10px 12px;
                            cursor:pointer;
                            font-size:14px;
                        ">
                    🗑 Delete
                </button>
            </form>
        </div>
    </div>

  </div>
  @endforeach
 
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
                [m{{ $album->master_id }}]
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
            <img src="{{ $album->image }}" alt="{{$album->title}}" width="150" height="147" >
            <div class="release-card-info">
                <div class="label">Master Release</div>
                <div class="title">{{ $album->title }}</div>
                <div class="year">{{ $album->year }}</div>
                <div class="formats">
                    @if(count($formats) > 0)
                        <a href="#">
                            <u>{{ $formats[0] }}</u>
                        </a>
                    @endif
                </div>
                <div class="price-range">From {{ $stats->lowest_price }} to {{ $stats->highest_price }}</div>
            </div>
        </div>

        <a href="{{ route('sell.list', ['master_id' => $album->master_id]) }}" class="btn-shop">
    Shop {{ $listing_count }} Listings
        </a>

        <!-- Statistics -->
        <div class="statistics-header">Statistics</div>
        <div class="stats-grid">
            <div class="stat-pair">
                <div class="stat-label">Have:</div>
                <div class="stat-value"><a href="#">{{ $stats->have }}</a></div>
            </div>

            <div class="stat-pair">
                <div class="stat-label">Avg Rating:</div>
                <div class="stat-value">{{ number_format($stats->avg_rating, 2) }}/ 5</div>
            </div>
            
            <div class="stat-pair">
                <div class="stat-label">Want:</div>
                <div class="stat-value"><a href="#">{{  number_format($stats->want, 2) }}</a></div>
            </div>

            <div class="stat-pair">
                <div class="stat-label">Ratings:</div>
                <div class="stat-value"><a href="#">{{ number_format ($stats->total_rating, 2) }}</a></div>
            </div>
        </div>

        <!-- Share -->
        <button class="share-btn">
            <svg class="share-icon" viewBox="0 0 24 24">
            <path path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"></path>
            <path d="M5 5h6v2H7v10h10v-4h2v6H5z"></path>
            </svg>Share
        </button>

        <div class="widget">

    <!-- Header -->
  <div class="header">
    <span>Audio</span>
  </div>
 
  <div class="music-content">
  <!-- Apple Music Bar -->
  <div class="music-bar">
    <div class="music-bar-left">
      <svg width="16" height="16" viewBox="0 0 814 1000" fill="#000" xmlns="http://www.w3.org/2000/svg">
        <path d="M788.1 340.9c-5.8 4.5-108.2 62.2-108.2 190.5 0 148.4 130.3 200.9 134.2 202.2-.6 3.2-20.7 71.9-68.7 141.9-42.8 61.6-87.5 123.1-155.5 123.1s-85.5-39.5-164-39.5c-76 0-103.7 40.8-165.9 40.8s-105-57.8-155.5-127.4C46 790.7 0 663 0 541.8c0-207.8 135.5-317.7 269.3-317.7 100.3 0 163.6 52.5 220.2 52.5 54 0 124.9-55.7 236.3-55.7 40.5 0 150.7 4.9 222.7 80.8zm-265.3-191.4c-43.3 17.8-121.4 81.6-121.4 177.7 0 95.7 60.4 153.8 99.1 153.8.5 0 1.2 0 1.9-.1.5-97.6 71.8-164.5 122-191.4 24.3-13.1 67.6-37.1 103.6-37.1.5-1.9.5-3.8.5-5.8-.1-86-63.5-168.8-205.7-97.1z"/>
      </svg>
      <span>Music</span>
    </div>
    <button class="btn-signin">Sign In</button>
  </div>
 
  <!-- Album Info -->
    <div class="album-info">
      <div class="album-art">
        <img src="{{ $album->image }}" alt="Album Art">
      </div>
      <div>
        <div class="album-title">{{ $album->title }}</div>
        <div class="album-artist">{{ $artist->name }}</div>
      </div>
    
    <button class="btn-dots">
      <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
        <circle cx="5" cy="12" r="2" fill="#FF3B5C"/>
        <circle cx="12" cy="12" r="2" fill="#FF3B5C"/>
        <circle cx="19" cy="12" r="2" fill="#FF3B5C"/>
      </svg>
    </button>
  </div>
  
    <!-- Hidden audio player -->
<audio id="player" style="display:none;"></audio>
 
  <!-- Track List -->
<div class="track-list">
  @foreach($tracks as $i => $track)
  <div class="track" data-audio="{{ $track->audio_url }}" onclick="playTrack(this)">
    
    <span class="track-num">{{ $i+1 }}</span>
    
    <span class="play-icon-hover">▶</span>
    
    <span class="track-name">{{ $track->title }}</span>
  </div>
  @endforeach
</div>
  <!-- Custom Play Button -->
<button id="playBtn">Play</button>
<button id="pauseBtn">Pause</button>

 
  <!-- Play Button -->
  <div class="play-wrap">
    <button class="btn-play">
      <svg width="14" height="16" viewBox="0 0 14 16" fill="white">
        <polygon points="0,0 14,8 0,16"/>
      </svg>
      <span>Play</span>
    </button>
  </div>
 
  View in App
  <div class="view-app">
    <a href="#">View in App ↗</a>
    <span>See how your data is managed...</span>
  </div>
  </div>

        <!-- VIDEO -->
        <div id="video-sidebar-section" style="margin-bottom:10px">
            <div class="v-header">
                {{--  paksa unique berdasarkan kolom youtube_url langsung saat menghitung --}}
                <h2>Videos ({{ $videos->unique('youtube_url')->count() }})</h2>
                <a href="#" class="small">Edit</a>
            </div>

            @if($videos->count() > 0)
            <div class="main-player" id="mainPlayer">
                {{-- Ambil thumbnail dari video pertama yang unik --}}
                <img src="{{ $videos->unique('youtube_url')->first()->thumbnail }}" id="currentThumb">
                <div class="play-btn-overlay"></div>
            </div>
            @endif

            <div class="v-list">
                {{-- 
                Tambahkan ->unique('youtube_url') sebelum @foreach 
                Ini akan menyaring daftar video berdasarkan URL YouTube-nya di level Blade secara instan.
                --}}
                @foreach($videos->unique('youtube_url') as $video)
                <div class="v-item" onclick="changeVideo('{{ $video->thumbnail }}', '{{ $video->youtube_url }}')">
                    <div class="v-thumb">
                        <img src="{{ $video->thumbnail }}">
                        <span class="v-time"> {{ $video->duration }} </span>
                    </div>
                    <div class="v-title"><b> {{ $video->title }} </b></div>
                </div>
                @endforeach
            </div>
        </div>
  

    <!-- LISTS -->
    <div class="l-section">
        <div class="l-header">
            <h2>Lists</h2>
            <a href="#" class="small text-decoration-none" 
                data-bs-toggle="modal" 
                data-bs-target="#addToListModal" 
                style="color: #2a5bd7;">Add to List</a>
        </div>

        <div class="l-list">
            @forelse($lists as $list)
                <div class="l-item">
                    <div>
                        <a href="#">{{ $list->list_name }}</a>
                    </div>
                    <div class="l-meta">
                        by <a href="#">{{ $list->username }}</a>
                    </div>
                </div>
            @empty
                <div class="l-meta">No lists yet</div>
            @endforelse
        </div>

        <div class="l-footer">
            <a href="/lists" class="view-more-lists">View more lists</a>
        </div>

    </div>

        
    </div>
    <!-- end .album-right -->

</div>


<!-- UNTUK KLIK VIDEO -->
<script>
    function changeVideo(thumbnail, youtube_url) {
        document.getElementById('currentThumb').src = thumbnail;
    }

    function validasiReview(type, id = '') {
        // Pemetaan Selector Elemen secara Dinamis
        const input = document.getElementById(type === 'edit' ? "editInput" + id : "reviewInput");
        const submitBtn = document.getElementById(type === 'edit' ? "editSubmitBtn" + id : "submitBtn");
        const previewBox = document.getElementById(type === 'edit' ? "editPreviewBox" + id : "previewBox");
        const previewText = document.getElementById(type === 'edit' ? "editPreviewText" + id : "previewText");
        const warning = document.getElementById(type === 'edit' ? "editWordWarning" + id : "wordWarning");

        // Keamanan tambahan: Jika elemen input tidak ditemukan, hentikan fungsi agar tidak crash
        if (!input) return;

        const text = input.value.trim();

        // 1. Kontrol Tampilan Preview
        if (previewBox && previewText) {
            if (text.length > 0) {
                previewBox.style.display = "block";
                previewText.textContent = text;
            } else {
                previewBox.style.display = "none";
            }
        }

        // 2. Hitung jumlah kata
        const wordCount = text
            .split(/\s+/)
            .filter(word => word.length > 0).length;

        // 3. Validasi Minimal 10 Kata & Styling Tombol
        if (submitBtn) {
            if (wordCount >= 10) {
                submitBtn.disabled = false;
                submitBtn.style.background = "#000";
                submitBtn.style.color = "#fff";
                submitBtn.style.border = "1px solid #000";
                submitBtn.style.cursor = "pointer";

                if (warning) warning.style.display = "none";
            } else {
                submitBtn.disabled = true;
                submitBtn.style.background = "#ccc";
                submitBtn.style.color = "#888";
                submitBtn.style.border = "1px solid #bbb";
                submitBtn.style.cursor = "not-allowed";

                if (warning) {
                    if (text.length > 0) {
                        warning.style.display = "block";
                    } else {
                        warning.style.display = "none";
                    }
                }
            }
        }
    }

    function showEditForm(id) {
        document.getElementById('editForm' + id).style.display = 'block';
        document.getElementById('reviewText' + id).style.display = 'none';
        
        // Jalankan fungsi validasi tunggal saat form edit dibuka
        validasiReview('edit', id); 
    }

    function toggleMenu(button) {
        const dropdown = button.nextElementSibling;

        // tutup semua dropdown lain
        document.querySelectorAll('.menu-dropdown').forEach(menu => {
            if (menu !== dropdown) {
                menu.style.display = 'none';
            }
        });

        // toggle current
        dropdown.style.display =
            dropdown.style.display === 'block'
                ? 'none'
                : 'block';
    }

    // klik luar = close
    document.addEventListener('click', function(e) {
        if (!e.target.closest('.review-menu')) {
            document.querySelectorAll('.menu-dropdown').forEach(menu => {
                menu.style.display = 'none';
            });
        }
    });

    function hideEditForm(id) {
        document.getElementById('editForm' + id).style.display = 'none';
        document.getElementById('reviewText' + id).style.display = 'block';
    }

function setGridView() {

    document.getElementById('gridBtn').classList.add('active');
    document.getElementById('listBtn').classList.remove('active');

    document.querySelectorAll('.version-row').forEach(row => {

        row.style.gridTemplateColumns =
            '1fr 220px 120px 80px 40px';

        // tampilkan gambar
        row.querySelector('.version-image').style.display = 'block';
    });
}

function setListView() {

    document.getElementById('listBtn').classList.add('active');
    document.getElementById('gridBtn').classList.remove('active');

    document.querySelectorAll('.version-row').forEach(row => {

        row.style.gridTemplateColumns =
            '1fr 220px 120px 80px 40px';

        // sembunyikan gambar
        row.querySelector('.version-image').style.display = 'none';
    });
}


function toggleVersion(index) {

    const detail = document.getElementById('detail' + index);
    const btn = document.getElementById('btn' + index);

    if(detail.style.display === 'none') {

        detail.style.display = 'block';
        btn.innerHTML = '▴';

    } else {

        detail.style.display = 'none';
        btn.innerHTML = '▾';
    }
}

</script>

@endsection