@extends('layouts.app')

@section('title', isset($album) ? 'Album - ' . $album->title : 'Album')

@section('content')

<style>
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
/* SIDEBAR */
.sidebar {padding-left: 20px;}
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
.arrow.right {
    transform: rotate(-45deg);
}

.arrow.down {
    transform: rotate(45deg);
}
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
</style>

<div class="artist-page">
<div class="row">

    <!-- LEFT -->
    <div class="col-md-2 ms-4 mt-4">
        <img src="https://i.discogs.com/7OyH6ag4ze3_wbHt4uIxkLeqUlQDUgBHP0eL9oWGu8A/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTM2NjI4/NDIwLTE3NzIyOTE4/NzAtNTQ5Ny5qcGVn.jpeg" alt="Bruno Mars - The Romantic album cover" width="150" height="147" >
        <div class="col-md-3 ms-9 text-end mt-0">
            <a href="#" class="text-decoration-none small d-inline-block text-nowrap">
             More images
            </a>
        </div>

        <div class="mt-3">
            <strong>Tracklist</strong>
            <hr class="my-0" style="width: 800px;">
            <div class="small" style="color: black;">Risk It All</div>
            <hr class="my-0" style="width: 800px;">
            <div class="small" style="color: black;">Cha Cha Cha</div>
            <hr class="my-0" style="width: 800px;">
            <div class="small" style="color: black;">I Just Might</div>
            <hr class="my-0" style="width: 800px;">
            <div class="small" style="color: black;">God Was Showing Off</div>
            <hr class="my-0" style="width: 800px;">
            <div class="small" style="color: black;">Why You Wanna Fight?</div>
            <hr class="my-0" style="width: 800px;">
            <div class="small" style="color: black;">On My Soul</div>
            <hr class="my-0" style="width: 800px;">
            <div class="small" style="color: black;">Something Serious</div>
            <hr class="my-0" style="width: 800px;">
            <div class="small" style="color: black;">Nothing Left</div>
            <hr class="my-0" style="width: 800px;">
            <div class="small" style="color: black;">Dance With Me</div>
        </div>

        <div class="mt-3">
            <strong>Credits (57)</strong>
            <hr class="my-0" style="width: 800px;">
        </div>
    </div>

    <!-- MIDDLE -->
    <div class="col-md-6">
        <div class="artist-name"><a href="#">Bruno Mars</a> - The Romantic</div>

        <div class="info-row">
            <div class="label">Genre:</div>
            <div class="content"><a href="">Funk / soul, Pop</a></div>
        </div>

        <div class="info-row">
            <div class="label">style:</div>
            <div class="content profile-text"></div>
        </div>

        <div class="info-row">
            <div class="label">year:</div>
            <div class="content"><a href="">2026</a></div>
        </div>
    </div>

    <!-- RIGHT -->
    <div class="col-md-3 sidebar">

        <div class="d-flex justify-content-between mt-4">
            <strong>Master Release</strong>
            <span><a href="">💿[m4146559]</a></span>
        </div>
        <hr class="my-2">
        <a href="#">Edit Master Release</a>
        <span class="d-block">
            Recently Edited
        </span>
        <div class="d-flex justify-content-between">
            <strong>For Sale</strong>
            <span><a href="">Sell a copy</a></span>
        </div>
        <hr class="my-2">

                <!-- ITEM 1 -->
                    <div class="d-flex mt-2">
                        <img src="https://i.discogs.com/7OyH6ag4ze3_wbHt4uIxkLeqUlQDUgBHP0eL9oWGu8A/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTM2NjI4/NDIwLTE3NzIyOTE4/NzAtNTQ5Ny5qcGVn.jpeg" alt="Bruno Mars - The Romantic album cover" width="100" height="87" >
                        
                        <div class="ms-3">
                            <div class="small">MASTER RELEASE</div>
                            <strong>The Romantic</strong><br>
                            <span class="small">2026</span><br>
                            <span class="small"><a href=""><u>Vinyl</u></a> · 
                                                <a href=""><u>CD</u></a> · 
                                                <a href=""><u>Cassette</u></a></span><br>
                            <span class="small">From $12 to $1,000</span>
                        </div>
                    </div>

                    <button class="btn btn-green w-100 mt-3">
                        Shop 407 Listings
                    </button>

                    <div class="ms-3 mt-2 ml-3">
                        <div class="small" style="color: black;">
                            <strong>Statistics</strong>
                        </div>
                        <hr class="my-2">
                            
                        <div style="display:flex; gap:12px; margin-bottom:6px;">
                            <div style="min-width:40px; color:#555;">Have:</div>
                            <div style="margin-right:20px;"><a href="">8548</a></div>

                            <div style="min-width:80px; color:#555;">Avg Rating:</div>
                            <div>4.71 / 5</div>
                        </div>

                        <div style="display:flex; gap:17px; margin-bottom:6px;">
                            <div style="min-width:20px; color:#555;">Want:</div>
                            <div style="margin-right:20px;"><a href="">981</a></div>

                            <div style="min-width:78px; color:#555;">Ratings:</div>
                            <div><a href="">1252</a></div>
                        </div>
                    </div>
        </div>


    </div>

</div>

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

                <!-- FILTER BAR (hidden dulu) -->
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
                        <button id="toggleFilter" class="btn btn-dark rounded-pill px-2" style="width:160px">
                            <p>Search & Filters 
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" fill="currentColor" class="bi bi-sliders2" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M10.5 1a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V4H1.5a.5.5 0 0 1 0-1H10V1.5a.5.5 0 0 1 .5-.5M12 3.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5m-6.5 2A.5.5 0 0 1 6 6v1.5h8.5a.5.5 0 0 1 0 1H6V10a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5M1 8a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2A.5.5 0 0 1 1 8m9.5 2a.5.5 0 0 1 .5.5v4a.5.5 0 0 1-1 0V13H1.5a.5.5 0 0 1 0-1H10v-1.5a.5.5 0 0 1 .5-.5m1.5 2.5a.5.5 0 0 1 .5-.5h2a.5.5 0 0 1 0 1h-2a.5.5 0 0 1-.5-.5"/>
                                </svg> 
                            </p>
                        </button>

                        <span id="sortYear" class="small" style="cursor:pointer;">
                            Year ↑
                        </span>

                        <button class="view-btn active" data-view="grid">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z"/>
                            </svg>
                        </button>
                        <button class="view-btn" data-view="gridlist"> 
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
                <div id="releaseContainer" class="grid-view">

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
                        <div class="release-more">•••</div>

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
                        <div class="release-more">•••</div>

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

    // render ulang
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