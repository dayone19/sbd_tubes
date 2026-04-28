@extends('layouts.app')

@section('content')
@include('components.navbarMy')

<style>
    a{text-decoration:none;}
    /* WRAPPER */
    .wantlist-wrapper{width:100%;background:#fff;border-top:1px solid #ddd;}
    .wantlist-content{width:96%;margin:auto;padding:14px 0 40px;}
    /* SEARCH BAR */
    .toolbar{margin-top:14px;display:flex;justify-content:space-between;align-items:center;gap:15px;flex-wrap:wrap;}
    .search-left{display:flex;align-items:center;gap:18px;}
    .search-box{width:400px;height:35px;position:relative;}
    .search-box input{width:100%;height:46px;padding:0 40px 0 10px;border:1px solid #bbb;font-size:18px;}
    .search-box span{position:absolute;right:14px; font-size:28px; color:#666;}
    .toolbar a{color:#2d5bd1;font-size:16px;}
    .right-btns{display:flex;align-items:center;gap:16px;}
    .btn-link{color:#2d5bd1;font-size:16px;}
    .btn-green{background:#158a1b; color:#fff; border:none; padding:10px 18px; font-size:16px; border-radius:3px;cursor:pointer; }
    /* RESULT BAR */
    .result-bar{ margin-top:18px; display:flex; justify-content:space-between;align-items:center;font-size:18px;font-weight:bold;}
    .view-right{display:flex;   align-items:center; gap:12px; font-weight:normal;}
    .view-right select{ height:36px; padding:0 10px; font-size:16px;}
    .view-icon{ font-size:24px; cursor:pointer;}
    /* ACTION BAR */
    .action-bar{ margin-top:22px; border:1px solid #ddd; background:#fafafa; padding:12px; display:flex; justify-content:space-between; align-items:center;}
    .gray-btn{border:1px solid #cfcfcf;background:#f7f7f7;padding:10px 18px;font-size:15px;border-radius:4px;cursor:pointer;}
    /* TABLE */
    table{width:100%;border-collapse:collapse;margin-top:16px;background:#fff;}
    thead th{background:#efefef;border:1px solid #ddd;padding:14px 10px;font-size:14px;color:#2d5bd1;text-align:left;}
    tbody td{border:1px solid #e3e3e3;padding:14px 10px;vertical-align:top; font-size:15px;}
    .check-col{width:42px;text-align:center;}
    .release-flex{display:flex; gap:14px;}
    .thumb{width:64px;height:64px;border:1px solid #ccc;object-fit:cover;}
    .title a{color:#2d5bd1;font-size:18px;}
    .artist{ color:#c2007a;}
    .sale{ margin-top:6px; font-size:16px;}
    .sale a{ color:#1f48d8; font-weight:bold;}
    .price{color:#d64500; font-weight:bold;}
    .stars{ color:#999; font-size:24px; letter-spacing:2px;}
    .edit-link{color:#2d5bd1;}
    /* FOOTER */
    .bottom-bar{margin-top:18px;display:flex;justify-content:space-between;align-items:center;font-size:18px; font-weight:bold;}
</style>

<div class="wantlist-wrapper">
    <div class="wantlist-content">

        <!-- toolbar -->
        <div class="toolbar">
            <div class="search-left">
                <div class="search-box">
                    <input type="text" placeholder="Search Wantlist">
                    <span>⌕</span>
                </div>

                <a href="#">Random Item</a>
            </div>

            <div class="right-btns">
                <a href="#" class="btn-link">Export My Wantlist</a>
                <button class="btn-green">Show Items in Marketplace</button>
            </div>
        </div>

        <!-- result -->
        <div class="result-bar">
            <span>1 – 1 of 1</span>

            <div class="view-right">
                <span>Show</span>

                <select>
                    <option>25</option>
                </select>

                <span class="view-icon">▦</span>
                <span class="view-icon">▤</span>
                <span class="view-icon">☰</span>
            </div>
        </div>

        <!-- actions -->
        <div class="action-bar">
            <button class="gray-btn">🗑 Remove Items</button>
            <button class="gray-btn">✥ Move To Collection</button>
        </div>

        <!-- table -->
        <table>
            <thead>
                <tr>
                    <th class="check-col"></th>
                    <th>Artist - Title ( Label, Catalog# )</th>
                    <th>Format</th>
                    <th>Year</th>
                    <th>Rating</th>
                    <th>Added ▼</th>
                    <th>Notes</th>
                </tr>
            </thead>

            <tbody>
                <tr>
                    <td class="check-col">
                        <input type="checkbox">
                    </td>

                    <td>
                        <div class="release-flex">
                            <img src="https://i.discogs.com/lX1VthrJVekKHjzBgbv9ShkYb7tp4rzbhT7M91-rtrM/rs:fill/g:sm/q:40/h:100/w:100/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTM2NjE4/NDQ1LTE3NzIxMTQ2/MDktNjAzOC5qcGVn.jpeg" class="thumb">

                            <div>
                                <div class="title">
                                    <a href="#">
                                        <span class="artist">Bruno Mars</span> - The Romantic
                                        (Atlantic - 075678590511)
                                    </a>
                                </div>

                                <div class="sale">
                                    <a href="#">155 For Sale</a>
                                    from <span class="price">€22.99</span>
                                </div>
                            </div>
                        </div>
                    </td>

                    <td>LP, Album, Ltd, Red</td>
                    <td>2026</td>
                    <td><span class="stars">☆☆☆☆☆</span></td>
                    <td>10 minutes ago</td>
                    <td><a href="#" class="edit-link">Edit</a></td>
                </tr>
            </tbody>
        </table>

        <!-- bottom -->
        <div class="action-bar" style="margin-top:18px;">
            <button class="gray-btn">🗑 Remove Items</button>
            <button class="gray-btn">✥ Move To Collection</button>
        </div>

        <div class="bottom-bar">
            <span>1 – 1 of 1</span>

            <div class="view-right">
                <span>Show</span>

                <select>
                    <option>25</option>
                </select>
            </div>
        </div>

    </div>
</div>

@endsection