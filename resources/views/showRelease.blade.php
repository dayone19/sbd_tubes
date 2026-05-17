@extends('layouts.app')

@section('title', 'Release')

@section('content')

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tabler/icons-webfont@latest/tabler-icons.min.css">
<style>
    * {box-sizing: border-box;}
    body {font-family: Arial, Helvetica, sans-serif;font-size: 13px;color: #333;background: #fff;}
    .album-wrapper {max-width: 1100px;margin: 20px auto;padding: 0 16px;display: flex;gap: 24px;}
    /* ── LEFT COLUMN ── */
    .album-left {flex: 1 1 0;min-width: 0;}
    /* Header */
    .album-header {display: flex;gap: 16px;align-items: flex-start;margin-bottom: 20px;}
    .album-cover-wrap {flex-shrink: 0;text-align: center;}
    .album-cover-wrap img {width: 160px;height: 160px;object-fit: cover;display: block;border: 1px solid #ccc;}
    .album-cover-wrap a {display: block;font-size: 11px;color: #0a71b3;margin-top: 4px;text-decoration: none;}
    .album-cover-wrap a:hover {text-decoration: underline;}
    .album-meta {flex: 1;padding-top: 4px;}
    .album-title {font-size: 22px;font-weight: bold; color: #333; margin-bottom: 10px; line-height: 1.2;}
    .album-title .artist-name {color: #0a71b3;text-decoration: none;}
    .album-title .artist-name:hover {text-decoration: underline;}
    .album-info-table {border: none;border-collapse: collapse;}
    .album-info-table td {padding: 2px 8px 2px 0;vertical-align: top;font-size: 13px;}
    .album-info-table td:first-child {color: #333; font-weight: normal; white-space: nowrap;}
    .album-info-table td a { color: #0a71b3; text-decoration: none; }
    .album-info-table td a:hover {text-decoration: underline;}
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
    .tracklist {width: 100%;border-collapse: collapse;margin-top: 0;}
    .tracklist tr {border-bottom: 1px solid #e8e8e8;}
    .tracklist tr:last-child {border-bottom: none;}
    .tracklist td {padding: 3px 4px;font-size: 13px;color: #333;}
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
    .credit-item img {width: 60px;height: auto;}
    .credit-info a {
        color: #0a71b3;
        text-decoration: none;
        font-size: 13px;
        font-weight: bold;
        display: block;
    }
    .credit-info a:hover {text-decoration: underline;}
    .credit-info span {font-size: 12px;color: #666;display: block;}
    /* ── RIGHT COLUMN ── */
    .album-right {width: 280px;flex-shrink: 0;}
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
    .master-release-links {font-size: 12px;margin-bottom: 12px;}
    .master-release-links a {
        color: #0a71b3;
        text-decoration: none;
        display: block;
        margin-bottom: 2px;
    }
    .master-release-links a:hover {text-decoration: underline;}
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
    .for-sale-header a:hover {text-decoration: underline;}
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
    .release-card-info {font-size: 12px;line-height: 1.5;}
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
    .release-card-info .year { color: #555;}
    .release-card-info .formats a {
        color: black;
        text-decoration: none;
        font-size: 12px;
    }
    .release-card-info .formats a:hover {text-decoration: underline;}
    .release-card-info .formats span {color: #666;}
    .release-card-info .price-range {color: #333;font-size: 12px;}
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
    .btn-shop:hover { background: #257025;}
    /* STATISTICS */
    .stats-box { margin-bottom: 16px;}
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
    .stats-grid .stat-pair:nth-last-child(-n+2) {border-bottom: 1px solid #ddd;padding-bottom: 6px;}
    .stat-pair {
        display: flex;
        justify-content: space-between;
        white-space: nowrap;
        gap: 7px;
    }
    .stat-row {display: contents;}
    .stat-label {  color: #000;}
    .stat-value {color: #000;text-align: right;}
    .stat-value a {color: #4b75b9;text-decoration: none; }
    .stat-value a:hover { text-decoration: underline; }
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
    .share-btn:hover {text-decoration: underline;}
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
    .videos-header .edit-link:hover {text-decoration: underline;}
    .versions-header {padding: 16px 0 8px 0;}
    .versions-header h2 {
        font-size: 16px;
        font-weight: bold;
        color: #333;
        margin-bottom: 12px;
    }
    .barcode-search {margin-top: 10px;position: relative;}
    .barcode-search input {
        width: 100%;
        padding: 7px 36px 7px 10px;
        font-size: 13px;
        border: 1px solid #000;
        border-radius: none;
        outline: none;
        color: #555;
    }
    .barcode-search input:focus {border-color: #aaa;}
    .barcode-search input::placeholder {color: #999; }
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
    .barcode-search .search-btn:hover {color: #333;}
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
    .v-list {max-height: 120px;overflow-y: auto;flex: 1;min-height: 0; }
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
  padding: 0 20px;
  flex-direction: row; 
  flex-wrap: nowrap;  
}
.star-rating-v2 {
  display: flex;
  flex-direction: row-reverse;
  justify-content: flex-start;
  gap: 2px; 
}
.middle-row::before {
  content: "";
  position: absolute;
  height: 24px;
  width: 1px;
  background: #ccc;
  left: 48%; 
  top: 50%;
  transform: translate(-50%, -50%);
}
/* Share button */
.share-btn {display: flex;align-items: center;gap: 5px;color: #0a71b3; font-size: 13px;text-decoration: none;border: none;
  background: none;cursor: pointer;padding: 0;margin-left: 70px;margin-right: 70px;top: -5px;}
.share-btn:hover {text-decoration: underline;}
.share-icon { width: 14px;height: 14px;fill: #0a71b3;}
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
  gap: 4px;              
  padding: 6px 10px; 
  font-size: 12px;
  background: #f2f2e8;
  border: 1px solid #ccc;
  border-radius: 0px;
  cursor: pointer;
  white-space: nowrap;
}
.btn:hover {background: #f2f2e8;}
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
    .track-dur {font-size: 13px;color: #000;}
    .track-credits {padding: 0 0 10px 38px;display: none;}
    .track-credits.open { display: block; }
    .credit-line {
      font-size: 12px;
      color: #000;
      line-height: 1.3;
      padding-left: 12px;
    }
    .credit-line a {color: #1a6bbf;text-decoration: none;}
    .credit-line a:hover { text-decoration: underline; }  
    .companies-section {
        border-top: 1px solid #ccc;
        padding-top: 5px;
        margin-top: 3px;
    }
    .companies-section p {
      line-height: 1.3;
      margin-bottom: 2px; 
      font-size: 12px; 
      color: #000; 
    }
    .companies-section a {color: #0070c0;text-decoration: none;}
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
    margin-top: 3px;}
  .credits-section p {
    line-height: 1.3;
    margin-bottom: 2px;
    font-size: 12px; 
    color: #000;
  }
  .credits-section a {color: #0070c0;text-decoration: none;}
  .credits-section a:hover { text-decoration: underline; }
  .notes-section p {
    margin-bottom: 6px;
    line-height: 1.6;
    color: #000;
    font-size: 12px;
  }
  .notes-section a {color: #0070c0;text-decoration: none;}
  .notes-section,
  .identifiers-section {
    border-top: 1px solid #ccc;
    padding-top: 5px;
    margin-top: 3px;}
  .notes-section a:hover { text-decoration: underline; }
  .identifiers-section p {
    line-height: 1.2; 
    margin: 0; 
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
    background: #fff;}
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
    .review-item {
    border-top: 1px solid #e0e0e0;
    padding: 10px 0;
    display: flex;
    align-items: flex-start;
    gap: 10px;
    position: relative;}
    .avatar {
    width: 48px;
    height: 48px;
    border-radius: 0;
    background-color: #c8c8c8;
    flex-shrink: 0;
    overflow: hidden;
    display: flex;
    align-items: center;
    justify-content: center;}
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
    .review-content {flex: 1;}
    .review-header {
      display: flex;
      align-items: center;
      gap: 8px;
      margin-bottom: 1px;}
    .review-username {
      color: #1a73e8;
      font-weight: bold;
      font-size: 14px;
      text-decoration: none;
    }
    .review-date {color: #666;font-size: 13px;}
    .reviews-title {
      font-size: 15px;
      font-weight: bold;
      color: #000;
      margin-top: 25px;
      padding-bottom: 10px;
      border-bottom: 1px solid #ccc;
      margin-bottom: 16px;}
    .review-text {
      color: #333;
      font-size: 12px;
      line-height: 1.3;
      margin-bottom: 5px; }
    .review-actions {display: flex;gap: 16px;}
    .action-link {
      color: #1a73e8;
      font-size: 13px;
      text-decoration: none;
      display: flex;
      align-items: center;
      gap: 4px;
      cursor: pointer;
    }
    .action-link:hover {text-decoration: underline;}
    .action-icon {font-size: 13px;}
    .dropdown-arrow {
      position: absolute;
      right: 0;
      top: 20px;
      color: #555;
      font-size: 12px;
      cursor: pointer;
    }
  .review-form-wrap {display: none;margin-bottom: 20px;}
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
  .review-preview-box {display: none;margin-top: 6px;}
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
  .review-word-warning em {font-style: italic;}
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
  .review-help-link:hover {text-decoration: underline;}
  .review-menu {position: absolute;top: 10px;right: 0;}
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
    .menu-dropdown a:last-child {border-bottom: none;}
    .menu-dropdown a:hover {background: #e8e8e8;}
    .delete-link {color: #000;}
    .widget {
        font-family: -apple-system, BlinkMacSystemFont, 'SF Pro Text', 'Helvetica Neue', sans-serif;
        background: #fff;
        width: 285px; 
        border-radius: 0;
        box-shadow: none; 
        overflow: hidden;
    }
    /* Header */
    .header {padding: 5px 10px 2px;border-bottom: 1px solid #e5e5e5;}
    .header span {font-size: 11px;font-weight: 600;color: #000;}
    .music-content {background: #f9f9f9;border-radius: 8px;}
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
    .track.dimmed .track-name { color: #ccc;}
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
    .see {
      text-align: right; font-size: 9px; padding: 6px 0px 0px 0px;
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
              
               <img src="{{ $release->image }}" alt="{{ $release->title }}" width="150" height="150">
                <a href="#">More images</a>

            </div>
            <div class="album-meta">
                <div class="album-title">
                  @foreach($artists as $artis)
                    <a href="{{ route('show.artist', $artis->artist_id) }}" class="artist-name">{{ $artis->name }}</a>@if(!$loop->last), @endif
                    @endforeach
                    &ndash; {{ $release->title }}
                </div>
                <table class="album-info-table">
                    <tr>
                        <td>Label:</td>
                        <td>
                          @foreach($labels as $label)
                              <a href="#">{{ $label }}</a> – {{ $release->barcode }}
                              @if(!$loop->last), @endif
                          @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Format:</td>
                        <td>
                          @foreach($formats as $format)
                           <a href="#">{{ $format }}</a>@if(!$loop->last), @endif
                           @endforeach
                        </td>
                    </tr>
                    <tr>
                        <td>Country:</td>
                        <td><a href="#">{{ $release->country }}</a></td>
                    </tr>
                    <tr>
                        <td>Released:</td>
                        <td><a href="#">{{ $release->release_date }}</a></td>
                    </tr>
                    <tr>
                        <td>Genre:</td>
                        @foreach($genres as $genre)
                        <td><a href="#">{{ $genre }}</a>@if(!$loop->last), @endif</td>
                        @endforeach
                    </tr>
                    <tr>
                        <td>Style:</td>
                        @foreach($styles as $style)
                        <td><a href="#">{{ $style }}</a>@if(!$loop->last), @endif</td>
                        @endforeach
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
 
      @foreach($tracks as $track)
      <!-- A1 -->
      <div class="track-row">
        <div class="track-main">
          
          <span class="track-num">{{ $track->position }}</span>
          <span class="track-title">{{ $track->title }}</span>
          <span class="track-dur">{{ $track->duration }}</span>
          
        </div>
        <div class="track-credits" id="c0">
          @foreach($credits as $credit)
          <div class="credit-line">{{ $credit->role }} – 
            <a href="#">{{ $credit->name }}</a></div>
          @endforeach 
        </div>
      </div>
    @endforeach 
    </div>

    <!-- Companies -->
    <h2>Companies, etc.</h2>
    <div class="companies-section">
      @foreach($companies as $companie)
        <p>{{ $companie->role }}–
          <a href="#"> {{ $companie->name }}</a>
        </p>
      @endforeach
    </div>

    <h2>Credits</h2>
    <div class="credits-section">
      @foreach($credits as $credit)
      <p>{{ $credit->role }} 
        <a href="#">{{ $credit->name }}</a>
      </p>
      @endforeach
    </div>
 
    <h2>Notes</h2>
    <div class="notes-section">
      <p> {{ $release->notes }} </p>
    </div>
 
    <h2>Barcode and Other Identifiers</h2>
    <div class="identifiers-section">
      @foreach($barcodes as $barcode)
      <p>{{ $barcode->type }} {{ $barcode->description }}: {{ $barcode->value }}</p>
      @endforeach
    </div>

    <!-- OTHER VERSIONS -->
    <div class="section-header">
      <span>Other Versions ({{ $otherVersions->count() }} of {{ $totalVersions }})</span>
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
    @foreach($otherVersions as $version)
    <div class="table-row">
      <div class="col-title">
        <a href="{{ route('show.release', $version->release_id) }}">
                {{ $version->title }}
            </a>
      </div>
      <div class="col-label"><a href="#">{{ $version->labels }} ,</a></div>
      <div class="col-cat">{{ $version->catno }} ,<br></div>
      <div class="col-country">{{ $version->country }}</div>
      <div class="col-year"> {{ \Carbon\Carbon::parse($version->release_date)->format('Y') }}</div>
    </div>
    @endforeach
 
<!-- RECOMMENDATIONS -->
<div class="rec-header">Recommendations</div>
 
<div class="rec-list">
 
  @foreach($recommendations as $recommendation)
  <div class="rec-card">
    <a href="{{ route('show.release', $recommendation->release_id) }}">
    <img src="{{ $recommendation->image }}" onerror="this.style.display='none';this.nextElementSibling.style.display='flex';" alt="{{ $recommendation->title }}">

    <!-- <div class="img-placeholder" style="background:#222;color:#fff;font-size:10px;text-align:center;padding:4px;">{{ $recommendation->title }}<br>
    <small>{{ $recommendation->artist }}</small>
    </div> -->
    </a>

    <div class="rec-title">{{ $recommendation->title }}</div>
    <div class="rec-artist">{{ $recommendation->artist }}</div>
    <div class="rec-year">  {{ \Carbon\Carbon::parse($release->release_date)->format('Y') }} &amp; {{ $recommendation->country }}</div>
    <div class="rec-format">{{ $recommendation->formats }}</div>
    <button class="btn-shop">Shop</button>
    <button class="btn-want">Want</button>
  </div>
  @endforeach
  </div>
 
<div class="reviews-title">Reviews</div>

<form action="{{ route('release.review', $release->release_id) }}" method="POST" id="reviewStoreForm">
    @csrf
    <div id="reviewForm" class="review-form-wrap" style="display:block;">
        <textarea
            id="reviewInput"
            class="review-textarea"
            placeholder="Enter your comment"
            name="comment"
            oninput="validasiReview('submit')" 
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
 
  <!-- Review 1 -->
  @foreach($reviews as $review)
  <div class="review-item">
    <div class="avatar">
      <img src="{{ $review->image }}" alt="{{ $review->username }}" />
    </div>

    <div class="review-content">
      <div class="review-header">
        <a href="#" class="review-username">{{ $review->username }}</a>
        <span class="review-date">{{ \Carbon\Carbon::parse($review->created_at)->format('M d, Y') }}</span>
      </div>

      @if(!empty($review->rating) && $review->rating > 0)
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
      @endif

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

          <div id="editPreviewBox{{ $review->review_id }}" class="review-preview-box" style="display:block; margin-top:10px;">
            <div class="review-preview-label">Preview</div>
            <div id="editPreviewText{{ $review->review_id }}" class="review-preview-text">
              {{ $review->comment }}
            </div>
          </div>

          <div id="editWordWarning{{ $review->review_id }}" class="review-word-warning" style="display:none; margin-top:5px;">
            <span style="color:#cc0000; font-weight:bold;">&#9432;</span>
            <em>At least 10 words must be entered.</em>
          </div>

          <div class="review-form-footer">
            <button type="submit" id="editSubmitBtn{{ $review->review_id }}" class="review-submit-btn active">
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

                <button type="submit" class="delete-link" style="
                  background:none;
                  border:none;
                  width:100%;
                  text-align:left;
                  padding:10px 12px;
                  cursor:pointer;
                  font-size:14px;">
                    🗑 Delete
                </button>
            </form>
          </div>
    </div>
  </div>

   <!-- <div class="stars">
        <span class="star">{{ $review->rating }}</span>
    </div> -->
 @endforeach
 </div>

 
 
    <!-- end .album-left -->

    <!--  RIGHT COLUMN -->
    <div class="album-right">

        <!-- Master Release -->
        <div class="master-release-header">
            <span>Release</span>
            <span class="release-id">
                <span class="release-icon"></span>
                [r{{ $release->release_id }}]
            </span>
        </div>
        <div class="master-release-links">
            <a href="#">Edit Release</a>
            <a href="{{route('album.versions', $release->master_id)}}">See all versions</a>
            <span style="color:black;">Recently Edited</span> 
        <!-- </div> -->

        <!-- For Sale -->
        <div class="for-sale-header">
            <span>For Sale</span>
            <a href="#">Sell a copy</a>
        </div>

        <div class="release-card">
            <img src="{{ $release->image }}" alt="{{ $release->title }}" width="150" height="150">
            <div class="release-card-info">
                <div class="label">{{ strtoupper($formats->first() ?? '-') }}</div>
                <div class="title">{{ $release->title }}</div>
                <div class="price-range">From {{ $stats->lowest_price }} to {{ $stats->highest_price }}</div>
            </div>
        </div>

        <a href="{{ route('sell.list', ['release_id' => $release->release_id]) }}" class="btn-shop">
    Shop {{ $productCount }} {{ strtoupper($formats->first()) }}
        </a>

        <!-- Statistics -->
        <div class="stats-box">
            <h3>Statistics</h3>
            <div class="stats-grid">
                <div class="stat-pair">
                    <div class="stat-label">Have:</div>
                    <a href="">
                    <div class="stat-value">{{ $stats->have }}</div>
                    </a>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Last Sold:</div>
                    <div class="stat-value">{{ $stats->last_sold ? date('M j, Y', strtotime($stats->last_sold)) : 'Never' }}</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Want:</div>
                    <div class="stat-value">{{ $stats->want }}</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Low:</div>
                    <div class="stat-value">{{ number_format($stats->lowest_price, 2) }}</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Avg Rating:</div>
                    <div class="stat-value">{{ number_format($stats->avg_rating, 2) }} / 5</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Median:</div>
                    <div class="stat-value">{{ number_format($stats->median_price, 2) }}</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">Ratings:</div>
                    <div class="stat-value">{{ $stats->total_rating, 2 }}</div>
                </div>

                <div class="stat-pair">
                    <div class="stat-label">High:</div>
                    <div class="stat-value">{{ number_format($stats->highest_price, 2) }}</div>
                </div>
            </div>
        </div>

        <div class="middle-row">
        <div class="star-rating-v2">
            <input type="radio" id="star5" name="rating" value="5" form="reviewStoreForm" style="display:none;" />
            <label for="star5" class="star-label" onclick="setRating(5)" style="font-size: 24px; cursor: pointer; color: #ccc;">★</label>

            <input type="radio" id="star4" name="rating" value="4" form="reviewStoreForm" style="display:none;" />
            <label for="star4" class="star-label" onclick="setRating(4)" style="font-size: 24px; cursor: pointer; color: #ccc;">★</label>

            <input type="radio" id="star3" name="rating" value="3" form="reviewStoreForm" style="display:none;" />
            <label for="star3" class="star-label" onclick="setRating(3)" style="font-size: 24px; cursor: pointer; color: #ccc;">★</label>

            <input type="radio" id="star2" name="rating" value="2" form="reviewStoreForm" style="display:none;" />
            <label for="star2" class="star-label" onclick="setRating(2)" style="font-size: 24px; cursor: pointer; color: #ccc;">★</label>

            <input type="radio" id="star1" name="rating" value="1" form="reviewStoreForm" style="display:none;" />
            <label for="star1" class="star-label" onclick="setRating(1)" style="font-size: 24px; cursor: pointer; color: #ccc;">★</label>
        </div>

        <button class="share-btn">
            <svg class="share-icon" viewBox="0 0 24 24">
                <path d="M14 3h7v7h-2V6.41l-9.29 9.3-1.42-1.42 9.3-9.29H14V3z"></path>
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
        <img src="{{ $release->image }}" alt="Album Art">
      </div>
      <div>
        <div class="album-title">{{ $release->title }}</div>
        <div class="album-artist">{{ $artis->name }}</div>
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
 
  <!-- Play Button -->
  <div class="play-wrap">
    <button class="btn-play">
      <svg width="14" height="16" viewBox="0 0 14 16" fill="white">
        <polygon points="0,0 14,8 0,16"/>
      </svg>
      <span>Play</span>
    </button>
  </div>

  <div class="view-app">
    <a href="#">View in App ↗</a>
    <div class="see">
      <span>See how your data is managed...</span>
    </div>
    
  </div>

</div>
</div>

        
              <div id="video-sidebar-section">
                <div class="v-header">
                    <h2>Videos ({{ $videos->count() }})</h2>
                    <a href="#" class="small">Edit</a>
                </div>

                @if($videos->count() > 0)
                <div class="main-player" id="mainPlayer">
                    <img src="{{ $videos[0]->thumbnail }}" id="currentThumb">
                    <div class="play-btn-overlay"></div>
                </div>
                @endif
                <!-- </div> -->

                <div class="v-list">
                    @foreach($videos as $video)
                    <div class="v-item" onclick="changevideo('{{ $video->thumbnail }}', '{{ $video->youtube_url }}') ">
                        <div class="v-thumb">
                            <img src="{{ $video->thumbnail }}">
                            <span class="v-time"> {{ $video->duration }} </span>
                        </div>
                        <div class="v-title"><b> {{ $video->title }} </b></div>
                    </div>
                    @endforeach
                </div>

                <div class="l-section">
      <div style="margin-bottom: 10px;">
    <div style="margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 8px;">
      <span style="font-weight: bold; font-size: 13px;">Lists</span>
      <span data-bs-toggle="modal" data-bs-target="#addToListModal" style="color:#0070c0; cursor:pointer;">Add to List</span>
    </div>
    <!-- MODAL -->
<div class="modal fade" id="addToListModal" tabindex="-1" aria-hidden="true">

  <div class="modal-dialog modal-dialog-centered" style="max-width:450px;">

    <div class="modal-content">

      <!-- HEADER -->
      <div class="modal-header border-0 pb-2">

        <h5 class="modal-title fw-bold">
          Add Artist to List
        </h5>

        <button type="button"
                class="btn-close"
                data-bs-dismiss="modal">
        </button>

      </div>

      <hr class="m-0" style="color:#eee; opacity:1;">

      <!-- BODY -->
      <div class="modal-body p-3">

        <form>

          <!-- RADIO -->
          <div class="mb-3 mt-1">

            <div class="form-check form-check-inline">

              <input class="form-check-input"
                     type="radio"
                     name="listOption"
                     id="radioExisting"
                     checked>

              <label class="form-check-label" for="radioExisting">
                Existing List
              </label>

            </div>

            <div class="form-check form-check-inline">

              <input class="form-check-input"
                     type="radio"
                     name="listOption"
                     id="radioNew">

              <label class="form-check-label" for="radioNew">
                New List
              </label>

            </div>

          </div>

          <!-- NEW LIST -->
          <div id="new-list-fields" class="d-none">

            <div class="mb-3">

              <label class="form-label">
                Title
              </label>

              <input type="text"
                     class="form-control"
                     placeholder="Enter list title">

            </div>

            <div class="mb-3">

              <label class="form-label">
                Description
                <span class="text-muted fst-italic">
                  Optional
                </span>
              </label>

              <textarea class="form-control"
                        rows="2"
                        style="resize:vertical;"
                        placeholder="Write description">
              </textarea>

            </div>

          </div>

          <!-- EXISTING LIST -->
          <div id="existing-list-fields">

            <div class="mb-3">

              <label class="form-label">
                List
              </label>

              <select class="form-select">

                <option>Favorite Artists</option>
                <option>Best Rock Albums</option>
                <option>Vinyl Collection</option>
                <option>My Playlist</option>

              </select>

            </div>

          </div>

          <!-- COMMENTS -->
          <div class="mb-3">

            <label class="form-label">
              Comments on this item
              <span class="text-muted fst-italic">
                Optional
              </span>
            </label>

            <textarea class="form-control"
                      rows="2"
                      style="resize:vertical;"
                      placeholder="Write comments">
            </textarea>

          </div>

          <!-- BUTTON -->
          <div class="d-flex gap-2 pt-2">

            <button type="button"
                    class="btn btn-success">
              Save
            </button>

            <button type="button"
                    class="btn btn-light"
                    data-bs-dismiss="modal">
              Cancel
            </button>

          </div>

        </form>

      </div>
    </div>
  </div>
</div>

    <div style="font-size: 12px; line-height: 1.8;">
      @foreach($lists as $list)
      <div>{{ $list->username }} by <span style="color: #0088cc; cursor: pointer;">{{ $list->username }}</span></div>
      @endforeach
    </div>
    <a href="/lists">
    <div style="width: 100%; border-top: 1px solid #ccc; padding-top: 8px; color: #0088cc;">View More Lists →</div>
    </a>
  </div>
  </div>

    <div style="margin-bottom: 10px; border-bottom: 1px solid #ccc; padding-bottom: 8px; font-weight: bold;">Contributors</div>
    @foreach($contributors as $contributor)
    <div style="font-size: 12px; line-height: 1.8; color: #0088cc;">
      {{ $contributor->username }}
  </div>
  @endforeach

  
    <div style="width: 100%; border-top: 1px solid #ccc; padding-top: 8px; color: #0088cc;">Report Suspicious Activity</div>
 </div>
      </div>
    </div>

    
   
    <!-- end .album-right -->
     

<script>

  function playTrack(el) {
    const url = el.getAttribute('data-audio');
    const player = document.getElementById('player');
    player.src = url;
    player.play();
  }

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

function setRating(ratingValue) {
    const labels = document.querySelectorAll('.star-rating-v2 .star-label');
    
    labels.forEach((label) => {
        // Mengambil nilai value dari atribut 'for' label (contoh: 'star5' diambil angka 5 nya)
        const htmlFor = label.getAttribute('for');
        const starValue = parseInt(htmlFor.replace('star', ''));

        if (starValue <= ratingValue) {
            label.style.color = '#e67e22'; // Warna orange/emas jika terpilih
        } else {
            label.style.color = '#ccc'; // Abu-abu jika tidak terpilih
        }
    });
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
    document.addEventListener('DOMContentLoaded', function () {

    const radioExisting = document.getElementById('radioExisting');
    const radioNew = document.getElementById('radioNew');

    const existingFields = document.getElementById('existing-list-fields');
    const newFields = document.getElementById('new-list-fields');

    function toggleFields() {

        if (radioNew.checked) {

            newFields.classList.remove('d-none');
            existingFields.classList.add('d-none');

        } else {

            newFields.classList.add('d-none');
            existingFields.classList.remove('d-none');

        }
    }

    radioExisting.addEventListener('change', toggleFields);
    radioNew.addEventListener('change', toggleFields);

    toggleFields();
});
</script>
</div>
@endsection