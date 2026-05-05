@extends('layouts.app')

@section('content')

<style>
    /* Header Section */
    .lists-header {
        position: relative;
        background-color: #1a1a1a;
        color: white;
        padding: 20px 0;
        overflow: hidden;
    }
    .mosaic-bg {
        position: absolute;
        top: 0; left: 0; width: 100%; height: 100%;
        background-image: url(https://catalog-assets.discogs.com/e42bbd4a.png);
        background-size: cover;
        opacity: 0.3;
        z-index: 1;
    }
    .header-content {
        position: relative;
        z-index: 2;
    }
    .btn-manage {
        background-color: #008000;
        color: white;
        border: none;
        padding: 10px 20px;
        font-weight: bold;
    }
    /* List Cards Section */
    .list-card {
        border: none;
        text-align: center;
    }
    .list-card img {
        width: 100%;
        aspect-ratio: 1/1;
        object-fit: cover;
        border: 1px solid #ddd;
    }
    .list-title {
        font-size: 14px;
        font-weight: bold;
        margin-top: 10px;
        color: #000;
        text-decoration: none;
        display: block;
    }
    .list-title:hover {
        text-decoration: underline;
    }
    .blue-link {
        color: #34cef8;
        text-decoration: none;
        font-size: 14px;
    }

    /* Search Bar Styling - Dibuat lebih lebar & Shadow halus */
    .search-lists-container {
        max-width: 450px;
        position: relative;
        margin: 40px 0 25px 0;
    }
    .search-lists-input {
        border-radius: 25px;
        padding-left: 20px;
        padding-right: 45px;
        height: 45px;
        border: 1px solid #ccc;
        box-shadow: inset 0 1px 3px rgba(0,0,0,0.1);
    }
    .search-icon {
        position: absolute;
        right: 18px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 18px;
        color: #333;
    }

    /* Table Styling - Mengikuti gaya Discogs */
    .table-lists {
        font-size: 15px;
        border-collapse: collapse;
        color: #333;
    }
    .table-lists thead th {
        background-color: #f2f2f2; /* Warna abu-abu header */
        border: none;
        padding: 12px 15px;
        font-weight: 600;
        color: #000;
    }
    .table-lists tbody tr {
        border-bottom: 1px solid #f0f0f0;
    }
    /* Zebra Striping: Baris genap abu-abu sangat muda */
    .table-lists tbody tr:nth-child(even) {
        background-color: #f9f9f9;
    }
    .table-lists td {
        vertical-align: top; /* Text rata atas seperti gambar */
        padding: 15px 15px;
    }
    .user-avatar {
        width: 32px;
        height: 32px;
        border-radius: 3px; /* Kotak sedikit rounded */
        object-fit: cover;
        margin-right: 10px;
    }
    /* Warna Link Biru Discogs */
    .list-link {
        color: #2a5bd7;
        text-decoration: none;
    }
    .list-link:hover {
        text-decoration: underline;
    }
    .user-link {
        color: #2a5bd7;
        text-decoration: none;
    }
    .created-text {
        color: #333;
        font-size: 14px;
    }

</style>

<div class="container-fluid p-0">
    <!-- HERO HEADER -->
    <header class="lists-header">
        <div class="mosaic-bg"></div>
        <div class="container header-content">
            <div class="row align-items-center">
                <div class="col-md-8">
                    <h1 class="fw-bold mb-3">Recent Lists</h1>
                    <p class="mb-0">Explore lists from the Discogs community. Lists can be about anything—notable album covers, prolific producers, your favorite holiday albums. The possibilities are endless! Lists can contain artists, releases, labels, or even other lists.</p>
                </div>
                <div class="col-md-4 text-md-end text-start mt-3 mt-md-0">
                    <button class="btn btn-manage">Manage My Lists</button>
                </div>
            </div>
        </div>
    </header>

    <div class="container mt-1">
        <a href="#" class="blue-link fw-bold">Read More About Creating Lists</a>
        
        <h4 class="fw-bold mt-1 mb-3">Lists We Like</h4>
        <p class="text-muted small mb-4">Here are a few lists we think deserve a mention.</p>

        <!-- LIST GRID -->
        <div class="row g-4">
            <!-- Item 1 -->
            <div class="col-6 col-sm-4 col-md-2-4" style="width: 20%;">
                <div class="list-card">
                    <img src="https://catalog-assets.discogs.com/4ad649cb.png" alt="Packaging">
                    <a href="#" class="list-title">Remarkable packaging and presentation</a>
                </div>
            </div>
            <!-- Item 2 -->
            <div class="col-6 col-sm-4 col-md-2-4" style="width: 20%;">
                <div class="list-card">
                    <img src="https://catalog-assets.discogs.com/b886b2dd.png" alt="Head">
                    <a href="#" class="list-title">WHAT HAVE YOU GOT ON YOUR HEAD???</a>
                </div>
            </div>
            <!-- Item 3 -->
            <div class="col-6 col-sm-4 col-md-2-4" style="width: 20%;">
                <div class="list-card">
                    <img src="https://catalog-assets.discogs.com/94a9ae14.png" alt="Name">
                    <a href="#" class="list-title">This Band's Name Was Another Band's Song</a>
                </div>
            </div>
            <!-- Item 4 -->
            <div class="col-6 col-sm-4 col-md-2-4" style="width: 20%;">
                <div class="list-card">
                    <img src="https://catalog-assets.discogs.com/7c3db4ed.png" alt="Art">
                    <a href="#" class="list-title">Art Nouveau</a>
                </div>
            </div>
            <!-- Item 5 -->
            <div class="col-6 col-sm-4 col-md-2-4" style="width: 20%;">
                <div class="list-card">
                    <img src="https://catalog-assets.discogs.com/04edd6ec.png" alt="Rare">
                    <a href="#" class="list-title">Rare and played by great djs!</a>
                </div>
            </div>
        </div>
    </div>

    <div class="container mt-4 mb-5">
    <!-- Search Bar -->
        <div class="search-lists-container">
            <input type="text" class="form-control search-lists-input" placeholder="Search Lists">
            <i class="fa fa-search search-icon"></i>
        </div>

        <!-- Table -->
        <div class="table-responsive">
            <table class="table table-lists">
                <thead>
                    <tr>
                        <th>List</th>
                        <th>User</th>
                        <th>Description</th>
                        <th>Created</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Row 1 -->
                    <tr>
                        <td><a href="#" class="list-link">all time favs</a></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="#" class="user-avatar">
                                <a href="#" class="user-link">fantasyuh</a>
                            </div>
                        </td>
                        <td>hello</td>
                        <td class="created-text">4 hours ago</td>
                    </tr>
                    
                    <!-- Row 2 -->
                    <tr>
                        <td><a href="#" class="list-link fw-bold text-uppercase" style="font-size: 13px;">WANT</a></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="#" class="user-avatar">
                                <a href="#" class="user-link">plattenyata</a>
                            </div>
                        </td>
                        <td></td>
                        <td class="created-text">5 hours ago</td>
                    </tr>

                    <!-- Row 3 -->
                    <tr>
                        <td><a href="#" class="list-link">Wantlist</a></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="https://i.pravatar.cc/32?img=3" class="user-avatar">
                                <a href="#" class="user-link">KobeAmerijckx</a>
                            </div>
                        </td>
                        <td>
                            <div class="small">
                                <a href="#" class="user-link">https://recordsonvinyl.nl/</a>
                            </div>
                        </td>
                        <td class="created-text">5 hours ago</td>
                    </tr>

                    <!-- Row 4  -->
                    <tr>
                        <td><a href="#" class="list-link">traditional music (non-classical)</a></td>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="#" class="user-avatar">
                                <a href="#" class="user-link">timewind75</a>
                            </div>
                        </td>
                        <td style="max-width: 400px;">traditional folk, medieval music, bard, ballads, nursery rhymes, anthems, etc.</td>
                        <td class="created-text">19 hours ago</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection