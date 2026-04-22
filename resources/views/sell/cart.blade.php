@extends('layouts.app')

@section('content')

@include('components.navbarMarket')

<div class="discogs-cart-container">
    <h2 class="cart-status-text">You have 1 item in your cart from 1 seller.</h2>

    <div class="shipping-alert">
        <div class="alert-icon">⚠️</div>
        <div class="alert-content">
            <strong>Before you can place an order with RelevantRecords:</strong><br>
            1. <a href="#">Set up your shipping information</a> so they know where to send your order
        </div>
    </div>

    <div class="cart-layout">
        <div class="cart-main">
            <div class="seller-section">
                <div class="seller-header">
                    <div class="seller-info">
                        Order from <span class="seller-name">RelevantRecords</span>
                        <span class="seller-rating">★★★★★ 99.4% positive (11,454)</span>
                    </div>
                    <button class="remove-btn">🗑</button>
                </div>

                <div class="cart-item">
                    <img src="https://i.discogs.com/TfN-vI29BZciaZUkkHenpqJN72-ZDwuw5uPSE1XnJmY/rs:fit/g:sm/q:40/h:100/w:100/czM6Ly9kaXNjb2dz/LWRhdGFiYXNlLWlt/YWdlcy9SLTI2MDU1/OTQzLTE3MzYyNzUw/NDYtNjk1OC5qcGVn.jpeg" alt="Album Cover">
                    <div class="item-details">
                        <a href="#" class="item-title">BLACKPINK - Born Pink (LP, Album, Tra)</a>
                        <p class="item-condition">Media: Mint (M) / Sleeve: Mint (M)</p>
                    </div>
                    <div class="item-price">
                        £28.99 GBP
                        <button class="small-remove">🗑</button>
                    </div>
                </div>
            </div>

            <div class="shipping-info-section">
                <h3>Your Shipping Address</h3>
                <p>You haven't provided a shipping address yet. You'll need to enter one before you can check out. <a href="#">Set your shipping address now</a></p>
            </div>
        </div>

        <div class="cart-sidebar">
            <div class="payment-summary-box">
                <h3>Payment</h3>
                <div class="payment-methods">
                    <input type="radio" checked> 
                    <span>PayPal</span>
                </div>

                <div class="price-row">
                    <span>Subtotal</span>
                    <span class="price-val">£28.99 GBP<br><small>€33.30 EUR</small></span>
                </div>
                <div class="price-row">
                    <span>Shipping</span>
                    <span>To be determined by seller</span>
                </div>
                <hr>
                <div class="price-row total-row">
                    <span>Total</span>
                    <span>To be determined by seller</span>
                </div>

                <div class="terms-checkbox">
                    <input type="checkbox" id="terms">
                    <label for="terms">I agree to <a href="#">Buyer Policy</a> and <a href="#">Seller Terms</a></label>
                </div>

                <button class="btn-pay-now">Place order and pay now</button>
            </div>

            <div class="sidebar-tips">
                <h4>Buying Items on Discogs</h4>
                <p>Your cart can hold items from many different sellers. When you're ready to check out, you'll place one order with each seller.</p>
                <a href="#">Learn more about how to buy</a>
            </div>
        </div>
    </div>

    <!-- kalau kosong -->
    <div class="cart-status-text">Your cart is empty</div>

        <div class="shipping-alert">
            ⚠ You haven't provided a shipping address yet. You'll need to enter one before you can check out. <br>
            <a href="#">Set your shipping address now</a>
        </div>

        <p>
            Shop for <a href="{{ route('sell.list') }}">Vinyl, CDs, and more</a> in the Marketplace.
        </p>

        <a href="{{ route('sell.list') }}" class="btn btn-success">Start Shopping</a>

    </div>
</div>

<style>
    body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f9f9f9; color: #333; }
    .discogs-cart-container { max-width: 1100px; margin: 20px auto; padding: 0 15px; }
    
    .cart-status-text { font-size: 20px; font-weight: bold; margin-bottom: 15px; }

    /* Alert Styling */
    .shipping-alert { 
        background-color: #fff4ec; 
        border: 1px solid #f9d6bc; 
        border-left: 5px solid #e67e22; 
        padding: 15px; 
        display: flex; 
        gap: 15px;
        margin-bottom: 20px;
    }
    .alert-icon { font-size: 20px; }
    .alert-content a { color: #2d6cdf; text-decoration: none; }

    /* Layout */
    .cart-layout { display: grid; grid-template-columns: 1fr 350px; gap: 20px; }

    /* Left Side */
    .seller-section { border: 1px solid #ddd; background: #fff; margin-bottom: 20px; }
    .seller-header { 
        background: #f6f6f6; 
        padding: 10px 15px; 
        border-bottom: 1px solid #ddd;
        display: flex; 
        justify-content: space-between; 
        align-items: center;
    }
    .seller-name { color: #2d6cdf; font-weight: bold; font-size: 16px; }
    .seller-rating { font-size: 12px; color: #666; margin-left: 10px; }
    .remove-btn, .small-remove { background: none; border: none; cursor: pointer; color: #999; }

    .cart-item { display: flex; padding: 15px; gap: 15px; border-bottom: 1px solid #eee; }
    .cart-item img { width: 80px; height: 80px; object-fit: cover; border: 1px solid #ddd; }
    .item-details { flex: 1; }
    .item-title { color: #2d6cdf; text-decoration: none; font-weight: bold; font-size: 15px; }
    .item-condition { font-size: 13px; color: #666; margin-top: 5px; }
    .item-price { text-align: right; font-weight: bold; font-size: 16px; color: #b12704; }

    .shipping-info-section { margin-top: 20px; }
    .shipping-info-section h3 { font-size: 18px; margin-bottom: 10px; }
    .shipping-info-section p { font-size: 14px; }

    /* Right Side (Summary) */
    .payment-summary-box { border: 1px solid #ddd; background: #fff; padding: 20px; }
    .payment-summary-box h3 { margin-top: 0; font-size: 18px; }
    
    .payment-methods { 
        border: 1px solid #2d6cdf; 
        padding: 10px; 
        display: flex; 
        align-items: center; 
        gap: 10px; 
        margin-bottom: 15px;
        background: #f0f5ff;
    }

    .price-row { display: flex; justify-content: space-between; margin-bottom: 10px; font-size: 14px; }
    .price-val { text-align: right; }
    .total-row { font-weight: bold; font-size: 16px; }
    
    .terms-checkbox { font-size: 13px; margin: 20px 0; display: flex; gap: 10px; }
    
    .btn-pay-now { 
        width: 100%; 
        background-color: #28a745; 
        color: white; 
        border: none; 
        padding: 12px; 
        font-weight: bold; 
        font-size: 16px; 
        border-radius: 4px;
        cursor: pointer;
    }
    .btn-pay-now:hover { background-color: #218838; }

    .sidebar-tips { 
        margin-top: 20px; 
        background: #fff; 
        border: 1px solid #ddd; 
        padding: 15px; 
        font-size: 13px; 
    }
    .sidebar-tips h4 { margin-top: 0; }
</style>

@endsection