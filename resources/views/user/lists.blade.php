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
        Check out <a href="/lists">Recent Lists</a>.
    </div>

    <div class="list-title">
        Lists by {{ $lists->first()->username }}
    </div>

    <table class="list-table">
        <thead>
            <tr>
                <th width="65%">List</th>
                <th>Updated</th>
            </tr>
        </thead>

        <tbody>
    @foreach($lists as $list)
            <tr>
            <td> <a href="{{ route('lists.show', $list->list_id) }}">{{ $list->name }}</a></td>
                <td>{{ \Carbon\Carbon::parse($list->created_at)->diffForHumans() }}</td>
            </tr>
    @endforeach
        </tbody>
    </table>
    

    <div class="table-line"></div>

    <div class="list-footer">

        <div class="footer-left">
            <span>Showing <b>1-{{ $total }}</b> of {{ $total }}</span>

            <button class="page-btn">&#8592;</button>
            <button class="page-btn">&#8594;</button>
        </div>

        <div class="footer-right">
            <form method="GET" action="{{ route('user.lists', ['user_id' => $user_id]) }}">
                <span>Show</span>
                <select name="show" class="show-select" onchange="this.form.submit()">
                    <option value="25" {{ $perPage == 25 ? 'selected' : '' }}>25</option>
                    <option value="50" {{ $perPage == 50 ? 'selected' : '' }}>50</option>
                    <option value="100" {{ $perPage == 100 ? 'selected' : '' }}>100</option>
                </select>
            </form>
        </div>

    </div>

</div>
@endsection