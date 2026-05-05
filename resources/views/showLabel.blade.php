@extends('layouts.app')

@section('title', 'Label')

@section('content')
<style>
.row {margin-right: 0;margin-left: 0;}
.label-page {font-size: 14px;color: #222;}
/* TITLE */
.label-name {font-size: 28px;font-weight: 700;margin-top: 15px;}
/* IMAGE */
.label-img {width: 140px;margin: 25px;}
/* INFO */
.info-row {display: flex;margin-bottom: 8px;}
.label {width: 130px;color: #555;}
.content {flex: 1;}
.profile-text {line-height: 1.5;}
/* LINK */
.label-page a {color: #2a5bd7;text-decoration: none;}
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
#toggleFilter {
    background: #f5f5f5;
    border: 1px solid #ccc;
    color: #333;
    font-size: 13px;
    font-weight: 500;
}
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
.view-btn { border: 1px solid #ccc;background: white; padding: 5px 10px; border-radius: 50%; /* Membuat tombol bulat */
    width: 38px;
    height: 38px;
    display: inline-flex;
    align-items: center;
    justify-content: center;}
.view-btn.active { background: #222; color: white; border-color: #222;}
/* view default*/
.release-main,.release-label,.release-year,.release-more,.grid-info {display: none;}
/* gridview*/
#releaseContainer.grid-view .grid-info {display: block;text-align: left;}
#releaseContainer.grid-view .release-item {display: block;}
.release-header {
    display: grid;
    grid-template-columns: 80px 3fr 1.5fr 1fr 40px;
    font-weight: 600;
    font-size: 13px;
    padding: 10px 0;
    border-top: 1px solid #f2f2f2;
    border-bottom: 1px solid #ddd;
    background-color: #fff;}
.release-header div { color: #2a5bd7; }
.grid-info .title {color: purple; font-weight: 700;font-size: 16px;}
.grid-info .artist { color: purple; font-size: 14px;}
.grid-info .year {font-size: 14px;  color: #333;}
/* gridlistview*/
#releaseContainer.gridlist-view .release-main,#releaseContainer.gridlist-view .release-label,#releaseContainer.gridlist-view .release-year, #releaseContainer.gridlist-view .release-more {display: block;}
#releaseContainer.gridlist-view .release-item {
    display: grid;
    /* Adjusted columns: Cover/Title | Catalog | Year | Options */
    grid-template-columns: 60px 3fr 1fr 100px 40px; 
    align-items: start;
    gap: 15px;
    padding: 15px 0;
    border-bottom: 1px solid #e5e5e5;
}
/* listview */
#releaseContainer.list-view .release-main,#releaseContainer.list-view .release-label,#releaseContainer.list-view .release-year,#releaseContainer.list-view .release-more {display: block;}
#releaseContainer.list-view .release-item {display: grid;grid-template-columns: 1fr 1fr 80px 40px;align-items: center; padding: 12px 0;border-bottom: 1px solid #ddd;}
#releaseContainer.list-view img {display: none;}
#releaseContainer.list-view .release-main .title {color: #2a5bd7;font-weight: 500;}
#releaseContainer.list-view .versions { font-size: 12px;background: #eee; padding: 3px 8px; border-radius: 4px;display: inline-block;margin-top: 5px;}
.release-main .title a {color: #2a5bd7;font-weight: 500;text-decoration: none;}
.release-main .title a:hover {text-decoration: underline;}
.release-label, .release-year {font-size: 13px;color: #333;}
.release-label {color: #2a5bd7;}
.release-main .format-text {
    font-size: 13px;
    color: #333;
    margin-top: 4px;
}
.release-catalog, .release-year {
    font-size: 13px;
    color: #333;
    padding-top: 2px;
}
.release-year {text-align: right;}
.release-more {text-align: center;}
.release-catalog {font-size: 13px;color: #333;}
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

<div class="label-page">
<div class="row">

    <!-- LEFT -->
    <div class="col-md-2">
        <img src="https://i.discogs.com/fNKnV5ZMswwZSBYhqUDVMq13KIcT10dr2ILJMtwrITU/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9MLTQxMzIx/LTEzMzk3MTI3NzQt/MTIxMS5naWY.jpeg" class="label-img">
    </div>

    <!-- MIDDLE -->
    <div class="col-md-6">
        <div class="label-name">Warner Bros. Music</div>

        <div class="info-row">
            <div class="label">Profile:</div>
            <div class="content profile-text">
                Publishing company affiliated with Warner Bros. Records. Use this entry if no further information is given. If a specific company/entity is mentioned such as
                1) Wb Music Corp. (including variants such as Warner Bros. Music Corp., Warner Bros. Music Corporation etc.) or
                2) Warner Bros. Music Ltd. (including variants such as Warner Bros. Music Ltd., Warner Brothers Music Ltd. etc.)
                use these entries. First of these entites is since 2019 known as WC Music Corp., second of these is since 1988 known as Warner Chappell Music Ltd.
            </div>
        </div>

        <div class="info-row">
            <div class="label">Parent Label:</div>
            <div class="content"><a>Warner Chappell Music</a></div>
        </div>

        <div class="info-row">
            <div class="label">Sublabels:</div>
            <div class="content"><a>Warner Bros. Music, Inc., Warner Brothers Music, France</a></div>
        </div>

        <div class="info-row">
            <div class="label">Contact Info:</div>
            <div class="content">Manufacturer Contact<br>
                Warner Bros. Music (obsolete)<br>
                Warner/Chappell<br>
                777 S. Santa Fe Avenue<br>
                Los Angeles, CA 90021<br>
                USA
                https://warnerchappell.com/</div>
        </div>

    </div>

    <!-- RIGHT -->
    <div class="col-md-3 sidebar">

        <div class="master-release-header">
            <span>Label</span>
            <span class="release-id">
                <span class="release-icon"></span>
                [l{{ $album->master_id ?? '138147' }}]
            </span>
        </div>
        <div class="master-release-links">
            <a href="#">Edit Label</a>
            <div style="color:black;">Data quality rating: Data Correct</div>
            <div style="color:blue; font-weight: bold;">19993 submissions pending</div>
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
                        <img src=https://i.discogs.com/iIZ74y-SGUGNfUaccYF3zVP5gCj4j6u_6ht7M-SUiis/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTEwOTU0/NjUzLTE1MjE5MzA0/MjEtMjAxMC5qcGVn.jpeg width="100" height="100" class="me-2">

                        <div>
                            <div class="small">MASTER RELEASE</div>
                            <strong>Les Mystérieuses Cités D'Or</strong><br>
                            <span class="small">Apollo (18)</span><br>
                            <span class="small">1983</span><br>
                            <span class="small">Vinyl · CD</span><br>
                            <span class="small">From $17 to $125</span>
                        </div>
                    </div>

                    <button class="btn btn-green w-100 mt-3">
                        Shop 23 Listings
                    </button>
                </div>

                <!-- ITEM 2 -->
                <div class="carousel-item">
                    <div class="d-flex mt-2">
                        <img src="https://via.placeholder.com/90" width="90" class="me-2">

                        <div>
                            <div class="small">MASTER RELEASE</div>
                            <strong>Goldorak</strong><br>
                            <span class="small">Various</span><br>
                            <span class="small">2018</span><br>
                            <span class="small">Vinyl</span><br>
                            <span class="small">France</span>
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
            Shop All Warner Brothers Music, France
        </button>

    </div>

</div>

<div class="container mt-4">


    <!-- RELEASES -->
    <div id="tab-discography" class="tab-content">
        <div class="mt-4">

            <div class="col-md-13">

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

                    <div class="release-header">
                        <div></div> <!-- Kosong untuk sejajar gambar -->
                        <div>Artist <span class="small">▼</span> – Title ( Format )</div>
                        <div>Catalog Number</div>
                        <div>Year</div>
                        <div></div>
                    </div>

                    <div class="release-item" data-year="2020">
                        <img src=https://i.discogs.com/7BI3dmn1urMQJPrC_M72b2IVa8BX3PDK8u4FDFo9XhE/rs:fit/g:sm/q:40/h:150/w:150/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTE0OTA0/MzczLTE1OTAxNjc5/NzAtNjA2OS5qcGVn.jpeg>

                        <!-- GRID VIEW -->
                        <div class="grid-info">
                            <div class="title"><a href="#">Yours Truly</a></div>
                            <div class="artist"><a href="#">Ariana Grande</a></div>
                            <div class="year">2013</div>
                        </div>

                        <!-- GRIDLIST + LIST -->
                        <div class="release-main">
                            <div>
                                <div class="title"><a href="#">Various</a> – <a href="#">Goldorak</a></div>
                                <div class="format-text">(LP, Pic, RE)</div>
                            </div>
                        </div>

                        <div class="release-catalog">3374786</div>

                        <div class="release-year">2020</div>
                        
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


</script>

@endsection