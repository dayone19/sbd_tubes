@extends('layouts.app')

@section('css')
    @vite('resources/css/home.css')
@endsection

@section('content')

<div class="container-fluid mt-4" style="background-color:black;">
    <div class="row g-3">
        <!-- big, left -->
        <div class="col-md-8">
            <div class="hero-card">
                <img src="https://content.discogs.com/media/Essential-Prog-Metal.jpg" class="img-fluid">
                <div class="overlay">
                    <h2 style="font-weight:600;">Prog Metal Essentials</h2>
                </div>
            </div>
        </div>

        <!-- small, right -->
        <div class="col-md-4 d-flex flex-column gap-3">

            <div class="hero-small">
                <img src="https://content.discogs.com/media/Most-Valuable-February.jpg" class="img-fluid">
                <div class="overlay-small">
                    <h5 style="font-weight:600;">Last Month’s Most Valuable Records</h5>
                </div>
            </div>

            <div class="hero-small">
                <img src="https://content.discogs.com/media/thurstonmoore_september24_discogs_vinylogue_shotbymelissa_17-1-min.jpg" class="img-fluid">
                <div class="overlay-small">
                    <h5 style="font-weight:600;">Thurston Moore and the Smell of Vinyl</h5>
                </div>
            </div>

            <div class="hero-small">
                <img src="https://content.discogs.com/media/Essential-Japanese-Jazz.jpg" class="img-fluid">
                <div class="overlay-small">
                    <h5 style="font-weight:600;">An Intro to Japanese Jazz</h5>
                </div>
            </div>

        </div>

    </div>
</div>


<!-- 2nd content -->
<div class="section">
    <div class="section-header">
        <div class="title">This Week's Best-Selling Vinyl Records & CDs</div>
    </div>

    <div class="carousel-wrapper">
        <button class="carousel-btn prev" onclick="scrollCarousel('bestselling', -1)">&#8249;</button>

        <div class="album-row" id="bestselling">
            @foreach($albums as $album)
            <div class="album-card">

                <img src="{{$album->image ?? 'https://via.placeholder.com/200'}}">

                <div class="album-title">
                    {{$album->title}}
                </div>

                <div class="artist">
                    {{$album->artis}}
                </div>

                <div class="year">
                    {{$album->tahun}} 
                </div>

                <!-- style -->
                <div class="year">
                    {{$album->style}}, {{$album->genre}}
                    <br>{{$album->format}}
                </div>

                <div class="year">
                    {{$album->total_copies ?? 0 }} copies from ${{number_format($album->lowest_price ?? 0, 2)}}
                </div>
            </div>
            @endforeach
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('bestselling', 1)">&#8250;</button>
    </div>
</div>

<!-- 3rd content -->
<div class="section">
    <div class="section-header">
        <div class="title">This Week's Valuable Vinyl Records & CDs</div>
    </div>

    <div class="carousel-wrapper">
        <button class="carousel-btn prev" onclick="scrollCarousel('valuable', -1)">&#8249;</button>

        <div class="album-row" id="valuable">
            @if(isset($valuables))
            @foreach($valuables as $x)
            <div class="album-card">

                <img src="{{$x->image ?? 'https://via.placeholder.com/200'}}">

                <div class="album-title">
                    {{$x->title}}
                </div>

                <div class="artist">
                    {{$x->artis}}
                </div>

                <div class="year">
                    {{$x->tahun}} 
                </div>

                <!-- style -->
                <div class="year">
                    {{$x->style}}, {{$x->genre}}
                    <br>{{$x->format}}
                </div>

                <div class="year">
                    {{$x->total_copies ?? 0 }} copies from ${{number_format($x->paling_mahal ?? 0, 2)}}
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('valuable', 1)">&#8250;</button>
    </div>
</div>

<!-- 4th content -->
<div class="section">
    <div class="section-header">
        <div class="title">This Week's Collected Vinyl Records & CDs</div>
    </div>

    <div class="carousel-wrapper">
        <button class="carousel-btn prev" onclick="scrollCarousel('collected', -1)">&#8249;</button>

        <div class="album-row" id="collected">
            @if(isset($collecteds))
            @foreach($collecteds as $collected)
            <div class="album-card">

                <img src="{{$collected->image ?? 'https://via.placeholder.com/200'}}">

                <div class="album-title">
                    {{$collected->title}}
                </div>

                <div class="artist">
                    {{$collected->artis}}
                </div>

                <div class="year">
                    {{$collected->tahun}} 
                </div>

                <!-- style -->
                <div class="year">
                    {{$collected->style}}, {{$collected->genre}}
                    <br>{{$collected->format}}
                </div>

                <div class="year">
                    {{$collected->total_copies ?? 0 }} copies from ${{number_format($collected->total_lowest ?? 0, 2)}}
                </div>
            </div>
            @endforeach
            @endif
        </div>
        <button class="carousel-btn next" onclick="scrollCarousel('collected', 1)">&#8250;</button>
    </div>
</div>

<script>
    function scrollCarousel(id, direction) {
    const row = document.getElementById(id);
    const scrollAmount = 220 * 3; // scroll 3 card sekaligus
    row.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
    }
</script>
@endsection