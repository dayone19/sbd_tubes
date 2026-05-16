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
        <img src="{{ $label->image ?? asset('images/no-image.png') }}" class="label-img">
    </div>

    <!-- MIDDLE -->
    <div class="col-md-6">
        <div class="label-name">{{ $label->name ?? 'Unknown Label' }}</div>

        @if($label->profile ?? false)
<div class="info-row">
    <div class="label">Profile:</div>
    <div class="content profile-text">{{ $label->profile }}</div>
</div>
@endif

@if($parentLabel)
<div class="info-row">
    <div class="label">Parent Label:</div>
    <div class="content">
        <a href="{{ route('show.label', $parentLabel->label_id) }}">{{ $parentLabel->name }}</a>
    </div>
</div>
@endif

@if($sublabels->count() > 0)
<div class="info-row">
    <div class="label">Sublabels:</div>
    <div class="content">
        @foreach($sublabels as $sub)
            <a href="{{ route('show.label', $sub->label_id) }}">{{ $sub->name }}</a>
            @if(!$loop->last), @endif
        @endforeach
    </div>
</div>
@endif

@if($label->contact_info ?? false)
<div class="info-row">
    <div class="label">Contact Info:</div>
    <div class="content">{{ $label->contact_info }}</div>
</div>
@endif

    </div>

    <!-- RIGHT -->
    <div class="col-md-3 sidebar">

        <div class="master-release-header">
            <span>Label</span>
            <span class="release-id">
                <span class="release-icon"></span>
                [l{{ $id }}]
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
                @forelse($forSale as $index => $sale)
                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                    <div class="d-flex mt-2">
                        <img src="{{ $sale->foto ?? asset('images/no-image.png') }}" width="100" height="100" class="me-2">
                        <div>
                            <div class="small">MASTER RELEASE</div>
                            <strong>{{ $sale->title }}</strong><br>
                            <span class="small">{{ $sale->year ?? '-' }}</span><br>
                            <span class="small">{{ $sale->format_name ?? '-' }}</span><br>
                            <span class="small">From ${{ number_format($sale->min_price, 2) }} to ${{ number_format($sale->max_price, 2) }}</span>
                        </div>
                    </div>
                    <a href="{{ route('album.versions', $sale->master_id) }}" class="btn btn-green w-100 mt-3">
                        Shop {{ $sale->total_listings }} Listings
                    </a>
                </div>
                @empty
                <div class="carousel-item active">
                    <div class="text-center py-3 text-muted">No listings available</div>
                </div>
                @endforelse
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
                @foreach($forSale as $index => $sale)
                <button data-bs-target="#saleCarousel" data-bs-slide-to="{{ $index }}" class="{{ $index == 0 ? 'active' : '' }}"></button>
                @endforeach
            </div>


        </div>

        <!-- BUTTON BAWAH -->
        <button class="btn btn-light w-100 mt-2">
            Shop All {{ $label->name }}
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
                <form method="GET" action="{{ route('show.label', $id) }}" id="filterBar" class="bg-light p-3 rounded mb-3 d-none">
                    <div class="row g-2">
                        <div class="col-md-3">
                            <input type="text" name="format" class="form-control" placeholder="Find a format" value="{{ request('format') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="country" class="form-control" placeholder="Find a country" value="{{ request('country') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="year" class="form-control" placeholder="Find a year" value="{{ request('year') }}">
                        </div>
                        <div class="col-md-3">
                            <input type="text" name="q" class="form-control" placeholder="Search Discography" value="{{ request('q') }}">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-dark mt-2">Apply Filter</button>
                </form>

                <!-- TOP CONTROL -->
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="small">
                    Showing {{ $releases->firstItem() }}–{{ $releases->lastItem() }} of {{ $releases->total() }}
                    @if($releases->previousPageUrl())
                        <a href="{{ $releases->previousPageUrl() }}" class="ms-2">‹ Prev</a>
                    @endif
                    @if($releases->nextPageUrl())
                        <a href="{{ $releases->nextPageUrl() }}" class="ms-2">Next ›</a>
                    @endif
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

                        <select class="form-select form-select-sm" style="width:70px;" onchange="changePerPage(this.value)">
                            <option value="25" {{ request('per_page') == 25 || !request('per_page') ? 'selected' : '' }}>25</option>
                            <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                            <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                            <option value="250" {{ request('per_page') == 250 ? 'selected' : '' }}>250</option>
                            <option value="500" {{ request('per_page') == 500 ? 'selected' : '' }}>500</option>
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

                    @forelse($releases as $release)
                    <div class="release-item" data-year="{{ $release->year }}">
                        <img src="{{ asset('images/no-image.png') }}">

                        <div class="grid-info">
                            <div class="title"><a href="{{ route('show.release', $release->release_id) }}">{{ $release->title }}</a></div>
                            <div class="year">{{ $release->year ?? '-' }}</div>
                        </div>

                        <div class="release-main">
                            <div>
                                <div class="title">
                                    <a href="{{ route('show.release', $release->release_id) }}">{{ $release->title }}</a>
                                </div>
                                <div class="format-text">({{ $release->format_name ?? '-' }})</div>
                            </div>
                        </div>

                        <div class="release-catalog">{{ $release->catalog_number ?? '-' }}</div>
                        <div class="release-year">{{ $release->year ?? '-' }}</div>

                        <div class="dropdown">
                            <div class="release-more" data-bs-toggle="dropdown" style="cursor:pointer;">•••</div>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" href="#">Add to List</a></li>
                                <li><a class="dropdown-item" href="#">Edit Release</a></li>
                            </ul>
                        </div>
                    </div>
                    @empty
                        <div class="text-center py-4">No releases found</div>
                    @endforelse

                    <!-- ini kubikin buat ngecek tombol year aj-->
                    

                </div>

            </div>
        </div>

    </div>

<div id="tab-reviews" class="tab-content">
    <h4 class="fw-bold mt-4">Reviews</h4>

    @forelse($reviews as $review)
    <div class="border-bottom py-3">
        <div class="d-flex justify-content-between">
            <strong>{{ $review->user_name }}</strong>
            <span class="text-muted small">{{ $review->created_at }}</span>
        </div>
        
        {{-- KONDISI 1: TAMPILAN REVIEW (Hanya muncul jika rating diisi/tidak null) --}}
        @if($review->rating && $review->rating > 0)
            <div class="my-1" style="color: #f5a623;">
                @for($i = 1; $i <= 5; $i++)
                    {{ $i <= $review->rating ? '★' : '☆' }}
                @endfor
            </div>
        @endif

        <div>{{ $review->comment }}</div>
    </div>
    @empty
        <div class="text-muted py-3">No reviews yet.</div>
    @endforelse

    <div class="mt-3 mb-5">
        <form method="POST" action="{{ route('label.review.store', $id) }}">
            @csrf
            @if($forSale->count() > 0)
                <select name="product_id" class="form-select mt-2 mb-2" style="width:200px;">
                    @foreach($forSale as $sale)
                    <option value="{{ $sale->product_id }}">{{ $sale->title }}</option>
                    @endforeach
                </select>
            @else
                <p class="text-muted small">No products available to review</p>
            @endif
            
            {{-- KONDISI 2: INPUT FORM RATING (Sekarang bebas, ada opsi kosong) --}}
            <select name="rating" class="form-select mt-2 mb-2" style="width:180px;">
                <option value="">-- No Rating (Comment Only) --</option>
                <option value="1">★ 1</option>
                <option value="2">★★ 2</option>
                <option value="3">★★★ 3</option>
                <option value="4">★★★★ 4</option>
                <option value="5">★★★★★ 5</option>
            </select>

            <textarea name="comment" class="form-control mt-2" id="reviewComment" placeholder="Enter your comment" rows="3"></textarea>
            <div class="d-flex justify-content-between align-items-center mt-2">
                <button type="submit" class="btn btn-secondary" id="submitReview" disabled>Submit</button>
                <a href="#" class="text-muted small">View Help</a>
            </div>
        </form>
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


</script>

<script>
function changePerPage(value) {
    let url = new URL(window.location.href);
    url.searchParams.set('per_page', value);
    url.searchParams.set('page', 1);
    window.location.href = url.href;
}
</script>

<script>
// Submit button disable/enable
document.getElementById('reviewComment').addEventListener('input', function() {
    const btn = document.getElementById('submitReview');
    if(this.value.trim() != '') {
        btn.disabled = false;
        btn.classList.remove('btn-secondary');
        btn.classList.add('btn-dark');
    } else {
        btn.disabled = true;
        btn.classList.remove('btn-dark');
        btn.classList.add('btn-secondary');
    }
});
</script>

@endsection