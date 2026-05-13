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
                    @if(isset($releases) && $releases->count())
                        @php
                            // Kumpulkan semua genre dari hasil pencarian
                            $genreList = $releases->pluck('genre')->filter()->flatMap(function($g) {
                                return explode(', ', $g);
                            })->countBy()->sortDesc()->take(5);
                        @endphp
                        @foreach($genreList as $gName => $gCount)
                            <div class="sidebar-item"><a href="#">{{ $gName }}</a><span>{{ number_format($gCount) }}</span></div>
                        @endforeach
                    @endif
                </div>
                <div class="sidebar-section mt-4">
                    <h6 class="sidebar-title">Style</h6>
                    @if(isset($releases) && $releases->count())
                        @php
                            $styleList = $releases->pluck('style')->filter()->flatMap(function($s) {
                                return explode(', ', $s);
                            })->countBy()->sortDesc()->take(5);
                        @endphp
                        @foreach($styleList as $sName => $sCount)
                            <div class="sidebar-item"><a href="#">{{ $sName }}</a><span>{{ number_format($sCount) }}</span></div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-10">
            <!-- Nav Tabs -->
            <div class="discogs-nav">
                @php
                    $currentType = request('type', 'all');
                    $queryParams = request()->except(['type', 'page']);
                @endphp
                <a href="{{ route('search', array_merge($queryParams, ['type' => 'all'])) }}"
                   class="{{ $currentType == 'all' ? 'active' : '' }}">All</a>

                <a href="{{ route('search', array_merge($queryParams, ['type' => 'release'])) }}"
                   class="{{ $currentType == 'release' ? 'active' : '' }}">Release
                   <span class="count">{{ number_format($releaseCount) }}</span></a>

                <a href="{{ route('search', array_merge($queryParams, ['type' => 'artist'])) }}"
                   class="{{ $currentType == 'artist' ? 'active' : '' }}">Artist
                   <span class="count">{{ number_format($artistCount) }}</span></a>

                <a href="{{ route('search', array_merge($queryParams, ['type' => 'label'])) }}"
                   class="{{ $currentType == 'label' ? 'active' : '' }}">Label
                   <span class="count">{{ number_format($labelCount) }}</span></a>
            </div>

            <!-- Top Nav -->
            <h4 class="fw-bold">Search Results</h4>

            @php
                $page = request('page', 1);
                $totalItems = ($currentType == 'release') ? $releaseCount :
                              (($currentType == 'artist') ? $artistCount :
                              (($currentType == 'label') ? $labelCount : $totalAll));
                $from = ($page - 1) * $perPage + 1;
                $to   = min($page * $perPage, $totalItems);
                $totalPages = ceil($totalItems / $perPage);
            @endphp

            <div class="search-bar-row mt-3">
                <div class="small">
                    {{ $from }} - {{ $to }} of {{ number_format($totalItems) }}
                    @if($page > 1)
                        <a href="{{ route('search', array_merge(request()->all(), ['page' => $page - 1])) }}" class="ms-2 text-decoration-none">❮ Prev</a>
                    @endif
                    @if($page < $totalPages)
                        <a href="{{ route('search', array_merge(request()->all(), ['page' => $page + 1])) }}" class="ms-1 text-decoration-none">Next ❯</a>
                    @endif
                </div>
                <div class="d-flex align-items-center">
                    <span class="me-2 small text-muted">Sort</span>
                    <select class="form-select form-select-sm" style="width: 150px;"
                            onchange="window.location.href=this.value">
                        @php $params = request()->except('sort'); @endphp
                        <option value="{{ route('search', array_merge($params, ['sort' => 'relevance'])) }}"
                            {{ request('sort','relevance')=='relevance' ? 'selected' : '' }}>Relevance</option>
                        <option value="{{ route('search', array_merge($params, ['sort' => 'title_asc'])) }}"
                            {{ request('sort')=='title_asc' ? 'selected' : '' }}>Title, A-Z</option>
                        <option value="{{ route('search', array_merge($params, ['sort' => 'title_desc'])) }}"
                            {{ request('sort')=='title_desc' ? 'selected' : '' }}>Title, Z-A</option>
                        <option value="{{ route('search', array_merge($params, ['sort' => 'year'])) }}"
                            {{ request('sort')=='year' ? 'selected' : '' }}>Year</option>
                    </select>

                    <div class="btn-group ms-2">
                        <button id="gridBtn" class="btn btn-sm btn-outline-black">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path d="M1 2.5A1.5 1.5 0 0 1 2.5 1h3A1.5 1.5 0 0 1 7 2.5v3A1.5 1.5 0 0 1 5.5 7h-3A1.5 1.5 0 0 1 1 5.5zm8 0A1.5 1.5 0 0 1 10.5 1h3A1.5 1.5 0 0 1 15 2.5v3A1.5 1.5 0 0 1 13.5 7h-3A1.5 1.5 0 0 1 9 5.5zm-8 8A1.5 1.5 0 0 1 2.5 9h3A1.5 1.5 0 0 1 7 10.5v3A1.5 1.5 0 0 1 5.5 15h-3A1.5 1.5 0 0 1 1 13.5zm8 0A1.5 1.5 0 0 1 10.5 9h3a1.5 1.5 0 0 1 1.5 1.5v3a1.5 1.5 0 0 1-1.5 1.5h-3A1.5 1.5 0 0 1 9 13.5z"/>
                            </svg>
                        </button>
                        <button id="listBtn" class="btn btn-sm btn-outline-black">
                            <svg xmlns="http://www.w3.org/2000/svg" width="22" height="16" fill="currentColor" viewBox="0 0 16 16">
                            <path fill-rule="evenodd" d="M2 2.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5V3a.5.5 0 0 0-.5-.5zM3 3H2v1h1z"/>
                            <path d="M5 3.5a.5.5 0 0 1 .5-.5h9a.5.5 0 0 1 0 1h-9a.5.5 0 0 1-.5-.5M5.5 7a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1zm0 4a.5.5 0 0 0 0 1h9a.5.5 0 0 0 0-1z"/>
                            <path fill-rule="evenodd" d="M1.5 7a.5.5 0 0 1 .5-.5h1a.5.5 0 0 1 .5.5v1a.5.5 0 0 1-.5.5H2a.5.5 0 0 1-.5-.5zM2 7h1v1H2zm0 3.5a.5.5 0 0 0-.5.5v1a.5.5 0 0 0 .5.5h1a.5.5 0 0 0 .5-.5v-1a.5.5 0 0 0-.5-.5zm1 .5H2v1h1z"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>

                        <!-- Hasil Pencarian -->
            <div id="albumContainer" class="row row-cols-1 row-cols-sm-2 row-cols-md-3 row-cols-lg-5 g-4">

                {{-- 1. LOOP UNTUK RELEASES (ALBUM) --}}
                @if(isset($releases) && $releases->count() > 0)
                    @foreach($releases as $release)
                    <div class="col">
                        <div class="album-card">
                            <!-- Tampilan Grid -->
                            <div class="grid-view-content">
                                <div class="album-cover-wrapper album-stack">
                                    <img src="{{ $release->image ?? 'https://via.placeholder.com/300?text=No+Image' }}" alt="{{ $release->title }}">
                                </div>
                                <div class="album-info">
                                    <p class="text-master mb-1">{{ $release->format ?? 'RELEASE' }}</p>
                                    <a href="/showAlbum/{{ $release->release_id }}" class="album-title">{{ $release->title }}</a>
                                    <div class="album-artist">{{ $release->artis }}</div>
                                    <div class="album-meta">{{ $release->tahun }} · {{ $release->label_name }}</div>
                                </div>
                            </div>

                            <!-- Tampilan List -->
                            <div class="list-view-content">
                                <div class="album-cover-wrapper album-stack">
                                    <img src="{{ $release->image ?? 'https://via.placeholder.com/300?text=No+Image' }}" alt="{{ $release->title }}">
                                </div>
                                <div class="album-info">
                                    <p class="text-master mb-1">{{ $release->format ?? 'RELEASE' }}</p>
                                    <a href="/showAlbum/{{ $release->release_id }}" class="album-title">{{ $release->title }}</a>
                                    <div class="album-artist">{{ $release->artis }}</div>
                                    <div class="album-meta">{{ $release->tahun }} · {{ $release->label_name }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

                {{-- 2. LOOP UNTUK ARTISTS --}}
                @if(isset($artists) && $artists->count() > 0)
                    @foreach($artists as $artist)
                    <div class="col">
                        <div class="album-card">
                            <!-- Tampilan Grid -->
                            <div class="grid-view-content">
                                <div class="album-cover-wrapper artist-circle">
                                    <img src="https://via.placeholder.com/300?text={{ urlencode($artist->name) }}" alt="{{ $artist->name }}">
                                </div>
                                <div class="album-info">
                                    <p class="text-master mb-1">ARTIST</p>
                                    <a href="/showArtist?id={{ $artist->artist_id }}" class="album-title">{{ $artist->name }}</a>
                                </div>
                            </div>

                            <!-- Tampilan List -->
                            <div class="list-view-content">
                                <div class="album-cover-wrapper artist-circle">
                                    <img src="https://via.placeholder.com/300?text={{ urlencode($artist->name) }}" alt="{{ $artist->name }}">
                                </div>
                                <div class="album-info">
                                    <p class="text-master mb-1">ARTIST</p>
                                    <a href="/showArtist?id={{ $artist->artist_id }}" class="album-title">{{ $artist->name }}</a>
                                    <div class="album-meta">{{ Str::limit($artist->profile, 100) }}</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

                {{-- 3. LOOP UNTUK LABELS --}}
                @if(isset($labels) && $labels->count() > 0)
                    @foreach($labels as $label)
                    <div class="col">
                        <div class="album-card">
                            <!-- Tampilan Grid -->
                            <div class="grid-view-content">
                                <div class="album-cover-wrapper">
                                    <img src="https://via.placeholder.com/300?text={{ urlencode($label->name) }}" alt="{{ $label->name }}">
                                </div>
                                <div class="album-info">
                                    <p class="text-master mb-1">LABEL</p>
                                    <a href="/showLabel?id={{ $label->label_id }}" class="album-title">{{ $label->name }}</a>
                                </div>
                            </div>

                            <!-- Tampilan List -->
                            <div class="list-view-content">
                                <div class="album-cover-wrapper">
                                    <img src="https://via.placeholder.com/300?text={{ urlencode($label->name) }}" alt="{{ $label->name }}">
                                </div>
                                <div class="album-info">
                                    <p class="text-master mb-1">LABEL</p>
                                    <a href="/showLabel?id={{ $label->label_id }}" class="album-title">{{ $label->name }}</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif

                {{-- 4. JIKA TIDAK ADA HASIL SAMA SEKALI --}}
                @if(
                    (!isset($releases) || $releases->count() == 0) && 
                    (!isset($artists) || $artists->count() == 0) && 
                    (!isset($labels) || $labels->count() == 0)
                )
                    <div class="col-12 text-center py-5">
                        <h5 class="text-muted">Oops! Tidak ada hasil yang ditemukan.</h5>
                        <p>Coba gunakan kata kunci lain atau cek <a href="/search/advanced">Advanced Search</a>.</p>
                    </div>
                @endif

            </div> <!-- Penutup #albumContainer -->
