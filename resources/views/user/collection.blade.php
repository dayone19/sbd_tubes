@extends('layouts.app')

@section('content')
@include('components.navbarMy')

<style>
a{text-decoration:none;color:#2457d6;}
body{background:#f5f5f5;font-family:Arial,Helvetica,sans-serif;}
/* WRAP */
.collection-wrap{
    width:100%;
    background:white;
}
.collection-content{
    width:96%;
    margin:auto;
    padding:16px 0 35px;
}
/* VALUE */
.value-row{
    display:flex;
    justify-content:space-between;
    align-items:center;
    padding:14px 0;
    font-size:14px;
}
.value-left{
    display:flex;
    gap:20px;
    align-items:center;
}
.value-right{
    display:flex;
    gap:18px;
}

/* FILTER */
.filter-bar{
    display:flex;
    justify-content:space-between;
    align-items:center;
    gap:10px;
    margin-bottom:14px;
}
.filter-left{
    display:flex;
    align-items:center;
    gap:12px;
}
.search-box{
    width:430px;
    position:relative;
}
.search-box input{
    width:100%;
    height:40px;
    border:1px solid #bbb;
    padding:0 42px 0 14px;
    font-size:15px;
    border-radius:22px;
}
.search-box span{
    position:absolute;
    right:14px;
    font-size:24px;
}
select{
    height:40px;
    padding:0 30px 0 12px;
    border:1px solid #bbb;
    font-size:14px;
}
/* ICON */
.filter-right{
    display:flex;
    align-items:center;
    gap:10px;
}
.icon-btn{
    width:40px;
    height:40px;
    border:1px solid #bbb;
    border-radius:50%;
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    background:#fff;
}
.icon-btn.active{
    background:#333;
    color:#fff;
}
/* TABLE */
.table-wrap{
    border:1px solid #ddd;
    background:#fff;
    overflow-x:auto;
}
table{
    width:1450px;
    border-collapse:collapse;
}
thead th{
    background:#efefef;
    border-right:1px solid #ddd;
    padding:12px 10px;
    text-align:left;
    font-size:14px;
}
tbody td{
    border-top:1px solid #eee;
    padding:12px 10px;
    vertical-align:top;
    font-size:14px;
}
.check-col{width:40px;text-align:center;}
.thumb-col{width:95px;}
.thumb{
    width:72px;
    height:72px;
    object-fit:cover;
    border-left:5px solid #f0c000;
}
.title-link{
    font-size:16px;
    font-weight:bold;
}
.artist{
    color:#c0008a;
    margin-top:3px;
}
.rating{
    color:#f0c000;
    font-size:18px;
}
.rating-col{
    width:120px;
}
.notes-input{
    width:100%;
    height:32px;
    border:1px solid #ccc;
    padding:0 10px;
    font-size:14px;
}
/* FOOT */
.bottom-row{
    display:flex;
    align-items:center;
    gap:10px;
    padding-top:14px;
    font-size:15px;
}
.page-btn{
    width:40px;
    height:40px;
    border:1px solid #ccc;
    background:#fff;
    font-size:20px;
    color:#999;
}
</style>

<div class="collection-wrap">
<div class="collection-content">

    <!-- VALUE -->
    <div class="value-row">
        <div class="value-left">
            <b>Estimated Collection Value ❶:</b>
            <span>Low €22.10</span>
            <span>Med €25.64</span>
            <span>High €39.99</span>
        </div>

        <div class="value-right">
            <a href="#">Manage Custom Folders</a>
            <a href="#">Manage Custom Fields</a>
            <a href="#">Export Collection</a>
        </div>
    </div>

    <!-- FILTER -->
    <div class="filter-bar">

        <div class="filter-left">

            <div class="search-box">
                <input type="text" placeholder="Search Collection">
                <span>⌕</span>
            </div>

            <a href="#">Random Item</a>

            <span>Sort</span>
            <select>
                <option>Newest Addition</option>
            </select>

            <span>Folder</span>
            <select>
                <option>All folders (1)</option>
            </select>

        </div>

        <div class="filter-right">
            <span>Show</span>
            <select style="width:85px">
                <option>25</option>
            </select>

            <div class="icon-btn">▦</div>
            <div class="icon-btn active">◫</div>
            <div class="icon-btn">☰</div>
        </div>

    </div>

    <!-- TABLE -->
    <div class="table-wrap">
        <table>

            <thead>
                <tr>
                    <th class="check-col"><input type="checkbox"></th>
                    <th class="thumb-col"></th>
                    <th>Title</th>
                    <th>Artist</th>
                    <th>Year</th>
                    <th>Format</th>
                    <th>Label</th>
                    <th>Low</th>
                    <th>Med</th>
                    <th>High</th>
                    <th>Added ↓</th>
                    <th>Folder</th>
                    <th>Rating</th>
                    <th>Notes</th>
                </tr>
            </thead>

            <tbody>
                <tr>

                    <td class="check-col">
                        <input type="checkbox">
                    </td>

                    <td class="thumb-col">
                        <img class="thumb"
                        src=https://i.discogs.com/lX1VthrJVekKHjzBgbv9ShkYb7tp4rzbhT7M91-rtrM/rs:fill/g:sm/q:40/h:100/w:100/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTM2NjE4/NDQ1LTE3NzIxMTQ2/MDktNjAzOC5qcGVn.jpeg>
                    </td>

                    <td>
                        <a href="#" class="title-link">The Romantic</a>
                    </td>

                    <td>
                        <div class="artist">Bruno Mars</div>
                    </td>

                    <td>2026</td>

                    <td>
                        Vinyl, LP, Album,<br>
                        Limited Edition <i>Red Translucent</i>
                    </td>

                    <td>Atlantic – 075678590511</td>

                    <td>€22.10</td>
                    <td>€25.64</td>
                    <td>€39.99</td>

                    <td>Apr 25, 2026</td>

                    <td>
                        <a href="#">Uncategorized</a>
                    </td>

                    <td class="rating-col">
                        <div class="rating" data-value="0">
                            <span data-star="1">☆</span>
                            <span data-star="2">☆</span>
                            <span data-star="3">☆</span>
                            <span data-star="4">☆</span>
                            <span data-star="5">☆</span>
                        </div>
                    </td>

                    <td>
                        <input type="text" class="notes-input" placeholder="Add notes...">
                    </td>

                </tr>
            </tbody>

        </table>
    </div>

    <!-- FOOT -->
    <div class="bottom-row">
        <b>1-1</b> of 1
        <button class="page-btn">‹</button>
        <button class="page-btn">›</button>
    </div>

</div>
</div>


<script>

document.querySelectorAll('.rating span').forEach(star => {
    star.addEventListener('click', function () {
        let value = this.getAttribute('data-star');
        let parent = this.parentElement;

        parent.setAttribute('data-value', value);

        parent.querySelectorAll('span').forEach(s => {
            s.textContent = s.getAttribute('data-star') <= value ? '★' : '☆';
        });
    });
});
</script>

@endsection