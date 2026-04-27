@extends('layouts.app')

@section('content')
@include('components.navbarMy')
<style>
.list-page{width:100%;padding:14px 28px 32px;font-family:Arial, sans-serif;background:#fff;color:#111;box-sizing:border-box;}
.community-text{font-size:14px;margin-bottom:26px;}
.community-text a{color:#b100a6;text-decoration:none;}
.list-title{font-size:28px;font-weight:700;margin-bottom:22px;}
/* tabel */
.list-table{width:100%;border-collapse:collapse;}
.list-table thead{background:#fafafa}
.list-table th{text-align:left;font-size:15px;padding:8px 10px;font-weight:700;}
.list-table td{padding:8px 10px;font-size:14px;}
.list-table a{color:#b100a6;text-decoration:none;}
.table-line{border-top:1px solid #222;margin:18px 0 20px;}
/* footer */
.list-footer{display:flex;justify-content:space-between;align-items:center;}
.footer-left{display:flex;align-items:center;gap:12px;font-size:15px;}
.footer-left b{font-weight:700;}
/* tombol panah */
.page-btn{width:36px;height:36px;border:1px solid #d0d0d0;background:#fafafa;font-size:18px;color:#999;cursor:pointer;}
.footer-right{display:flex;align-items:center;gap:14px;font-size:15px;}
.show-select{width:62px;height:36px;border:1px solid #cfcfcf;padding:0 10px;font-size:14px;background:#fff;
}
</style>

<div class="list-page">

    <div class="community-text">
        Want to see other lists from the Discogs Community?
        Check out <a href="#">Recent Lists</a>.
    </div>

    <div class="list-title">
        Lists by gweh
    </div>

    <table class="list-table">
        <thead>
            <tr>
                <th width="65%">List</th>
                <th>Updated</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td><a href="#">saya</a></td>
                <td>2 days ago</td>
            </tr>
        </tbody>
    </table>

    <div class="table-line"></div>

    <div class="list-footer">

        <div class="footer-left">
            <span>Showing <b>1-1</b> of 1</span>

            <button class="page-btn">&#8592;</button>
            <button class="page-btn">&#8594;</button>
        </div>

        <div class="footer-right">
            <span>Show</span>

            <select class="show-select">
                <option>25</option>
                <option>50</option>
                <option>100</option>
            </select>
        </div>

    </div>

</div>
@endsection