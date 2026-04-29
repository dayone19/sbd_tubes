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

/* ================= FIX GRID BOOTSTRAP ================= */
.row {
    margin-right: 0;
    margin-left: 0;
}

/* ================= INFO (TENGAH) ================= */
.info-row {
    display: flex;
    align-items: flex-start;
    margin-bottom: 6px;
}

.label {
    width: 100px;
    flex-shrink: 0; /* 🔥 penting */
    color: #555;
}

.content {
    flex: 1;
}

/* ================= SIDEBAR ================= */
.sidebar {
    padding-left: 20px;
}

.sidebar .d-flex {
    align-items: flex-start;
}

.sidebar img {
    width: 100px;
    height: 90px;
    object-fit: cover;
}

/* ================= STATISTICS ================= */
.stats-row {
    display: flex;
    align-items: center;
    margin-bottom: 6px;
}

.stats-label {
    width: 90px;
    color: #555;
}

.stats-value {
    margin-right: 20px;
}
.credit-item a,
.credit-item div div {
    white-space: nowrap; /* 🔥 biar 1 baris terus */
}

.credit-item {
    display: flex;
    align-items: center;
    gap: 12px;
    flex-wrap: nowrap; /* 🔥 penting: cegah turun ke bawah */
}

.credit-item img {
    width: 45px;
    height: 45px;
    object-fit: contain;
}

.credit-item > div {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.credits-container {
    padding-top: 20px;
    display: grid;
    grid-template-columns: repeat(2, 1fr);
    column-gap: 350px; /* 🔥 jarak kiri-kanan */
    row-gap: 30px;     /* atas-bawah tetap */
}

.credits-container button {
    grid-column: span 2;
    width: 100%;
    border: 1px solid #ccc;
    padding: 8px;
    background: white;
    font-weight: 400;
}

.img-box {
    width: 70px;
    height: 80px;
    display: flex;
    align-items: center;
    justify-content: center;
    overflow: hidden;
}

/* default */
.img-box img {
    max-width: 100%;
    max-height: 100%;
    object-fit: contain;
}

/* 🔥 khusus Steven dibesarin */
.img-box.steven img {
    transform: scale(1.5); /* coba 1.2 - 1.5 */
}

#video-sidebar-section {
        margin-top: 30px;
        border-top: 1px solid #ddd;
        padding-top: 15px;
    }
    #video-sidebar-section .v-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 10px;
    }
    #video-sidebar-section h2 { font-size: 16px; font-weight: bold; margin: 0; }
    
    .main-player {
        width: 100%;
        aspect-ratio: 16 / 9;
        background-color: #000;
        position: relative;
        display: flex;
        justify-content: center;
        align-items: center;
        margin-bottom: 10px;
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

    .v-list { max-height: 250px; overflow-y: auto; margin-bottom: 15px; }
    .v-item { display: flex; gap: 10px; padding: 5px 0; cursor: pointer; border-bottom: 1px solid #f0f0f0; }
    .v-item:hover { background: #f9f9f9; }
    .v-thumb { width: 100px; height: 60px; position: relative; flex-shrink: 0; }
    .v-thumb img { width: 100%; height: 100%; object-fit: cover; }
    .v-time { position: absolute; bottom: 2px; right: 2px; background: #000; color: #fff; font-size: 10px; padding: 0 3px; }
    .v-title { font-size: 13px; color: #2a5bd7; line-height: 1.2; }

    /* Custom scrollbar untuk list video */
    .v-list::-webkit-scrollbar { width: 5px; }
    .v-list::-webkit-scrollbar-thumb { background: #ccc; border-radius: 10px; }

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
</style>

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

        <div class="credits-container">
            <div class="credit-item">
                <div class="img-box steven">
                    <img src="https://i.discogs.com/ybMm_0uVnr36tXqpU8rivrlaIuTGe118KVYo0hZtwEM/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTQ3MjAw/OS0xMjA4NTQ2MjUz/LmpwZWc.jpeg" alt="Steve Tirpak" class="image_RSPxy" width="60px" height="40px">
                </div>
                <div>
                    <a href="#" style="font-weight: bold;">Steven Tirpak*</a>
                    <div>Arranged By [Strings; Co]</div>
                </div>
            </div>
            
            <div class="credit-item">
                <div class="img-box">
                    <img src="https://i.discogs.com/VohVwMYOWsSIs1sRFOLr6ATRfBRRv1uXHedPr9Pf2bo/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTIxMzI4/MC0xNTkxNDc3MDc2/LTc3MTEuanBlZw.jpeg" alt="Larry Gold" class="image_RSPxy" width="60px" height="40px">
                </div>
                <div>
                    <a href="#" style="font-weight: bold;">Larry Gold</a>
                    <div>Arranged By [Strings]</div>
                </div>
            </div>
            

            <div class="credit-item">
                <div class="img-box">
                    <img src="https://i.discogs.com/UYK3QABIA2glrBqrn4y_LtiCix9wNPPsQrWgl-x0Vt0/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTcyNDY4/NC0xNDM1OTE0MTg0/LTkzNzAuanBlZw.jpeg" alt="Glenn Fischbach" class="image_RSPxy" width="60px" height="40px">
                </div>  
                <div>
                    <a href="#" style="font-weight: bold;">Glenn Fischbach</a>
                    <div>Cello</div>
                </div>
            </div>

            <div class="credit-item">
                <div class="img-box">
                    <img src="https://i.discogs.com/VohVwMYOWsSIs1sRFOLr6ATRfBRRv1uXHedPr9Pf2bo/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTIxMzI4/MC0xNTkxNDc3MDc2/LTc3MTEuanBlZw.jpeg" alt="Larry Gold" class="image_RSPxy" width="60px" height="40px">
                </div>
                <div>
                    <a href="#" style="font-weight: bold;">Larry Gold</a>
                    <div>Conductor [Strings]</div>
                </div>
            </div>
            

            <div class="credit-item">
                <div class="img-box">
                    <img src="https://i.discogs.com/4wV9jzZ8OX1L0NVY2utfB5uhHhD85DmErfF-IC7Q1OU/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTcwMTMx/OTItMTY0MzE0MTQ4/Ni0xNjIwLmpwZWc.jpeg" alt="Daniel Rodriguez (15)" class="image_RSPxy" width="60px" height="40px">
                </div>                
                <div>
                    <a href="#" style="font-weight: bold;">Daniel Rodriguez</a>
                    <div>Congas</div>
                </div>
            </div>

            <div class="credit-item">
                <div class="img-box steven">
                    <img src="https://i.discogs.com/ybMm_0uVnr36tXqpU8rivrlaIuTGe118KVYo0hZtwEM/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTQ3MjAw/OS0xMjA4NTQ2MjUz/LmpwZWc.jpeg" alt="Steve Tirpak" class="image_RSPxy" width="80px" height="40px">
                </div>
                <div>
                    <a href="#" style="font-weight: bold;">Steven Tirpak*</a>
                    <div>Copyist</div>
                </div>
            </div>

            <button>
                ▼ Show more credits...
            </button>
        </div>
        <div class="mt-3">
            <strong>Versions</strong>
            <hr class="my-0" style="width: 800px;">

            <div class="small" style="color: black; padding-top:10px;">Filter by</div>
            <div class="small" style="color: black; padding-top:7px;">Format</div>

            <div class="filter-box" onclick="toggleDropdown()">
                <span style="color: gray; font-weight: 400;">Find a format</span>
                <span class="arrow right" id="arrow"></span>
            </div>

        <!-- DROPDOWN -->
         <div id="formatMenu" class="hidden mt-2">
            <input type="text" placeholder="Find a format" class="form-control mb-2">
            <div class="filter-item">Vinyl</div>
            <div class="filter-item">CD</div>
            <div class="filter-item">Cassette</div>
            <div class="filter-item">Digital</div>
        </div>
    </div>


    </div>

    <!-- MIDDLE -->
    <div class="col-md-6">
        <div class="artist-name"><a href="#">Bruno Mars</a> - The Romantic</div>

        <div class="info-row">
            <div class="label">Genre:</div>
            <div class="content">
                <a href="#">Funk / Soul</a>, 
                <a href="#">Pop</a>
            </div>
        </div>
        
        <div class="info-row">
            <div class="label">Style:</div>
            <div class="content profile-text">-</div>
        </div>
        
        <div class="info-row">
            <div class="label">Year:</div>
            <div class="content"><a href="#">2026</a></div>
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
                            
                        <div class="stats-row">
                            <div class="stats-label">Have:</div>
                            <div class="stats-value"><a href="#">8548</a></div>
                            <div class="stats-label">Avg Rating:</div>
                            <div>4.71 / 5</div>
                        </div>
                        <div class="stats-row">
                            <div class="stats-label">Want:</div>
                            <div class="stats-value"><a href="#">981</a></div>
                            <div class="stats-label">Ratings:</div>
                            <div><a href="#">1252</a></div>
                        </div>
                    </div>

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
        <a href="#" class="small text-decoration-none" style="position: relative; top: 1px;">
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
    <a href="#" class="text-decoration-none">View More List -></a>
</div>
</div>
</div>
</div>
<script>
    function toggleDropdown() {
    const menu = document.getElementById("formatMenu");
    const arrow = document.getElementById("arrow");

    menu.classList.toggle("hidden");

    if (menu.classList.contains("hidden")) {
        arrow.classList.remove("down");
        arrow.classList.add("right");
    } else {
        arrow.classList.remove("right");
        arrow.classList.add("down");
    }
}
</script>


@endsection