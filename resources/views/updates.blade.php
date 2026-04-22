@extends('layouts.selling')

@section('content')

    
    <div style="width:100%;">
        <!-- 1st content -->
        <div style="background-color: #f5f5f5; padding-bottom:5%">
           <div class="flex justify-center" style="padding-top: 3%; padding-bottom: 1%;text-align: center">
                <h1 style="font-weight:bold;">Seller Updates</h1>
            </div>
            <div class="flex justify-center" style="text-align: center"">
                <p>See recent news about seller tools, trends, and improvements to the Discogs <br> Marketplaces. Filter updates by topic to find the most relevant information.</p>
            </div>

            <div class="flex justify-center" style="margin-top:2%">~
                <h4 style="font-weight:bold;">TOPIC FILTER</h4>
            </div>

            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/shipping-vinyl-record-icon-arrow-pattern-teal-on-green.png" class="card-img-top" alt="4">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Your Guide to All of the New Inventory Management Upgrades</h4>
                        <p class="card-text">Inventory management is easier, faster, and more reliable than ever.</p>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/shipping-vinyl-record-icon-pattern-teal-on-green.png" class="card-img-top" alt="4">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Seller Account Identification</h4>
                        <p class="card-text">Discogs verifies some seller account information to ensure marketplace security and compliance with global regulations.</p>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/payments-how-to-price-tag-icon-pattern-teal-on-green.png" class="card-img-top" alt="3">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Christmas in July? Early Prep for the Holiday Season</h4>
                        <p class="card-text">With the biggest shopping season just a few months away, now’s the time to get your store in order.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection