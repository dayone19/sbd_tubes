@extends('layouts.app')

@section('content')
@include('components.navbarMarket')

<style>
body {
    font-family: Arial, Helvetica, sans-serif;
    font-size: 12px;
    color: #222;
}

/* LAYOUT */
.marketplace {
    display: flex;
    padding: 15px 20px;
    gap: 20px;
}

/* SIDEBAR */
.sidebar {
    width: 240px;
    font-size: 13px;
}

.sidebar h4 {
    margin-top: 15px;
    font-weight: bold;
}

.sidebar a {
    display: flex;
    justify-content: space-between;
    color: #0b5ed7;
    padding: 3px 0;
}

.sidebar span {
    color: #999;
    font-size: 12px;
}

/* CONTENT */
.content {
    flex: 1;
}

/* TOP */
.top {
    display: flex;
    gap: 20px;
    align-items: center;
}

.top h2 {
    font-size: 20px;
    font-weight: bold;
}

/* PAGINATION */
.pagination {
    margin: 8px 0;
    color: #333;
}

/* HEADER TABLE */
.list-header {
    display: grid;
    grid-template-columns: 80px 3fr 180px 140px 120px;
    background: #f1f1f1;
    padding: 6px 8px;
    font-size: 12px;
    border: 1px solid #ddd;
}

/* ITEM */
.item {
    display: grid;
    grid-template-columns: 80px 3fr 180px 140px 120px;
    gap: 10px;
    padding: 10px;
    border-bottom: 1px solid #ddd;
    align-items: flex-start;
}

.item img {
    width: 60px;
    height: 60px;
}

/* INFO */
.title {
    color: #0b5ed7;
    font-weight: bold;
    font-size: 13px;
    text-decoration: none;
}

.info p {
    margin: 1px 0;
    font-size: 11px;
    color: #555;
}

/* SELLER */
.seller {
    font-size: 11px;
}

.seller a {
    color: #0b5ed7;
    font-weight: bold;
    text-decoration: none;
}

/* PRICE */
.price {
    color: #d0021b;
    font-weight: bold;
    font-size: 13px;
}

.price p {
    font-size: 11px;
    color: #555;
}

/* BUTTON */
.item button {
    background: #28a745;
    border-radius: 3px;
    font-size: 11px;
    padding: 5px 10px;
}

.item button:hover {
    background: #218838;
}

/* HOVER */
.item:hover {
    background: #f9f9f9;
}
.sort-box {
    font-size: 12px;
}
</style>

<div id="all" class="tab-content">

    <div class="marketplace">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <h4>Ships From</h4>
            <a href="#">United States <span>16,805,452</span></a>
            <a href="#">United Kingdom <span>11,310,924</span></a>

            <h4>Format</h4>
            <a href="#">Vinyl <span>51,465,233</span></a>
            <a href="#">CD <span>24,923,167</span></a>
        </div>

        <!-- CONTENT -->
        <div class="content">

            <!-- HEADER -->
            <div class="top">
                <h2>Shop Vinyl Records, CDs, and More</h2>

                <div class="sort-box">
                    Sort
                    <select><option>Listed</option></select>
                    Show
                    <select><option>25</option></select>
                </div>
            </div>

            <!-- PAGINATION -->
            <div class="pagination">
                1 – 25 of 79,088,247
            </div>

            <!-- HEADER TABLE -->
            <div class="list-header">
                <div></div>
                <div>Sort By: Listed</div>
                <div>Seller</div>
                <div>Price</div>
                <div></div>
            </div>

            <!-- ITEM -->
            <div class="item">
                <img src="https://via.placeholder.com/80">

                <div class="info">
                    <a class="title">Donald Byrd - Street Lady (CD, Album, Ltd)</a>
                    <p><b>Label:</b> Blue Note</p>
                    <p><b>Cat#:</b> BN-123</p>
                    <p><b>Media Condition:</b> VG+</p>
                    <p><b>Sleeve Condition:</b> VG+</p>
                    <p>Label: Blue Note</p>
                    <p>Media Condition: Very Good Plus (VG+)</p>
                    <p>Ships From: United States</p>
                </div>

                <div class="seller">
                    <a href="#">KUPIKU.US</a>
                    <p>⭐ 100%, 7,027 ratings</p>
                </div>

                <div class="price">
                    $23.55
                    <p>+ shipping</p>
                </div>

                <div>
                    <button>Add to Cart</button>
                </div>
            </div>


        </div>
    </div>

</div>


@endsection