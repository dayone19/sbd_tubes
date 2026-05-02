<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Versions Section</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Helvetica Neue', Arial, sans-serif;
            font-size: 13px;
            color: #333;
            background: #fff;
        }

        .page-wrapper {
            display: flex;
            max-width: 1300px;
            margin: 0 auto;
            gap: 0;
        }

        /* ===================== MAIN CONTENT ===================== */
        .main-content {
            flex: 1;
            padding: 0 0 20px 0;
            border-right: 1px solid #ddd;
            min-width: 0;
        }

        /* Show more credits */
        .show-more-credits {
            text-align: center;
            border-top: 1px solid #ddd;
            border-bottom: 1px solid #ddd;
            padding: 8px 0;
            font-size: 13px;
            color: #333;
            cursor: pointer;
            background: #fff;
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

        /* Versions header */
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
            border: 1px solid #ccc;
            border-radius: 3px;
            background: #fff;
            appearance: none;
            -webkit-appearance: none;
            cursor: pointer;
            outline: none;
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
            font-size: 11px;
            color: #555;
            pointer-events: none;
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
            border: 1px solid #ccc;
            border-radius: 3px;
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
            border-top: 1px solid #ccc;
            border-bottom: 1px solid #ccc;
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
            border-bottom: 1px solid #ddd;
            background: #f9f9f9;
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
            align-items: start;
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
            border-left: 4px solid #f5a623;
            margin-bottom: 2px;
        }

        /* ===================== SIDEBAR ===================== */
        .sidebar {
            width: 260px;
            flex-shrink: 0;
            padding: 0 0 20px 20px;
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
            display: inline-block;
            margin-top: 8px;
            font-size: 13px;
            color: #0000ff;
            text-decoration: none;
        }

        .view-more-lists:hover {
            text-decoration: underline;
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
    </style>
</head>
<body>
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
        <div class="versions-header">
            <h2>Versions</h2>
        </div>

        <!-- Filter by -->
        <div class="filter-section">
            <div class="filter-label">Filter by</div>
            <div class="filter-row">
                <div class="filter-select">
                    <select>
                        <option value="">Find a format</option>
                        <option value="lp">LP</option>
                        <option value="cd">CD</option>
                        <option value="cassette">Cassette</option>
                    </select>
                </div>
                <div class="filter-select">
                    <select>
                        <option value="">Find a label or comp...</option>
                        <option value="atlantic">Atlantic</option>
                        <option value="columbia">Columbia</option>
                    </select>
                </div>
                <div class="filter-select">
                    <select>
                        <option value="">Find a country</option>
                        <option value="usa">USA</option>
                        <option value="europe">Europe</option>
                        <option value="uk">UK</option>
                    </select>
                </div>
                <div class="filter-select">
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

    </div><!-- end main-content -->

    <!-- ===== SIDEBAR ===== -->
    <div class="sidebar">

        <!-- Media item -->
        <div class="sidebar-media">
            <div class="media-item">
                <div class="media-thumb">
                    <div style="background:#222;width:100%;height:100%;display:flex;align-items:center;justify-content:center;">
                        <span style="color:#fff;font-size:10px;text-align:center;padding:4px;">Album</span>
                    </div>
                    <div class="media-progress">
                        <div class="media-progress-bar"></div>
                    </div>
                    <div class="media-time">0:00</div>
                </div>
                <div class="media-info">
                    <a href="#">Bruno Mars - The Romantic</a>
                </div>
            </div>
            <div style="text-align:center;">
                <span class="sidebar-collapse-btn">▾</span>
            </div>
        </div>

        <!-- Lists section -->
        <div class="sidebar-section">
            <div class="sidebar-section-header">
                <h3>Lists</h3>
                <a href="#">Add to List</a>
            </div>

            <div class="list-item">
                <a href="#">listening log</a> by <a href="#">agasa</a>
            </div>
            <div class="list-item">
                <a href="#">Albums/EPs I've Listened To</a> by <a href="#">DylanBrylren</a>
            </div>
            <div class="list-item">
                <a href="#">ren</a> by <a href="#">sirenzz</a>
            </div>
            <div class="list-item">
                <a href="#">Albums I Really Want</a> by <a href="#">Britliz1960</a>
            </div>
            <div class="list-item">
                <a href="#">past - present - eternal.</a> by <a href="#">BubbleBuzz</a>
            </div>

            <a href="#" class="view-more-lists">View More Lists →</a>
        </div>

        <!-- Ad placeholder -->
        <div class="sidebar-ad">
            <div style="background: linear-gradient(135deg, #1a237e 0%, #283593 40%, #1565c0 100%); width:100%; height:100%; display:flex; flex-direction:column; align-items:center; justify-content:center; position:relative;">
                <div class="sidebar-ad-logo">Digs</div>
                <div class="sidebar-ad-badge">&#9432;</div>
                <div style="color:#fff; font-size:28px; font-weight:900; text-align:center; text-transform:uppercase; letter-spacing:2px; padding: 10px; text-shadow: 2px 2px 0px #000; line-height:1.2;">
                    GOD SAVE THE QUEEN
                    <div style="font-size:18px; margin-top:4px; letter-spacing:3px;">SEX PISTOLS</div>
                </div>
                <div class="sidebar-ad-overlay">
                    God Save Your Green: The 25 Most Expensive Punk 7-inches
                </div>
            </div>
        </div>

    </div><!-- end sidebar -->

</div><!-- end page-wrapper -->
</body>
</html>