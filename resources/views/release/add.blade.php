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
.btn{border:1px solid #bbb;background:#fff;padding:4px 18px; font-size:13px; cursor:pointer; border-radius:3px;}
.btn + .btn{margin-left:8px; background:#f5f5f5;}
.btn-green{background:green;color:#fff; border:none;font-weight:700;}
.btn-dark{background:#000;color:#fff;border:none;}
.btn-format{border:1px solid #bbb; border-radius: 3px; background:#f5f5f5; font-size:12px; padding: 4px 5px; width:80px;}
/* SECTION */
.sec{border:1px solid var(--border);border-top:none;padding:28px;}
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
.small{width:160px;}
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
.grid3{
    display:grid;
    grid-template-columns: 220px 1fr 280px;
    gap:18px;
}
/* FORMAT */
.format-box{
    border:1px solid var(--border);
    background:#fafafa;
    padding:18px;
    margin-top:16px;
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
.track-table{
    width:100%;
    border-collapse:collapse;
    margin-top:10px;
}
.track-table th{
    text-align:left;
    background:#f2f2f2;
    font-size:15px;
    padding:14px;
    border:1px solid #ddd;
}
.track-table td{
    border:1px solid #eee;
    padding:14px;
    vertical-align:top;
}
.mini-link{
    color:#2457d6;
    text-decoration:none;
    font-size:15px;
}
/* GENRE */
.genre-grid{display:grid;grid-template-columns:repeat(5,1fr);gap:10px 20px;}
/* SIDEBAR */
.side-card{ border-left:1px solid #ddd;padding-left:22px;position:sticky;top:15px;}
.side-title{font-size:15px; font-weight:700; margin-bottom:18px;}
.guide-link{ display:flex;justify-content:space-between;padding:16px 0;border-bottom:1px solid #ececec;text-decoration:none;color:#111;font-size:15px;font-weight:700;}
.help-link{display:inline-block;margin-top:22px;color:#2457d6;text-decoration:none;font-size:15px;}
/* CHECK / RADIO */
.add.input[type=checkbox],
.add.input[type=radio]{ transform:scale(1.6);margin-right:10px;}
.input-medium{ max-width: 400px; border: 1px solid #000; border-radius:3px; padding:2px; margin-left: 10px; background-color:white;}
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
                <button class="btn btn-green">Preview / Submit</button>
            </div>
        </div>

        <!-- Images -->
        <div class="sec">
            <div class="sec-title">Images <span class="info">ⓘ</span></div>

            <div class="image-grid">
                <div class="drop">
                    <p>⬆</p>
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
            <div class="sec-title">Artists <span class="req">*</span> <span class="info">ⓘ</span></div>

            <div class="row">
                <input type="text" class="input-medium" placeholder="Name">
                <button class="btn-format">Add ANV</button>
            </div>

            <button class="btn">+ Add artist</button>
        </div>

        <!-- Title -->
        <div class="sec">
            <div class="sec-title">Title <span class="req">*</span> <span class="info">ⓘ</span></div>
            <input type="text" class="input-medium" placeholder="Title">
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
            <br>
            <button class="btn">+ Add label</button>
        </div>

        <!-- Barcodes -->
        <div class="sec">
            <div class="sec-title">Barcodes and Other Identifiers <span class="info">ⓘ</span></div>

            <button class="btn">+ Add barcode or other identifier</button>
        </div>

        <!-- Format -->
        <div class="sec">
            <div class="sec-title">Format <span class="req">*</span> <span class="info">ⓘ</span></div>

            <div class="row">
                <select style="max-width:420px;">
                    <option>Vinyl</option>
                </select>

                <span style="font-size:15px;">Qty:</span>
                <input type="text" class="small" value="1">
                <span style="font-size:34px;">▲</span>
            </div>

            <div class="format-box">
                <div class="format-grid">
                    <div>
                        <b style="font-size:15px;">Size *</b><br><br>
                        <label><input type="checkbox">LP</label>
                        <label><input type="checkbox">12"</label>
                        <label><input type="checkbox">7"</label>
                    </div>

                    <div>
                        <b style="font-size:15px;">Speed</b><br><br>
                        <label><input type="checkbox">33⅓ RPM</label>
                        <label><input type="checkbox">45 RPM</label>
                    </div>

                    <div>
                        <b style="font-size:15px;">Description</b><br><br>
                        <label><input type="checkbox">Album</label>
                        <label><input type="checkbox">EP</label>
                    </div>

                    <div>
                        <b style="font-size:15px;">Channels</b><br><br>
                        <label><input type="checkbox">Stereo</label>
                        <label><input type="checkbox">Mono</label>
                    </div>
                </div>
            </div>
        </div>

        <!-- Track -->
        <div class="sec">
            <div class="row" style="justify-content:space-between;">
                <div class="sec-title" style="margin:0;">Tracklist <span class="req">*</span></div>

                <div>
                    <a href="#" class="mini-link">Edit all Track Artists/Credits</a>
                    &nbsp; | &nbsp;
                    <a href="#" class="mini-link">Save all Track Artists/Credits</a>
                </div>
            </div>

            <table class="track-table">
                <tr>
                    <th>Position</th>
                    <th>Artist</th>
                    <th>Title/Credits</th>
                    <th>Duration</th>
                </tr>

                @for($i=0;$i<2;$i++)
                <tr>
                    <td><input type="text" placeholder="#"></td>
                    <td><a href="#" class="mini-link">+ Add</a></td>
                    <td>
                        <input type="text" placeholder="Track Title">
                        <div style="margin-top:10px;">
                            Credits <a href="#" class="mini-link">+ Add</a>
                        </div>
                    </td>
                    <td><input type="text" placeholder="0:00"></td>
                </tr>
                @endfor
            </table>
        </div>

        <!-- Genres -->
        <div class="sec">
            <div class="sec-title">Genres <span class="req">*</span></div>

            <div class="genre-grid">
                <label><input type="checkbox">Electronic</label>
                <label><input type="checkbox">Rock</label>
                <label><input type="checkbox">Pop</label>
                <label><input type="checkbox">Hip Hop</label>
                <label><input type="checkbox">Jazz</label>
                <label><input type="checkbox">Funk / Soul</label>
                <label><input type="checkbox">Reggae</label>
                <label><input type="checkbox">Blues</label>
                <label><input type="checkbox">Latin</label>
                <label><input type="checkbox">Classical</label>
            </div>
        </div>

        <!-- Notes -->
        <div class="sec">
            <div class="sec-title">Notes</div>
            <textarea rows="5"></textarea>
        </div>

        <div class="sec">
            <div class="sec-title">Submission Notes <span class="req">*</span></div>
            <textarea rows="5"></textarea>

            <div style="margin-top:20px;font-size:15px;">
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

@endsection