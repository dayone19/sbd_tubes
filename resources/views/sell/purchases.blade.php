@extends('layouts.app')

@section('content')

@include('components.navbarMarket')

<style>
    body{font-family: Arial, Helvetica, sans-serif;background:#fff;color:#111;}
    .purchase-wrap{width:100%;padding:22px 30px 40px;}
    .buyer-rating{font-size:15px;margin-bottom:34px;}
    .buyer-rating span{color:#777;}
    .top-row,.bottom-row{display:flex;justify-content:space-between;align-items:center;margin-bottom:18px;flex-wrap:wrap;gap:12px;}
    .count-text{font-size:16px;font-weight:700;color:#111;}
    .filter-group{display:flex; align-items:center; gap:18px; flex-wrap:wrap;}
    .filter-item{display:flex;align-items:center;gap:10px;font-size:14px;}
    .filter-item label{color:#111;margin:0;}
    .filter-item select{
        height:38px;
        border:1px solid #999;
        padding:0 35px 0 12px;
        font-size:14px;
        background:#fff;
        min-width:145px;
    }
    .filter-item.show select{
        min-width:65px;
    }
    .discogs-btn{
        background:#efefef;
        border:1px solid #cfcfcf;
        padding:10px 18px;
        font-size:14px;
        color:#222;
        border-radius:4px;
        font-weight:500;
    }
    .discogs-btn:hover{
        background:#e5e5e5;
    }
    .table-wrap{
        margin-top:18px;
        border:1px solid #ddd;
    }
    table{
        width:100%;
        border-collapse:collapse;
    }

    thead tr{
        background:#f2f2f2;
    }

    thead th{
        padding:14px 10px;
        font-size:15px;
        font-weight:700;
        color:#2457d6;
        border-bottom:1px solid #ddd;
    }

    tbody td{
        padding:24px 10px;
        font-size:15px;
        border-bottom:1px solid #eee;
    }

    .empty-row td{
        text-align:center;
        color:#222;
        padding:28px 10px;
        font-size:15px;
    }

    .checkbox-col{
        width:42px;
        text-align:center;
    }

    .center{
        text-align:center;
    }

    .bottom-row{
        margin-top:22px;
        padding-top:18px;
        border-top:1px solid #ddd;
    }

    input[type="checkbox"]{
        width:16px;
        height:16px;
        accent-color:#0d6efd;
    }

    @media(max-width:992px){
        .top-row,
        .bottom-row{
            flex-direction:column;
            align-items:flex-start;
        }

        .filter-group{
            gap:10px;
        }
    }
</style>

<div class="purchase-wrap">

    <div class="buyer-rating">
        My Buyer Rating:
        <span>You have no buyer feedback</span>
    </div>

    {{-- TOP INFO --}}
    <div class="top-row">
        <div class="count-text">0 – 0 of 0</div>

        <div class="filter-group">
            <div class="filter-item">
                <label>Archived</label>
                <select>
                    <option>Not Archived</option>
                </select>
            </div>

            <div class="filter-item">
                <label>Status</label>
                <select>
                    <option>All</option>
                </select>
            </div>

            <div class="filter-item show">
                <label>Show</label>
                <select>
                    <option>50</option>
                </select>
            </div>
        </div>
    </div>

    {{-- BUTTON --}}
    <button class="discogs-btn mb-3">
        /||| Add To Collection
    </button>

    {{-- TABLE --}}
    <div class="table-wrap">
        <table>
            <thead>
                <tr>
                    <th class="checkbox-col">
                        <input type="checkbox" checked>
                    </th>
                    <th>Order #</th>
                    <th class="center">Summary</th>
                    <th>Seller</th>
                    <th>Total</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
            </thead>

            <tbody>
                <tr class="empty-row">
                    <td colspan="7">No orders found.</td>
                </tr>
            </tbody>
        </table>
    </div>

    {{-- BUTTON BOTTOM --}}
    <div style="margin-top:22px;">
        <button class="discogs-btn">
            /||| Add To Collection
        </button>
    </div>

    {{-- BOTTOM INFO --}}
    <div class="bottom-row">
        <div class="count-text">0 – 0 of 0</div>

        <div class="filter-group">
            <div class="filter-item">
                <label>Archived</label>
                <select>
                    <option>Not Archived</option>
                </select>
            </div>

            <div class="filter-item">
                <label>Status</label>
                <select>
                    <option>All</option>
                </select>
            </div>

            <div class="filter-item show">
                <label>Show</label>
                <select>
                    <option>50</option>
                </select>
            </div>
        </div>
    </div>

</div>

@endsection