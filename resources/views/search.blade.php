@extends('layouts.app')

@section('content')

<style>
    /*Sidebar */
    .sidebar { top: 20px; }
    .sidebar-title { font-weight: 600; margin-bottom: 10px; }
    .sidebar-item { display: flex; justify-content: space-between; font-size: 14px; margin-bottom: 6px; }
    .sidebar-item a { color: #2a5bd7; text-decoration: none; }
    .sidebar-item span { color: #666; font-size: 13px; }
    .sidebar-more { font-size: 13px; color: #2a5bd7; text-decoration: none; }
    /* Right */
    .discogs-nav { border-bottom: 1px solid #ddd; padding-bottom: 5px; margin-bottom: 15px; }
    .discogs-nav a { color: #2a5bd7; text-decoration: none; margin-right: 15px; font-size: 14px; }
    .discogs-nav a .count { color: #888; font-weight: normal; }
    .discogs-nav a.active { color: #000; font-weight: bold; border-bottom: 3px solid #000; padding-bottom: 7px; }

    .search-bar-row { display: flex; justify-content: space-between; align-items: center; margin-bottom: 25px; }
    .album-card { border: none; font-size: 13px; }
    .album-cover-wrapper { position: relative; border: 1px solid #000; margin-bottom: 8px; border-radius: 3%; }
    .album-cover-wrapper img { width: 100%; aspect-ratio: 1/1; border-radius: 3%;}
    /* Stack */
    .album-stack::before, .album-stack::after {content: ""; position: absolute; top: -4px; right: -4px; width: 100%; height: 100%; background: #fff; border: 1px solid #000; z-index: -1; border-radius: 5%;}
    .album-stack::after { top: -8px; right: -8px; z-index: -2; }
    /* Circle*/
    .artist-circle img {width: 100%; height: 100%; border-radius: 50%;}
    .artist-circle {border-radius: 50%;}
    /*card */
    .album-title { font-weight: bold; color: #333; display: block; overflow: hidden; text-overflow: ellipsis; white-space: nowrap; margin-bottom: 0; }
    .album-artist { color: #2a5bd7; text-decoration: none; display: block; }
    .album-meta { color: #666; font-size: 12px; }
    .text-master { font-size: 11px; text-transform: uppercase; color: #666; letter-spacing: 0.5px; }
    /* grid view n list view */
    .list-view .album-card {display: flex;gap: 15px;padding: 10px 0;border-bottom: 1px solid #ddd;}
    .list-view {display: block !important;}
    .list-view .row {display: block;}
    .list-view .col {width: 100% !important;max-width: 100% !important;flex: 0 0 100%; margin-top:10px}
    .list-view .album-cover-wrapper {width: 90px; height: 90px;min-width: 90px; margin-bottom: 0; border: 1px solid #000}
    .list-view .album-info {flex: 1;}
    .list-view .grid-view-content { display: none;}
    .list-view .list-view-content {display: flex; gap: 15px; width: 100%;}
    .grid-view-content {display: block;}
    .list-view-content {display: none;}
    .pagination-text a {color: #2a5bd7;}
    .pagination-text a:hover {text-decoration: underline;}
    select.form-select-sm {border-radius: 4px;padding: 2px 6px;font-size: 13px;}

</style>

<div class="container-fluid mt-4 px-3">
    <div class="row">
        <!-- Sidebar -->
        <div class="col-md-2 ">
            <div class="sidebar">
                <div class="sidebar-section">
                    <h6 class="sidebar-title">Genre</h6>
                    <div class="sidebar-item"><a href="#">Rock</a><span>7,058,948</span></div>
                    <div class="sidebar-item"><a href="#">Electronic</a><span>5,633,745</span></div>
                    <a href="#" class="sidebar-more">All ▾</a>
                </div>
                <div class="sidebar-section mt-4">
                    <h6 class="sidebar-title">Style</h6>
                    <div class="sidebar-item"><a href="#">Pop Rock</a><span>1,045,672</span></div>
                    <div class="sidebar-item"><a href="#">House</a><span>815,720</span></div>
                    <a href="#" class="sidebar-more">All ▾</a>
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <!-- Nav -->
            <div class="discogs-nav">
                <a href="#" class="active">All</a>
                <a href="#">Release <span class="count">19,174,030</span></a>
                <a href="#">Master <span class="count">2,595,262</span></a>
                <a href="#">Artist <span class="count">9,973,140</span></a>
                <a href="#">Label <span class="count">2,248,219</span></a>
            </div>

            <!-- Top Nav -->
            <h4 class="fw-bold">Find Music on Discogs</h4>

            <div class="search-bar-row mt-3">
                <div class="small">1 - 25 of 21,769,292  
                    <a href="#" class="ms-2 text-decoration-none">❮ Prev</a> 
                    <a href="#" class="ms-1 text-decoration-none">Next ❯</a>
                </div>
                <div class="d-flex align-items-center">
                    <span class="me-2 small text-muted">Sort</span>
                    <select class="form-select form-select-sm" style="width: 150px;">
                    <option>Relevance</option>    
                    <option>Latest Additions</option>
                    <option>Latest Edits</option>
                    <option>Title, A-Z</option>
                    <option>Title, Z-A</option>
                    <option>Most Collected</option>
                    <option>Most Wanted</option>
                    <option>Trending</option>
                    </select>

                    <div class="btn-group ms-2">
                        <button id="gridBtn" class="btn btn-sm btn-outline-black">
                            <i class="bi bi-grid-3x3-gap-fill">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" fill="currentColor" class="bi bi-grid-fill" viewBox="0 0 16 16">
                                <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z"/>
                                </svg>
                            </i>
                        </button>
                        <button id="listBtn" class="btn btn-sm btn-outline-black">
                            <i class="bi bi-list-ul">
                                <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" fill="currentColor" class="bi bi-list-task" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z"/>
                                <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z"/>
                                <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z"/>
                                </svg>
                            </i>
                        </button>
                    </div>

                </div>
            </div>

            <!-- Right -->
            <div id="albumContainer" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">

                <div class="col">
                    <div class="album-card">
                        <!-- Covers View. Kalau Master,CD, dll -->
                        <div class="grid-view-content">
                            <div class="album-cover-wrapper album-stack">
                                <img src="https://i.discogs.com/Dbf-keTDtm2UEu6AWChTIEzE70P9OTzl0UwJg3Gelh8/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTM2Njk3/MzkzLTE3NzI4MjQw/NTAtMzk5OC5wbmc.jpeg" alt="Album Cover">
                            </div>
                            <div class="album-info">
                                <p class="text-master mb-1">MASTER RELEASE</p>
                                <a href="#" class="album-title">Kiss All The Time. Disco, Occasionally.</a>
                                <div class="album-artist">Harry Styles</div>
                                <div class="album-meta">2026</div>
                            </div>
                        </div>

                        <!-- LIst View. Kalau Master,CD, dll -->
                        <div class="list-view-content">
                            <div class="album-cover-wrapper album-stack">
                                <img src="https://i.discogs.com/Dbf-keTDtm2UEu6AWChTIEzE70P9OTzl0UwJg3Gelh8/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTM2Njk3/MzkzLTE3NzI4MjQw/NTAtMzk5OC5wbmc.jpeg" alt="Album Cover">
                            </div>
                            <div class="album-info">
                                <p class="text-master mb-1">MASTER RELEASE</p>
                                <a href="#" class="album-title">Kiss All The Time. Disco, Occasionally.</a>
                                <a href="#" class="album-artist">Harry Styles</a>
                                <div class="album-year">2026</div>
                                <a href="#" class="album-meta">Erskine Records, Coulombia</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="album-card">
                        <!-- Covers View. Kalau Vinyl -->
                        <div class="grid-view-content">
                            <div class="album-cover-wrapper">
                                <img src="https://i.discogs.com/Dbf-keTDtm2UEu6AWChTIEzE70P9OTzl0UwJg3Gelh8/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTM2Njk3/MzkzLTE3NzI4MjQw/NTAtMzk5OC5wbmc.jpeg" alt="Album Cover">
                            </div>
                            <div class="album-info">
                                <p class="text-master mb-1">Vinyl • Ltd Edition</p>
                                <a href="#" class="album-title">Kiss All The Time. Disco, Occasionally.</a>
                                <a href="#" class="album-artist">Harry Styles</a>
                                <div class="album-year">2026</div>
                            </div>
                        </div>

                        <!-- List View. Kalau Vinyl -->
                        <div class="list-view-content">
                            <div class="album-cover-wrapper">
                                <img src="https://i.discogs.com/Dbf-keTDtm2UEu6AWChTIEzE70P9OTzl0UwJg3Gelh8/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTM2Njk3/MzkzLTE3NzI4MjQw/NTAtMzk5OC5wbmc.jpeg" alt="Album Cover">
                            </div>
                            <div class="album-info">
                                <p class="text-master mb-1">Vinyl • Ltd Edition</p>
                                <a href="#" class="album-title">Kiss All The Time. Disco, Occasionally.</a>
                                <a href="#" class="album-artist">Harry Styles</a>
                                <div class="album-meta">LP, Album, Stereo, Pink Opaque [Kiss Pink]</div>
                                <div class="album-year">2026</div>
                                <a href="#" class="album-meta">Erskine Records,</a> <a href="#" class="album-meta">Columbia</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="album-card">
                        <!-- Covers View. Kalau Label -->
                        <div class="grid-view-content">
                            <div class="album-cover-wrapper">
                               <img src="https://i.discogs.com/fS_pUY2lx9fkP5dLs2IBqzUUkdf2FF-nmvbIF_l_Qh8/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9MLTEwMDAt/MTY0NDg3NDIwMS01/ODI0LmpwZWc.jpeg" alt="Album Cover">
                            </div>
                            <div class="album-info">
                                <p class="text-master mb-1">Label</p>
                                <a href="#" class="album-title">Warner Bros. Records</a>
                            </div>
                        </div>

                        <!-- List View. Kalau Label -->
                        <div class="list-view-content">
                            <div class="album-cover-wrapper">
                               <img src="https://i.discogs.com/fS_pUY2lx9fkP5dLs2IBqzUUkdf2FF-nmvbIF_l_Qh8/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9MLTEwMDAt/MTY0NDg3NDIwMS01/ODI0LmpwZWc.jpeg" alt="Album Cover">
                            </div>
                            <div class="album-info">
                                <p class="text-master mb-1">Label</p>
                                <a href="#" class="album-title">Warner Bros. Records</a>
                                <div class="album-meta">Label Code: LC 0392 / LC 00392</div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col">
                    <div class="album-card">
                        <!-- Covers View. Kalau Artist -->
                        <div class="grid-view-content">
                            <div class="album-cover-wrapper artist-circle">
                                <img src="https://i.discogs.com/U4UHwrEeEFIae1O8VuoeKWE-9hNjqFISKHqDu2f4h-0/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTgyNzMw/LTE0MTk3MTQ5ODgt/OTY3NS5qcGVn.jpeg" alt="Album Cover">
                            </div>
                            <div class="album-info">
                                <p class="text-master mb-1">Artist</p>
                                <a href="#" class="album-title">The Beatles</a>
                            </div>
                        </div>

                        <!-- List View. Kalau Artist -->
                        <div class="list-view-content">
                            <div class="album-cover-wrapper artist-circle">
                                <img src="https://i.discogs.com/U4UHwrEeEFIae1O8VuoeKWE-9hNjqFISKHqDu2f4h-0/rs:fit/g:sm/q:40/h:300/w:300/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9BLTgyNzMw/LTE0MTk3MTQ5ODgt/OTY3NS5qcGVn.jpeg" alt="Album Cover">
                            </div>
                            <div class="album-info">
                                <p class="text-master mb-1">Artist</p>
                                <a href="#" class="album-title">The Beatles</a>
                                <div class="album-meta">Emerging from Liverpool, England in 1960, the Beatles were a seminal British group that evolved from rock/pop origins into pioneers of musical experimentation.</div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="small">
                    1 - 25 of 2,178,231

                    <a href="#" class="ms-2 text-decoration-none">❮ Prev</a>
                    <a href="#" class="ms-1 text-decoration-none">Next ❯</a>
                </div>

                <!-- RIGHT: Show dropdown -->
                <div class="d-flex align-items-center">
                    <span class="me-2 small text-muted">Show</span>

                    <select class="form-select form-select-sm" style="width: 80px;">
                        <option>10</option>
                        <option selected>25</option>
                        <option>50</option>
                        <option>100</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

</div>

<script>
    const tabs = document.querySelectorAll('.discogs-nav a');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();

            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script>

<script>
const gridBtn = document.getElementById('gridBtn');
const listBtn = document.getElementById('listBtn');
const container = document.getElementById('albumContainer');

gridBtn.onclick = () => {
    container.classList.remove('list-view');

    // BALIKIN GRID BOOTSTRAP
    container.classList.add(
        'row-cols-1',
        'row-cols-sm-2',
        'row-cols-md-3',
        'row-cols-lg-5'
    );
}

listBtn.onclick = () => {
    container.classList.add('list-view');

    // MATIIN GRID BOOTSTRAP
    container.classList.remove(
        'row-cols-1',
        'row-cols-sm-2',
        'row-cols-md-3',
        'row-cols-lg-5'
    );
}
</script>

@endsection