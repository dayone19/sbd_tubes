@extends('layouts.selling')

@section('content')

<style>
    body {background-color: #fff;font-family: Arial, sans-serif;}
    .hero { height: 250px;
         background-image: url('https://content.discogs.com/media/grading-condition-star-icon-pattern-teal-on-green.png'); /* optional */
        background-size: cover;background-position: center;}
    .content {background: white;padding: 30px 0;}
    .content-box {max-width: 700px;margin: auto;background: transparent;}
    h1 {  font-weight: 700;margin-bottom: 20px;}
    h2,h5 {margin-top: 30px;font-weight: 700;}
    p {color: #333;line-height: 1.6;}
    .intro {text-align: center;margin-bottom: 50px;}
    .intro h1 {font-size: 42px;}
    .intro p {max-width: 600px; margin: 10px auto;}
    .intro a {color: #333;text-decoration: underline; font-weight: 600;}
    .grade-item {display: flex;align-items: flex-start;gap: 25px;margin-top: 40px;}
    .grade-item img {width: 120px;flex-shrink: 0; }
    .grade-item h2 { margin-top: 0;}
    .goldmine {background: #f5f5f5; padding: 60px 0;}
    .video { position: relative;padding-bottom: 56.25%;height: 0; overflow: hidden; margin: 30px auto; max-width: 1200px;}
    .video iframe {position: absolute; top: 0;left: 0; width: 100%;height: 100}
</style>

<div class="hero"></div>

<div class="content">
    <div class="content-box"></div>
</div>

<!-- 1st content -->
<div class="content">
    <div class="content-box">

        <h1>All About Record Grading</h1>
        <p> The condition of each piece of media will greatly influence its value. 
            No matter how rare the item is, it will not be worth much if it doesn’t 
            sound (and look) good. However, the condition is unique to each and every 
            item. Here’s a quick guide to determining the condition of your physical 
            music and grading it accordingly. </p>

        
        <h2>Inspect the Item</h2>
        <p> You must give the item a visual inspection and, in most cases, play it to 
            grade how it sounds. This expectation applies to all types of physical media, 
            including vinyl records, CDs, cassettes, box sets, and more.</p>


        <h5>How Does It Look?</h5>
        <p> Inspect the sleeve, case, and any inserts for wear, discoloration, sticker 
            residue, and seam splits. Next, look at the item’s surface for scratches and 
            other imperfections. Visually inspecting an item is best done under a bright 
            light positioned close to the surface. </p>


        <h5>How Does It Sound?</h5>
        <p> Give the record a spin, load the CD into a tray, or slide the cassette into a deck. 
            Do you hear clicks, pops, or skipping? Listen to the media in its entirety. Make 
            note of the different sounds and what side they correspond to. </p>


        <h2>Reference the Grading Standard</h2>
        <p> Discogs uses the Goldmine Grading Guide, a universally accepted standard for representing 
            the condition of physical music in the resale market. The levels range from Mint (perfect) 
            down to Poor/Fair (damaged). </p>
        <p> Grade the different components of the item separately. For example, the vinyl record can 
            be in Near Mint condition, but the album cover may only be Very Good because it shows signs of wear. </p>


        <h2>Use Comments to Add Clarification</h2>
        <p> Your listing’s comments section can justify your grading and note any additional issues that may 
            not drastically affect the item’s grading, such as inaudible but visible blemishes or slight dings. 
            The more detail, the better. </p>
        <p> Comments will help you cut down on potential buyer confusion and show that you have a good understanding 
            of the record you’re selling.</p>
    </div>
</div>


<!-- 2nd content -->
<div class="content goldmine">
    <div class="content-box">

        <div class="text-center intro">
            <h1>Goldmine Grading Guide</h1>
            <p>
                These standards will help your grade the condition of your physical media, including vinyl records,
                CDs, and cassettes. Don’t forget to grade each component separately.
            </p>
            <a href="#">See more examples of grading by format</a>
        </div>

        <div class="grade-item">
            <img src="https://content.discogs.com/media/goldmine-standard-logo-mint.png" alt="mint">
            <div>
                <h2>Mint (M)</h2>
                <p> The item and container are absolutely perfect in every way. To qualify as Mint, the item must never have 
                    been played and is possibly still sealed. Mint should be used sparingly as a grade, if at all. Note that 
                    an item can be sealed and not Mint. If you suspect your record is in Mint condition, do not play it.</p>
            </div>
        </div>

        <div class="grade-item">
            <img src="https://content.discogs.com/media/goldmine-standard-logo-near-mint.png" alt="nm">
            <div>
                <h2>Near Mint (NM or M-)</h2>
                <p> The item is nearly perfect. Near Mint (NM) media has more than likely never been played, and if it has, 
                    there will be no imperfections during playback. The item should show no obvious signs of wear. The cover 
                    or container can have very minor defects., but it should have no folds, seam splits, scratches, or other 
                    noticeable similar defects. The same should be true of any other inserts, such as posters, lyric sleeves, 
                    etc. Many dealers won’t give a grade higher than NM, implying (perhaps correctly) that no item is ever truly perfect.</p>
            </div>
        </div>

        <div class="grade-item">
            <img src="https://content.discogs.com/media/goldmine-standard-logo-very-good-plus.png" alt="vgp">
            <div>
                <h2>Very Good Plus (VG+)</h2>
                <p> The item will show some signs that it was played and handled by a previous owner who took good care of it. 
                    Any defects are of a cosmetic nature and do not affect the actual playback. In theory, a Very Good Plus (VG+) 
                    item should sound the same as a Near Mint (NM) one. Surfaces may show some signs of wear, such as slight 
                    scuffs or very light scratches, and slight warps that do not affect the sound are okay. Paper products like 
                    sleeves will have some wear, slightly turned-up corners, or a small seam-split. In general, it plays perfectly, 
                    and if not for some minor aesthetic wear, it would be Near Mint.</p>
            </div>
        </div>

        <div class="grade-item">
            <img src="https://content.discogs.com/media/goldmine-standard-logo-very-good.png" alt="vg">
            <div>
                <h2>Very Good (VG)</h2>
                <p> The item’s defects will be more pronounced. Surface noise will be evident upon playing, especially in soft 
                    passages and during a song’s intro and fade, but will not overpower the music. Wear will start to be noticeable, 
                    such as with light scratches on vinyl (deep enough to feel with a fingernail) that will affect the sound. Labels, 
                    covers, and sleeves may be marred by writing or have tape, stickers, and residue attached. However, a VG item 
                    will not have all of these problems at the same time.</p>
            </div>
        </div>

        <div class="grade-item">
            <img src="https://content.discogs.com/media/goldmine-standard-logo-good-and-good-plus.png" alt="good">
            <div>
                <h2>Good (G / G+)</h2>
                <p> An item in Good (G) or Good Plus (G+) condition can be played through without skipping, but it will have 
                    significant surface noise, scratches, crackling, or visible wear. A container, cover, or sleeve will have 
                    scratches or seam splits, especially at the bottom or on the spine. Tape, writing, or other defects will also 
                    be present.</p>
            </div>
        </div>

        <div class="grade-item">
            <img src="https://content.discogs.com/media/goldmine-standard-logo-poor-fair.png" alt="poor">
            <div>
                <h2>Poor / Fair (P / F)</h2>
                <p> The item is cracked, badly warped, and won’t play through without skipping or repeating. The container or cover 
                    could be cracked, water-damaged, and heavily marred by wear or writing. If it is a vinyl record, the album cover 
                    and inner sleeves are fully split, crinkled, and written upon. Poor (P) or Fair (F) records are generally worth 
                    very little. </p>
            </div>
        </div>
    </div>
</div>

<!-- 3rd content -->
<div class="text-center content">
    <h2>Dirty vinyl?</h2>
    <h5>How to give your records a good clean</h5>
    <div class="video">
    <div>
        <iframe 
            src="https://www.youtube.com/embed/lmhW6zaL4Mk"
            title="YouTube video"
            frameborder="0"
            allowfullscreen>
        </iframe>
    </div>
</div>

<!-- 4th content -->
<div class="content goldmine">
    <div style="padding-bottom:5%">
            <div class="flex justify-center" style="padding-top:3%">
                <h2 style="font-weight:bold;">Essential Resources</h2>
            </div>

            <div class="flex justify-center gap-6 mt-8">
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/grading-condition-star-icon-pink-on-purple.png" class="card-img-top" alt="4">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">How to Use the Goldmine Grading Guide</h4>
                        <p class="card-text">Learn more about the guidelines for grading the condition of items listed in the Marketplace.</p>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/tax-payments-coins-icon-pattern-teal-on-teal.png" class="card-img-top" alt="4">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">Where Can I Access Sales History?</h4>
                        <p class="card-text">Sales History is a feature that provides you with an overview of the most recent prices of a sold item.</p>
                    </div>
                </div>
                <div class="card border-0" style="width: 18rem; background-color:#f5f5f5">
                    <img src="https://content.discogs.com/media/vinyl-record-icon-red-on-peach-generic-header-image.png" class="card-img-top" alt="3">
                    <div class="card-body">
                        <h4 href="#" style="font-weight:bold; font-color:black;">How to Clean Vinyl Records</h4>
                        <p class="card-text">Clean records before you grade them to tell the difference between smudges and scratches.</p>
                    </div>
                </div>
            </div>
            <div class="flex justify-center" style="padding-top:3%">
                <a href="#" style="color:grey; font-weight:600;">More Seller Resources</a>
            </div>
        </div>
</div>

@endsection
