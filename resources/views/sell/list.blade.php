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
.sidebar a {display: flex;justify-content: space-between;color: #0b5ed7;padding: 3px 0;}
.sidebar span {color: #999;font-size: 12px;}
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
.item img {
    width: 60px;
    height: 60px;
}
/* INFO */
.title {
    color: #0b5ed7;
    font-weight: bold;
    font-size: 14px;
    text-decoration: none;
}
.info {
    margin: 3px;
    font-size: 14px;
    color: #555;
}
/* SELLER */
.seller {
    font-size: 14px;
}
.seller a {
    color: #0b5ed7;
    font-weight: bold;
    text-decoration: none;
}
/* PRICE */
.price {color: #d0021b;font-weight: bold;font-size: 14px;}
.price p {font-size: 14px;color: #555;}
/* BUTTON */
.item button {
    background: #008000;
    border-radius: 3px;
    font-size: 11px;
    padding: 5px 10px;
    color: #fff;
}
.item button:hover {background: #218838;}
/* HOVER */
.item:hover {background: #f9f9f9;}
.item-img-container { position: relative; }
.item-img-container img { width: 100px; height: 100px; border: 1px solid #ddd; object-fit: cover; }
.community-stats { font-size: 11px; margin-top: 5px; color: #666; }
.community-stats .have { color: #4CAF50; margin-right: 5px; }
.community-stats .want { color: #f44336; }
.rating-stars {
    color: #f5a623;
    font-size: 14px;
    margin: 2px 0;
    display: block;
}
</style>

<div id="all" class="tab-content">

    <div class="marketplace">

        <!-- SIDEBAR -->
        <div class="sidebar">
            <h5>Ships From</h5>
            <a href="#">United States <span>16,805,452</span></a>
            <a href="#">United Kingdom <span>11,310,924</span></a>
            <a href="#">Germany <span>10,374,370</span></a>
            <a href="#">Italy <span>5,815,199</span></a>
            <a href="#">Netherlands <span>5,102,763</span></a>
            <a href="#">Show more... </a>

            <h5>Format</h5>
            <a href="#">Vinyl <span>51,506,531</span></a>
            <a href="#">CD <span>24,860,040</span></a>
            <a href="#">Cassete <span>1,604,085</span></a>
            <a href="#">DVD <span>710,676</span></a>
            <a href="#">Box Set <span>674,607</span></a>
            <a href="#">Show more... </a>

            <h5>Currency</h5>
            <a href="#">EUR (€) <span>40,396,075</span></a>
            <a href="#">USD ($) <span>21,583,615</span></a>
            <a href="#">GBP (£) <span>11,579,616</span></a>
            <a href="#">AUD (A$) <span>1,281,244</span></a>
            <a href="#">CHF (CHF) <span>1,226,249</span></a>
            <a href="#">Show more... </a>

            <h5>Genre</h5>
            <a href="#">Rock <span>51,506,531</span></a>
            <a href="#">Electronic <span>24,860,040</span></a>
            <a href="#">Pop <span>1,604,085</span></a>
            <a href="#">Funk / Soul <span>710,676</span></a>
            <a href="#">Jazz <span>674,607</span></a>
            <a href="#">Show more... </a>

            <h5>Style</h5>
            <a href="#">Pop Rock <span>51,506,531</span></a>
            <a href="#">House <span>24,860,040</span></a>
            <a href="#">Disco <span>1,604,085</span></a>
            <a href="#">Synth-pop <span>710,676</span></a>
            <a href="#">Soul <span>674,607</span></a>
            <a href="#">Show more... </a>

            <h5>Format Description</h5>
            <a href="#">Album <span>51,506,531</span></a>
            <a href="#">LP <span>24,860,040</span></a>
            <a href="#">45 RPM <span>1,604,085</span></a>
            <a href="#">7" <span>710,676</span></a>
            <a href="#">Stereo <span>674,607</span></a>
            <a href="#">Show more... </a>

            <h5>Media Condition</h5>
            <a href="#">Very Good Plus (VG+) <span>51,506,531</span></a>
            <a href="#">Near Mint (NM or M+) <span>24,860,040</span></a>
            <a href="#">Mint (M) <span>1,604,085</span></a>
            <a href="#">Very Good (VG) <span>710,676</span></a>
            <a href="#">Good Plus (G+) <span>674,607</span></a>
            <a href="#">Show more... </a>

            <h5>Year</h5>
            <a href="#">Costume Range </a>
            <a href="#">1997 <span>51,506,531</span></a>
            <a href="#">1996 <span>24,860,040</span></a>
            <a href="#">1995 <span>1,604,085</span></a>
            <a href="#">1989 <span>710,676</span></a>
            <a href="#">1988 <span>674,607</span></a>
            <a href="#">Show more... </a>

            <h5>More FFilters</h5>
            <a href="#">Make an Offer <span>51,506,531</span></a>
            <a href="#">Seller... </a>
        </div>

        <!-- CONTENT -->
        <div class="content">

            <!-- HEADER -->
            <div class="top">
                <h2>Shop Vinyl Records, CDs, and More</h2>
            </div>

            <div class="pagination-container">
                <div class="pagination-info">
                    1 – 25 of 78,437,967 
                    <a href="#">❮ Prev</a> 
                    <a href="#">Next ❯</a>
                </div>
                <div class="sort-box">
                    Sort <select><option>Listed Newest</option></select>
                    Show <select><option>25</option></select>
                </div>
            </div>

            <!-- HEADER TABLE -->
            <div class="list-header">
                <div></div>
                <div>Sort By: Listed, Condition, Artist, Title, Label</div>
                <div>Seller</div>
                <div>Price</div>
                <div></div>
            </div>

            <!-- ITEM 1 -->
            <div class="item">
                <div class="item-img-container">
                    <img src="https://via.placeholder.com/150" alt="Album Cover">
                    <div class="community-stats">
                        <span class="have">■ 1 have</span>
                        <span class="want">■ 2 want</span>
                    </div>
                </div>

                <div class="info">
                    <div>
                        <a class="title">Purple Kiss - On The Violet (CD, MiniAlbum, Ltd + DVD-V, NTSC)</a>
                    </div>
                    <div>
                        <b>Label:</b> Victor
                    </div>
                    <div>
                        <b>Cat#:</b> VIZL-2326
                    </div>
                    <div>
                        <b>Media Condition:</b> Very Good Plus (VG+) 
                    </div>
                    <div>
                        <b>Sleeve Condition:</b> Very Good Plus (VG+) 
                    </div>
                    <div>
                        <p>Delivery from our U.S. location by USPS. 😊 Please see our shipping details for more. Gently used authentic 🇯🇵 Japanese (VIZL-2326) issue. No OBI.</p>
                    </div>
                    <div>
                        <a href="#">View Release Page</a>
                    </div>
                </div>

                <div class="seller">
                    <a href="#">KUPIKU.US</a>
                    <!-- Ganti baris ini -->
                    <div class="rating-stars">
                        ★★★★★ <span style="color:#333; font-weight:bold;">100.0%</span>
                    </div>
                    <p style="font-size:12px; color:#0b5ed7; margin:0;">7,320 ratings</p>
                    <div>
                        <b>Ships From: </b> United States
                    </div>
                </div>

                <div class="price">
                    $119.70
                    <p>+ shipping</p>
                    <p>+ tax</p>
                </div>

                <div>
                    Add your address to see shipping availability
                </div>
            </div>


            <!-- ITEM 2 -->
            <div class="item">
                <div class="item-img-container">
                    <img src="https://via.placeholder.com/150" alt="Album Cover">
                    <div class="community-stats">
                        <span class="have">■ 71 have</span>
                        <span class="want">■ 84 want</span>
                    </div>
                </div>

                <div class="info">
                    <div>
                        <a class="title">Mashkov & Aurum - AFR / Tronic (12")</a>
                    </div>
                    <div>
                        <b>Label:</b> System 108
                    </div>
                    <div>
                        <b>Cat#:</b> SYSV001
                    </div>
                    <div>
                        <b>Media Condition:</b> Very Good Plus (VG+) 
                    </div>
                    <div>
                        <b>Sleeve Condition:</b> Very Good Plus (VG+) 
                    </div>
                    <div>
                        <p> </p>
                    </div>
                    <div>
                        <a href="#">View Release Page</a>
                    </div>
                </div>

                <div class="seller">
                    <a href="#">The_Digging_Portal</a>
                    <div class="rating-stars">
                        ★★★★<span style="color:#ccc">★</span> <span style="color:#333; font-weight:bold;">99.7%</span>
                    </div>
                    <p style="font-size:12px; color:#0b5ed7; margin:0;">882 ratings</p>
                    <div>
                        <b>Ships From: </b> France
                    </div>
                </div>

                <div class="price">
                    €8.90
                    <p>+€28.00 shipping</p>
                    <p>€36.90 + tax</p>
                </div>

                <div>
                    <button class="btn btn-primary">Add to Cart</button>
                </div>
            </div>

        </div>
    </div>

</div>


@endsection