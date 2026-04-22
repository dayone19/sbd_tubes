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
            <div class="album-card">
                <img src="https://upload.wikimedia.org/wikipedia/en/6/6e/Talk_Talk_Spirit_of_Eden.jpg">
                <div class="album-title">Spirit Of Eden</div>
                <div class="artist">Talk Talk</div>
                <div class="year">2026 · Rock</div>
                <div class="price">12 copies from $45.00</div>
            </div>

            <div class="album-card">
                <img src="https://upload.wikimedia.org/wikipedia/en/9/9f/Gorillaz_-_The_Now_Now.png">
                <div class="album-title">The Now Now</div>
                <div class="artist">Gorillaz</div>
                <div class="year">2026 · Alternative</div>
                <div class="price">8 copies from $38.50</div>
            </div>

            <div class="album-card">
                <img src="https://upload.wikimedia.org/wikipedia/en/0/0c/Hiroshi_Suzuki_Cat.jpg">
                <div class="album-title">Cat</div>
                <div class="artist">Hiroshi Suzuki</div>
                <div class="year">2025 · Jazz</div>
                <div class="price">5 copies from $120.00</div>
            </div>

            <div class="album-card">
                <img src="https://upload.wikimedia.org/wikipedia/en/2/2b/Kind_of_Blue.jpg">
                <div class="album-title">Kind of Blue</div>
                <div class="artist">Miles Davis</div>
                <div class="year">1959 · Jazz</div>
                <div class="price">30 copies from $25.00</div>
            </div>

            <!-- tambah card lagi biar keliatan efek scroll-nya -->
            <div class="album-card">
                <img src="https://upload.wikimedia.org/wikipedia/en/6/6e/Talk_Talk_Spirit_of_Eden.jpg">
                <div class="album-title">Spirit Of Eden</div>
                <div class="artist">Talk Talk</div>
                <div class="year">2026 · Rock</div>
                <div class="price">12 copies from $45.00</div>
            </div>

            <div class="album-card">
                <img src="https://upload.wikimedia.org/wikipedia/en/2/2b/Kind_of_Blue.jpg">
                <div class="album-title">Kind of Blue</div>
                <div class="artist">Miles Davis</div>
                <div class="year">1959 · Jazz</div>
                <div class="price">30 copies from $25.00</div>
            </div>
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
        <button class="carousel-btn prev" onclick="scrollCarousel('bestselling', -1)">&#8249;</button>

        <div class="album-row" id="bestselling">
            <div class="album-card">
                <img src="https://upload.wikimedia.org/wikipedia/en/6/6e/Talk_Talk_Spirit_of_Eden.jpg">
                <div class="album-title">Spirit Of Eden</div>
                <div class="artist">Talk Talk</div>
                <div class="year">2026 · Rock</div>
                <div class="price">12 copies from $45.00</div>
            </div>

            <div class="album-card">
                <img src="https://upload.wikimedia.org/wikipedia/en/9/9f/Gorillaz_-_The_Now_Now.png">
                <div class="album-title">The Now Now</div>
                <div class="artist">Gorillaz</div>
                <div class="year">2026 · Alternative</div>
                <div class="price">8 copies from $38.50</div>
            </div>
        </div>
    </div>
</div>

<!-- 4th content -->
<div class="section">
    <div class="section-header">
        <div class="title">This Week's Collected Vinyl Records & CDs</div>
    </div>

    <div class="carousel-wrapper">
        <button class="carousel-btn prev" onclick="scrollCarousel('bestselling', -1)">&#8249;</button>

        <div class="album-row" id="bestselling">
            <div class="album-card">
                <img src="https://upload.wikimedia.org/wikipedia/en/6/6e/Talk_Talk_Spirit_of_Eden.jpg">
                <div class="album-title">Spirit Of Eden</div>
                <div class="artist">Talk Talk</div>
                <div class="year">2026 · Rock</div>
                <div class="price">12 copies from $45.00</div>
            </div>

            <div class="album-card">
                <img src="https://upload.wikimedia.org/wikipedia/en/9/9f/Gorillaz_-_The_Now_Now.png">
                <div class="album-title">The Now Now</div>
                <div class="artist">Gorillaz</div>
                <div class="year">2026 · Alternative</div>
                <div class="price">8 copies from $38.50</div>
            </div>
        </div>
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