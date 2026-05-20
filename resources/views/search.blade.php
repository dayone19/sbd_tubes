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
    .discogs-nav a { color: #666; text-decoration: none; margin-right: 15px; font-size: 14px; }
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

    .artist-no-image {display: flex; align-items: center; justify-content: center; background: #e8e8e8; border-radius: 50%; aspect-ratio: 1/1;}
    .artist-no-image svg { width: 45%; height: 45%; opacity: 1;}
    .album-title:hover { color: #2a5bd7; text-decoration: underline; }
    .label-no-image {
    display: flex; align-items: center; justify-content: center; background: #e8e8e8; aspect-ratio: 1/1; border-radius: 3%; }
.label-no-image svg {
    width: 80%; height: 80%; }

</style>

<form method="GET" action="{{ route('search') }}" id="filterForm">
<input type="hidden" name="type" value="{{ request('type') }}">
<input type="hidden" name="q" value="{{ request('q') }}">

<div class="container-fluid mt-4 px-3">
    <div class="row">

    <div class="col-md-2">
        <div class="sidebar-filters p-3">
    
   <!-- Bagian Genre -->
<div class="filter-group mb-4">
    <h6 class="fw-bold" style="font-size: 0.9rem;">Genre</h6>
    <ul class="list-unstyled">
        @foreach($Genre->take(5) as $g)
        <li class="d-flex justify-content-between align-items-center mb-1">
        <div class="form-check">
            <input class="form-check-input filter-checkbox" type="checkbox" 
                name="genre[]" 
                value="{{ $g->genre_id }}" 
                id="g{{ $g->genre_id }}"
              {{ in_array($g->genre_id, (array) request('genre', [])) ? 'checked' : '' }}
            <label class="form-check-label small ms-2" for="g{{ $g->genre_id }}">
                {{ $g->name }}
            </label>
        </div>
        <span class="text-muted small">{{ number_format($g->releases_count) }}</span>
        </li>
        @endforeach
    </ul>
    <a href="#" class="text-decoration-none small fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#modalGenre">+ View All</a>
</div>

    <!-- Bagian Style -->
<div class="filter-group mb-4">
    <h6 class="fw-bold" style="font-size: 0.9rem;">Style</h6>
    <ul class="list-unstyled">
        @foreach($Style->take(5) as $s)
        <li class="d-flex justify-content-between align-items-center mb-1">
            <div class="form-check">
                <input class="form-check-input filter-checkbox" type="checkbox" 
                    name="style[]" 
                    value="{{ $s->style_id }}" 
                    id="style{{ $s->style_id }}"
                  {{-- Perbaikan Baris 99 --}}
{{ in_array($s->style_id, (array) request('style', [])) ? 'checked' : '' }}

                <label class="form-check-label small" for="style{{ $s->style_id }}" style="cursor:pointer;">
                    {{ $s->name }}
                </label>
            </div>
            <span class="text-muted small" style="font-size: 0.75rem;">{{ number_format($s->releases_count) }}</span>
        </li>
        @endforeach
    </ul>
    <a href="#" class="text-decoration-none small fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#modalStyle">+ View All</a>
</div>

<!-- Bagian Format -->
<div class="filter-group mb-4">
    <h6 class="fw-bold" style="font-size: 0.9rem;">Format</h6>
    <ul class="list-unstyled">
        @foreach($Format->take(5) as $f)
        <li class="d-flex justify-content-between align-items-center mb-1">
            <div class="form-check">
                <input class="form-check-input filter-checkbox" type="checkbox" 
                    name="format[]" 
                    value="{{ $f->format_id }}" 
                    id="format{{ $f->format_id }}"
                {{-- Perbaikan Baris 122 --}}
{{ in_array($f->format_id, (array) request('format', [])) ? 'checked' : '' }}

                <label class="form-check-label small" for="format{{ $f->format_id }}" style="cursor:pointer;">
                    {{ $f->name }}
                </label>
            </div>
            <span class="text-muted small" style="font-size: 0.75rem;">{{ number_format($f->releases_count) }}</span>
        </li>
        @endforeach
    </ul>
    <a href="#" class="text-decoration-none small fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#modalFormat">+ View All</a>
</div>

     <!-- Bagian Country -->
<div class="filter-group mb-4">
    <h6 class="fw-bold" style="font-size: 0.9rem;">Country</h6>
    <ul class="list-unstyled">
        @foreach($Country->take(5) as $c)
        <li class="d-flex justify-content-between align-items-center mb-1">
            <div class="form-check">
                <input class="form-check-input filter-checkbox" type="checkbox" 
                    name="country[]" 
                    value="{{ $c->country }}" 
                    id="country{{ $c->country }}"
                  {{ in_array($c->country, (array) request('country', [])) ? 'checked' : '' }}
                <label class="form-check-label small" for="country{{ $c->country }}" style="cursor:pointer;">
                    {{ $c->country }}
                </label>
            </div>
            <span class="text-muted small" style="font-size: 0.75rem;">{{ number_format($c->releases_count) }}</span>
        </li>
        @endforeach
    </ul>
    <a href="#" class="text-decoration-none small fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#modalCountry">+ View All</a>
</div>

     <!-- Bagian Decade -->
<div class="filter-group mb-4">
    <h6 class="fw-bold" style="font-size: 0.9rem;">Decade</h6>
    <ul class="list-unstyled">
        @foreach($Decade->take(5) as $d)
        <li class="d-flex justify-content-between align-items-center mb-1">
            <div class="form-check">
                <input class="form-check-input filter-checkbox" type="checkbox" 
                    name="decade[]" 
                    value="{{ $d->decade }}" 
                    id="dec{{ $d->decade }}"
                  {{ in_array($d->decade, (array) request('decade', [])) ? 'checked' : '' }}
                <label class="form-check-label small" for="dec{{ $d->decade }}" style="cursor:pointer;">
                    {{ $d->decade }}
                </label>
            </div>
            <span class="text-muted small" style="font-size: 0.75rem;">{{ number_format($d->releases_count) }}</span>
        </li>
        @endforeach
    </ul>
    <a href="#" class="text-decoration-none small fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#modalDecade">+ View All</a>
</div>

@if(!empty(request('decade')))
<div class="filter-group mb-4">
    <h6 class="fw-bold" style="font-size: 0.9rem;">Year</h6>
    <ul class="list-unstyled">
        @foreach($Years->take(5) as $y)
        <li class="d-flex justify-content-between align-items-center mb-1">
            <div class="form-check">
                <input class="form-check-input filter-checkbox" type="checkbox" 
                    name="year[]" 
                    value="{{ $y->year }}" 
                    id="year{{ $y->year }}"
                    {{ in_array($y->year, request('year', [])) ? 'checked' : '' }}
                    onchange="this.form.submit()">
                <label class="form-check-label small" for="year{{ $y->year }}" style="cursor:pointer;">
                    {{ $y->year }}
                </label>
            </div>
            <span class="text-muted small" style="font-size: 0.75rem;">{{ number_format($y->releases_count) }}</span>
        </li>
        @endforeach
    </ul>
    
    @if($Years->count() > 5)
        <a href="#" class="text-decoration-none small fw-bold text-dark" data-bs-toggle="modal" data-bs-target="#modalYear">+ View All</a>
    @endif
</div>
@endif
</div>
</div>

    <!-- === MODAL GENRE === -->
<div class="modal fade" id="modalGenre" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content shadow border-0">
            <div class="modal-header">
                <h5 class="modal-title fw-bold">Genre</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0" style="max-height: 400px; overflow-y: auto;">
                <ul class="list-unstyled pt-3 ">
                    @foreach($Genre as $g)
                    <li class="d-flex justify-content-between align-items-center mb-2">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="{{ $g->genre_id }}" id="mG{{ $g->genre_id }}">
                            <label class="form-check-label" for="mG{{ $g->genre_id }}">{{ $g->name }}</label>
                        </div>
                        <span class="text-muted small" >{{ number_format($g->releases_count ?? 0) }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-dark fw-bold px-5" data-bs-dismiss="modal">Show Results</button>
            </div>
        </div>
    </div>
</div>

<!-- === MODAL STYLE === -->
<div class="modal fade" id="modalStyle" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered"> <!-- Pakai modal-xl biar lebar -->
        <div class="modal-content shadow border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Style</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                <!-- KUNCI UTAMA: style="column-count: 4" -->
                <ul class="list-unstyled pt-3 discogs-multi-column">
                    @foreach($Style as $s)
                    <li class="d-flex justify-content-between align-items-center mb-2 pe-3" style="break-inside: avoid;">
                        <div class="form-check p-0 d-flex align-items-center">
                            <input class="form-check-input m-0 custom-check" type="checkbox" id="ms{{ $s->style_id }}">
                            <label class="form-check-label ms-2 small text-truncate" for="ms{{ $s->style_id }}" style="max-width: 130px;">
                                {{ $s->name }}
                            </label>
                        </div>
                        <span class="text-muted" style="font-size: 11px;">{{ number_format($s->releases_count ?? 0) }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-dark fw-bold px-5" data-bs-dismiss="modal">Show Results</button>
            </div>
        </div>
    </div>
</div>

<!-- === MODAL FORMAT === -->
<div class="modal fade" id="modalFormat" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered"> <!-- Pakai modal-xl biar lebar -->
        <div class="modal-content shadow border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Format</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                <!-- KUNCI UTAMA: style="column-count: 4" -->
                <ul class="list-unstyled pt-3 discogs-multi-column">
                    @foreach($Format as $f)
                    <li class="d-flex justify-content-between align-items-center mb-2 pe-3" style="break-inside: avoid;">
                        <div class="form-check p-0 d-flex align-items-center">
                            <input class="form-check-input m-0 custom-check" type="checkbox" id="mF{{ $f->format_id }}">
                            <label class="form-check-label ms-2 small text-truncate" for="mF{{ $f->format_id }}" style="max-width: 130px;">
                                {{ $f->name }}
                            </label>
                        </div>
                        <span class="text-muted" style="font-size: 11px;">{{ number_format($f->releases_count ?? 0) }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-dark fw-bold px-5" data-bs-dismiss="modal">Show Results</button>
            </div>
        </div>
    </div>
</div>

<!-- === MODAL Country === -->
<div class="modal fade" id="modalCountry" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered"> <!-- Pakai modal-xl biar lebar -->
        <div class="modal-content shadow border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Country</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                <!-- KUNCI UTAMA: style="column-count: 4" -->
                <ul class="list-unstyled pt-3 discogs-multi-column">
                    @foreach($Country as $c)
                    <li class="d-flex justify-content-between align-items-center mb-2 pe-3" style="break-inside: avoid;">
                        <div class="form-check p-0 d-flex align-items-center">
                            <input class="form-check-input m-0 custom-check" type="checkbox" id="mC{{ $c->country }}">
                            <label class="form-check-label ms-2 small text-truncate" for="mC{{ $c->country }}" style="max-width: 130px;">
                                {{ $c->country }}
                            </label>
                        </div>
                        <span class="text-muted" style="font-size: 11px;">{{ number_format($c->releases_count ?? 0) }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-dark fw-bold px-5" data-bs-dismiss="modal">Show Results</button>
            </div>
        </div>
    </div>
</div>

<!-- === MODAL Decade === -->
<div class="modal fade" id="modalDecade" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-xl modal-dialog-centered"> <!-- Pakai modal-xl biar lebar -->
        <div class="modal-content shadow border-0">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Decade</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-0">
                <!-- KUNCI UTAMA: style="column-count: 4" -->
                <ul class="list-unstyled pt-3 discogs-multi-column">
                    @foreach($Decade as $d)
                    <li class="d-flex justify-content-between align-items-center mb-2 pe-3" style="break-inside: avoid;">
                        <div class="form-check p-0 d-flex align-items-center">
                            <input class="form-check-input m-0 custom-check" type="checkbox" id="mD{{ $d->decade }}">
                            <label class="form-check-label ms-2 small text-truncate" for="mD{{ $d->decade }}" style="max-width: 130px;">
                                {{ $d->decade }}
                            </label>
                        </div>
                        <span class="text-muted" style="font-size: 11px;">{{ number_format($d->releases_count ?? 0) }}</span>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-dark fw-bold px-5" data-bs-dismiss="modal">Show Results</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="modalYear" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-md">
        <div class="modal-content">
            <div class="modal-header border-0">
                <h5 class="modal-title fw-bold">Year</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="max-height: 400px; overflow-y: auto;">
                <div class="row">
                    @if(!empty($Years))
                        @foreach($Years as $y)
                        <div class="col-12 d-flex justify-content-between align-items-center mb-2">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" 
                                    name="year[]" 
                                    value="{{ $y->year }}" 
                                    id="m_year{{ $y->year }}"
                                    {{ in_array($y->year, request('year', [])) ? 'checked' : '' }}>
                                <label class="form-check-label" for="m_year{{ $y->year }}">
                                    {{ $y->year }}
                                </label>
                            </div>
                            <span class="text-muted small">{{ number_format($y->releases_count) }}</span>
                        </div>
                        @endforeach
                    @endif
                </div>
            </div>
            <div class="modal-footer border-0">
                {{-- Ganti 'filterForm' dengan ID <form> utama kamu --}}
                <button type="submit" form="filterForm" class="btn btn-dark w-100 fw-bold">Show Results</button>
            </div>
        </div>
    </div>
</div>

        <div class="col-md-10">
            <!-- Nav -->
           {{-- SESUDAH --}}
<div class="discogs-nav">
    <a href="{{ route('search') }}" class="{{ !request('type') ? 'active' : '' }}">
        All <span class="count">({{ number_format($countAll) }})</span>
    </a>
    <a href="{{ route('search', ['type' => 'release']) }}" class="{{ request('type') == 'release' ? 'active' : '' }}">
        Release <span class="count">({{ number_format($countRelease) }})</span>
    </a>
    <a href="{{ route('search', ['type' => 'master']) }}" class="{{ request('type') == 'master' ? 'active' : '' }}">
        Master <span class="count">({{ number_format($countMaster) }})</span>
    </a>
    <a href="{{ route('search', ['type' => 'artist']) }}" class="{{ request('type') == 'artist' ? 'active' : '' }}">
        Artist <span class="count">({{ number_format($countArtist) }})</span>
    </a>
    <a href="{{ route('search', ['type' => 'label']) }}" class="{{ request('type') == 'label' ? 'active' : '' }}">
        Label <span class="count">({{ number_format($countLabel) }})</span>
    </a>
</div>

            <!-- Top Nav -->
            <h4 class="fw-bold">Find Music on Discogs</h4>

            <div class="search-bar-row mt-3">
                <div class="small">
                {{ $albums->firstItem() }} - {{ $albums->lastItem() }} of {{ number_format($albums->total()) }}

                <div class="active-filters" style="display: flex; gap: 10px; align-items: center; justify-content: flex-start; margin: 15px 0; flex-wrap: wrap;">
    
            @php
        // Daftar semua kolom yang ingin kita buatkan Chip-nya
        $filterFields = [
            'title' => 'Title',
            'credit' => 'Credit',
            'artist' => 'Artist',
            'genre' => 'Genre',
            'label' => 'Label',
            'style' => 'Style',
            'track' => 'Track',
            'country' => 'Country',
            'catno' => 'Cat #',
            'year' => 'Year',
            'barcode' => 'Barcode',
            'submitter' => 'Submitter',
            'anv' => 'ANV',
            'contributor' => 'Contributor',
            'format' => 'Format',
            'matrix' => 'Matrix'
        ];
         @endphp

    {{-- Looping untuk kolom teks --}}
    @foreach($filterFields as $field => $label)
        @if(request($field))
            <div class="chip" style="background: #f0f0f0; border: 1px solid #ddd; padding: 4px 10px; border-radius: 4px; font-size: 12px; display: flex; align-items: center; gap: 8px;">
                <span style="color: #666;">{{ $label }}:</span>
                <span style="font-weight: bold;">
                    {{ is_array(request($field)) ? implode(', ', request($field)) : request($field) }}
                </span>
                <a href="{{ request()->fullUrlWithQuery([$field => null]) }}" style="text-decoration: none; color: #999; font-size: 16px; line-height: 1;">&times;</a>
            </div>
        @endif
    @endforeach

    {{-- Chip Khusus Checkbox --}}
    @if(request('need_votes'))
        <div class="chip" style="background: #f0f0f0; border: 1px solid #ddd; padding: 4px 10px; border-radius: 4px; font-size: 12px; display: flex; align-items: center; gap: 8px;">
            <span style="font-weight: bold;">Needs Vote</span>
            <a href="{{ request()->fullUrlWithQuery(['need_votes' => null]) }}" style="text-decoration: none; color: #999; font-size: 16px; line-height: 1;">&times;</a>
        </div>
    @endif

    @if(request('need_changes'))
        <div class="chip" style="background: #f0f0f0; border: 1px solid #ddd; padding: 4px 10px; border-radius: 4px; font-size: 12px; display: flex; align-items: center; gap: 8px;">
            <span style="font-weight: bold;">Needs Changes</span>
            <a href="{{ request()->fullUrlWithQuery(['need_changes' => null]) }}" style="text-decoration: none; color: #999; font-size: 16px; line-height: 1;">&times;</a>
        </div>
    @endif

    {{-- Tombol Clear All --}}
    @if(count(request()->except(['type', 'per_page', 'sort', 'page', 'q'])) > 0)
        <a href="{{ route('advanced.results', ['type' => request('type', 'all')]) }}" style="font-size: 12px; color: #d32f2f; text-decoration: none; font-weight: bold; margin-left: 10px;">Clear All</a>
    @endif
   </div>

                <a href="{{ $albums->previousPageUrl() ? $albums->previousPageUrl() . '&' . http_build_query(request()->except('page')) : '#' }}">❮ Prev</a>
                <a href="{{ $albums->nextPageUrl() ? $albums->nextPageUrl() . '&' . http_build_query(request()->except('page')) : '#' }}">Next ❯</a>

                </div>
                <div class="d-flex align-items-center">
                    <span class="me-2 small text-muted">Sort</span>
                    <select class="form-select form-select-sm" style="width: 150px;" onchange="submitSort(this.value)">
                        <option value="relevance" {{ request('sort','relevance')=='relevance' ? 'selected' : '' }}>Relevance</option>
                        <option value="title_az" {{ request('sort')=='title_az' ? 'selected' : '' }}>Title, A-Z</option>
                        <option value="title_za" {{ request('sort')=='title_za' ? 'selected' : '' }}>Title, Z-A</option>
                        <option value="latest" {{ request('sort')=='latest' ? 'selected' : '' }}>Latest Additions</option>
                    </select>

                    <div class="btn-group ms-2">
                        <button id="gridBtn" class="btn btn-sm btn-outline-black active">
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

<div id="albumContainer" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">

    @foreach ($albums as $album)
    <div class="col-6 col-md-4 col-lg-2">
        <div class="album-card">

            {{-- GRID VIEW --}}
            <div class="grid-view-content">
                <div class="album-cover-wrapper {{ $album->format_name == 'MASTER RELEASE' ? 'album-stack' : ($album->format_name == 'ARTIST' ? 'artist-circle' : '') }}">
                    @if($album->format_name == 'MASTER RELEASE')
                        <a href="{{ route('album.versions', $album->master_id) }}">
                            <img src="{{ $album->foto ?? asset('images/no-image.png') }}" alt="{{ $album->judul }}">
                        </a>
                    @elseif($album->format_name == 'ARTIST')
                        <a href="{{ route('show.artist', $album->master_id) }}">
                            @if($album->foto)
                                <img src="{{ $album->foto }}" alt="{{ $album->judul }}">
                            @else
                                <div class="artist-no-image">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#3d5a8a">
                                        <path d="M12 1a4 4 0 0 1 4 4v6a4 4 0 0 1-8 0V5a4 4 0 0 1 4-4zm0 2a2 2 0 0 0-2 2v6a2 2 0 0 0 4 0V5a2 2 0 0 0-2-2zm7 6a1 1 0 0 1 1 1 8 8 0 0 1-7 7.938V20h2a1 1 0 0 1 0 2H9a1 1 0 0 1 0-2h2v-2.062A8 8 0 0 1 4 10a1 1 0 0 1 2 0 6 6 0 0 0 12 0 1 1 0 0 1 1-1z"/>
                                    </svg>
                                </div>
                            @endif
                        </a>
                    @elseif($album->format_name == 'LABEL')
                        <a href="{{ route('show.label', $album->master_id) }}">
                            @if($album->foto)
                                <img src="{{ $album->foto }}" alt="{{ $album->judul }}">
                            @else
                                <div class="label-no-image">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="48" fill="#3b4a6b"/>
                                        <circle cx="50" cy="50" r="44" fill="#c8d0e0"/>
                                        <path d="M6 50 A44 44 0 0 1 94 50 Z" fill="#c8d0e0"/>
                                        <path d="M6 50 A44 44 0 0 0 94 50 Z" fill="#3b4a6b"/>
                                        <rect x="28" y="26" width="44" height="7" rx="2" fill="#3b4a6b"/>
                                        <rect x="22" y="36" width="56" height="7" rx="2" fill="#3b4a6b"/>
                                        <ellipse cx="50" cy="52" rx="14" ry="9" fill="#3b4a6b"/>
                                        <circle cx="50" cy="52" r="6" fill="#c8d0e0"/>
                                        <rect x="22" y="62" width="56" height="8" rx="2" fill="#c8d0e0"/>
                                        <rect x="26" y="73" width="48" height="6" rx="2" fill="#c8d0e0"/>
                                        <rect x="22" y="82" width="56" height="7" rx="2" fill="#c8d0e0"/>
                                    </svg>
                                </div>
                            @endif
                        </a>
                    @else
                        <a href="{{ route('show.release', $album->release_id) }}">
                            <img src="{{ $album->foto ?? asset('images/no-image.png') }}" alt="{{ $album->judul }}">
                        </a>
                    @endif
                </div>
                <div class="album-info">
                    <p class="text-master mb-1">
                        @if($album->format_name && $album->format_name != 'MASTER RELEASE')
                            {{ strtoupper($album->format_name) }}
                        @else
                            MASTER RELEASE
                        @endif
                    </p>
                    @if($album->format_name == 'MASTER RELEASE')
                        <a href="{{ route('album.versions', $album->master_id) }}" class="album-title">{{ $album->judul }}</a>
                        <div class="album-artist">{{ $album->nama_artis }}</div>
                        <div class="album-meta">{{ $album->tahun ?? '-'}}</div>
                    @elseif($album->format_name == 'ARTIST')
                        <a href="{{ route('show.artist', $album->master_id) }}" class="album-title">{{ $album->judul }}</a>
                    @elseif($album->format_name == 'LABEL')
                        <a href="{{ route('show.label', $album->master_id) }}" class="album-title">{{ $album->judul }}</a>
                    @else
                        <a href="{{ route('show.release', $album->release_id) }}" class="album-title">{{ $album->judul }}</a>
                        <div class="album-artist">{{ $album->nama_artis }}</div>
                        <div class="album-meta">{{ $album->tahun ?? '-'}}</div>
                    @endif
                </div>
            </div>

            {{-- LIST VIEW --}}
            <div class="list-view-content">
                <div class="album-cover-wrapper {{ $album->format_name == 'MASTER RELEASE' ? 'album-stack' : ($album->format_name == 'ARTIST' ? 'artist-circle' : '') }}">
                    @if($album->format_name == 'MASTER RELEASE')
                        <a href="{{ route('album.versions', $album->master_id) }}">
                            <img src="{{ $album->foto ?? asset('images/no-image.png') }}" alt="{{ $album->judul }}">
                        </a>
                    @elseif($album->format_name == 'ARTIST')
                        <a href="{{ route('show.artist', $album->master_id) }}">
                            @if($album->foto)
                                <img src="{{ $album->foto }}" alt="{{ $album->judul }}">
                            @else
                                <div class="artist-no-image">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="#3d5a8a">
                                        <path d="M12 1a4 4 0 0 1 4 4v6a4 4 0 0 1-8 0V5a4 4 0 0 1 4-4zm0 2a2 2 0 0 0-2 2v6a2 2 0 0 0 4 0V5a2 2 0 0 0-2-2zm7 6a1 1 0 0 1 1 1 8 8 0 0 1-7 7.938V20h2a1 1 0 0 1 0 2H9a1 1 0 0 1 0-2h2v-2.062A8 8 0 0 1 4 10a1 1 0 0 1 2 0 6 6 0 0 0 12 0 1 1 0 0 1 1-1z"/>
                                    </svg>
                                </div>
                            @endif
                        </a>
                    @elseif($album->format_name == 'LABEL')
                        <a href="{{ route('show.label', $album->master_id) }}">
                            @if($album->foto)
                                <img src="{{ $album->foto }}" alt="{{ $album->judul }}">
                            @else
                                <div class="label-no-image">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100">
                                        <circle cx="50" cy="50" r="48" fill="#3b4a6b"/>
                                        <circle cx="50" cy="50" r="44" fill="#c8d0e0"/>
                                        <path d="M6 50 A44 44 0 0 1 94 50 Z" fill="#c8d0e0"/>
                                        <path d="M6 50 A44 44 0 0 0 94 50 Z" fill="#3b4a6b"/>
                                        <rect x="28" y="26" width="44" height="7" rx="2" fill="#3b4a6b"/>
                                        <rect x="22" y="36" width="56" height="7" rx="2" fill="#3b4a6b"/>
                                        <ellipse cx="50" cy="52" rx="14" ry="9" fill="#3b4a6b"/>
                                        <circle cx="50" cy="52" r="6" fill="#c8d0e0"/>
                                        <rect x="22" y="62" width="56" height="8" rx="2" fill="#c8d0e0"/>
                                        <rect x="26" y="73" width="48" height="6" rx="2" fill="#c8d0e0"/>
                                        <rect x="22" y="82" width="56" height="7" rx="2" fill="#c8d0e0"/>
                                    </svg>
                                </div>
                            @endif
                        </a>
                    @else
                        <a href="{{ route('show.release', $album->release_id) }}">
                            <img src="{{ $album->foto ?? asset('images/no-image.png') }}" alt="{{ $album->judul }}">
                        </a>
                    @endif
                </div>
                <div class="album-info">
                    <p class="text-master mb-1">
                        @if($album->format_name && $album->format_name != 'MASTER RELEASE')
                            {{ strtoupper($album->format_name) }}
                        @else
                            MASTER RELEASE
                        @endif
                    </p>
                    @if($album->format_name == 'MASTER RELEASE')
                        <a href="{{ route('album.versions', $album->master_id) }}" class="album-title">{{ $album->judul }}</a>
                        <div class="album-artist">{{ $album->nama_artis }}</div>
                        <div class="album-meta">{{ $album->tahun ?? '-'}}</div>
                    @elseif($album->format_name == 'ARTIST')
                        <a href="{{ route('show.artist', $album->master_id) }}" class="album-title">{{ $album->judul }}</a>
                    @elseif($album->format_name == 'LABEL')
                        <a href="{{ route('show.label', $album->master_id) }}" class="album-title">{{ $album->judul }}</a>
                    @else
                        <a href="{{ route('show.release', $album->release_id) }}" class="album-title">{{ $album->judul }}</a>
                        <div class="album-artist">{{ $album->nama_artis }}</div>
                        <div class="album-meta">{{ $album->tahun ?? '-'}}</div>
                    @endif
                </div>
            </div>

        </div>
    </div>
    @endforeach

</div>
{{ $albums->appends(request()->except('page'))->links() }}

            <!-- Pagination -->
            <div class="d-flex justify-content-between align-items-center mt-4">
                <div class="small">
                    {{ $albums->firstItem() }} - {{ $albums->lastItem() }} of {{ number_format($albums->total()) }}

                    <a href="{{ $albums->previousPageUrl() ? $albums->previousPageUrl() . '&' . http_build_query(request()->except('page')) : '#' }}">❮ Prev</a>
                    <a href="{{ $albums->nextPageUrl() ? $albums->nextPageUrl() . '&' . http_build_query(request()->except('page')) : '#' }}">Next ❯</a>

                </div>

                <!-- RIGHT: Show dropdown -->
                <div class="d-flex align-items-center">
                    <span class="me-2 small text-muted">Show</span>

                    <select class="form-select form-select-sm" style="width:70px;" onchange="changePerPage(this.value)">
                        <option value="10" {{ request('per_page') == 10 ? 'selected' : '' }}>10</option>
                        <option value="25" {{ request('per_page') == 25 || !request('per_page') ? 'selected' : '' }}>25</option>
                        <option value="50" {{ request('per_page') == 50 ? 'selected' : '' }}>50</option>
                        <option value="100" {{ request('per_page') == 100 ? 'selected' : '' }}>100</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

</div>
</form>

<!-- <script>
    const tabs = document.querySelectorAll('.discogs-nav a');

    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();

            tabs.forEach(t => t.classList.remove('active'));
            this.classList.add('active');
        });
    });
</script> -->
<script>
document.querySelectorAll('.filter-checkbox').forEach(cb => {
    cb.addEventListener('change', () => {
        document.getElementById('filterForm').submit();
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

<script>
function changePerPage(value) {
    // Ambil URL saat ini
    let url = new URL(window.location.href);
    
    // Set atau update parameter 'per_page' di URL
    url.searchParams.set('per_page', value);
    
    // Reset halaman ke page 1 lagi supaya tidak error kalau datanya berkurang
    url.searchParams.set('page', 1);
    
    // Pindah ke URL baru
    window.location.href = url.href;
}
</script>

<script>
function submitSort(value) {
    const url = new URL(window.location.href);
    url.searchParams.set('sort', value);
    url.searchParams.delete('page');
    window.location.href = url.toString();
}
</script>



@endsection