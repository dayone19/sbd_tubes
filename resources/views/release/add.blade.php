@extends('layouts.app')

@section('content')

<style>
:root{
    --blue:#1976d2;
    --green:#0a8f1f;
    --border:#d9d9d9;
    --soft:#f3f3f3;
    --text:#111;
    --muted:#666;
}
/* PAGE */
.release-wrap{width:96%;max-width:1550px;margin:18px 25px 50px;display:flex;gap:18px;}
.main-release{flex:1;}
.side-guide{width:390px;}
/* TOP */
.top-title{font-size:25px;font-weight:700;margin-bottom:6px;}
.top-links{margin-bottom:12px;}
.top-links a{color:#2457d6;text-decoration:none;font-size:13px;margin-right:28px;}
.top-box{border:1px solid var(--border);background:#f5f5f5;padding:12px 28px;display:flex;justify-content:space-between;align-items:center;}
.top-box h2{margin:0;font-size:20px; font-weight:bold;}
/* BUTTON */
.btn{border:1px solid #bbb; background:#fff;padding:4px 18px; font-size:13px; cursor:pointer; border-radius:3px;}
.btn-plus{border:1px solid #000; background:#f5f5f5; padding:4px 18px; font-size:13px; cursor:pointer; border-radius:3px;}
.btn-green{background:#158a1b; color:#fff; border:none; padding:5px 10px; font-size:13px; border-radius:3px;cursor:pointer; font-weight:bold;}
.btn-dark{background:#000;color:#fff;border:none;}
.btn-format{border:1px solid #bbb; border-radius: 3px; background:#f5f5f5; font-size:12px; padding: 4px 5px; width:90px;}
/* SECTION */
.sec{border:1px solid var(--border);border-top:none;padding:10px 20px 15px 25px;}
.sec-title{font-size:15px;font-weight:700;margin-bottom:18px;}
.info{color:#28a9df;font-size:15px;}
.req{color:#cc0000;}
select,textarea{
    width:100%;
    border:1px solid #9f9f9f;
    padding:2px 10px;
    font-size:15px;
    box-sizing:border-box;
    background:#fff;}
textarea{resize:vertical;}
.input-medium{ max-width: 400px; border: 1px solid #000; border-radius:3px; padding:2px; margin-left: 10px; background-color:white;}
.input-small{ max-width: 50px; border: 1px solid #000; border-radius:3px; padding:2px; margin-left: 10px; background-color:white;}
.input-format{ max-width: 350px; border: 1px solid #000; border-radius:3px; padding:2px; margin-left: 10px; background-color:white;}
/* IMAGE */
.image-grid{display:grid;grid-template-columns: 1.8fr 1fr;gap:30px;}
.drop{border:3px dashed #ddd;padding:55px 30px;text-align:center;}
.drop p{font-size:15px;margin:10px 0;}
.drop small{display:block;color:#666;font-size:13px;margin-top:18px;}
.rule{display:flex;gap:18px;margin-bottom:24px;font-size:15px;line-height:1.45;}
.rule-no{width:100px; height:45px; border-radius:50%;background:#f0d730;
    display:flex;align-items:center;justify-content:center;font-weight:700;}
/* FLEX */
.row{
    display:flex;
    gap:18px;
    align-items:center;
    margin-bottom:16px;
    background-color:#f5f5f5;
    padding: 9px 1px 9px;
    border: 1px solid #ddd;
}
.grid3{display:grid; grid-template-columns: 220px 1fr 280px;gap:18px;}
.grid4{display:grid;grid-template-columns: 220px 25px 450px 10px; gap:8px;}
/* FORMAT */
.format-box{
    border:1px solid var(--border);
    background:#fafafa;
    padding: 18px;
    margin:-16px -10px 10px -10px;
}
.format-grid{
    display:grid;
    grid-template-columns:repeat(4,1fr);
    gap:18px;
}
.format-grid label,
.genre-grid label{
    display:block;
    font-size:15px;
    margin-bottom:12px;
}
/* TRACKLIST */
/* HEADER */
.tracklist-header{
    display:flex;
    justify-content:space-between;
    align-items:center;
    margin-bottom:8px;
}

/* TABLE */
.track-table{
    width:100%;
    border-collapse:collapse;
    border:1px solid #ccc;
    font-size:13px;
}

.track-table th{
    background:#f2f2f2;
    border-bottom:1px solid #ccc;
    padding:6px;
    text-align:left;
}

.track-table td{
    border-top:1px solid #eee;
    padding:6px;
    vertical-align:middle;
}

/* INPUT */
.input-track{
    width:100%;
    padding:4px 6px;
    border:1px solid #bbb;
    border-radius:2px;
    font-size:13px;
}

.input-track.small{
    width:70px;
}

/* LINKS */
.add-link{
    color:#333;
    text-decoration:none;
    font-size:13px;
}

.add-link span{
    font-weight:bold;
    margin-right:3px;
}

/* CREDITS */
.credits{
    font-size:12px;
    color:#555;
    margin-top:4px;
}

/* ICONS */
.drag{
    text-align:center;
    color:#aaa;
    cursor:move;
}

.arrow{
    text-align:center;
    color:#aaa;
    cursor:pointer;
    font-size:11px;
}

/* FOOTER */
.track-footer{
    margin-top:10px;
    background:#f5f5f5;
    padding:8px;
    border:1px solid #ddd;
    display:flex;
    gap:6px;
    align-items:center;
}

.track-footer button{
    background:#fff;
    border:1px solid #bbb;
    padding:4px 8px;
    font-size:12px;
    cursor:pointer;
}

.track-footer button:hover{
    background:#eee;
}

/* LINKS */
.mini-link{
    color:#2457d6;
    text-decoration:none;
    font-size:13px;
}
/* GENRE */
.genre-grid{display:grid;grid-template-columns:repeat(5,1fr);}
/* SIDEBAR */
.side-card{ border-left:1px solid #ddd;padding-left:22px;position:sticky;top:15px;}
.side-title{font-size:15px; font-weight:700; margin-bottom:18px;}
.guide-link{ display:flex;justify-content:space-between;padding:16px 0;border-bottom:1px solid #ececec;text-decoration:none;color:#111;font-size:15px;font-weight:700;}
.help-link{display:inline-block;margin-top:22px;color:#2457d6;text-decoration:none;font-size:15px;}
/* CHECK / RADIO */
.add.input[type=checkbox],
.add.input[type=radio]{ transform:scale(1.6); margin-right:20px;}
.rating{display:flex;gap:30px;margin-top:15px;}
.rating label{text-align:center;font-size:15px;}
</style>

<div class="release-wrap">

    <div class="main-release">

        <div class="top-title">Add Release</div>

        <div class="top-links">
            <a href="#">Quick Start Guide</a>
            <a href="#">Submission Guidelines</a>
        </div>

        <div class="top-box">
            <h2>Add Release</h2>
            <div>
                <button class="btn">Save Draft</button>
                <button class="btn-green">Preview / Submit</button>
            </div>
        </div>

        <!-- Images -->
        <div class="sec">
            <div class="sec-title">Images <span class="info">ⓘ</span></div>

            <div class="image-grid">
                <div class="drop">
                    <p><svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#000"><path d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/></svg></p>
                    <p>Drag and drop image files here</p>
                    <p>or</p>
                    <button class="btn btn-dark">Browse files</button>

                    <small>
                        Accepted image formats are .jpg, .gif, .png.
                        Images must be larger than 150 px wide and less than 4 MB.
                    </small>
                </div>

                <div>
                    <div style="font-size:15px;font-weight:700;margin-bottom:18px;">Image Rules and Requirements</div>

                    <div class="rule">
                        <div class="rule-no">1</div>
                        <div>Images must match the exact version of the release. For example, don't add the CD image to the LP version.</div>
                    </div>

                    <div class="rule">
                        <div class="rule-no">2</div>
                        <div>Do not upload images with watermarks, or images of generic sleeves. </div>
                    </div>

                    <div class="rule">
                        <div class="rule-no">3</div>
                        <div>Do not copy images from the Internet unless one of the Intellectual Property Rules requirements is met.</div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Artists -->
        <div class="sec">
        <div class="sec-title">Artists <span class="req">*</span></div>

        <div id="artistContainer">
            <div class="row">
                <div class="grid3">
                    <input type="text" class="input-medium" placeholder="Name">

                    <button class="btn-format">Add ANV</button>

                    <input type="text" class="input-format" placeholder="ANV" style="display:none;">

                    <button class="btn-remove">
                        <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#000"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                    </button>
                </div>
            </div>
        </div>

        <button class="btn-plus">+ Add artist</button>
        </div>

        <!-- Title -->
        <div class="sec">
            <div class="sec-title">Title <span class="req">*</span> <span class="info">ⓘ</span></div>
            <input type="text" class="input-medium" placeholder="Title" style="margin-left:-2px">
        </div>

        <!-- Label -->
        <div class="sec">
            <div class="sec-title">Label, Company, Catalog Number, Etc. <span class="req">*</span> <span class="info">ⓘ</span></div>
            <div class="row">
                <div class="grid3">
                    <select>
                        <option>Label</option>
                    </select>

                    <input type="text" class="input-medium" placeholder="Name">

                    <input type="text" class="input-medium" placeholder="Catalog Number">
                </div>
            </div>
            
            <button class="btn-plus">+ Add label</button>
        </div>

        <!-- Barcodes -->
        <div class="sec">
            <div class="sec-title">Barcodes and Other Identifiers <span class="info">ⓘ</span></div>

            <button class="btn-plus">+ Add barcode or other identifier</button>
        </div>

        <!-- Format -->
        <div class="sec">
            <div class="sec-title">Format <span class="req">*</span> <span class="info">ⓘ</span></div>

            <div class="row">
                <div class="grid4">
                    <select style="max-width:420px;">
                        <option>Vinyl</option>
                    </select>

                    <span style="font-size:15px;">Qty:</span>
                    <input type="text" class="input-small" value="1">
                    <span style="font-size:20px;">▲</span>
                </div>
            </div>

            <div class="format-box">
                <div class="format-grid">
                    <div>
                        <b style="font-size:15px;">Size *</b><br>
                        <label><input type="checkbox">LP</label>
                        <label><input type="checkbox">16"</label>
                        <label><input type="checkbox">14"</label>
                        <label><input type="checkbox">12"</label>
                        <label><input type="checkbox">11"</label>
                        <label><input type="checkbox">10"</label>
                        <label><input type="checkbox">9"</label>
                        <label><input type="checkbox">8"</label>
                        <label><input type="checkbox">7"</label>
                        <label><input type="checkbox">6½"</label>
                        <label><input type="checkbox">6"</label>
                        <label><input type="checkbox">5½"</label>
                        <label><input type="checkbox">5"</label>
                        <label><input type="checkbox">4"</label>
                        <label><input type="checkbox">3½"</label>
                        <label><input type="checkbox">3"</label>
                        <label><input type="checkbox">2"</label>
                        <label><input type="checkbox">1"</label>
                    </div>

                    <div>
                        <b style="font-size:15px;">Speed</b><br>
                        <label><input type="checkbox">8⅓ RPM</label>
                        <label><input type="checkbox">16⅔ RPM</label>
                        <label><input type="checkbox">33⅓ RPM</label>
                        <label><input type="checkbox">45 RPM</label>
                        <label><input type="checkbox">78 RPM</label>
                        <label><input type="checkbox">80 RPM</label>

                        <br><b style="font-size:15px;">Shape</b><br>
                        <label><input type="checkbox">Shape</label>

                        <br><b style="font-size:15px;">Sides</b><br>
                        <label><input type="checkbox">Single Sides</label>
                    </div>

                    <div>
                        <b style="font-size:15px;">Description</b><br>
                        <label><input type="checkbox">Advanced</label>
                        <label><input type="checkbox">Album</label>
                        <label><input type="checkbox">Mini-Album</label>
                        <label><input type="checkbox">EP</label>
                        <label><input type="checkbox">Maxi-Single</label>
                        <label><input type="checkbox">Record Store Day</label>
                        <label><input type="checkbox">Single</label>
                        <label><input type="checkbox">Compilation</label>
                        <label><input type="checkbox">Bioplastic</label>
                        <label><input type="checkbox">Card Backed</label>
                        <label><input type="checkbox">Club Edition</label>
                        <label><input type="checkbox">Deluxe Edition</label>
                        <label><input type="checkbox">Enhanced</label>
                        <label><input type="checkbox">Etched</label>
                        <label><input type="checkbox">Jukebox</label>
                        <label><input type="checkbox">Limited Edition</label>
                        <label><input type="checkbox">Mispress</label>
                        <label><input type="checkbox">Misprint</label>
                        <label><input type="checkbox">Mixed</label>
                        <label><input type="checkbox">Mixtape</label>
                        <label><input type="checkbox">Numbered</label>
                        <label><input type="checkbox">Partially Mixed</label>
                        <label><input type="checkbox">Partially Unofficial</label>
                        <label><input type="checkbox">Picture Disc</label>
                        <label><input type="checkbox">Promo</label>
                        <label><input type="checkbox">Reissue</label>
                        <label><input type="checkbox">Remastered</label>
                        <label><input type="checkbox">Repress</label>
                        <label><input type="checkbox">Sampler</label>
                        <label><input type="checkbox">Special Cut</label>
                        <label><input type="checkbox">Special Edition</label>
                        <label><input type="checkbox">Styrene</label>
                        <label><input type="checkbox">Test Pressing</label>
                        <label><input type="checkbox">Tour Recording</label>
                        <label><input type="checkbox">Transcription</label>
                        <label><input type="checkbox">Unofficial Release</label>
                        <label><input type="checkbox">White Label</label>
                    </div>

                    <div>
                        <b style="font-size:15px;">Channels</b><br>
                        <label><input type="checkbox">Stereo</label>
                        <label><input type="checkbox">Mono</label>
                        <label><input type="checkbox">Quardraphonic</label>
                        <label><input type="checkbox">Ambisonic</label>

                        <br><b style="font-size:15px;">Free Text</b><br>
                        <input type="text" class="input-medium">
                    </div>
                </div>
            </div>

            <button class="btn-plus">+ Add Format</button>

        </div>

        <!-- Country -->
        <div class="sec">
            <div class="sec-title">Country <span class="info">ⓘ</span></div>
                <select style="max-width:300px;">
                    <option> </option>
                </select>
        </div>

        <!-- Released -->
        <div class="sec">
            <div class="sec-title">Released <span class="info">ⓘ</span></div>
            <input type="text" class="input-medium" placeholder="Date" style="margin-left:-2px">
        </div>

        <!-- Track -->
        <div class="sec">

    <!-- HEADER -->
    <div class="tracklist-header">
        <span class="sec-title">
            Tracklist <span class="req">*</span> <span class="info">ⓘ</span>
        </span>

        <div>
            <a href="#" class="mini-link">Edit all Track Artists/Credits</a>
            <span class="separator">|</span>
            <a href="#" class="mini-link">Save all Track Artists/Credits</a>
        </div>
    </div>

    <!-- TABLE -->
    <table class="track-table">
        <thead>
            <tr>
                <th style="width:30px;"></th>
                <th style="width:90px;">Position</th>
                <th style="width:130px;">Artist</th>
                <th>Title/Credits</th>
                <th style="width:110px;">Duration</th>
                <th style="width:30px;"></th>
            </tr>
        </thead>

        <tbody>
            @for($i=0; $i<4; $i++)
            <tr>
                <!-- drag -->
                <td class="drag">↕</td>

                <!-- position -->
                <td>
                    <input type="text" class="input-track small" placeholder="#">
                </td>

                <!-- artist -->
                <td>
                    <a href="#" class="add-link"><span>+</span> Add</a>
                </td>

                <!-- title -->
                <td>
                    <input type="text" class="input-track" placeholder="Track Title">

                    <div class="credits">
                        Credits <a href="#" class="add-link"><span>+</span> Add</a>
                    </div>
                </td>

                <!-- duration -->
                <td>
                    <input type="text" class="input-track small" placeholder="0:00">
                </td>

                <!-- dropdown -->
                <td class="arrow">▼</td>
            </tr>
            @endfor
        </tbody>
    </table>

    <!-- FOOTER -->
    <div class="track-footer">
        <select>
            <option>1</option>
        </select>

        <button>Add Tracks</button>

        <span class="separator">|</span>

        <button>Auto-number Tracks</button>
        <button>Add Artist Per Track</button>
        <button>Add Credit Per Track</button>
    </div>

</div>

        <!-- Genres -->
        <div class="sec">
            <div class="sec-title">Genres <span class="req">*</span> <span class="info">ⓘ</span></div>

            <div class="genre-grid">
                <label><input type="checkbox">Electronic</label>
                <label><input type="checkbox">Rock</label>
                <label><input type="checkbox">Funk / Soul</label>
                <label><input type="checkbox">Pop</label>
                <label><input type="checkbox">Children's</label>
                <label><input type="checkbox">Hip Hop</label>
                <label><input type="checkbox">Reggae</label>
                <label><input type="checkbox">Blues</label>
                <label><input type="checkbox">Classical</label>
                <label><input type="checkbox">Folk, World & Country</label>
                <label><input type="checkbox">Jazz</label>
                <label><input type="checkbox">Latin</label>
                <label><input type="checkbox">Non-Music</label>
                <label><input type="checkbox">Brass & Military</label>
                <label><input type="checkbox">Stage & Screen</label>
            </div>
        </div>

        <!-- Notes -->
        <div class="sec">
            <div class="sec-title">Notes <span class="info">ⓘ</span></div>
            <textarea rows="5"></textarea>
        </div>

        <div class="sec">
            <div class="sec-title">Submission Notes <span class="req">*</span> <span class="info">ⓘ</span></div>
            <textarea rows="5"></textarea>
        </div>

        <div class="sec">
            <div>
                <label><input type="checkbox"> Add to My Collection</label>
            </div>
        </div>

        <div class="sec">
            <div class="sec-title">Rating</div>

            <div class="rating">
                <label><input type="radio" name="r"><br>No rating</label>

                @for($i=1;$i<=5;$i++)
                <label><input type="radio" name="r"><br>{{$i}}</label>
                @endfor
            </div>
        </div>

        <div style="text-align:right;margin-top:22px;">
            <button class="btn">Save Draft</button>
            <button class="btn btn-green">Preview / Submit</button>
        </div>

    </div>

    <!-- Sidebar -->
    <div class="side-guide">
        <div class="side-card">

            <div class="side-title">ⓘ Guidelines Reference</div>

            @for($i=1;$i<=13;$i++)
            <a href="#" class="guide-link">
                <span>
                    {{$i}}.
                    @switch($i)
                        @case(1) General Rules @break
                        @case(2) Artist @break
                        @case(3) Title @break
                        @case(4) Label/Catalog @break
                        @case(5) Barcodes and Other Identifiers @break
                        @case(6) Format @break
                        @case(7) Country @break
                        @case(8) Release Date @break
                        @case(9) Genres/Styles @break
                        @case(10) Credits @break
                        @case(11) Release Notes @break
                        @case(12) Tracklisting @break
                        @case(13) Images @break
                    @endswitch
                </span>
                <span>↗</span>
            </a>
            @endfor

            <a href="#" class="help-link">Search Help Center ↗</a>

        </div>
    </div>

</div>

<script>
//add anv
document.addEventListener("click", function(e) {

  if (e.target.classList.contains("btn-format")) {
    const row = e.target.closest(".row");
    const anvInput = row.querySelector(".input-format");

    if (anvInput.style.display === "none") {
      anvInput.style.display = "inline-block";
      e.target.textContent = "Remove ANV";
    } else {
      anvInput.style.display = "none";
      anvInput.value = "";
      e.target.textContent = "Add ANV";
    }
  }

});

// remove artist
document.addEventListener("click", function(e) {

  const removeBtn = e.target.closest(".btn-remove");
  if (!removeBtn) return;

  const row = removeBtn.closest(".row");
  const container = document.getElementById("artistContainer");

  if (container.children.length > 1) {
    row.remove();
    updateRemoveButtons();
  }
});

function updateRemoveButtons() {
  const rows = document.querySelectorAll("#artistContainer .row");

  rows.forEach(row => {
    const btn = row.querySelector(".btn-remove");

    if (rows.length > 1) {
      btn.style.display = "inline-block";
    } else {
      btn.style.display = "none";
    }
  });
}

// add artist
document.addEventListener("click", function(e) {

  if (e.target.classList.contains("btn-plus")) {

    // khusus artist section
    const container = document.getElementById("artistContainer");
    if (!container) return;

    const firstRow = container.querySelector(".row");
    const newRow = firstRow.cloneNode(true);

    // reset input
    newRow.querySelector(".input-medium").value = "";
    newRow.querySelector(".input-format").value = "";
    newRow.querySelector(".input-format").style.display = "none";

    // reset tombol ANV
    newRow.querySelector(".btn-format").textContent = "Add ANV";

    container.appendChild(newRow);
    updateRemoveButtons();
  }

});
</script>

@endsection