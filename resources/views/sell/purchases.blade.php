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
    .filter-item select{height:38px;border:1px solid #999;padding:0 35px 0 12px;font-size:14px;background:#fff;min-width:145px;}
    .filter-item.show select{min-width:65px;}
    .discogs-btn{background:#efefef;border:1px solid #cfcfcf;padding:10px 18px;font-size:14px;color:#222;border-radius:4px;font-weight:500;cursor:pointer;}
    .discogs-btn:hover{background:#e5e5e5;}
    .table-wrap{margin-top:18px;border:1px solid #ddd;}
    table{width:100%;border-collapse:collapse;}
    thead tr{background:#f2f2f2;}
    thead th{padding:14px 10px;font-size:15px;font-weight:700;color:#2457d6;border-bottom:1px solid #ddd;}
    tbody td{padding:18px 10px;font-size:14px;border-bottom:1px solid #eee;vertical-align:middle;}
    .empty-row td{text-align:center;color:#555;padding:36px 10px;font-size:15px;}
    .checkbox-col{width:42px; text-align:center;}
    .center{text-align:center;}
    .bottom-row{margin-top:22px;padding-top:18px;border-top:1px solid #ddd;}
    input[type="checkbox"]{width:16px;height:16px;accent-color:#0d6efd;}

    /* Status badge style */
    .badge-status{display:inline-block;padding:3px 10px;border-radius:12px;font-size:12px;font-weight:700;text-transform:capitalize;}
    .badge-pending   {background:#fff3cd;color:#856404;}
    .badge-paid      {background:#d1ecf1;color:#0c5460;}
    .badge-shipped   {background:#cce5ff;color:#004085;}
    .badge-completed {background:#d4edda;color:#155724;}
    .badge-cancelled {background:#f8d7da;color:#721c24;}

    /* Order link */
    .order-link{color:#2457d6;text-decoration:none;font-weight:600;}
    .order-link:hover{text-decoration:underline;}
    .summary-title{font-weight:600;color:#111;font-size:14px;}
    .summary-sub{font-size:12px;color:#666;margin-top:2px;}

    /* Pagination */
    .pagination-wrap{margin-top:18px;display:flex;justify-content:center;gap:4px;}
    .pagination-wrap a, .pagination-wrap span{padding:6px 12px;border:1px solid #ddd;font-size:13px;color:#2457d6;border-radius:3px;text-decoration:none;}
    .pagination-wrap span.current{background:#2457d6;color:#fff;border-color:#2457d6;}
    .pagination-wrap a:hover{background:#f0f0f0;}

    @media(max-width:992px){
        .top-row, .bottom-row{flex-direction:column;align-items:flex-start;}
        .filter-group{gap:10px;}
    }
</style>

<div class="purchase-wrap">
<div class="buyer-rating">
    My Buyer Rating:
    @if($buyerRating)
        <span style="color:#111; font-weight:700;">
            ⭐ {{ $buyerRating['avg_rating'] }} / 5
        </span>
        <span style="color:#777; font-size:13px;">
            ({{ $buyerRating['total'] }} review{{ $buyerRating['total'] > 1 ? 's' : '' }})
        </span>
    @else
        <span>You have no buyer feedback</span>
    @endif
</div>

    {{-- FILTER FORM --}}
    <form method="GET" action="{{ route('sell.purchases') }}" id="filterForm">

        {{-- TOP ROW INFO & FILTER --}}
        <div class="top-row">
            <div class="count-text">
                @if($total > 0)
                    {{ $from }} – {{ $to }} of {{ $total }}
                @else
                    0 – 0 of 0
                @endif
            </div>

            <div class="filter-group">
                {{-- Status filter atas --}}
                <div class="filter-item">
                    <label for="status">Status</label>
                    <select name="status" id="status">
                        @foreach($statusOptions as $val => $label)
                            <option value="{{ $val }}" {{ $status === $val ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                        @endforeach
                    </select>
                </div>

                {{-- Per Page filter atas --}}
                <div class="filter-item show">
                    <label for="show">Show</label>
                    <select name="show" id="show">
                        @foreach([25, 50, 100] as $n)
                            <option value="{{ $n }}" {{ $perPage == $n ? 'selected' : '' }}>{{ $n }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

        {{-- BUTTON TOP --}}
        <button type="button" class="discogs-btn mb-3">
            /||| Add To Collection
        </button>

        {{-- TABLE DATA --}}
        <div class="table-wrap">
            <table>
                <thead>
                    <tr>
                        <th class="checkbox-col">
                            <input type="checkbox" id="checkAll">
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
                    @forelse($transactions as $transaction)
                        <tr>
                            {{-- Checkbox per baris --}}
                            <td class="checkbox-col">
                                <input type="checkbox" name="selected[]" value="{{ $transaction->transaction_id }}" class="row-check">
                            </td>

                            {{-- Order Number Link --}}
                            <td>
                                <a href="{{ route('sell.purchases.show', $transaction->transaction_id) }}" class="order-link">
                                    #{{ $transaction->transaction_id }}
                                </a>
                            </td>

                            {{-- Summary Product --}}
                            <td class="center">
                                @php
                                    // Mengambil detail item pertama dari pesanan ini
                                    $firstDetail = $transaction->transactionDetails->first();
                                    $productName = $firstDetail?->product?->release?->title ?? 'Unknown Product';
                                    $qty         = $transaction->transactionDetails->sum('quantity');
                                    $extraCount  = $transaction->transactionDetails->count() - 1;
                                @endphp
                                <div class="summary-title">{{ $productName }}</div>
                                @if($qty > 1 || $extraCount > 0)
                                    <div class="summary-sub">
                                        {{ $qty }} item{{ $qty > 1 ? 's' : '' }}
                                        @if($extraCount > 0)
                                            (+{{ $extraCount }} more)
                                        @endif
                                    </div>
                                @endif
                            </td>

                            {{-- Seller Store Name --}}
                            <td>
                                @php
                                    // Ambil store_name dari lapak seller, jika kosong ambil username usernya
                                    $sellerName = $firstDetail?->product?->seller?->store_name
                                        ?? $firstDetail?->product?->seller?->user?->username
                                        ?? '-';
                                @endphp
                                {{ $sellerName }}
                            </td>

                            {{-- Total Price --}}
                            <td>
                                ${{ number_format($transaction->total_price, 2) }}
                            </td>

                            {{-- Transaction Date --}}
                            <td>
                                {{ $transaction->created_at ? \Carbon\Carbon::parse($transaction->created_at)->format('M d, Y') : '-' }}
                            </td>

                            {{-- Status Badge --}}
                            <td>
                                <span class="badge-status badge-{{ strtolower($transaction->status) }}">
                                    {{ ucfirst($transaction->status) }}
                                </span>
                            </td>
                        </tr>
                    @empty
                        <tr class="empty-row">
                            <td colspan="7">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        {{-- BUTTON BOTTOM --}}
        <div style="margin-top:22px;">
            <button type="button" class="discogs-btn">
                /||| Add To Collection
            </button>
        </div>

        {{-- BOTTOM ROW INFO & FILTER --}}
        <div class="bottom-row">
            <div class="count-text">
                @if($total > 0)
                    {{ $from }} – {{ $to }} of {{ $total }}
                @else
                    0 – 0 of 0
                @endif
            </div>

            <div class="filter-group">
                {{-- Status filter bawah --}}
                <div class="filter-item">
                    <label>Status</label>
                    <select id="status_bottom">
                        @foreach($statusOptions as $val => $label)
                            <option value="{{ $val }}" {{ $status === $val ? 'selected' : '' }}>{{ $label }}</option>
                        @endforeach
                    </select>
                </div>

                {{-- Per Page filter bawah --}}
                <div class="filter-item show">
                    <label>Show</label>
                    <select id="show_bottom">
                        @foreach([25, 50, 100] as $n)
                            <option value="{{ $n }}" {{ $perPage == $n ? 'selected' : '' }}>{{ $n }}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>

    </form>

    {{-- LINK PAGINATION --}}
    @if($transactions->hasPages())
        <div class="pagination-wrap">
            @if($transactions->onFirstPage())
                <span>&laquo;</span>
            @else
                <a href="{{ $transactions->previousPageUrl() }}">&laquo;</a>
            @endif

            @foreach($transactions->getUrlRange(1, $transactions->lastPage()) as $page => $url)
                @if($page == $transactions->currentPage())
                    <span class="current">{{ $page }}</span>
                @else
                    <a href="{{ $url }}">{{ $page }}</a>
                @endif
            @endforeach

            @if($transactions->hasMorePages())
                <a href="{{ $transactions->nextPageUrl() }}">&raquo;</a>
            @else
                <span>&raquo;</span>
            @endif
        </div>
    @endif

</div>

<script>
    // Fitur Check-all checkbox di header tabel
    document.getElementById('checkAll').addEventListener('change', function () {
        document.querySelectorAll('.row-check').forEach(cb => cb.checked = this.checked);
    });

    // Ambil element filter untuk sinkronisasi dua arah
    const topStatus = document.getElementById('status');
    const bottomStatus = document.getElementById('status_bottom');
    const topShow = document.getElementById('show');
    const bottomShow = document.getElementById('show_bottom');
    const form = document.getElementById('filterForm');

    // Sinkronisasi Filter Status (Atas <-> Bawah) + Auto Submit
    topStatus.addEventListener('change', function() { bottomStatus.value = this.value; form.submit(); });
    bottomStatus.addEventListener('change', function() { topStatus.value = this.value; form.submit(); });

    // Sinkronisasi Filter Show Per Page (Atas <-> Bawah) + Auto Submit
    topShow.addEventListener('change', function() { bottomShow.value = this.value; form.submit(); });
    bottomShow.addEventListener('change', function() { topShow.value = this.value; form.submit(); });
</script>

@endsection