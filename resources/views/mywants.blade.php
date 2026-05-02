@extends('layouts.app')

@section('content')
@include('components.navbarMarket')


<style>
    body {font-family: "Helvetica Neue", Helvetica, Arial, sans-serif;background-color: #fff;color: #333;margin: 0;}
    .want-container {display: flex;gap: 40px;padding: 20px 40px;}
    /* SIDEBAR */
    .want-sidebar {width: 210px;font-size: 13px;}
    .want-sidebar h4, .want-sidebar h5 {font-size: 14px;font-weight: bold;margin-bottom: 10px;}
    .save-btn {width: 100%;background: #eee;border: 1px solid #ccc;color: #999;padding: 6px;border-radius: 3px;margin-bottom: 20px;text-align: center;font-size: 13px;}
    .filter-item {display: flex;justify-content: space-between;margin-bottom: 8px;align-items: center;}
    .filter-item label {display: flex;align-items: center;gap: 8px;cursor: pointer;}
    .filter-item .count {color: #888;}
    /* CONTENT */
    .want-content { flex: 1;}
    .content-title-row {display: flex;justify-content: space-between;align-items: flex-end;margin-bottom: 10px;}
    .content-title-row h2 {font-size: 24px;margin: 0; font-weight:bold;}
    .learn-link {font-size: 12px;color: #2d5bd1;text-decoration: none;}
    /* PAGINATION BAR */
    .pagination-bar {display: flex;justify-content: space-between;align-items: center;margin-bottom: 15px;font-size: 13px;}
    .page-numbers {display: flex; gap: 15px; align-items: center;}
    .page-numbers .active {background: #000;color: #fff;width: 25px;height: 25px;display: flex;align-items: center;justify-content: center;border-radius: 50%;}
    /* TABLE HEADER */
    .table-header {display: flex;background: #f9f9f9;border-top: 1px solid #ddd;border-bottom: 1px solid #ddd;padding: 8px 0;font-size: 12px;font-weight: bold;}
    .col-info { width: 250px; padding-left: 10px; }
    .col-cond { width: 180px; }
    .col-sell { width: 200px; }
    .col-price { flex: 1; text-align: right; padding-right: 10px; }
    .blue-link { color: #2d5bd1; text-decoration: none; }
    .blue-link:hover { text-decoration: underline; }
    /* ITEM ROW */
    .item-row {display: flex;padding: 15px 0; border-bottom: 1px solid #eee; font-size: 13px;}
    .item-row img {width: 65px;height: 65px;border: 1px solid #ddd;margin-right: 15px;}
    .release-title {font-size: 15px;font-weight: bold;display: block;margin-bottom: 3px;}
    .badge-grade {background: #758918;color: white;padding: 0px 4px;border-radius: 2px;font-weight: bold;font-size: 11px;}
    .dot {height: 8px;width: 8px;background-color: #fff;border-radius: 50%;display: inline-block;margin-right: 2px;}
    .seller-info .name {font-weight: bold;font-size: 14px;}
    .price-container {text-align: right;}
    .main-price {font-size: 22px;font-weight: bold;display: block;}
    .shipping-price {color: #666; font-size: 12px;}
    .converted-price {color: #888;font-size: 11px;margin-top: 4px;}
    .add-to-cart {
        background-color: #008000;
        color: white;
        border: none;
        padding: 8px 10px;
        border-radius: 4px;
        font-weight: bold;
        font-size: 14px;
        margin-top: 10px;
        cursor: pointer;
        width: 130px;
    }
</style>

<div class="want-container">

    <div class="want-sidebar">
        <h4>Applied Filters (0):</h4>
        <div class="save-btn">Save Search</div>

        <h5>Ships From</h5>
        <div class="filter-item">
            <label><input type="checkbox"> Spain</label>
            <span class="count">16</span>
        </div>
        <div class="filter-item">
            <label><input type="checkbox"> Germany</label>
            <span class="count">11</span>
        </div>
        <div class="filter-item">
            <label><input type="checkbox"> Italy</label>
            <span class="count">11</span>
        </div>
        <div class="filter-item">
            <label><input type="checkbox"> Netherlands</label>
            <span class="count">10</span>
        </div>
        <div class="filter-item">
            <label><input type="checkbox"> United States</label>
            <span class="count">10</span>
        </div>
        <a href="#" class="blue-link" style="font-size: 12px;">Show more</a>

        <h5 style="margin-top:25px;">Format</h5>
        <div class="filter-item">
            <label><input type="checkbox"> Vinyl</label>
            <span class="count">83</span>
        </div>

        <h5 style="margin-top:25px;">Format Description</h5>
        <div class="filter-item">
            <label><input type="checkbox"> Album</label>
            <span class="count">83</span>
        </div>
        <div class="filter-item">
            <label><input type="checkbox"> Limited Edition</label>
            <span class="count">83</span>
        </div>
    </div>

    <div class="want-content">
        
        <div class="content-title-row">
            <h2>Shop - All Items I Want</h2>
            <a href="#" class="learn-link">Learn how to filter your Wantlist</a>
        </div>

        <div class="pagination-bar">
            <div class="page-numbers">
                <span style="color:#888">1-25 <strong>of 83</strong></span>
                <span style="color:#ccc">❮</span>
                <span class="active">1</span>
                <span>2</span>
                <span>3</span>
                <span>4</span>
                <span>❯</span>
                <span>❱</span>
            </div>

            <div style="display:flex; gap:15px; align-items:center;">
                <span>Sort</span>
                <select style="padding: 4px 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option>Listed Newest</option>
                </select>
                <span>Show</span>
                <select style="padding: 4px 8px; border: 1px solid #ccc; border-radius: 4px;">
                    <option>25</option>
                </select>
            </div>
        </div>

        <div class="table-header">
            <div class="col-info">Sort By: <span class="blue-link">Artist</span>, <span class="blue-link">Title</span></div>
            <div class="col-cond"><span class="blue-link">Condition</span></div>
            <div class="col-sell"><span class="blue-link">Seller</span>, <span class="blue-link">Listed ▾</span></div>
            <div class="col-price"><span class="blue-link">Price</span></div>
        </div>

        <div class="item-row">
            <div class="col-info" style="display:flex;">
                <img src="https://st.discogs.com/9796e68962f92f2324976451e5e2e8790299f063/images/spacer.gif" style="background: #eee;" alt="cover">
                <div>
                    <a href="#" class="release-title blue-link">The Romantic</a>
                    <div style="color:#666;"><span class="blue-link">Bruno Mars</span> • Vinyl</div>
                    <div style="color:#666; font-size: 11px; margin-top: 2px;">Album, Limited Edition, LP, ...</div>
                    <div style="color:#666; margin-top: 2px;">2026 • USA & Europe</div>
                    <a href="#" class="blue-link" style="font-size: 12px; margin-top:5px; display:block;">View release page</a>
                </div>
            </div>

            <div class="col-cond">
                <div style="margin-bottom: 5px;">Condition: Media <span class="badge-grade"><span class="dot"></span>M</span></div>
                <div style="margin-bottom: 8px;">Sleeve <span class="badge-grade">M</span></div>
                <div style="font-size: 11px; font-weight: bold; color: #666; text-transform: uppercase;">Stock - New Copy - Sealed</div>
                <div style="color: #666; margin-top: 5px;">Ships from: United Kingdom</div>
            </div>

            <div class="col-sell">
                <div class="seller-info">
                    <a href="#" class="name blue-link">globalgroove.co.uk</a>
                    <span style="color: #4caf50;">✔</span>
                    <div style="color:#666; font-size:12px;">(71247 ratings) 99.9%</div>
                    <div style="color:#888; font-size:12px; font-style: italic; margin-top:5px;">Listed 9 hours ago</div>
                </div>
            </div>

            <div class="col-price">
                <div class="price-container">
                    <span class="main-price">£31.49</span>
                    <span class="shipping-price">+ £14.00 <span style="text-decoration: underline;">shipping</span></span>
                    <div class="converted-price">about $52.25 + tax ⓘ</div>
                    <button class="add-to-cart">Add to cart</button>
                </div>
            </div>
        </div>

        <div class="item-row">
            <div class="col-info" style="display:flex;">
                <img src="https://st.discogs.com/9796e68962f92f2324976451e5e2e8790299f063/images/spacer.gif" style="background: #eee;" alt="cover">
                <div>
                    <a href="#" class="release-title blue-link">The Romantic</a>
                    <div style="color:#666;"><span class="blue-link">Bruno Mars</span> • Vinyl</div>
                    <div style="color:#666; font-size: 11px; margin-top: 2px;">Album, Limited Edition, LP, ...</div>
                    <div style="color:#666; margin-top: 2px;">2026 • USA & Europe</div>
                    <a href="#" class="blue-link" style="font-size: 12px; margin-top:5px; display:block;">View release page</a>
                </div>
            </div>

            <div class="col-cond">
                <div style="margin-bottom: 5px;">Condition: Media <span class="badge-grade"><span class="dot"></span>M</span></div>
                <div style="margin-bottom: 8px;">Sleeve <span class="badge-grade">M</span></div>
                <div style="font-size: 11px; font-weight: bold; color: #666; text-transform: uppercase;">Sealed - Last Copy !</div>
                <div style="color: #666; margin-top: 5px;">Ships from: United Kingdom</div>
            </div>

            <div class="col-sell">
                <div class="seller-info">
                    <a href="#" class="name blue-link">SEISMIC_RECORDS</a>
                    <span style="color: #4caf50;">✔</span>
                    <div style="color:#666; font-size:12px;">(22526 ratings) 100%</div>
                    <div style="color:#888; font-size:12px; font-style: italic; margin-top:5px;">Listed 2 days ago</div>
                </div>
            </div>

            <div class="col-price">
                <div class="price-container">
                    <span class="main-price">£31.47</span>
                    <span class="shipping-price">+ £20.00 <span style="text-decoration: underline;">shipping</span></span>
                    <div class="converted-price">about $59.12 + tax ⓘ</div>
                    <button class="add-to-cart">Add to cart</button>
                </div>
            </div>
        </div>

    </div>

</div>


@endsection