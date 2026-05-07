@extends('layouts.app')

@section('title', 'Release')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
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
    .btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        white-space: nowrap;
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

    
    /* STATISTICS */
    .stats-box {
        margin-bottom: 16px;
    }

    .stats-box h3 {
        font-size: 15px;
        font-weight: bold;
        color: #333;
        margin-bottom: 8px;
        border-bottom: 1px solid #ddd;
        padding-bottom: 4px;
    }

    .stats-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        column-gap: 30px;
        row-gap: 2px;
        position: relative;
    }

    .stats-grid::after {
        content: "";
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        border-bottom: 1px solid #ddd;
    }

    .stats-grid .stat-pair:nth-last-child(-n+2) {
        border-bottom: 1px solid #ddd;
        padding-bottom: 6px;
    }

    .stat-pair {
        display: flex;
        justify-content: space-between;
        white-space: nowrap;
        gap: 7px; /* dari 6 → 12 biar agak lega */
    }

    .stat-row {
        display: contents;
    }

    .stat-label {
        color: #000;
    }

    .stat-value {
        color: #000;
        text-align: right;
    }

    .stat-value a {
        color: #4b75b9;
        text-decoration: none;
    }

    .stat-value a:hover {
        text-decoration: underline;
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

    .versions-header {
        padding: 16px 0 8px 0;
    }

    .versions-header h2 {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 12px;
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

    #video-sidebar-section {
        margin-top: 10px;
        border-top: none;
        padding-top: 15px;
        display: flex;
        flex-direction: column;
        max-height: 200px;
    }

    #video-sidebar-section .v-header {
        display: flex;
        gap: 8px; 
        align-items: center;
        margin-bottom: 10px;
        border-bottom: 1px solid #ddd; 
    }

    #video-sidebar-section h2 { 
        font-size: 13px; 
        font-weight: bold; 
        margin: 0; 
    }
    
    .main-player {
        width: 100%;
        background-color: #000;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
        height: 350px;
    }
    
    .player img { width: 100%; height: 100%; object-fit: cover; opacity: 0.8; }
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
        max-height: 120px;
        overflow-y: auto;
        flex: 1;         
        min-height: 0;    
    }

    .v-item { display: flex; gap: 10px; padding: 5px 0; cursor: pointer; border-bottom: 1px solid #f0f0f0; }
    .v-item:hover { background: #f9f9f9; }
    .v-thumb { width: 100px; height: 60px; position: relative; flex-shrink: 0; }
    .v-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .v-time { position: absolute; bottom: 2px; right: 2px; background: #000; color: #fff; font-size: 10px; padding: 0 3px; }
    .v-title { font-size: 13px; color: #2a5bd7; line-height: 1.2; }

    /* Custom scrollbar untuk list video */
    .v-list::-webkit-scrollbar {width: 6px;}
    .v-list::-webkit-scrollbar-thumb {background: #ccc;border-radius: 10px;}
    .v-list::-webkit-scrollbar-thumb:hover {background: #999;}
    .l-section { border-top: none; padding-top: 0px; }
    .l-section a { display: inline; font-size: 13px; margin-bottom: 3px; color: #2a5bd7; }

    .tracklist-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }


/* Container bintang + share */
.middle-row {
  display: flex;
  align-items: center;
  justify-content: space-between;
  position: relative;
  margin: 10px 0;
  padding: 0 20px; /* biar ada ruang kiri kanan */
}

.middle-row::before {
  content: "";
  position: absolute;
  height: 20px;
  width: 1px;
  background: #ccc;
  left: 50%;
  transform: translateX(-50%);
}

/* Bintang */
.stars {
  display: flex;
  gap: 3px;
  margin-left: auto;
  margin-right: 8px; /* jarak ke garis */
}

.star {
  font-size: 18px;
  line-height: 1;
}

.star.filled {
  color: #f5a623; /* kuning */
}

.star.empty {
  color: #ccc; /* abu */
}

/* Share button */
 .share-btn {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #0a71b3;
        font-size: 13px;
        text-decoration: none;
        border: none;
        background: none;
        cursor: pointer;
        padding: 0;
        margin-left: 70px;
        margin-right: 70px;
        top: -5px;
    }

    .share-btn:hover {
        text-decoration: underline;
    }

    .share-icon {
        width: 14px;
        height: 14px;
        fill: #0a71b3;
    }
/* Divider */
.divider {
  border: none;
  border-top: 1px solid #ccc;
  margin: 10px 0;
}

/* Button group */
.btn-group {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 8px;
}

/* Button */
.btn {
  display: flex;
  align-items: center;
  justify-content: center;

  gap: 4px;              /* ⬅️ jarak icon & teks diperkecil */
  padding: 6px 10px;     /* ⬅️ dalam tombol diperkecil */

  font-size: 12px;       /* opsional biar lebih compact */

  background: #f2f2e8;
  border: 1px solid #ccc;
  border-radius: 0px;

  cursor: pointer;
  white-space: nowrap;
}

.btn:hover {
  background: #f2f2e8;
}

 .tl-header {
      display: flex;
      justify-content: space-between;
      align-items: center;
      padding-bottom: 2px;
      border-bottom: 1px solid #e0e0e0;;
      margin-bottom: 0;
    }
    .tl-header h2 {
      font-size: 15px;
      font-weight: 700;
    }
    .show-credits-btn {
      display: flex;
      align-items: center;
      gap: 6px;
      background: none;
      border: none;
      cursor: pointer;
      color: #1a6bbf;
      font-size: 14px;
      font-weight: 500;
      padding: 0;
    }
    .show-credits-btn i { font-size: 17px; }
    .track-row { border-bottom: 1px solid #e0e0e0; }
    .track-row:last-child { border-bottom: none; }
    .track-main {
      display: flex;
      align-items: center;
      padding: 2px 0;
    }
    .track-num {
      width: 38px;
      font-size: 13px;
      color: #000;
      flex-shrink: 0;
    }
    .track-title {
      flex: 1;
      font-size: 13px;
      color: #000;
    }
    .track-dur {
      font-size: 13px;
      color: #000;
    }
    .track-credits {
      padding: 0 0 10px 38px;
      display: none;
    }
    .track-credits.open { display: block; }
    .credit-line {
      font-size: 12px;
      color: #000;
      line-height: 1.3;
      padding-left: 12px;
    }
    .credit-line a {
      color: #1a6bbf;
      text-decoration: none;
    }
    .credit-line a:hover { text-decoration: underline; }
        
    .companies-section {
    border-top: 1px solid #ccc;   /* garis di atas */
    padding-top: 5px;
    margin-top: 3px;
}
    .companies-section p {
      line-height: 1.3;   /* dari 1.7 → lebih rapat */
      margin-bottom: 2px; /* kecilin jarak bawah */
      font-size: 12px; 
      color: #000; 
    }

    .companies-section a {
    color: #0070c0;
    text-decoration: none;
    }
    
    .companies-section a:hover { text-decoration: underline; }

    h2 {
    font-size: 14px;
    font-weight: bold;
    border-bottom:none;
    padding-bottom: 3px;
    margin-bottom: 6px;
    margin-top: 14px;
    color: #000;
  }
  .credits-section {
    border-top: 1px solid #ccc;
    padding-top: 5px;
    margin-top: 3px;
}
  .credits-section p {
    line-height: 1.3;   /* dari 1.7 → lebih rapat */
    margin-bottom: 2px; /* kecilin jarak bawah */
    font-size: 12px; 
    color: #000;
  }
  .credits-section a {
    color: #0070c0;
    text-decoration: none;
  }
  .credits-section a:hover { text-decoration: underline; }
  .notes-section p {
    margin-bottom: 6px;
    line-height: 1.6;
    color: #000;
    font-size: 12px;
  }
  .notes-section a {
    color: #0070c0;
    text-decoration: none;
  }
  .notes-section,
  .identifiers-section {
    border-top: 1px solid #ccc;
    padding-top: 5px;
    margin-top: 3px;
}
  .notes-section a:hover { text-decoration: underline; }
  .identifiers-section p {
    line-height: 1.2;   /* kecilin tinggi baris */
    margin: 0;          /* hilangin jarak atas bawah */
    font-size: 12px;
    color: #000;
  }

  /* OTHER VERSIONS */
  .section-header { display: flex; align-items: center; gap: 10px; margin-bottom: 10px; margin-top: 18px; padding-bottom: 6px; border-bottom: 1px solid #ccc; }
  .section-header span { font-size: 13px; font-weight: bold; }
  .section-header a { font-size: 12px; color: #0070c0; text-decoration: none; }
  .section-header a:hover { text-decoration: underline; }
 
  /* TABLE HEADER */
  .table-head { display: grid; grid-template-columns: 1fr 140px 160px 90px 50px; border-bottom: 1px solid #ccc; padding: 6px 4px; font-weight: bold; font-size: 12px; color: #333; }
 
  /* TABLE ROWS */
.table-row { 
    display: grid; 
    grid-template-columns: 1fr 140px 160px 90px 50px; 
    border-bottom: 1px solid #e0e0e0; 
    padding: 5px 4px; 
    align-items: start; 
    position: relative; 
    line-height: 1.2;
}
  .table-row.highlighted { border-left: 6px solid #e8a000; padding-left: 6px; background: #fff; }
 
  .col-title a { color: #0070c0; text-decoration: none; font-size: 13px; }
  .col-title a:hover { text-decoration: underline; }
  .col-title span { font-style: italic; }
 
  .col-label a { color: #0070c0; text-decoration: none; font-size: 13px; }
  .col-label a:hover { text-decoration: underline; }
 
  .col-cat { font-size: 12px; color: #333; }
  .col-country { font-size: 12px; color: #333; }
  .col-year { font-size: 12px; color: #333; }
 
  /* RECOMMENDATIONS */
  .rec-header { 
    font-size: 14px; 
    font-weight: bold; 
    margin: 20px 0 12px 0; 

    border-bottom: 1px solid #ccc;
    padding-bottom: 6px;
}
 
  .rec-list { display: flex; gap: 12px; overflow-x: auto; padding-bottom: 8px; }
 
 .rec-card { 
    min-width: 140px; 
    max-width: 150px; 
    flex-shrink: 0; 

    border: 1px solid #ddd;
    border-radius: 4px;

    padding: 8px;
    display: flex;
    flex-direction: column;
    gap: 6px;

    background: #fff;
}
  .rec-card img { width: 100%; height: 130px; object-fit: cover; display: block; }
  .rec-card .img-placeholder { width: 100%; height: 130px; background: #ccc; display: flex; align-items: center; justify-content: center; font-size: 11px; color: #666; }
 
  .rec-card .rec-title { font-size: 13px; font-weight: bold; line-height: 1.3; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .rec-card .rec-artist { font-size: 10px; color: #555; }
  .rec-card .rec-year { font-size: 10px; color: #555; }
  .rec-card .rec-format { font-size: 11px; color: #555; display: flex; align-items: center; gap: 4px; }
  .rec-card .rec-format::before { content: "⊙"; font-size: 12px; }
 
  .rec-card .btn-shop,
  .rec-card .btn-want {
    width: 100%;
    padding: 5px 0;
    margin: 0;
    font-size: 12px;
    color: #333;
    text-align: center;

    background: #f2f2e8;
    border: 1px solid #ccc;
    border-radius: 2px;

    cursor: pointer;
}
  .rec-card .btn-shop:hover, .rec-card .btn-want:hover { background: #e8e8e8; }
 
  /* NAVIGATION ARROWS */
  .nav-arrows { display: flex; justify-content: space-between; margin-top: 12px; }
  .nav-arrows a { color: #0070c0; text-decoration: none; font-size: 18px; }
  .nav-arrows a:hover { color: #004a99; }

  .reviews-title {
    font-size: 15px;
    font-weight: bold;
    color: #000;

    margin-top: 25px; /* jarak dari rekomendasi */

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
 
    .add-review-btn:hover {
      background-color: #e8e8e8;
    }
 
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
               <img src="https://i.discogs.com/55OYJqGsg9ov3VrCPSdj3lmQyBrmeoRBO7EGNcPC7cE/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTMzMTM2/NzU1LTE3Mzk1ODQ4/NTAtMTUzNi5qcGVn.jpeg" alt="Sabrina Carpenter - Short N' Sweet (Deluxe) album cover" width="150" height="150">
                <a href="#">More images</a>
            </div>
            <div class="album-meta">
                <div class="album-title">
                    <a href="#" class="artist-name">Sabrina Carpenter</a>
                    &ndash; Short N\' Sweet (Deluxe)
                </div>
                <table class="album-info-table">
                    <tr>
                        <td>Label:</td>
                        <td>
                            <a href="#">Island Records</a> &ndash; 602475656999</a>
                        </td>
                    </tr>
                    <tr>
                        <td>Format:</td>
                        <td>
                            2 x <a href="#">Vinyl,</a> LP, Album, Deluxe Edition, Repress, <i>Blue Opaque [Bright Azure]</i>
                        </td>
                    </tr>
                    <tr>
                        <td>Country:</td>
                        <td><a href="#">US</a></td>
                    </tr>
                    <tr>
                        <td>Released:</td>
                        <td><a href="#">14 Feb 2025</a></td>
                    </tr>
                    <tr>
                        <td>Genre:</td>
                        <td><a href="#">Funk / Soul, Pop</a></td>
                    </tr>
                    <tr>
                        <td>Style:</td>
                        <td><a href="#">Bubblegum, Contempory R&B, Nu-Disco, Voca</a></td>
                    </tr>
                </table>
            </div>
        </div>

        <!-- Tracklist -->
       <div class="tl-wrap">
  <div class="tl-header">
    <h2>Tracklist</h2>
    <button class="show-credits-btn" id="toggleBtn" onclick="toggleAll()">
        <i id="btnIcon" class="ti ti-eye"></i>
        <span id="btnLabel">Show Credits</span>
    </button>
  </div>
 
  <!-- A1 -->
  <div class="track-row">
    <div class="track-main">
      <span class="track-num">A1</span>
      <span class="track-title">Taste</span>
      <span class="track-dur">2:37</span>
    </div>
    <div class="track-credits" id="c0">
      <div class="credit-line">Drums – <a href="#">Aaron Sterling</a></div>
      <div class="credit-line">Engineer [Mix] – <a href="#">Bryce Bordone</a></div>
      <div class="credit-line">Mastered By – <a href="#">Nathan Dantzler</a></div>
      <div class="credit-line">Mixed By – <a href="#">Serban Ghenea</a></div>
      <div class="credit-line">Producer – <a href="#">Ian Kirkpatrick</a>, <a href="#">John Ryan (17)</a>, <a href="#">Julian Bunetta</a></div>
      <div class="credit-line">Programmed By, Guitar, Bass, Drums, Keyboards, Percussion – <a href="#">John Ryan (17)</a>, <a href="#">Julian Bunetta</a></div>
      <div class="credit-line">Recorded By – <a href="#">Jeff Gunnell</a>, <a href="#">John Ryan (17)</a></div>
      <div class="credit-line">Vocals – <a href="#">Sabrina Carpenter</a></div>
      <div class="credit-line">Written-By – <a href="#">Amy Allen (3)</a>, <a href="#">Ian Kirkpatrick</a>, <a href="#">John Ryan (17)</a>, <a href="#">Julia Michaels</a>, <a href="#">Sabrina Carpenter</a></div>
    </div>
  </div>
 
  <!-- A2 -->
  <div class="track-row">
    <div class="track-main">
      <span class="track-num">A2</span>
      <span class="track-title">Please Please Please</span>
      <span class="track-dur">3:06</span>
    </div>
    <div class="track-credits" id="c1">
      <div class="credit-line">Drum Programming, Percussion, Drums [Drum Kit], Electric Guitar, Acoustic Guitar, Synthesizer [Juno 60, Moog, Prophet 5, Korg M1], Bass Guitar – <a href="#">Jack Antonoff</a></div>
      <div class="credit-line">Engineer [Assistant] – <a href="#">Jack Manning (9)</a>, <a href="#">Joey Miller (7)</a>, <a href="#">Jozef Caldwell</a></div>
      <div class="credit-line">Engineer [Mix] – <a href="#">Bryce Bordone</a></div>
      <div class="credit-line">Flute – <a href="#">Evan Smith (2)</a></div>
      <div class="credit-line">Mastered By – <a href="#">Ruairi O'Flaherty</a></div>
      <div class="credit-line">Mixed By – <a href="#">Serban Ghenea</a></div>
      <div class="credit-line">Producer – <a href="#">Jack Antonoff</a></div>
      <div class="credit-line">Recorded By – <a href="#">Laura Sisk</a>, <a href="#">Oli Jacobs</a></div>
      <div class="credit-line">Violin – <a href="#">Bobby Hawk</a></div>
      <div class="credit-line">Vocals – <a href="#">Sabrina Carpenter</a></div>
      <div class="credit-line">Written-By – <a href="#">Amy Allen (3)</a>, <a href="#">Jack Antonoff</a>, <a href="#">Sabrina Carpenter</a></div>
    </div>
  </div>
 
  <!-- A3 -->
  <div class="track-row">
    <div class="track-main">
      <span class="track-num">A3</span>
      <span class="track-title">Good Graces</span>
      <span class="track-dur">3:05</span>
    </div>
    <div class="track-credits" id="c2">
      <div class="credit-line">Mastered By – <a href="#">Nathan Dantzler</a></div>
      <div class="credit-line">Mastered By [Assistant] – <a href="#">Harrison Tate</a></div>
      <div class="credit-line">Mixed By – <a href="#">Manny Marroquin</a></div>
      <div class="credit-line">Mixed By [Assistant] – <a href="#">Anthony Vilchis</a>, <a href="#">Trey Station</a>, <a href="#">Zach Pereyra</a></div>
      <div class="credit-line">Producer – <a href="#">John Ryan (17)</a>, <a href="#">Julian Bunetta</a></div>
      <div class="credit-line">Programmed By, Guitar, Bass, Drums, Keyboards, Percussion – <a href="#">John Ryan (17)</a>, <a href="#">Julian Bunetta</a></div>
      <div class="credit-line">Recorded By – <a href="#">Jeff Gunnell</a>, <a href="#">John Ryan (17)</a>, <a href="#">Julian Bunetta</a></div>
      <div class="credit-line">Vocals – <a href="#">Sabrina Carpenter</a></div>
      <div class="credit-line">Written-By – <a href="#">Amy Allen (3)</a>, <a href="#">John Ryan (17)</a>, <a href="#">Julia Michaels</a>, <a href="#">Julian Bunetta</a>, <a href="#">Sabrina Carpenter</a></div>
    </div>
  </div>
 
  <!-- A4 -->
  <div class="track-row">
    <div class="track-main">
      <span class="track-num">A4</span>
      <span class="track-title">Sharpest Tool</span>
      <span class="track-dur">3:38</span>
    </div>
    <div class="track-credits" id="c3">
      <div class="credit-line">Producer – <a href="#">Amy Allen (3)</a>, <a href="#">Jon Bellion</a></div>
      <div class="credit-line">Vocals – <a href="#">Sabrina Carpenter</a></div>
      <div class="credit-line">Written-By – <a href="#">Amy Allen (3)</a>, <a href="#">Jon Bellion</a>, <a href="#">Sabrina Carpenter</a></div>
    </div>
  </div>
 
  <!-- A5 -->
  <div class="track-row">
    <div class="track-main">
      <span class="track-num">A5</span>
      <span class="track-title">Coincidence</span>
      <span class="track-dur">2:44</span>
    </div>
    <div class="track-credits" id="c4">
      <div class="credit-line">Producer – <a href="#">Amy Allen (3)</a>, <a href="#">Jon Bellion</a></div>
      <div class="credit-line">Vocals – <a href="#">Sabrina Carpenter</a></div>
      <div class="credit-line">Written-By – <a href="#">Amy Allen (3)</a>, <a href="#">Jon Bellion</a>, <a href="#">Sabrina Carpenter</a></div>
    </div>
  </div>
 
  <!-- A6 -->
  <div class="track-row">
    <div class="track-main">
      <span class="track-num">A6</span>
      <span class="track-title">Bed Chem</span>
      <span class="track-dur">2:51</span>
    </div>
    <div class="track-credits" id="c5">
      <div class="credit-line">Producer – <a href="#">Jack Antonoff</a></div>
      <div class="credit-line">Vocals – <a href="#">Sabrina Carpenter</a></div>
      <div class="credit-line">Written-By – <a href="#">Jack Antonoff</a>, <a href="#">Sabrina Carpenter</a></div>
    </div>
  </div>
 
  <!-- B7 -->
  <div class="track-row">
    <div class="track-main">
      <span class="track-num">B7</span>
      <span class="track-title">Espresso</span>
      <span class="track-dur">2:55</span>
    </div>
    <div class="track-credits" id="c6">
      <div class="credit-line">Producer – <a href="#">Amy Allen (3)</a>, <a href="#">Julian Bunetta</a></div>
      <div class="credit-line">Vocals – <a href="#">Sabrina Carpenter</a></div>
      <div class="credit-line">Written-By – <a href="#">Amy Allen (3)</a>, <a href="#">Julian Bunetta</a>, <a href="#">Sabrina Carpenter</a></div>
    </div>
  </div>
 
  <!-- B8 -->
  <div class="track-row">
    <div class="track-main">
      <span class="track-num">B8</span>
      <span class="track-title">Dumb & Poetic</span>
      <span class="track-dur">2:13</span>
    </div>
    <div class="track-credits" id="c7">
      <div class="credit-line">Producer – <a href="#">Ian Kirkpatrick</a></div>
      <div class="credit-line">Vocals – <a href="#">Sabrina Carpenter</a></div>
      <div class="credit-line">Written-By – <a href="#">Ian Kirkpatrick</a>, <a href="#">Sabrina Carpenter</a></div>
    </div>
  </div>
 
</div>

        <!-- Companies -->
<h2>Companies, etc.</h2>
<div class="companies-section">
    <p>Phonographic Copyright ℗ –<a href="#"> Island Records</a></p>
    <p>Copyright © - <a href="#">Island Records</a></p>
    <p>Record Company - <a href="#">UMG Recordungs, Inc.</a></p>
    <p>Distributed By - <a href="#">UMG Commercial Services</a></p>
    <p>Pressed By - <a href="#">Vantiva, Guadalajara, Mexico</a> - 1271098 </p>
    <p>Published By - <a href="#">Sabalicious Songs</a></p>
    <p>Mixed At - <a href="#">MixStar Studios</a></p>
    <p>Mastered At - <a href="#">Nomograph Mastering</a></p>
    <p>Recorded At - <a href="#">The Perch</a></p>
</div>

<h2>Credits</h2>
<div class="credits-section">
  <p>A&R – <a href="#">Jackie Winkler</a></p>
  <p>A&R, Administrator – <a href="#">Gabrielle Rosen</a></p>
  <p>Art Direction – <a href="#">Sarah Carpenter (3)</a></p>
  <p>Coordinator, A&R – <a href="#">Gloria Jozwicki</a></p>
  <p>Creative Director – <a href="#">Dannah Gottlieb</a></p>
  <p>Graphic Design – <a href="#">Chase Shawbridge</a></p>
  <p>Legal [Business Affairs] – <a href="#">Antoinette Trotman</a>, <a href="#">Ian Allen (7)</a>, <a href="#">Julia Nagar</a>, <a href="#">Niya Fleming</a>, <a href="#">Rachel Meisner</a>, <a href="#">Skyler Salamon</a></p>
  <p>Management – <a href="#">Volara Management</a></p>
  <p>Marketing – <a href="#">Natasha Kilibarda</a></p>
  <p>Production Manager [Package Production] – <a href="#">Paul Lane</a></p>
</div>
 
<h2>Notes</h2>
<div class="notes-section">
  <p>Issued in gatefold jacket with printed die-cut inner sleeves, foldout poster, and double-sided credit insert.</p>
  <p>Copies signed on the front cover by the artist were also available at indie record stores at release with a barcode sticker on rear shrink wrap.</p>
  <p>"VINYL MADE IN MEXICO" printed on rear shrink wrap.</p>
  <p>Signed copies were released with a barcode sticker on rear shrink wrap without the manufacturer's printing.</p>
  <p>Side A &amp; B were repressed with lacquers from the <a href="#">standard edition release</a>.<br>
  Side C &amp; D were cut new for the deluxe release.</p>
  <p>Tracks are listed sequentially, regardless of side.</p>
  <p>Track times are listed on center labels.</p>
  <p>Runouts are stamped.</p>
</div>
 
<h2>Barcode and Other Identifiers</h2>
<div class="identifiers-section">
  <p>Barcode (Printed, text): 6 02475 85899 9</p>
  <p>Barcode (Printed, scanned): 602475858999</p>
  <p>Barcode (Stickered, text): 6 02475 85859 1</p>
  <p>Barcode (Stickered, scanned): 602475858591</p>
  <p>Rights Society: BMI</p>
  <p>Rights Society: ASCAP</p>
  <p>Other (Side A label): 00602475658999-A</p>
  <p>Other (Side B label): 00602475658999-B</p>
  <p>Other (Side C label): 00602475658999-C</p>
  <p>Other (Side D label): 60247565899 9-D</p>
  <p>Matrix / Runout (Side A runout): (1271098) 01010252 00602465835199A</p>
  <p>Matrix / Runout (Side B runout): (1271099) 01010613 00602465835199B</p>
  <p>Matrix / Runout (Side C runout): (1288399) 01010310 60247565899 9A</p>
  <p>Matrix / Runout (Side D runout): (1280400) 01010320 60247565899 9B</p>
</div>

<!-- OTHER VERSIONS -->
<div class="section-header">
  <span>Other Versions (5 of 53)</span>
  <a href="#">View All</a>
</div>
 
<!-- Table Header -->
<div class="table-head">
  <div>Title (Format)</div>
  <div>Label</div>
  <div>Cat#</div>
  <div>Country</div>
  <div>Year</div>
</div>
 
<!-- Row 1 -->
<div class="table-row">
  <div class="col-title">
    <a href="#">Short N' Sweet</a> (LP, Album, <span>Blue Marbled [Light Sky]</span>)
  </div>
  <div class="col-label"><a href="#">Island Records</a>, <a href="#">Island Records</a></div>
  <div class="col-cat">00602465835199,<br>602465835199</div>
  <div class="col-country">Worldwide</div>
  <div class="col-year">2024</div>
</div>
 
<!-- Row 2 (highlighted) -->
<div class="table-row highlighted">
  <div class="col-title">
    <a href="#">Short N' Sweet</a> (LP, Album, Limited Edition, Stereo, <span>Clear [Moonlight], Optimal Media GmbH Pressing</span>)
  </div>
  <div class="col-label"><a href="#">Island Records</a></div>
  <div class="col-cat">00602465839807</div>
  <div class="col-country">Worldwide</div>
  <div class="col-year">2024</div>
</div>
 
<!-- Row 3 (highlighted) -->
<div class="table-row highlighted">
  <div class="col-title">
    <a href="#">Short N' Sweet</a> (12×File, AAC, Album, <span>256 kbps</span>)
  </div>
  <div class="col-label"><a href="#">Island Records</a></div>
  <div class="col-cat">none</div>
  <div class="col-country">Worldwide</div>
  <div class="col-year">2024</div>
</div>
 
<!-- Row 4 (highlighted) -->
<div class="table-row highlighted">
  <div class="col-title">
    <a href="#">Short N' Sweet</a> (LP, Album, <span>Blue [Lapis Lazuli]</span>)
  </div>
  <div class="col-label"><a href="#">Island Records</a></div>
  <div class="col-cat">602465869118</div>
  <div class="col-country">Europe</div>
  <div class="col-year">2024</div>
</div>
 
<!-- Row 5 (highlighted) -->
<div class="table-row highlighted">
  <div class="col-title">
    <a href="#">Short N' Sweet</a> (LP, Album, Stereo, <span>Blue Marbled [Light Sky]</span>)
  </div>
  <div class="col-label"><a href="#">Island Records</a></div>
  <div class="col-cat">602465835199</div>
  <div class="col-country">US</div>
  <div class="col-year">2024</div>
</div>
 
<!-- RECOMMENDATIONS -->
<div class="rec-header">Recommendations</div>
 
<div class="rec-list">
 
  <!-- Card 1: Reputation -->
  <div class="rec-card">
    <img src="https://i.discogs.com/reputation_taylor_swift.jpg" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';" alt="Reputation">
    <div class="img-placeholder" style="background:#222;color:#fff;font-size:10px;text-align:center;padding:4px;">reputation<br><small>Taylor Swift</small></div>
    <div class="rec-title">Reputation</div>
    <div class="rec-artist">Taylor Swift</div>
    <div class="rec-year">2017 USA &amp; Europe</div>
    <div class="rec-format">Vinyl — LP, Album...</div>
    <button class="btn-shop">Shop</button>
    <button class="btn-want">Want</button>
  </div>
 
  <!-- Card 2: The Tortured Poets Department -->
  <div class="rec-card">
    <div class="img-placeholder" style="background:#2a2a2a;color:#aaa;font-size:10px;text-align:center;padding:4px;">The Tortured Poe...</div>
    <div class="rec-title">The Tortured Poe...</div>
    <div class="rec-artist">Taylor Swift</div>
    <div class="rec-year">2024 US</div>
    <div class="rec-format">Vinyl — LP</div>
    <button class="btn-shop">Shop</button>
    <button class="btn-want">Want</button>
  </div>
 
  <!-- Card 3: Lover (Live From...) -->
  <div class="rec-card">
    <div class="img-placeholder" style="background:#d4b8a0;color:#fff;font-size:10px;text-align:center;padding:4px;">Lover (Live From...)</div>
    <div class="rec-title">Lover (Live From ...</div>
    <div class="rec-artist">Taylor Swift</div>
    <div class="rec-year">2025 USA &amp; Europe</div>
    <div class="rec-format">Vinyl — 8", 33 ⅓ ...</div>
    <button class="btn-shop">Shop</button>
    <button class="btn-want">Want</button>
  </div>
 
  <!-- Card 4: Lover -->
  <div class="rec-card">
    <div class="img-placeholder" style="background:#b0c8e8;color:#fff;font-size:10px;text-align:center;padding:4px;">Lover</div>
    <div class="rec-title">Lover</div>
    <div class="rec-artist">Taylor Swift</div>
    <div class="rec-year">2019 USA &amp; Canada</div>
    <div class="rec-format">Vinyl — LP</div>
    <button class="btn-shop">Shop</button>
    <button class="btn-want">Want</button>
  </div>
 
  <!-- Card 5: 1989 (Taylor's Version) -->
  <div class="rec-card">
    <div class="img-placeholder" style="background:#87aec4;color:#fff;font-size:10px;text-align:center;padding:4px;">1989 (Taylor's Ver...)</div>
    <div class="rec-title">1989 (Taylor's Ver...</div>
    <div class="rec-artist">Taylor Swift</div>
    <div class="rec-year">2023 Worldwide</div>
    <div class="rec-format">Vinyl — LP, Album...</div>
    <button class="btn-shop">Shop</button>
    <button class="btn-want">Want</button>
  </div>
 
  <!-- Card 6: Mid... (partial) -->
  <div class="rec-card">
    <div class="img-placeholder" style="background:#c0a080;color:#fff;font-size:10px;text-align:center;padding:4px;">Mid...</div>
    <div class="rec-title">Mid...</div>
    <div class="rec-artist">Taylo...</div>
    <div class="rec-year">2022</div>
    <div class="rec-format">Vinyl...</div>
    <button class="btn-shop">Shop</button>
    <button class="btn-want">Want</button>
  </div>
</div>

<div class="reviews-title">Reviews</div>
 
  <button class="add-review-btn">Add Review</button>
 
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
        <a href="#" class="review-username">tlrbreslin</a>
        <span class="review-date">Aug 17, 2025</span>
      </div>
      <div class="review-text">This is actually a really good quality pressing, I am impressed.</div>
      <div class="review-actions">
        <a href="#" class="action-link"><span class="action-icon">↩</span> Reply</a>
        <a href="#" class="action-link"><span class="action-icon">🏷</span> Helpful</a>
      </div>
    </div>
    <div class="dropdown-arrow">▼</div>
  </div>
 
  <!-- Review 2 -->
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
        <a href="#" class="review-username">Oliviatay19</a>
        <span class="review-date">Jul 12, 2025</span>
      </div>
      <div class="stars">
        <span class="star">★</span>
        <span class="star">★</span>
        <span class="star">★</span>
        <span class="star">★</span>
        <span class="star">★</span>
      </div>
      <div class="review-text">This album is pop perfection, Sabrina is a star and this album is funny, short and super sweet.</div>
      <div class="review-actions">
        <a href="#" class="action-link"><span class="action-icon">↩</span> Reply</a>
        <a href="#" class="action-link"><span class="action-icon">🏷</span> Helpful</a>
      </div>
    </div>
    <div class="dropdown-arrow">▼</div>
  </div>
 
  <!-- Review 3 -->
  <div class="review-item">
    <div class="avatar">
      <img src="https://i.pravatar.cc/48?img=12" alt="shawnhostetler1982" />
    </div>
    <div class="review-content">
      <div class="review-header">
        <a href="#" class="review-username">shawnhostetler1982</a>
        <span class="review-date">Mar 9, 2025</span>
      </div>
      <div class="review-text">Yo! This Blows. I already bought the original album. I HATE When Artist Do This! Even with Dolly Parton on the song with you isn't enough. The songs are So So and honestly seemed rushed. Why didn't you just include them on the original album?</div>
      <div class="review-actions">
        <a href="#" class="action-link"><span class="action-icon">↩</span> Reply</a>
        <a href="#" class="action-link"><span class="action-icon">🏷</span> Helpful</a>
      </div>
    </div>
    <div class="dropdown-arrow">▼</div>
  </div>
</div>



    <!-- end .album-left -->

    <!--  RIGHT COLUMN -->
    <div class="album-right">

        <!-- Master Release -->
        <div class="master-release-header">
            <span>Release</span>
            <span class="release-id">
                <span class="release-icon"></span>
                [r33136755]
            </span>
        </div>
        <div class="master-release-links">
            <a href="#">Edit Release</a>
            <a href="#">See all versions</a>
            <span style="color:black;">Recently Edited</span> 
        </div>

        <!-- For Sale -->
        <div class="for-sale-header">
            <span>For Sale</span>
            <a href="#">Sell a copy</a>
        </div>

        <div class="release-card">
            <img src="https://i.discogs.com/55OYJqGsg9ov3VrCPSdj3lmQyBrmeoRBO7EGNcPC7cE/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTMzMTM2/NzU1LTE3Mzk1ODQ4/NTAtMTUzNi5qcGVn.jpeg" alt="Sabrina Carpenter - Short N' Sweet (Deluxe) album cover" width="150" height="150">
            <div class="release-card-info">
                <div class="label">VINYL</div>
                <div class="title">Short N' Sweet (Deluxe)</div>
                <div class="price-range">From $30 to $100</div>
            </div>
        </div>

        <a href="#" class="btn-shop">Shop 25 Vinyl</a>

        <!-- Statistics -->
        {{-- Statistics --}}
        <div class="stats-box">
            <h3>Statistics</h3>
            <div class="stats-grid">
                <div class="stat-pair">
                    <div class="stat-label">Have:</div>
                    <div class="stat-value">11316</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Last Sold:</div>
                    <div class="stat-value">May 2, 2026</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Want:</div>
                    <div class="stat-value">2132</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Low:</div>
                    <div class="stat-value">$15.00</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Avg Rating:</div>
                    <div class="stat-value">4.77 / 5</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Median:</div>
                    <div class="stat-value">$33.61</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Ratings:</div>
                    <div class="stat-value">1321</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">High:</div>
                    <div class="stat-value">$139.99</div>
                </div>
            </div>
        </div>

        <div class="middle-row">
    <div class="stars">
      <span class="star filled">★</span>
      <span class="star filled">★</span>
      <span class="star filled">★</span>
      <span class="star empty">★</span>
      <span class="star empty">★</span>
    </div>
    <button class="share-btn">
        <svg class="share-icon" viewBox="0 0 24 24">
        <path path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"></path>
        <path d="M5 5h6v2H7v10h10v-4h2v6H5z"></path>
        </svg>Share
    </button>
  </div>
 
  <div class="btn-group">
    <button class="btn">
      <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <rect x="3" y="3" width="18" height="18" rx="2"/>
        <line x1="8" y1="8" x2="16" y2="8"/>
        <line x1="8" y1="12" x2="16" y2="12"/>
        <line x1="8" y1="16" x2="16" y2="16"/>
      </svg>
      Add to Collection
    </button>
    <button class="btn">
        <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
        <path d="M2 12s4-7 10-7 10 7 10 7-4 7-10 7-10-7-10-7z"/>
        <circle cx="12" cy="12" r="3"/>
        </svg>Add to Wantlist
    </button>
  </div>

        
                <div id="video-sidebar-section">
                <div class="v-header">
                    <h2>Videos (11)</h2>
                    <a href="#" class="small">Edit</a>
                </div>

                <div class="main-player" id="mainPlayer">
                    <img src="https://via.placeholder.com/400x225/222/fff?text=BRUNO+MARS+VIDEO" id="currentThumb">
                    <div class="play-btn-overlay"></div>
                </div>
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

      <div style="margin-bottom: 10px;">
    <div style="margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 8px;">
      <span style="font-weight: bold; font-size: 13px;">Lists</span>
      <span style="color: #0088cc; font-size: 12px; cursor: pointer;">Add to List</span>
    </div>
    <div style="font-size: 12px; line-height: 1.8;">
      <div>Sabrina Carpenter by <span style="color: #0088cc; cursor: pointer;">musiccouple25</span></div>
      <div>◇#．blue pressings！ by <span style="color: #0088cc; cursor: pointer;">healthyhabit</span></div>
      <div>pop by <span style="color: #0088cc; cursor: pointer;">amerella</span></div>
    </div>
    <div style="width: 100%; border-top: 1px solid #ccc; padding-top: 8px; color: #0088cc;">View More Lists →</div>
  </div>

    <div style="margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 8px; font-weight: bold;">Contributors</div>
    <div style="font-size: 12px; line-height: 1.8; color: #0088cc;">
      tonevendor, reunov, tji, myvinyldiscography, soldoutvinylrecords, IanMeetsMcEnroe, melodramarecords, beebotjean, SP_Vinyl, _DjRay1967_, Killerian123333, Nicolas-1223, timohanen
  </div>

  
    <div style="width: 100%; border-top: 1px solid #ccc; padding-top: 8px; color: #0088cc;">Report Suspicious Activity</div>

    
</div>

        
    </div>
    <!-- end .album-right -->

<script>
let visible = true;
let showing = false;

function toggleCredits() {
    const credits = document.querySelectorAll('.credits');
    const text = document.querySelector('.toggle-text');

    visible = !visible;

    credits.forEach(c => {
        c.style.display = visible ? 'block' : 'none';
    });

    text.innerText = visible ? 'Hide Credits' : 'Show Credits';
}

function toggleAll() {
    showing = !showing;

    const credits = document.querySelectorAll('.track-credits');

    credits.forEach(el => {
        el.classList.toggle('open', showing);
    });

    const icon = document.getElementById('btnIcon');
    const label = document.getElementById('btnLabel');

    if (showing) {
        icon.className = 'ti ti-eye-off'; // mata tertutup
        label.textContent = 'Hide Credits';
    } else {
        icon.className = 'ti ti-eye'; // mata terbuka
        label.textContent = 'Show Credits';
    }
}
</script>

</div>

@endsection