@extends('layouts.app')

@section('content')
@include('components.navbarMarket')

<style>
body {font-family: Arial, Helvetica, sans-serif;font-size: 12px;color: #222;}
/* LAYOUT */
.marketplace {display: flex;padding: 15px 20px;gap: 20px;}
/* SIDEBAR */
.sidebar {width: 200px;font-size: 13px;}
.sidebar h5 {margin-top: 13px;font-weight: bold;}
.sidebar a {display: flex;justify-content: space-between;color: #0b5ed7;padding: 3px 0;text-decoration: none;}
.sidebar span {color: #999;font-size: 12px;}
.sidebar-hidden { display: none; }
.show-more-btn { cursor: pointer; color: #0b5ed7; font-size: 13px; padding: 3px 0; display:block; background:none; border:none; text-align:left; width:100%; }
.show-more-btn:hover { text-decoration: underline; }
/* CONTENT */
.content {flex: 1;}
/* TOP */
.top {display: flex;gap: 20px;align-items: center;}
.top h2 {font-size: 20px;font-weight: bold;}
/* PAGINATION */
.pagination-container {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 10px;
    font-size: 13px;
}
.pagination-info { font-weight: bold; }
.pagination-info a { color: #0b5ed7; text-decoration: none; margin: 0 5px; }
.sort-box { font-size: 13px; }
.sort-box select { padding: 2px; border: 1px solid #ccc; border-radius: 3px; }
/* HEADER TABLE */
.list-header {
    display: grid;
    grid-template-columns: 80px 3fr 180px 140px 120px;
    background: #f1f1f1;
    padding: 6px 8px;
    font-size: 14px;
    border: 1px solid #ddd;
}
/* ITEM */
.item {
    display: grid;
    grid-template-columns: 100px 3fr 180px 140px 120px;
    gap: 10px;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    align-items: flex-start;
}
.item img { width: 60px; height: 60px; }
/* INFO */
.title { color: #0b5ed7; font-weight: bold; font-size: 14px; text-decoration: none; }
.info { margin: 3px; font-size: 14px; color: #555; }
/* SELLER */
.seller { font-size: 14px; }
.seller a { color: #0b5ed7; font-weight: bold; text-decoration: none; }
/* PRICE */
.price {color: #d0021b;font-weight: bold;font-size: 14px;}
.price p {font-size: 14px;color: #555;}
/* BUTTON */
.item button { background: #008000; border-radius: 3px; font-size: 11px; padding: 5px 10px; color: #fff; border: none; cursor: pointer; }
.item button:hover {background: #218838;}
/* HOVER */
.item:hover {background: #f9f9f9;}
.item-img-container { position: relative; }
.item-img-container img { width: 100px; height: 100px; border: 1px solid #ddd; object-fit: cover; }
.community-stats { font-size: 11px; margin-top: 5px; color: #666; }
.community-stats .have { color: #4CAF50; margin-right: 5px; }
.community-stats .want { color: #f44336; }
.rating-stars { color: #f5a623; font-size: 14px; margin: 2px 0; display: block; }
.empty-state { padding: 40px; text-align: center; color: #555; font-size: 15px; }
</style>

<div id="all" class="tab-content">
    <div class="marketplace">

        <div class="sidebar">

            {{-- YOUR FILTERS --}}
            @if(!empty($activeFilters))
            <div style="margin-bottom:15px;">
                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:8px;">
                    <strong style="font-size:14px;">You Selected:</strong>
                    <a href="{{ route('sell.list', array_merge(request()->except(array_keys($activeFilters)), ['sort' => request('sort'), 'show' => request('show')])) }}"
                       style="color:#333; text-decoration:none; font-size:16px; font-weight:bold;">×</a>
                </div>
                @foreach($activeFilters as $filter)
                <a href="{{ request()->fullUrlWithQuery([$filter['param'] => null]) }}"
                   style="display:flex; justify-content:space-between; align-items:center;
                          background:#2060c0; color:#ffffff; padding:8px 12px; margin-bottom:4px;
                          text-decoration:none; font-size:13px; font-weight:bold; border-radius:2px;">
                    <span style="color:#ffffff; font-weight:bold;">{{ $filter['label'] }}</span>
                    <span style="color:#ffffff; font-size:16px; margin-left:10px; font-weight:bold;">✕</span>
                </a>
                @endforeach
            </div>
            @endif

            {{-- Ships From --}}
            <div class="sidebar-section" data-section="countries">
                <h5>Ships From</h5>
                @foreach($countries->take(5) as $c)
                    @if($filterCountry !== $c->country)
                        <a href="{{ request()->fullUrlWithQuery(['country' => $c->country]) }}">
                            {{ $c->country }} <span>{{ number_format($c->product_count) }}</span>
                        </a>
                    @endif
                @endforeach
                @if($countries->count() > 5)
                    <div class="sidebar-hidden" id="hidden-countries">
                        @foreach($countries->slice(5) as $c)
                            @if($filterCountry !== $c->country)
                                <a href="{{ request()->fullUrlWithQuery(['country' => $c->country]) }}">
                                    {{ $c->country }} <span>{{ number_format($c->product_count) }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <button class="show-more-btn" onclick="toggleMore('countries', this)">Show more...</button>
                @endif
            </div>

            {{-- Format --}}
            <div class="sidebar-section" data-section="formats">
                <h5>Format</h5>
                @foreach($formats->take(5) as $f)
                    @if($filterFormat !== $f->format_name)
                        <a href="{{ request()->fullUrlWithQuery(['format' => $f->format_name]) }}">
                            {{ $f->format_name }} <span>{{ number_format($f->product_count) }}</span>
                        </a>
                    @endif
                @endforeach
                @if($formats->count() > 5)
                    <div class="sidebar-hidden" id="hidden-formats">
                        @foreach($formats->slice(5) as $f)
                            @if($filterFormat !== $f->format_name)
                                <a href="{{ request()->fullUrlWithQuery(['format' => $f->format_name]) }}">
                                    {{ $f->format_name }} <span>{{ number_format($f->product_count) }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <button class="show-more-btn" onclick="toggleMore('formats', this)">Show more...</button>
                @endif
            </div>

            {{-- Currency (statis) --}}
            <div class="sidebar-section" data-section="currency">
                <h5>Currency</h5>
                <a href="#">EUR (€) <span>40,396,075</span></a>
                <a href="#">USD ($) <span>21,583,615</span></a>
                <a href="#">GBP (£) <span>11,579,616</span></a>
                <a href="#">AUD (A$) <span>1,281,244</span></a>
                <a href="#">CHF (CHF) <span>1,226,249</span></a>
                <div class="sidebar-hidden" id="hidden-currency"></div>
                <button class="show-more-btn" onclick="toggleMore('currency', this)">Show more...</button>
            </div>

            {{-- Genre --}}
            <div class="sidebar-section" data-section="genres">
                <h5>Genre</h5>
                @foreach($genres->take(5) as $g)
                    @if($filterGenre !== $g->name)
                        <a href="{{ request()->fullUrlWithQuery(['genre' => $g->name]) }}">
                            {{ $g->name }} <span>{{ number_format($g->product_count) }}</span>
                        </a>
                    @endif
                @endforeach
                @if($genres->count() > 5)
                    <div class="sidebar-hidden" id="hidden-genres">
                        @foreach($genres->slice(5) as $g)
                            @if($filterGenre !== $g->name)
                                <a href="{{ request()->fullUrlWithQuery(['genre' => $g->name]) }}">
                                    {{ $g->name }} <span>{{ number_format($g->product_count) }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <button class="show-more-btn" onclick="toggleMore('genres', this)">Show more...</button>
                @endif
            </div>

            {{-- Style --}}
            <div class="sidebar-section" data-section="styles">
                <h5>Style</h5>
                @foreach($styles->take(5) as $s)
                    @if($filterStyle !== $s->name)
                        <a href="{{ request()->fullUrlWithQuery(['style' => $s->name]) }}">
                            {{ $s->name }} <span>{{ number_format($s->product_count) }}</span>
                        </a>
                    @endif
                @endforeach
                @if($styles->count() > 5)
                    <div class="sidebar-hidden" id="hidden-styles">
                        @foreach($styles->slice(5) as $s)
                            @if($filterStyle !== $s->name)
                                <a href="{{ request()->fullUrlWithQuery(['style' => $s->name]) }}">
                                    {{ $s->name }} <span>{{ number_format($s->product_count) }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <button class="show-more-btn" onclick="toggleMore('styles', this)">Show more...</button>
                @endif
            </div>

            {{-- Format Description --}}
            <div class="sidebar-section" data-section="formatDescriptions">
                <h5>Format Description</h5>
                @foreach($formatDescriptions->take(5) as $fd)
                    @if($filterFormatDesc !== $fd->name)
                        <a href="{{ request()->fullUrlWithQuery(['format_desc' => $fd->name]) }}">
                            {{ $fd->name }} <span>{{ number_format($fd->product_count) }}</span>
                        </a>
                    @endif
                @endforeach
                @if($formatDescriptions->count() > 5)
                    <div class="sidebar-hidden" id="hidden-formatDescriptions">
                        @foreach($formatDescriptions->slice(5) as $fd)
                            @if($filterFormatDesc !== $fd->name)
                                <a href="{{ request()->fullUrlWithQuery(['format_desc' => $fd->name]) }}">
                                    {{ $fd->name }} <span>{{ number_format($fd->product_count) }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <button class="show-more-btn" onclick="toggleMore('formatDescriptions', this)">Show more...</button>
                @endif
            </div>

            {{-- Year --}}
            <div class="sidebar-section" data-section="years">
                <h5>Year</h5>
                @foreach($years->take(5) as $y)
                    @if($filterYear != $y->year)
                        <a href="{{ request()->fullUrlWithQuery(['year' => $y->year]) }}">
                            {{ $y->year }} <span>{{ number_format($y->product_count) }}</span>
                        </a>
                    @endif
                @endforeach
                @if($years->count() > 5)
                    <div class="sidebar-hidden" id="hidden-years">
                        @foreach($years->slice(5) as $y)
                            @if($filterYear != $y->year)
                                <a href="{{ request()->fullUrlWithQuery(['year' => $y->year]) }}">
                                    {{ $y->year }} <span>{{ number_format($y->product_count) }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <button class="show-more-btn" onclick="toggleMore('years', this)">Show more...</button>
                @endif
            </div>

            {{-- Media Condition --}}
            <div class="sidebar-section" data-section="conditions">
                <h5>Media Condition</h5>
                @foreach($conditions->take(5) as $cond)
                    @if($filterCondition !== $cond->condition)
                        <a href="{{ request()->fullUrlWithQuery(['condition' => $cond->condition]) }}">
                            {{ $cond->condition }} <span>{{ number_format($cond->product_count) }}</span>
                        </a>
                    @endif
                @endforeach
                @if($conditions->count() > 5)
                    <div class="sidebar-hidden" id="hidden-conditions">
                        @foreach($conditions->slice(5) as $cond)
                            @if($filterCondition !== $cond->condition)
                                <a href="{{ request()->fullUrlWithQuery(['condition' => $cond->condition]) }}">
                                    {{ $cond->condition }} <span>{{ number_format($cond->product_count) }}</span>
                                </a>
                            @endif
                        @endforeach
                    </div>
                    <button class="show-more-btn" onclick="toggleMore('conditions', this)">Show more...</button>
                @endif
            </div>

        </div>

        <div class="content">

            <div class="top">
                <h2>Shop Vinyl Records, CDs, and More</h2>
            </div>

            {{-- FILTER FORM --}}
            <form method="GET" action="{{ url()->current() }}" id="sortForm">
                <div class="pagination-container">
                    <div class="pagination-info">
                        {{ $from }} – {{ $to }} of {{ number_format($total) }}
                        @if($products->previousPageUrl())
                            <a href="{{ $products->previousPageUrl() }}">❮ Prev</a>
                        @endif
                        @if($products->nextPageUrl())
                            <a href="{{ $products->nextPageUrl() }}">Next ❯</a>
                        @endif
                    </div>
                    <div class="sort-box">
                        Sort 
                        <select name="sort" onchange="document.getElementById('sortForm').submit()">
                            <option value="newest"     {{ $sort === 'newest'     ? 'selected' : '' }}>Listed Newest</option>
                            <option value="price_asc"  {{ $sort === 'price_asc'  ? 'selected' : '' }}>Price: Low to High</option>
                            <option value="price_desc" {{ $sort === 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                            <option value="condition"  {{ $sort === 'condition'  ? 'selected' : '' }}>Condition</option>
                        </select>
                        Show 
                        <select name="show" onchange="document.getElementById('sortForm').submit()">
                            @foreach([25, 50, 100] as $n)
                                <option value="{{ $n }}" {{ $perPage == $n ? 'selected' : '' }}>{{ $n }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
            </form>

            <div class="list-header">
                <div></div>
                <div>
                    Sort By: 
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" style="text-decoration:none; display:inline-block; margin-right: 8px; color:{{ $sort === 'newest' ? '#222; font-weight:bold;' : '#0b5ed7' }}">Listed</a>, 
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'condition']) }}" style="text-decoration:none; display:inline-block; margin-right: 8px; color:{{ $sort === 'condition' ? '#222; font-weight:bold;' : '#0b5ed7' }}">Condition</a>, 
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'artist']) }}" style="text-decoration:none; display:inline-block; margin-right: 8px; color:{{ $sort === 'artist' ? '#222; font-weight:bold;' : '#0b5ed7' }}">Artist</a>, 
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'title']) }}" style="text-decoration:none; display:inline-block; margin-right: 8px; color:{{ $sort === 'title' ? '#222; font-weight:bold;' : '#0b5ed7' }}">Title</a>, 
                    <a href="{{ request()->fullUrlWithQuery(['sort' => 'label']) }}" style="text-decoration:none; display:inline-block; color:{{ $sort === 'label' ? '#222; font-weight:bold;' : '#0b5ed7' }}">Label</a>
                </div>
                <div>Seller</div>
                <div>Price</div>
                <div></div>
            </div>

            {{-- LOOPING ITEM JUALAN --}}
            @forelse($products as $product)
                @php
                    $release    = $product->release;
                    $seller     = $product->seller;
                    $image      = $release?->images?->first();
                    $artists    = $release?->artists?->pluck('name')->join(', ') ?? 'Unknown Artist';
                    $label      = $release?->labels?->first()?->name ?? '-';
                    $catNum     = $release?->catalog_number ?? '-';
                    $country    = $release?->country ?? '-';

                    $reviews      = $seller?->reviews ?? collect();
                    $totalReviews = $reviews->count();
                    $avgRating    = $totalReviews > 0 ? round($reviews->avg('rating'), 1) : null;
                    $starsFull    = $avgRating ? floor($avgRating) : 0;
                @endphp

                <div class="item">
                    <div class="item-img-container">
                        <img src="{{ $image?->url ?? 'https://via.placeholder.com/150' }}" alt="Album Cover">
                        <div class="community-stats">
                            <span class="have">■ {{ $product->stock }} in stock</span>
                        </div>
                    </div>

                    <div class="info">
                        <div>
                            <a class="title" href="#">
                                {{ $artists }} - {{ $release?->title ?? 'Unknown Title' }} 
                                ({{ $release?->formats?->pluck('name')->join(', ') ?? '-' }})
                            </a>
                        </div>
                        <div><b>Label:</b> {{ $label }}</div>
                        <div><b>Cat#:</b> {{ $catNum }}</div>
                        <div><b>Media Condition:</b> {{ $product->condition }}</div>
                        <div><b>Sleeve Condition:</b> Generic</div>
                        <div><p>{{ $release?->notes ?? 'No additional notes.' }}</p></div>
                        <div>
                            <a href="{{ route('release.show', $product->release_id) }}" class="btn-view-release">
                                View Release Page
                            </a>
                        </div>
                    </div>

                    <div class="seller">
                        <a href="#">{{ $seller?->store_name ?? 'Unknown Store' }}</a>
                        @if($avgRating)
                            <div class="rating-stars">
                                @for($i = 1; $i <= 5; $i++)
                                    {!! $i <= $starsFull ? '★' : '<span style="color:#ccc">★</span>' !!}
                                @endfor
                                <span style="color:#333; font-weight:bold;">{{ number_format(($avgRating / 5) * 100, 1) }}%</span>
                            </div>
                            <p style="font-size:12px; color:#0b5ed7; margin:0;">{{ number_format($totalReviews) }} ratings</p>
                        @else
                            <p style="font-size:12px; color:#999; margin:0;">No ratings yet</p>
                        @endif
                        <div><b>Ships From: </b> {{ $country }}</div>
                    </div>

                    <div class="price">
                        ${{ number_format($product->price, 2) }}
                        <p>+ ${{ number_format($product->shipping, 2) }} shipping</p>
                        <p>+ ${{ number_format($product->tax, 2) }} tax</p>
                    </div>

                    <div>
    {{-- Gunakan route('cart.add') biar Laravel yang nyari URL aslinya secara otomatis --}}
    <form method="POST" action="{{ route('cart.add') }}">
        @csrf
        <input type="hidden" name="product_id" value="{{ $product->product_id }}">
        <button type="submit" class="btn btn-primary btn-sm">Add to Cart</button>
    </form>
</div>
                </div>
            @empty
                <div class="empty-state">
                    Belum ada produk aktif yang sedang dijual di marketplace saat ini.
                </div>
            @endforelse

        </div>
    </div>
</div>

<script>
    function toggleMore(key, btn) {
        const hidden = document.getElementById('hidden-' + key);
        if (!hidden) return;

        const isExpanding = hidden.style.display === 'none' || hidden.style.display === '';

        if (isExpanding) {
            // Tampilkan yang diklik
            hidden.style.display = 'block';
            btn.textContent = 'Show less';

            // Sembunyikan section lain
            document.querySelectorAll('.sidebar-section').forEach(function(section) {
                if (section.dataset.section !== key) {
                    section.style.display = 'none';
                }
            });

        } else {
            // Sembunyikan yang diklik
            hidden.style.display = 'none';
            btn.textContent = 'Show more...';

            // Tampilkan semua section lagi
            document.querySelectorAll('.sidebar-section').forEach(function(section) {
                section.style.display = '';
            });
        }
    }
</script>
@endsection