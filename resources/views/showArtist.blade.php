@extends('layouts.app')

@section('title', 'Artist')

@section('content')
<style>
.row {margin-right: 0;margin-left: 0;}
.artist-page {font-size: 14px;color: #222;}
/* TITLE */
.artist-name {font-size: 28px;font-weight: 700;margin-top: 15px;}
/* IMAGE */
.artist-img {width: 160px;margin: 25px;}
/* INFO */
.info-row {display: flex;margin-bottom: 8px;}
.label {width: 130px;color: #555;}
.content {flex: 1;}
.profile-text {line-height: 1.5;}
/* LINK */
.artist-page a {color: #2a5bd7;text-decoration: none;}
.row { margin-right: 0;margin-left: 0;}
/* SIDEBAR */
.sidebar {padding-left: 20px; width: 400px;}
.sidebar .d-flex {margin-top: 10px;}
/* SMALL TEXT */
.small {font-size: 12px;color: #666;}
/* BUTTON */
.btn-green {background: #0a7d12;color: white;font-weight: 600;}
.btn-green:hover {background: #06680d;}
/* PANAH BULAT PUTIH */
.carousel-control-prev,
.carousel-control-next {width: 40px;height: 40px;top: 40%;transform: translateY(-50%);background-color: white; border-radius: 50%;opacity: 1 !important;box-shadow: 0 2px 6px rgba(0,0,0,0.2);}
/* ICON HITAM */
.carousel-control-prev-icon,
.carousel-control-next-icon {filter: invert(1);width: 18px; height: 18px;}
/* DOT KECIL */
.carousel-indicators {position: static;margin-top: 10px;justify-content: center;}
.carousel-indicators [data-bs-target] {width: 6px;height: 6px;border-radius: 50%;background-color: #ccc; margin: 0 3px;}
.carousel-indicators .active {background-color: #333;}
.tab-btn {background: #eee;border: none;padding: 8px 15px;font-size: 14px;}
.tab-btn.active { background: #333;color: white;}
.filter-item, .filter-box {cursor: pointer; padding: 8px 10px;border-radius: 6px;width:200px}
.filter-item:hover {background: #f2f2f2;}
.filter-item.active,
.filter-box.active {background: #e5e5e5;font-weight: 600;}
#releaseMenu {margin-left: 10px;}
.hidden {display: none;}
.filter-box { display: flex;justify-content: space-between; cursor: pointer; padding: 8px 10px; border-radius: 6px;background: #eee;font-weight: 600;width:200px; ;}
.arrow {
    display: inline-block;
    width: 6px;
    height: 6px;
    border: solid black;
    border-width: 0 2px 2px 0;
    margin-right: 8px;
    transition: 0.2s;
}
/* arah panah */
.arrow.right {transform: rotate(-45deg);}
.arrow.down {transform: rotate(45deg);}
/* tombol */
.view-btn { border: 1px solid #ccc;background: white; padding: 5px 10px;}
.view-btn.active { background: #333; color: white;}
/* view default*/
.release-main,.release-label,.release-year,.release-more,.grid-info {display: none;}
/* gridview*/
#releaseContainer.grid-view .grid-info {display: block;text-align: left;}
#releaseContainer.grid-view .release-item {display: block;}
.grid-info .title {color: purple; font-weight: 700;font-size: 16px;}
.grid-info .artist { color: purple; font-size: 14px;}
.grid-info .year {font-size: 14px;  color: #333;}
/* gridlistview*/
#releaseContainer.gridlist-view .release-main,#releaseContainer.gridlist-view .release-label,#releaseContainer.gridlist-view .release-year, #releaseContainer.gridlist-view .release-more {display: block;}
#releaseContainer.gridlist-view .release-item {display: grid;grid-template-columns: 60px 2fr 1.5fr 80px 40px;align-items: center;gap: 15px;padding: 12px 0;border-bottom: 1px solid #ddd;}
/* listview */
#releaseContainer.list-view .release-main,#releaseContainer.list-view .release-label,#releaseContainer.list-view .release-year,#releaseContainer.list-view .release-more {display: block;}
#releaseContainer.list-view .release-item {display: grid;grid-template-columns: 1fr 1fr 80px 40px;align-items: center; padding: 12px 0;border-bottom: 1px solid #ddd;}
#releaseContainer.list-view img {display: none;}
#releaseContainer.list-view .release-main .title {color: #2a5bd7;font-weight: 500;}
#releaseContainer.list-view .versions { font-size: 12px;background: #eee; padding: 3px 8px; border-radius: 4px;display: inline-block;margin-top: 5px;}
.release-label {color: #2a5bd7;}
.release-year {text-align: right;}
.release-more {text-align: center;}
.master-release-header {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
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
        margin-top: 40px;
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
</style>

<div class="artist-page">
<div class="row">

    <!-- LEFT -->
    <div class="col-md-2">
        <img src="https://i.discogs.com/k_MaY-4qMwso5o-xKS4MxnsZKCk8vBgj6irhOgJ4Hoo/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTMzMTA3/MzctMTc3NTMyNzI2/Ny04NjUwLmpwZWc.jpeg" class="artist-img">
    </div>

    <!-- MIDDLE -->
    <div class="col-md-6">
        <div class="artist-name">Ariana Grande</div>

        <div class="info-row">
            <div class="label">Real Name:</div>
            <div class="content">Ariana Grande-Butera</div>
        </div>

        <div class="info-row">
            <div class="label">Profile:</div>
            <div class="content profile-text">
                American singer and actress, born June 26, 1993.
                Grande began her career in the Broadway musical 13, before landing the role of Cat Valentine on the Nickelodeon television series Victorious in 2009.
                After the show ended, Grande rose to prominence as a teen idol on her own spinoff, Sam & Cat. She later signed a recording contract with Republic Records, and released 7 studio albums with them: Yours Truly in 2013, 
                My Everything in 2014, Dangerous Woman in 2016, Sweetener in 2018, Thank U, Next in 2019, Positions in 2020, and Eternal Sunshine in 2024.
            </div>
        </div>

        <div class="info-row">
            <div class="label">Sites:</div>
            <div class="content">arianagrande.com , Facebook , X , Instagram , Instagram , Instagram , Soundcloud , YouTube , YouTube , YouTube , Wikipedia , Lastfm </div>
        </div>

        <div class="info-row">
            <div class="label">In Groups:</div>
            <div class="content">Kids Who Care: The Musical Troupe, Victorious Cast, Wicked Movie Cast </div>
        </div>

        <div class="info-row">
            <div class="label">Variations:</div>
            <div class="content">Viewing All| Ariana Grande</div>
        </div>

        <div class="info-row">
            <div class="content">A Grande, A. Grande, Ariana Grande-Butera, Arianna Grande, Grande, アリアナ・グランデ, 亞莉安娜, 安娜公主亞莉安娜</div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="col-md-3 sidebar">

        <div class="master-release-header">
            <span>Artist</span>
            <span class="release-id">
                <span class="release-icon"></span>
                [a{{ $album->master_id ?? '3310737' }}]
            </span>
        </div>
        <div class="master-release-links">
            <a href="#">Edit Artist</a>
        </div>
        
        <div class="d-flex justify-content-between">
            <strong>For Sale</strong>
            <span>Sell a copy</span>
        </div>
        <hr>

        <!-- CAROUSEL -->
        <div id="saleCarousel" class="carousel slide" data-bs-ride="carousel">

            <div class="carousel-inner">

                <!-- ITEM 1 -->
                <div class="carousel-item active">
                    <div class="d-flex mt-2">
                        <img src="https://i.discogs.com/dftp2W1wk61cXlEdpBsPvsa4bqatbTgV0F5e2okcxK4/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTI5OTcz/Mjc3LTE3MTAxMTEw/MjItMTQ3Ni5qcGVn.jpeg" width="100" height="100" class="me-2">

                        <div>
                            <div class="small">MASTER RELEASE</div>
                            <strong>Wicked: For Good</strong><br>
                            <span class="small">2025</span><br>
                            <span class="small">Vinyl · CD</span><br>
                            <span class="small">From $5 to $500</span>
                        </div>
                    </div>

                    <button class="btn btn-green w-100 mt-3">
                        Shop 625 Listings
                    </button>
                </div>

                <!-- ITEM 2 -->
                <div class="carousel-item">
                    <div class="d-flex mt-2">
                        <img src="https://via.placeholder.com/90" width="90" class="me-2">

                        <div>
                            <div class="small">MASTER RELEASE</div>
                            <strong>Album 2</strong><br>
                            <span class="small">2024</span><br>
                            <span class="small">2024</span>
                        </div>
                    </div>

                    <button class="btn btn-green w-100 mt-3">
                        Shop 120 Listings
                    </button>
                </div>

            </div>

            <!-- PANAH -->
            <button class="carousel-control-prev" type="button" data-bs-target="#saleCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#saleCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>

            <!-- DOT -->
            <div class="carousel-indicators">
                <button data-bs-target="#saleCarousel" data-bs-slide-to="0" class="active"></button>
                <button data-bs-target="#saleCarousel" data-bs-slide-to="1"></button>
            </div>

        </div>

        <!-- BUTTON BAWAH -->
        <button class="btn btn-light w-100 mt-2">
            Shop All Ariana Grande
        </button>

    </div>

</div>

<div class="container mt-4">

    <!-- TAB NAV -->
    <div class="mt-5 border-bottom">
        <div class="d-flex gap-2">
            <button data-tab="discography" class="tab-btn active">Discography</button>
            <button data-tab="reviews" class="tab-btn">Reviews</button>
            <button data-tab="videos" class="tab-btn">Videos</button>
            <button data-tab="lists" class="tab-btn">Lists</button>
        </div>
    </div>

    <!-- RELEASES -->
    <div id="tab-discography" class="tab-content">
        <div class="mt-4">
        <!-- left -->
        <div class="row">
            <!-- sidebar -->
            <div class="col-md-3 filter-sidebar">

                <div class="filter-box" onclick="toggleMenu('releaseMenu', this)">
                    <span class="arrow down"></span> Releases <span>88</span>
                </div>
                <div id="releaseMenu">
                    <div class="filter-item">Albums <span>12</span></div>
                    <div class="filter-item">Singles & EPs <span>72</span></div>
                    <div class="filter-item">Compilations <span>2</span></div>
                    <div class="filter-item">Miscellaneous <span>2</span></div>
                </div>

                <!-- APPEARANCES -->
                <div class="filter-box mt-2" onclick="toggleMenu('appearMenu', this)">
                    <span class="arrow down"></span> Appearances <span>1422</span>
                </div>
                <div id="appearMenu" class="hidden">
                    <div class="filter-item">Albums <span>64</span></div>
                    <div class="filter-item">Singles & EPs <span>4</span></div>
                    <div class="filter-item">Compilations <span>1187</span></div>
                    <div class="filter-item">Mixes <span>140</span></div>
                    <div class="filter-item">Videos <span>22</span></div>
                    <div class="filter-item">Miscellaneous <span>5</span></div>
                </div>

                <!-- UNOFFICIAL -->
                <div class="filter-box mt-2" onclick="toggleMenu('unoffMenu', this)">
                    <span class="arrow down"></span> Unofficial <span>52</span>
                </div>
                <div id="unoffMenu" class="hidden">
                    <div class="filter-item">Albums <span>13</span></div>
                    <div class="filter-item">Singles & EPs <span>20</span></div>
                    <div class="filter-item">Compilations <span>9</span></div>
                    <div class="filter-item">Videos <span>2</span></div>
                    <div class="filter-item">Miscellaneous <span>8</span></div>
                </div>

                <!-- CREDITS -->
                <div class="filter-box mt-2" onclick="toggleMenu('creditMenu', this)">
                    <span class="arrow down"></span> Credits <span>366</span>
                </div>
                <div id="creditMenu" class="hidden">
                    <div class="filter-item">Featuring & Presenting <span>107</span></div>
                    <div class="filter-item">Writing & Arrangement <span>156</span></div>
                    <div class="filter-item">Production <span>31</span></div>
                    <div class="filter-item">Vocals <span>61</span></div>
                    <div class="filter-item">Technical <span>5</span></div>
                    <div class="filter-item">Instruments & Performance <span>5</span></div>
                    <div class="filter-item">Visual <span>1</span></div>
                </div>

            </div>


            <!-- RIGHT CONTENT -->
            <div class="col-md-9">

                <h5 class="fw-bold">Release</h5>

                <!-- FILTER BAR (hidden) -->
                <div id="filterBar" class="bg-light p-3 rounded mb-3 d-none">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Find a format">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Find a label">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Find a country">
                        </div>
                        <div class="col-md-3">
                            <input type="text" class="form-control" placeholder="Find a year">
                        </div>
                    </div>

                    <input type="text" class="form-control mt-2" placeholder="Search Discography">
                </div>

                <!-- TOP CONTROL -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="small">
                        Showing 1–25 of 88
                        <a href="#" class="ms-2">Next ›</a>
                    </div>

                    <div class="d-flex align-items-center gap-2">
                        <button id="toggleFilter" class="btn btn-dark rounded-pill px-3" style="width:170px;">
                            <div class="d-flex justify-content-between align-items-center">
                                <span>Search & Filters</span>
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" fill="currentColor" class="bi bi-sliders2" viewBox="0 0 16 16">
                                    <path fill-rule="evenodd" d="M10.5 1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4H1.5a.5.5 0 0 1 0-1H10V1.5a.5.5 0 0 1 .5-.5M12 3.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-6.5 2A.5.5 0 0 1 6 6v1.5h8.5a.5.5 0 0 1 0 1H6V10a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5M1 8a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 1 8m9.5 2a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V13H1.5a.5.5 0 0 1 0-1H10v-1.5a.5.5 0 0 1 .5-.5m1.5 2.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                                </svg>
                            </div>
                        </button>

                        <span id="sortYear" class="small" style="cursor:pointer;">
                            Year ↑
                        </span>

                        <button class="view-btn" data-view="grid">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z"/>
                            </svg>
                        </button>
                        <button class="view-btn active" data-view="gridlist"> 
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z"/>
                            <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z"/>
                            <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z"/>
                            </svg>
                        </button>
                        <button class="view-btn" data-view="list">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-list" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2.5 12a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5m0-4a.5.5 0 0 1 .5-.5h10a.5.5 0 0 1 0 1H3a.5.5 0 0 1-.5-.5"/>
                            </svg>
                        </button>

                        <select class="form-select form-select-sm" style="width:70px;">
                            <option>25</option>
                            <option>50</option>
                            <option>100</option>
                            <option>250</option>
                            <option>500</option>
                        </select>
                    </div>

                </div>

                <!-- LIST ITEM -->
                <div id="releaseContainer" class="gridlist-view">

                    <div class="release-item" data-year="2013">
                        <img src="https://i.discogs.com/hR1_tNewaSFa8myEfAwEdXYo5xnDKYZOrdCz8nYkW_8/rs:fit/g:sm/q:40/h:150/w:150/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTQ5NDI0/MzQtMTQ2MzY2NzI4/OC01MTM4LmpwZWc.jpeg">

                        <!-- GRID VIEW -->
                        <div class="grid-info">
                            <div class="title"><a href="#">Yours Truly</a></div>
                            <div class="artist"><a href="#">Ariana Grande</a></div>
                            <div class="year">2013</div>
                        </div>

                        <!-- GRIDLIST + LIST -->
                        <div class="release-main">
                            <div>
                                <div class="title"><a href="#">Yours Truly</a></div>
                                <div class="versions">36 versions ▼</div>
                            </div>
                        </div>

                        <div class="release-label">Republic Records</div>
                        <div class="release-year">2013</div>
                        <div class="dropdown">
                            <div class="release-more" data-bs-toggle="dropdown" style="cursor:pointer;">
                                •••
                            </div>
                            <ul class="dropdown-menu" style="color: black; background: white; border: 1px solid #ddd;">
                                <li><a class="dropdown-item" href="#">Add to List</a></li>
                                <li><a class="dropdown-item" href="#">Edit Master Release</a></li>
                            </ul>
                        </div>

                    </div>

                    <!-- ini kubikin buat ngecek tombol year aj-->
                    <div class="release-item" data-year="2024">
                            
                        <img src="https://i.discogs.com/dftp2W1wk61cXlEdpBsPvsa4bqatbTgV0F5e2okcxK4/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTI5OTcz/Mjc3LTE3MTAxMTEw/MjItMTQ3Ni5qcGVn.jpeg" width="150">

                        <!-- GRID VIEW -->
                        <div class="grid-info">
                            <div class="title"><a href="#">Eternal Sunshine</a></div>
                            <div class="artist"><a href="#">Ariana Grande</a></div>
                            <div class="year">2024</div>
                        </div>

                        <!-- GRIDLIST + LIST -->
                        <div class="release-main">
                            <div>
                                <div class="title"><a href="#">Eternal Sunshine</a></div>
                                <div class="versions">60 versions ▼</div>
                            </div>
                        </div>

                        <div class="release-label">Republic Records</div>
                        <div class="release-year">2024</div>
                        <div class="dropdown" >
                            <div class="release-more" data-bs-toggle="dropdown" style="cursor:pointer;">
                                •••
                            </div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Add to List</a></li>
                                <li><a class="dropdown-item" href="#">Edit Master Release</a></li>
                            </ul>
                        </div>

                    </div>

                </div>

            </div>
        </div>
        </div>
    </div>

    <!-- REVIEWS -->
    <div id="tab-reviews" class="tab-content d-none">
        <h4>Reviews</h4>
        <textarea class="form-control" placeholder="Enter your comment"></textarea>
        <button class="btn btn-secondary mt-2 mb-4">Submit</button>
    </div>

    <!-- VIDEOS -->
    <div id="tab-videos" class="tab-content d-none">
        <h5 class="fw-bold">Videos (149)</h5>

        <div class="row mt-3">
            <!-- big vid -->
            <div class="col-md-8">
                <iframe id="mainVideo"
                    width="100%"
                    height="400"
                    src="https://www.youtube.com/embed/_sV0S8qWSy0"
                    frameborder="0"
                    allowfullscreen>
                </iframe>
            </div>
            <!-- vid list -->
            <div class="col-md-4" style="max-height:400px; overflow-y:auto;">

                <div class="video-item d-flex mb-3" data-video="_sV0S8qWSy0" style="cursor:pointer;">
                    <img src="https://img.youtube.com/vi/_sV0S8qWSy0/mqdefault.jpg" width="120">
                    <div class="ms-2">
                        <div class="small fw-bold">
                            Ariana Grande - The Way (Official Video)
                        </div>
                    </div>
                </div>

                <div class="video-item d-flex mb-3" data-video="BPgEgaPk62M" style="cursor:pointer;">
                    <img src="https://img.youtube.com/vi/BPgEgaPk62M/mqdefault.jpg" width="120">
                    <div class="ms-2">
                        <div class="small fw-bold">
                            Ariana Grande - raindrops (audio)
                        </div>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <!-- LISTS -->
    <div id="tab-lists" class="tab-content d-none">
        <div class="fw-bold">List 
            <a href="#">Add to List</a>
        </div>

        <li>
            <a href="#">Love POP :)</a> by <a href="#">pop.music.love</a>
        </li>
        <li>
            <a href="#">Completed Artist</a> by <a href="#">DylanBryl</a>
        </li>
    </div>

</div>

</div>


<script>
/* ACTIVE FILTER */
document.querySelectorAll('.filter-item, .filter-box').forEach(item => {
    item.addEventListener('click', () => {
        document.querySelectorAll('.filter-item, .filter-box')
            .forEach(i => i.classList.remove('active'));
        item.classList.add('active');
    });
});

/* TOGGLE MENU */
function toggleMenu(id, el) {
    const menu = document.getElementById(id);
    const arrow = el.querySelector('.arrow');

    menu.classList.toggle('hidden');

    if (menu.classList.contains('hidden')) {
        arrow.classList.remove('down');
        arrow.classList.add('right');
    } else {
        arrow.classList.remove('right');
        arrow.classList.add('down');
    }
}

/* FILTER BAR */
document.getElementById('toggleFilter').onclick = () => {
    document.getElementById('filterBar').classList.toggle('d-none');
};

/* VIEW SWITCH */
const container = document.getElementById('releaseContainer');

document.querySelectorAll('.view-btn').forEach(btn => {
    btn.onclick = () => {
        document.querySelectorAll('.view-btn')
            .forEach(b => b.classList.remove('active'));

        btn.classList.add('active');

        container.className = ''; // reset
        container.classList.add(btn.dataset.view + '-view');
    };
});

let asc = true;

document.getElementById('sortYear').addEventListener('click', function () {
    const container = document.getElementById('releaseContainer');
    const items = Array.from(container.querySelectorAll('.release-item'));

    items.sort((a, b) => {
        const yearA = parseInt(a.dataset.year);
        const yearB = parseInt(b.dataset.year);

        return asc ? yearA - yearB : yearB - yearA;
    });

    // toggle arah
    asc = !asc;
    this.innerText = asc ? 'Year ↑' : 'Year ↓';

    items.forEach(item => container.appendChild(item));
});

document.querySelectorAll('.tab-btn').forEach(btn => {
    btn.addEventListener('click', () => {

        // reset active button
        document.querySelectorAll('.tab-btn')
            .forEach(b => b.classList.remove('active'));

        btn.classList.add('active');

        // sembunyikan semua konten
        document.querySelectorAll('.tab-content')
            .forEach(c => c.classList.add('d-none'));

        // tampilkan sesuai tab
        const tab = btn.dataset.tab;
        document.getElementById('tab-' + tab)
            .classList.remove('d-none');
    });
});

document.querySelectorAll('.video-item').forEach(item => {
    item.addEventListener('click', () => {
        const videoId = item.dataset.video;
        document.getElementById('mainVideo').src =
            "https://www.youtube.com/embed/" + videoId;
    });
});

</script>

@endsection