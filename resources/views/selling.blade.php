@extends('layouts.selling')

@section('content')

    
    <div style="width:100%;">
        <!-- 1st content -->
        <div style="display:flex; align-items:center; min-height:500px">
            <div style="width:55%; padding:60px;">
                <h1 style="font-size:56px; font-weight:bold;">
                    Sell on Discogs
                </h1>
                <p style="margin-top:20px; font-size:20px; line-height:1.7;">
                    Independent sellers around the world fuel the Discogs Marketplace. 
                    Connect with the largest audience of passionate music collectors. 
                    Explore selling guides and resources, see the latest updates, learn 
                    more about seller tools, and get the support you need to build your 
                    business.
                </p>
            </div>
            <div style="width:45%;">
                <img src="https://content.discogs.com/media/vinyl-record-icon-close-up-teal-on-green-generic-header-image-768x432.png" 
                    style="width:100%; height:500px; object-fit:cover;">
            </div>
        </div>

        <!-- 2nd content -->
        <div style="background-color: #f5f5f5; padding-bottom:5%">
            <div class="flex justify-center" style="padding-top:10%">
                <h2 style="font-weight:bold;">Latest News</h2>
            </div>
            <div class="flex justify-center" style="margin-bottom:5%">
                <h4 style="font-weight:bold;">FOR SELLER</h4>
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

        <!-- 3rd content -->
         <div style="display:flex; align-items:center; min-height:500px">
            <div style="width:45%;">
                <img src="https://content.discogs.com/media/vinyl-record-icon-pattern-teal-on-green-generic-header-image-1536x864.png" 
                    style="width:100%; height:500px; object-fit:cover;">
            </div>
            <div style="width:55%; padding:60px;">
                <h1 style="font-size:56px; font-weight:bold;">
                    Why Sell on Discogs?
                </h1>
                <p style="margin-top:20px; font-size:20px; line-height:1.7;">
                    Get the most out of your collection by selling directly to music fans. Discogs is a crowdsourced database 
                    featuring more than 15 million music releases. It is also a vibrant marketplace where people around the 
                    world can buy, sell, and evaluate vinyl records, CDs, cassettes, and more. Discogs is the only place where 
                    you can find a community that is this excited about physical music.
                </p>
            </div>
        </div>

        <!-- 4th content -->
        <div style="background-color: #f5f5f5;padding-bottom:5%">
            <div class="flex justify-center" style="padding-top:10%; padding-bottom:3%">
                <h2 style="font-weight:bold;">Discogs Put Seller First</h2>
            </div>

            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5; text-align: center">
                    <img style="width: 40%;height: 35%; display:block; margin:auto;" src="https://content.discogs.com/media/Selling-Listing-is-Free-pict-225px.png" class="card-img-top" alt="5">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Listing is free</h4>
                        <p class="card-text">
                            Starting a Discogs account is free. Signing up as a seller is free. Listing an item is free. You are 
                            only charged fees the moment that you sell an item.</p>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5; text-align: center">
                    <img style="width: 40%;height: 35%; display:block; margin:auto;" src="https://content.discogs.com/media/Selling-Fees-pict-225px.png" class="card-img-top" alt="6">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Enjoy fair fees</h4>
                        <p class="card-text">
                            When you sell an item, you are charged a flat fee of 9% with a maximum fee of $150 USD per item. Compare 
                            this to more than 10% on both items and shipping with eBay, Amazon, and Etsy.</p>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5; text-align: center">
                    <img style="width: 40%;height: 35%; display:block; margin:auto;" src="https://content.discogs.com/media/Selling-Data-pict-225px.png" class="card-img-top" alt="7">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Access sale data</h4>
                        <p class="card-text">
                            Discogs is committed to being an open-source site and a resource for sellers, which includes making 
                            proprietary Marketplace data public. This data can help you price and manage inventory.
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5th content -->
        <div style="background-color: white;padding-bottom:5%">
            <div class="flex justify-center" style="padding-top:10%; padding-bottom:3%; text-align: center">
                <h2 style="font-weight:bold;">Join from wherever<br>you are on your journey</h2>
            </div>

            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center;
                transition: transform 0.25s ease, box-shadow 0.25s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <img src="{{ asset('10.png') }}" class="card-img-top" alt="10">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Start</h4>
                        <p class="card-text">
                            Understand the basics of how to sell on Discogs.</p>
                        <a href="/start" style="color:grey; font-weight:600;">Start Selling</a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center;
                transition: transform 0.25s ease, box-shadow 0.25s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <img src="{{ asset('9.png') }}" class="card-img-top" alt="9">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Enjoy fair fees</h4>
                        <p class="card-text">
                            Explore selling guides and tools.</p>
                        <a href="/Resources" style="color:grey; font-weight:600;">Seller Resource</a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center;
                transition: transform 0.25s ease, box-shadow 0.25s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
                    <img src="{{ asset('8.png') }}" class="card-img-top" alt="8">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Access sale data</h4>
                        <p class="card-text">
                            Find the answers to your questions.
                        </p>
                        <a href="/start" style="color:grey; font-weight:600;">Seller Support</a>
                    </div>
                </div>
            </div>
        </div>

        <!-- 6th content -->
        <section class="hero">
            <div class="overlay"></div>
            <div class="hero-content" style="font-family:helvetica;">
                <div class="quote">“</div>
                <h1 style="font-weight: bold;">
                    Discogs is an endless <br>
                    source of musical <br>
                    inspiration.
                </h1>
                <p>JIM, COLLECTOR AND SELLER</p>
            </div>
        </section>

        <!-- 7th content -->
        <div style="background-color: #f5f5f5; padding-bottom:5%">
            <div class="flex justify-center" style="padding-top:10%">
                <h2 style="font-weight:bold;">Essential Resources</h2>
            </div>
            <div class="flex justify-center" style="margin-bottom:5%">
                <h4 style="font-weight:bold;">FOR SELLER</h4>
            </div>

            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/grading-condition-star-icon-pattern-teal-on-green.png" class="card-img-top" alt="4">
                    <div class="card-body">
                        <a href="/htg"><h4 style="font-weight:bold; color:black;">All About Record Grading</h4></a>
                        <p class="card-text">Determine the condition of your physical music and grade it accordingly before listing for sale.</p>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/payments-how-to-price-tag-icon-pattern-teal-on-green.png" class="card-img-top" alt="4">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">How to Price Records</h4>
                        <p class="card-text">Access Discogs’ exclusive, open-source sales data to competitively price your items in the Marketplace.</p>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/shipping-vinyl-record-icon-pattern-teal-on-green.png" class="card-img-top" alt="3">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Packing and Shipping</h4>
                        <p class="card-text">These guidelines cover packing and shipping for vinyl records, CDs, and cassettes.</p>
                    </div>
                </div>
            </div>
        

            <div class="btn-container" style="text-align: center; margin-top: 40px;">
                <a href="/start"><button class="sell-btn">Start Selling</button></a>
            </div>

        </div>
    </div>
@endsection