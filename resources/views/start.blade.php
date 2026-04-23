@extends('layouts.selling')

@section('content')

    <!-- tes bray -->
    <!-- tes kedua bray -->
    <div style="width:100%;">
        <!-- 1st content -->
        <div style="display:flex; align-items:center; min-height:500px">
            <div style="width:55%; padding:40px;">
                <h1 style="font-size:56px; font-weight:bold;">
                    How to Sell Records on Discogs
                </h1>
                
                <div style="font-family:Arial, Helvetica, sans-serif; padding:40px; width:650px;">
                    <div style="display:flex; align-items:center; margin-bottom:25px;">
                        <div style="width:45px; height:45px; background:black; color:white; border-radius:50%; display:flex; justify-content:center; align-items:center; font-weight:bold; font-size:20px; margin-right:20px;">
                            1
                        </div>
                        <div style="font-size:28px; font-weight:600;">
                            Set up your Discogs shop
                        </div>
                    </div>
                    
                    <div style="display:flex; align-items:center; margin-bottom:25px;">
                        <div style="width:45px; height:45px; background:black; color:white; border-radius:50%; display:flex; justify-content:center; align-items:center; font-weight:bold; font-size:20px; margin-right:20px;">
                            2
                        </div>
                        <div style="font-size:28px; font-weight:600;">
                            List your items in the Marketplace
                        </div>
                    </div>
                    
                    <div style="display:flex; align-items:center;">
                        <div style="width:45px; height:45px; background:black; color:white; border-radius:50%; display:flex; justify-content:center; align-items:center; font-weight:bold; font-size:20px; margin-right:20px;">
                            3
                        </div>
                        <div style="font-size:28px; font-weight:600;">
                            Sell, ship, and get paid
                        </div>
                    </div>
                </div>

                <p style="margin-top:20px; font-size:20px; line-height:1.7;">
                    The Discogs Marketplace connects independent sellers like you with music lovers around the world. Learn how to sell vinyl records online in easy steps.
                </p>

                <p style="margin-top:20px; font-size:15px; line-height:1.7;">
                    <a href="/login">Sign up and start selling</a>
                </p>
            </div>
            <div style="width:45%;">
                <img src="https://content.discogs.com/media/vinyl-record-icon-pattern-teal-on-green-generic-header-image-1536x864.png" 
                    style="width:100%; height:700px; object-fit:cover;">
            </div>
        </div>

        <!-- 2nd content -->
        <div style="background-color: #f5f5f5;padding-bottom:5%;padding-top:10px;">
            <div style="text-align:right; margin-right: 120px; color: #4e4f51;">
                <p style="font-size: 10px; letter-spacing: 1px;">ICON CREDIT: DAVIDE EUCALIPTO</p>
            </div>
            <br><br><br><br>
            <div style="width:45px; height:45px; background:black; color:white; border-radius:50%; 
            display:flex; justify-content:center; align-items:center; 
            font-weight:bold; font-size:20px; margin:0 auto;">1</div>
            <div class="flex justify-center" style="margin-bottom:2px;">
                <h4 style="font-weight:680; font-size: 30px;">Set up your shop</h4>
            </div>
            <div style="margin-bottom:5%; text-align:center;">
                <p style="text-align:center;">
                    Filling out the requirements in your 
                    <a href="/login">Seller Settings</a> 
                    is the first step on <br> 
                    your journey to becoming a Discogs seller. Your settings include the <br> 
                    address that items ship from, preferred payment methods, and tax <br> 
                    information, but there are a few that stand out:
                </p>
            </div>


            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5; text-align: center">
                    <img src="https://content.discogs.com/media/Selling-Paypal-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h3 href="#" style="font-weight:bold; font-color:black;">PayPal</h3>
                        <p class="card-text">
                           You need a verified PayPal account to ensure a smooth checkout process.</p>
                        <a href="">Connect to PayPal</a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5; text-align: center">
                    <img src="https://content.discogs.com/media/Selling-Shipping-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h3 href="#" style="font-weight:bold; font-color:black;">Shipping Policies</h3>
                        <p class="card-text">
                            Establish Shipping Policies to immediately calculate buyers’ shipping costs around the world.</p>
                        <a href="">Learn more</a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5; text-align: center">
                    <img src="https://content.discogs.com/media/Selling-Trust-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h3 href="#" style="font-weight:bold; font-color:black;">Seller Terms</h3>
                        <p class="card-text">
                            Provide clear information regarding your terms for shipping, returns, and tax collection.
                        </p>
                        <a href="">Understand Seller terms</a>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- 3th content -->
        <div style="background-color: white;padding-top:140px">
            <div style="width:45px; height:45px; background:black; color:white; border-radius:50%; 
            display:flex; justify-content:center; align-items:center; 
            font-weight:bold; font-size:20px; margin:0 auto;">2</div>
            <div class="flex justify-center" style=" text-align: center">
                <h2 style="font-weight:bold;">List your items</h2>
            </div>
            <div style="margin-bottom:5%; text-align:center;">
                <p style="text-align:center;padding-top: 5px;">
                    Start by identifying the exact release you want to sell, the condition the <br>
                    item is in, and how much you want to sell it for.
                </p>
            </div>


            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center">
                    <img src="https://content.discogs.com/media/Selling-Record-Stores-2-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h3 style="font-weight:bold; font-color:black;">Find the release</h3>
                        <p class="card-text">
                            Find exactly which version of a release you have by using the comprehensive Discogs Database.</p>
                        <a href="">How to spot release details</a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center">
                    <img src="https://content.discogs.com/media/Selling-Grading-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h3 style="font-weight:bold; font-color:black; white-space:nowrap;">Determine condition</h3>
                        <p class="card-text">
                            Discogs uses universally-accepted guidelines for representing the condition of physical music.</p>
                        <a href="/htg"><h6 style="color:grey;">How to grade items</h6></a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center">
                    <img src="https://content.discogs.com/media/Selling-Pricing-International-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h3 style="font-weight:bold; font-color:black;">Evaluate the price</h3>
                        <p class="card-text">
                            Use Discogs historical sales data to ensure that sellers and buyers understand the value of their music.
                        </p>
                        <a href="">How to price items</a>
                        <br><br><br><br>
                    </div>
                </div>
            </div>
        </div>

        <!-- 4th content -->
        <br><br><br>
        <div style="background-color: #f5f5f5;padding-bottom:5%;padding-top:100px;">
            <div class="flex justify-center" style="margin-bottom:2px;">
                <h4 style="font-weight:680; font-size: 30px;">Complete your listing</h4>
            </div>

            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 28rem; background-color:#f5f5f5; text-align: center">
                    <img src="https://content.discogs.com/media/Selling-Policies-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h3 href="#" style="font-weight:bold; font-color:black;">Final Step</h3>
                        <p class="card-text"; style="max-width: 150%; margin: 0 auto;">
                            Once you identify, grade, and price your items, the easiest way to add
                            them to your inventory is through your Discogs Dashboard. Use the <a href="">List Item for Sale</a> tool to quickly search and list multiple items.
                        </p>
                        <button style="background-color:black; color:white; margin-top: 30px; padding:10px 20px; border:none; border-radius:2px; font-weight:bold; cursor:pointer;"
                        onmouseover="this.style.backgroundColor='#888'";
                        onmouseout="this.style.backgroundColor='black';"> List Item for Sell
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- 5th content -->
        <div style="background-color: white;padding-top:140px">
            <div style="width:45px; height:45px; background:black; color:white; border-radius:50%; 
            display:flex; justify-content:center; align-items:center; 
            font-weight:bold; font-size:20px; margin:0 auto;">3</div>
            <div class="flex justify-center" style=" text-align: center">
                <h2 style="font-weight:bold;">Sell, ship, and get paid</h2>
            </div>
            <div style="margin-bottom:5%; text-align:center;">
                <p style="text-align:center;padding-top: 5px;">
                    Once you have active items in your inventory, music fans around the <br> world will be able to see your listings in the Marketplace.
                </p>
            </div>


            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center">
                    <img src="https://content.discogs.com/media/Selling-Start-2-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h3 href="#" style="font-weight:bold; font-color:black;">Manage orders</h3>
                        <p class="card-text">
                            Use the <a href="">order page</a>in <a href="">your Discogs Dashboard </a> to communicate with buyers and track <a href="">status</a> updates.
                        </p>
                        <a href="">How to manage your first order</a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center">
                    <img src="https://content.discogs.com/media/Selling-Packing-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h3 href="#" style="font-weight:bold; font-color:black; white-space:nowrap;">Pack & ship</h3>
                        <p class="card-text">
                            Prep the item for shipping, drop it off at your local postal service, and mark the status on the <a href="">order page.</a>
                        </p>
                        <a href="">Tips for packing and shipping</a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center">
                    <img src="https://content.discogs.com/media/Selling-Internaltional-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h3 href="#" style="font-weight:bold; font-color:black;">Process payments</h3>
                        <p class="card-text">
                            Discogs sales fees and taxes are automatically collected so all the money you receive is yours to keep.
                        </p>
                        <a href="">See your orders</a>
                        <br><br><br><br>
                    </div>
                </div>
            </div>
        </div>

        <!-- 6th content -->
       <div style="background-color: #f5f5f5; padding-bottom:5%">
        <div class="flex justify-center" style="padding-top:10%">
            <h2 style="font-weight:bold; letter-spacing:1.5px; font-size: 45px;">Learn the basics</h2>
        </div>
        <div class="flex justify-center" style="margin-bottom:5%;">
            <h4 style="font-weight:bold; font-size:1em; letter-spacing:1px;">ESSENTIAL RESOURCES</h4>
        </div>

            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/grading-condition-star-icon-pattern-teal-on-green.png" class="card-img-top" style="border-top-left-radius:10px; border-top-right-radius:10px; 
                    border-bottom-left-radius:0; 
                    border-bottom-right-radius:0; 
                    height:200px; 
                    object-fit:cover;">
                    <div class="card-body">
                        <a href="/htg"> <h3 style="font-weight:bold; color:black;">All About Record Grading</h3></a>
                        <p class="card-text">Determine the condition of your physical music and grade it accordingly before listing for sale.</p>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/payments-how-to-price-tag-icon-pattern-teal-on-green.png" class="card-img-top" style="border-top-left-radius:10px; 
                    border-top-right-radius:10px; 
                    border-bottom-left-radius:0; 
                    border-bottom-right-radius:0; 
                    height:200px; 
                    object-fit:cover;">
                    <div class="card-body">
                        <h3 href="#" style="font-weight:bold; font-color:black;">How to Price Records</h3>
                        <p class="card-text">Access Discogs’ exclusive, open-source sales data to competitively price your items in the Marketplace.</p>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/shipping-vinyl-record-icon-pattern-teal-on-green.png" class="card-img-top" style="border-top-left-radius:10px; 
                    border-top-right-radius:10px; 
                    border-bottom-left-radius:0; 
                    border-bottom-right-radius:0; 
                    height:200px; 
                    object-fit:cover;" >
                    <div class="card-body">
                        <h3 href="#" style="font-weight:bold; font-color:black;">Packing and Shipping</h3>
                        <p class="card-text">These guidelines cover packing and shipping for vinyl records, CDs, and cassettes.</p>
                    </div>
                </div>
            </div>
            <button style="background-color:black; color:white; margin-top:30px; padding:10px 20px; border:none; border-radius:2px; font-weight:bold; cursor:pointer; display:block; margin:30px auto 0 auto;"
            onmouseover="this.style.backgroundColor='#888'"
            onmouseout="this.style.backgroundColor='black'">
            More Resources
            </button>
        </div>

    </div>
@endsection