@extends('layouts.selling')

@section('content')

    <div style="width:100%;">

        <div style="background-color: white;padding-bottom:5%">
            <div class="flex justify-center" style="padding-top: 3%; text-align: center">
                <h1 style="font-weight:bold;">Seller Resources</h1>
            </div>

            <div class="flex justify-center" style="text-align: center">
                <p>Explore guides to the most important topics and tools for Discogs sellers, <br>
                whether you are just getting started or growing your business.</p>
            </div>
            
            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center;
                transition: transform 0.25s ease, box-shadow 0.25s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.1); padding-top: 35px; ">
                    <img src="https://content.discogs.com/media/trust-seller-identification-pict-selling-resource.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Account <br> Identification</h4>
                        <p class="card-text" style="padding-bottom:25px;">
                            Understand the requirements <br> for seller account identification <br> and the related laws.</p>
                        <a href="" style="color:grey; font-weight:600; display:block; margin-bottom:20px" >Learn requirements</a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center;
                transition: transform 0.25s ease, box-shadow 0.25s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.1); padding-top: 35px;">
                    <img src="https://content.discogs.com/media/Selling-Grading-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black; padding-bottom:28px;">Grading</h4>
                        <p class="card-text">
                            Determine the condition of your <br> physical music and grade it <br> accordingly before listing for <br> sale.</p>
                        <a href="" style="color:grey; font-weight:600; display:block; margin-bottom:20px">Learn grading</a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center;
                transition: transform 0.25s ease, box-shadow 0.25s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.1); padding-top: 35px;"">
                    <img src="https://content.discogs.com/media/Selling-Pricing-International-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black; padding-bottom:28px">Pricing</h4>
                        <p class="card-text">
                            Access Discogs’ exclusive, <br> open-source sales data to <br> competitively price your items <br> in the Marketplace.
                        </p>
                        <a href="" style="color:grey; font-weight:600;">Learn pricing</a>
                    </div>
                </div>
            </div>
            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center;
                transition: transform 0.25s ease, box-shadow 0.25s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.1); padding-top: 35px;">
                    <img src="https://content.discogs.com/media/Selling-Record-Stores-2-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black; padding-bottom:28px;">Packing</h4>
                        <p class="card-text">
                            Follow guidelines for packing <br> and shipping the three most <br> common formats sold on <br> Discogs.</p>
                        <a href="" style="color:grey; font-weight:600; display:block; margin-bottom:20px">Learn packing</a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center;
                transition: transform 0.25s ease, box-shadow 0.25s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.1); padding-top: 35px;">
                    <img src="https://content.discogs.com/media/Selling-Shipping-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black; padding-bottom:28px;">Shipping</h4>
                        <p class="card-text">
                            Shipping Policies allow you to <br> manage shipping guidelines, <br> coverage, and costs for your <br> Discogs store.</p>
                        <a href="" style="color:grey; font-weight:600; display:block; margin-bottom:20px">Learn policies</a>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:white; text-align: center;
                transition: transform 0.25s ease, box-shadow 0.25s ease; box-shadow: 0 5px 15px rgba(0,0,0,0.1); padding-top: 35px;">
                    <img src="https://content.discogs.com/media/Selling-Packing-pict-225px.png" width="150" height="150" class="mx-auto d-block">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black; padding-bottom:28px;">Shipping Labels</h4>
                        <p class="card-text">
                            Sellers in the U.S. can <br> download discounted shipping <br> labels from the USPS through <br> Discogs.</p>
                        <a href="" style="color:grey; font-weight:600; display:block; margin-bottom:20px">Learn about labels</a>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection