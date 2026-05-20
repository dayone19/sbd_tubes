@extends('layouts.app')

@section('content')

@include('components.navbarMarket')

<style>
    body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #fff; color: #333; }
    .discogs-cart-container { max-width: 1100px; margin: 20px auto; padding: 0 15px; }
    .cart-status-text { font-size: 20px; font-weight: bold; margin-bottom: 15px; }
    /* Alert Styling */
    .shipping-alert { background-color: #fff4ec; border: 1px solid #f9d6bc; border-left: 5px solid #e67e22; 
        padding: 15px; display: flex; gap: 15px;margin-bottom: 20px;}
    .alert-icon { font-size: 20px; }
    .alert-content a { color: #2d6cdf; text-decoration: none; }
    /* Flash */
    .flash-success { background: #d4edda; border: 1px solid #c3e6cb; color: #155724; padding: 12px 15px; margin-bottom: 15px; border-radius: 4px; }
    .flash-error   { background: #f8d7da; border: 1px solid #f5c6cb; color: #721c24; padding: 12px 15px; margin-bottom: 15px; border-radius: 4px; }
    /* Left Side */
    .seller-section { border: 1px solid #ddd; background: #fff; margin-bottom: 20px; }
    .seller-header { background: #f6f6f6; padding: 10px 15px; border-bottom: 1px solid #ddd;display: flex; 
        justify-content: space-between; align-items: center;}
    .seller-name { color: #2d6cdf; font-weight: bold; font-size: 16px; }
    .seller-rating { font-size: 12px; color: #666; margin-left: 10px; }
    .remove-btn { background: none; border: none; cursor: pointer; color: #999; font-size: 16px; }
    .remove-btn:hover { color: #b12704; }
    .cart-item { display: flex; padding: 15px; gap: 15px; border-bottom: 1px solid #eee; align-items: flex-start; }
    .cart-item img { width: 80px; height: 80px; object-fit: cover; border: 1px solid #ddd; flex-shrink: 0; }
    .cart-layout { 
    display: grid; grid-template-columns: 1fr 350px; gap: 20px; align-items: start; }
    .cart-sidebar {
    position: sticky; top: 20px; align-self: start;}
    .item-details { flex: 1; }
    .item-title { color: #2d6cdf; text-decoration: none; font-weight: bold; font-size: 15px; }
    .item-condition { font-size: 13px; color: #666; margin-top: 5px; }
    /* Quantity */
    .item-quantity { display: flex; align-items: center; gap: 8px; margin-top: 8px; }
    .item-quantity label { font-size: 13px; color: #666; }
    .qty-form { display: inline-flex; align-items: center; gap: 4px; }
    .qty-input { width: 50px; padding: 3px 6px; border: 1px solid #ccc; border-radius: 3px; font-size: 13px; text-align: center; }
    .qty-btn { background: #f0f0f0; border: 1px solid #ccc; border-radius: 3px; padding: 2px 8px; cursor: pointer; font-size: 14px; }
    .qty-btn:hover { background: #ddd; }
    .qty-btn:disabled { opacity: 0.4; cursor: not-allowed; }
    /* Price col */
    .item-price-col { text-align: right; min-width: 100px; }
    .item-price { font-weight: bold; font-size: 16px; color: #b12704; }
    .item-subtotal { font-size: 12px; color: #888; margin-top: 3px; }
    .shipping-info-section { margin-top: 20px; }
    .shipping-info-section h3 { font-size: 18px; margin-bottom: 10px; }
    .shipping-info-section p { font-size: 14px; }
    /* Right Side (Summary) */
    .payment-summary-box { border: 1px solid #ddd; background: #fff; padding: 20px;}
    .payment-summary-box h3 { margin-top: 0; font-size: 18px; }
    .payment-methods { border: 1px solid #2d6cdf; padding: 10px; display: flex; 
        align-items: center;  gap: 10px;  margin-bottom: 15px; background: #f0f5ff;}
    .price-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px; }
    .price-val { text-align: right; }
    .total-row { font-weight: bold; font-size: 16px; }
    .total-amount { color: #b12704; }
    .terms-checkbox { font-size: 13px; margin: 20px 0; display: flex; gap: 10px; }
    .terms-checkbox a { color: #2d6cdf; }
    .btn-pay-now { width: 100%; background-color: #28a745; color: white; border: none; padding: 12px; 
        font-weight: bold; font-size: 16px; border-radius: 4px;cursor: pointer;}
    .btn-pay-now:hover { background-color: #218838; }
    .sidebar-tips { margin-top: 20px; background: #fff; border: 1px solid #ddd; padding: 15px; font-size: 13px; }
    .sidebar-tips h4 { margin-top: 0; }
    .sidebar-tips a { color: #2d6cdf; }
    /* Empty */
    .empty-cart { text-align: center; padding: 60px 20px; }
    .empty-cart-icon { font-size: 64px; margin-bottom: 20px; }
    .btn-shop { display: inline-block; background: #28a745; color: white; padding: 10px 24px; border-radius: 4px; text-decoration: none; font-weight: bold; }
    .btn-shop:hover { background: #218838; color: white; }
</style>

<div class="discogs-cart-container">

    {{-- Flash Messages --}}
    @if(session('removed_product_id'))
    <div class="flash-info" style="background:#e8f4fd; border:1px solid #bee5eb; color:#0c5460; padding:12px 15px; margin-bottom:15px; border-radius:4px;">
        ℹ️ Removed item from your cart. 
        <form action="{{ route('cart.addBack') }}" method="POST" style="display:inline">
            @csrf
            <input type="hidden" name="product_id" value="{{ session('removed_product_id') }}">
            <button type="submit" style="background:none; border:none; color:#2d6cdf; cursor:pointer; font-weight:bold; text-decoration:underline;">
                Add it back
            </button>
        </form>
    </div>
@endif
    @if(session('error'))
        <div class="flash-error">❌ {{ session('error') }}</div>
    @endif

    @php
        $totalItems   = 0;
        $totalSellers = 0;
        $grandTotal   = 0;

        if (!empty($cartItemsBySeller) && $cartItemsBySeller->isNotEmpty()) {
            $totalSellers = $cartItemsBySeller->count();
            foreach ($cartItemsBySeller as $items) {
                foreach ($items as $item) {
                    $totalItems += $item->quantity;
                    $grandTotal += $item->product->price * $item->quantity;
                }
            }
        }
    @endphp

    {{-- ===== CART ISI ===== --}}
    @if(!empty($cartItemsBySeller) && $cartItemsBySeller->isNotEmpty())

        <h2 class="cart-status-text">
            You have {{ $totalItems }} {{ Str::plural('item', $totalItems) }} in your cart
            from {{ $totalSellers }} {{ Str::plural('seller', $totalSellers) }}.
        </h2>

        <div class="shipping-alert">
            <div class="alert-icon">⚠️</div>
            <div class="alert-content">
                <strong>Before you can place an order:</strong><br>
                1. <a href="#">Set up your shipping information</a> so they know where to send your order
            </div>
        </div>

        <div class="cart-layout">
            <div class="cart-main">

                @foreach($cartItemsBySeller as $sellerId => $items)
                    @php $seller = $items->first()->product->seller; @endphp

                    <div class="seller-section">
                        <div class="seller-header">
                            <div class="seller-info">
                                Order from <span class="seller-name">{{ $seller->store_name }}</span>
                            </div>
                            {{-- Hapus semua item dari seller ini --}}
                            <form action="{{ route('cart.removeSeller', $sellerId) }}" method="POST"
                                  onsubmit="return confirm('Remove all items from {{ $seller->store_name }}?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="remove-btn" title="Remove all from this seller">🗑</button>
                            </form>
                        </div>

                        @foreach($items as $item)
                            @php
                                $release   = $item->product->release;
                               $imgUrl = $release->images->where('type', 'primary')->first()->url ?? 'https://via.placeholder.com/80x80?text=No+Image';
                                $itemTotal = $item->product->price * $item->quantity;
                            @endphp

                            <div class="cart-item">
                                <img src="{{ $imgUrl }}" alt="{{ $release->title ?? 'Album' }}">

                                <div class="item-details">
                                    <a href="#" class="item-title">{{ $release->title ?? 'Unknown Title' }}</a>
                                    <p class="item-condition">
                                        Condition: {{ $item->product->condition ?? 'N/A' }}
                                    </p>
                                </div>

                                <div class="item-price-col">
                                    <div class="item-price">${{ number_format($item->product->price, 2) }}</div>
                                    @if($item->quantity > 1)
                                        <div class="item-subtotal">Subtotal: ${{ number_format($itemTotal, 2) }}</div>
                                    @endif
                                    {{-- Hapus satu item --}}
                                    <form action="{{ route('cart.removeItem', $item->cart_item_id) }}" method="POST"
                                          style="margin-top:6px" onsubmit="return confirm('Remove this item?')">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="remove-btn">🗑</button>
                                    </form>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach

                <div class="shipping-info-section">
                    <h3>Your Shipping Address</h3>
                    <p>You haven't provided a shipping address yet. You'll need to enter one before you can check out.
                        <a href="#">Set your shipping address now</a></p>
                </div>
            </div>

            <div class="cart-sidebar">
                <div class="payment-summary-box">
                    <h3>Payment</h3>
                    <div class="payment-methods" style="display: flex; align-items: center; justify-content: space-between; padding: 10px; border: 1px solid #2d6cdf; background: #f0f5ff; border-radius: 4px;">
                        {{-- Sisi Kiri: Radio Button & Label --}}
                        <div style="display: flex; align-items: center; gap: 8px;">
                            <input type="radio" name="payment_method" value="paypal" checked id="paypal-radio">
                            <label for="paypal-radio" style="margin: 0; cursor: pointer; font-weight: 500;">PayPal</label>
                        </div>
                        
                        <div class="payment-icons" style="display: flex; align-items: center; gap: 8px;">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/b/b5/PayPal.svg" width="45" alt="PayPal">
                            <img src="https://cdn.jsdelivr.net/gh/simple-icons/simple-icons/icons/visa.svg" width="35" alt="Visa">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/2/2a/Mastercard-logo.svg" width="30" alt="Mastercard">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/3/30/American_Express_logo.svg" width="25" alt="Amex" style="border-radius: 2px;">
                        </div>
                    </div>

                    <div class="price-row">
                        <span>Subtotal ({{ $totalItems }} item)</span>
                        <span class="price-val total-amount">${{ number_format($grandTotal, 2) }}</span>
                    </div>
                    <div class="price-row">
                        <span>Shipping</span>
                        <span>To be determined by seller</span>
                    </div>
                    <hr>
                    <div class="price-row total-row">
                        <span>Total</span>
                        <span class="total-amount">${{ number_format($grandTotal, 2) }}</span>
                    </div>

                    <form action="{{ route('cart.placeOrder') }}" method="POST">
                        @csrf
                        <div class="terms-checkbox">
                            <input type="checkbox" name="terms" id="terms" value="1" required>
                            <label for="terms">I agree to <a href="#">Buyer Policy</a> and <a href="#">Seller Terms</a></label>
                        </div>
                        <button type="submit" class="btn-pay-now">Place order and pay now</button>
                    </form>
                </div>

                <div class="sidebar-tips">
                    <h4>Buying Items on Discogs</h4>
                    <p>Your cart can hold items from many different sellers. When you're ready to check out, you'll place one order with each seller.</p>
                    <a href="#">Learn more about how to buy</a>
                </div>
            </div>
        </div>

    {{-- ===== CART KOSONG ===== --}}
    @else
        <div class="empty-cart">
            <div class="empty-cart-icon">🛒</div>
            <h2 class="cart-status-text">Your cart is empty</h2>

            <div class="shipping-alert" style="max-width:500px; margin: 0 auto 20px; text-align:left;">
                <div class="alert-icon">⚠️</div>
                <div class="alert-content">
                    You haven't provided a shipping address yet.<br>
                    <a href="#">Set your shipping address now</a>
                </div>
            </div>

            <p>Shop for <a href="{{ route('sell.list') }}">Vinyl, CDs, and more</a> in the Marketplace.</p>
            <a href="{{ route('sell.list') }}" class="btn-shop">Start Shopping</a>
        </div>
    @endif

</div>

@endsection