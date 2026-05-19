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
.top-box h2{margin:0;font-size:20px;font-weight:bold;}
/* BUTTON */
.btn{border:1px solid #bbb;background:#fff;padding:4px 18px;font-size:13px;cursor:pointer;border-radius:3px;}
.btn-plus{border:1px solid #000;background:#f5f5f5;padding:4px 18px;font-size:13px;cursor:pointer;border-radius:3px;}
.btn-green{background:#158a1b;color:#fff;border:none;padding:5px 10px;font-size:13px;border-radius:3px;cursor:pointer;font-weight:bold;}
.btn-dark{background:#000;color:#fff;border:none;}
.btn-format{border:1px solid #bbb;border-radius:3px;background:#f5f5f5;font-size:12px;padding:4px 5px;width:90px;}
/* SECTION */
.sec{border:1px solid var(--border);border-top:none;padding:10px 20px 15px 25px;}
.sec-title{font-size:15px;font-weight:700;margin-bottom:18px;}
.info{color:#28a9df;font-size:15px;}
.req{color:#cc0000;}
select,textarea{width:100%;border:1px solid #9f9f9f;padding:2px 10px;font-size:15px;box-sizing:border-box;background:#fff;}
textarea{resize:vertical;}
.input-medium{max-width:400px;border:1px solid #000;border-radius:3px;padding:2px;margin-left:10px;background-color:white;}
.input-small{max-width:50px;border:1px solid #000;border-radius:3px;padding:2px;margin-left:10px;background-color:white;}
.input-format{max-width:350px;border:1px solid #000;border-radius:3px;padding:2px;margin-left:10px;background-color:white;}
/* IMAGE */
.image-grid{display:grid;grid-template-columns:1.8fr 1fr;gap:30px;}
.drop{border:2px dashed var(--border);padding:30px;text-align:center;background:#fafafa;border-radius:4px;}
.drop p{font-size:15px;margin:10px 0;}
.drop small{display:block;color:#666;font-size:13px;margin-top:18px;}
.rule{display:flex;gap:18px;margin-bottom:24px;font-size:15px;line-height:1.45;}
.rule-no{width:45px;height:45px;border-radius:50%;background:#f0d730;display:flex;align-items:center;justify-content:center;font-weight:700;flex-shrink:0;}
/* FLEX */
.row{display:flex;gap:18px;align-items:center;margin-bottom:16px;background-color:#f5f5f5;padding:9px 1px 9px;border:1px solid #ddd;}
.grid3{display:grid;grid-template-columns:220px 1fr 280px;gap:18px;}
/* FORMAT */
.format-entry{border:1px solid var(--border);border-radius:3px;margin-bottom:10px;overflow:hidden;}
.format-header{display:flex;align-items:center;gap:10px;background:#f5f5f5;padding:8px 12px;border-bottom:1px solid var(--border);}
.format-header .fmt-type-select{flex:1;max-width:240px;border:1px solid #9f9f9f;padding:4px 8px;font-size:14px;border-radius:3px;background:#fff;width:auto;}
.qty-wrap{display:flex;align-items:center;gap:6px;font-size:13px;color:#555;}
.qty-wrap .qty-input{max-width:48px;border:1px solid #9f9f9f;border-radius:3px;padding:4px 6px;text-align:center;font-size:13px;background:#fff;margin-left:0;}
.qty-btn{background:#fff;border:1px solid #bbb;border-radius:3px;width:24px;height:24px;cursor:pointer;font-size:15px;display:flex;align-items:center;justify-content:center;line-height:1;}
.qty-btn:hover{background:#eee;}
.toggle-format-btn{margin-left:auto;background:#fff;border:1px solid #bbb;border-radius:3px;padding:4px 12px;font-size:12px;cursor:pointer;color:#333;display:flex;align-items:center;gap:5px;white-space:nowrap;}
.toggle-format-btn:hover{background:#eee;}
.toggle-format-btn .chevron{display:inline-block;transition:transform .2s;font-size:10px;}
.toggle-format-btn.open .chevron{transform:rotate(180deg);}
.btn-remove-format{background:none;border:none;cursor:pointer;padding:2px 6px;display:inline-flex;align-items:center;justify-content:center;color:#555;flex-shrink:0;}
.btn-remove-format:hover{color:#cc0000;}
.format-panel{padding:16px 18px;display:none;background:#fafafa;}
.format-panel.open{display:block;}
.format-grid{display:grid;grid-template-columns:repeat(4,1fr);gap:18px;}
.format-grid label{display:block;font-size:14px;margin-bottom:8px;cursor:pointer;}
.genre-grid label{display:block;font-size:15px;margin-bottom:12px;}
.format-free-input{width:100%;border:1px solid #9f9f9f;border-radius:3px;padding:4px 8px;font-size:13px;margin-top:4px;box-sizing:border-box;}
/* TRACKLIST */
.tracklist-header{display:flex;justify-content:space-between;align-items:center;margin-bottom:8px;}
.track-table{width:100%;border-collapse:collapse;border:1px solid #ccc;font-size:13px;}
.track-table th{background:#f2f2f2;border-bottom:1px solid #ccc;padding:6px;text-align:left;}
.track-table td{border-top:1px solid #eee;padding:6px;vertical-align:middle;}
.input-track{width:100%;padding:4px 6px;border:1px solid #bbb;border-radius:2px;font-size:13px;}
.input-track.small{width:70px;}
.add-link{color:#333;text-decoration:none;font-size:13px;}
.add-link span{font-weight:bold;margin-right:3px;}
.credits{font-size:12px;color:#555;margin-top:4px;}
.drag{text-align:center;color:#aaa;cursor:move;}
.arrow{text-align:center;color:#aaa;cursor:pointer;font-size:11px;}
.track-footer{margin-top:10px;background:#f5f5f5;padding:8px;border:1px solid #ddd;display:flex;gap:6px;align-items:center;}
.track-footer button{background:#fff;border:1px solid #bbb;padding:4px 8px;font-size:12px;cursor:pointer;}
.track-footer button:hover{background:#eee;}
.mini-link{color:#2457d6;text-decoration:none;font-size:13px;}
/* GENRE */
.genre-grid{display:grid;grid-template-columns:repeat(5,1fr);}
/* SIDEBAR */
.side-card{border-left:1px solid #ddd;padding-left:22px;position:sticky;top:15px;}
.side-title{font-size:15px;font-weight:700;margin-bottom:18px;}
.guide-link{display:flex;justify-content:space-between;padding:16px 0;border-bottom:1px solid #ececec;text-decoration:none;color:#111;font-size:15px;font-weight:700;}
.help-link{display:inline-block;margin-top:22px;color:#2457d6;text-decoration:none;font-size:15px;}
/* CHECK / RADIO */
.rating{display:flex;gap:30px;margin-top:15px;}
.rating label{text-align:center;font-size:15px;}
/* REMOVE BUTTON */
.btn-remove{background:none;border:none;cursor:pointer;padding:2px 6px;display:inline-flex;align-items:center;justify-content:center;color:#555;flex-shrink:0;}
.btn-remove:hover{color:#cc0000;}
.btn-remove svg,.btn-remove-format svg{pointer-events:none;}

/* ══════════════════════════════════════════
   PREVIEW PANEL STYLES
══════════════════════════════════════════ */
#previewPanel {
    display: none;
    border: 1px solid #ccc;
    margin-bottom: 18px;
    background: #fff;
}
#previewPanel .preview-header {
    background: #e0e0e0;
    border-bottom: 1px solid #ccc;
    padding: 6px 10px;
    font-weight: bold;
    font-size: 13px;
    display: flex;
    justify-content: space-between;
    align-items: center;
}
#previewPanel .preview-close {
    cursor: pointer;
    color: #555;
    font-size: 15px;
    font-weight: normal;
}
#previewPanel .preview-body {
    padding: 24px;
}
.preview-release-info { display: flex; gap: 16px; align-items: flex-start; }
.preview-thumb-wrap { display: flex; flex-direction: column; align-items: center; flex-shrink: 0; }
.preview-thumb { width: 140px; height: 140px; background: #e8e8e8; border: 1px solid #bbb; display: flex; align-items: center; justify-content: center; overflow: hidden; }
.preview-thumb img { width: 100%; height: 100%; object-fit: cover; display: none; }
.vinyl-placeholder { width: 120px; height: 120px; border-radius: 50%; background: repeating-radial-gradient(circle at 50% 50%, #888 0px, #666 2px, #555 4px, #444 6px, #555 8px, #666 10px, #777 12px); display: flex; align-items: center; justify-content: center; }
.vinyl-center { width: 18px; height: 18px; border-radius: 50%; background: #ccc; border: 1px solid #aaa; }
.preview-details { flex: 1; }
.preview-title { font-size: 17px; font-weight: bold; margin-bottom: 8px; color: #333; }
.preview-table { border-collapse: collapse; }
.preview-table td { padding: 2px 10px 2px 0; vertical-align: top; font-size: 13px; color: #333; }
.preview-table td:first-child { min-width: 80px; }
.preview-tracklist { margin-top: 14px; padding-top: 10px; }
.preview-tracklist-label { font-weight: bold; font-size: 13px; margin-bottom: 6px; border-bottom: 1px solid #ddd; }
.preview-track-table { width: 100%; border-collapse: collapse; }
.preview-track-table td { padding: 3px 6px; font-size: 13px; color: #333; }
.preview-track-table td:first-child { width: 30px; }
.preview-track-table td:last-child { text-align: right; }
.preview-notes-area { margin-top: 14px; margin-bottom: 12px; }
.preview-notes-label { font-weight: bold; font-size: 13px; margin-bottom: 4px; }
.preview-notes-text { font-size: 13px; color: #333; background: #f9f9f9; padding: 8px; border: 1px solid #ddd; border-radius: 4px; }
.before-submit { background: #f5f5f5; border-radius: 6px; padding: 10px 14px; margin-top: 12px; }
.before-submit .bs-title { font-weight: bold; margin-bottom: 6px; font-size: 13px; }
.before-submit ul { padding-left: 20px; margin-bottom: 8px; }
.before-submit ul li { margin-bottom: 3px; line-height: 1.5; }
.before-submit p { margin-bottom: 6px; line-height: 1.6; }
.before-submit ol { padding-left: 20px; margin-bottom: 8px; }
.before-submit ol li { margin-bottom: 3px; line-height: 1.5; }
.before-submit .ip-warning { font-weight: bold; margin-bottom: 10px; line-height: 1.5; }
.btn-submit { background: #228B22; color: #fff; border: 1px solid #3a6018; padding: 8px 18px; font-size: 13px; cursor: pointer; font-weight: bold; border-radius: 3px; }
.btn-submit:hover { background: #1a6e18; }
</style>

<div class="release-wrap">

    <div class="main-release">

        <div class="top-title">Add Release</div>
        <div class="top-links">
            <a href="#">Quick Start Guide</a>
            <a href="#">Submission Guidelines</a>
        </div>

        {{-- ══════════════════════════════════════════
             PANEL PREVIEW (tersembunyi, muncul saat klik Preview/Submit)
        ══════════════════════════════════════════ --}}
        <div id="previewPanel">
            <div class="preview-header">
                Preview / Submit
                <span class="preview-close" onclick="closePreview()">&#x2715;</span>
            </div>
            <div class="preview-body">

                {{-- Release Info --}}
                <div class="preview-release-info">
                    <div class="preview-thumb-wrap">
                        <div class="preview-thumb">
                            <img id="prevImg" src="" alt="Release Image">
                            <div class="vinyl-placeholder" id="prevVinyl">
                                <div class="vinyl-center"></div>
                            </div>
                        </div>
                        <div style="font-size:11px;color:#1a6ebf;text-align:center;margin-top:4px;">Add an image</div>
                    </div>

                    <div class="preview-details">
                        <div class="preview-title" id="prevTitle">–</div>
                        <table class="preview-table">
                            <tr id="prevLabelRow"><td>Label:</td><td id="prevLabel">–</td></tr>
                            <tr id="prevFormatRow"><td>Format:</td><td id="prevFormat">–</td></tr>
                            <tr><td>Country:</td><td id="prevCountry">–</td></tr>
                            <tr><td>Released:</td><td id="prevDate">–</td></tr>
                            <tr id="prevGenreRow"><td>Genres:</td><td id="prevGenres">–</td></tr>
                            <tr id="prevNotesRow"><td>Notes:</td><td id="prevNotes">–</td></tr>
                        </table>
                    </div>
                </div>

                {{-- Tracklist --}}
                <div class="preview-tracklist" id="prevTracklistSection" style="display:none;">
                    <div class="preview-tracklist-label">Tracklist</div>
                    <table class="preview-track-table" id="prevTrackTable"></table>
                </div>

                {{-- Submission Notes --}}
                <div class="preview-notes-area" id="prevSubNotesSection" style="display:none;">
                    <div class="preview-notes-label">Submission Notes:</div>
                    <div class="preview-notes-text" id="prevSubNotes"></div>
                </div>

                {{-- Before Submit --}}
                <div class="before-submit">
                    <div class="bs-title">Before you submit:</div>
                    <ul>
                        <li>Test all hyperlinks and make sure they link to the correct artist/label</li>
                        <li>Read and understand the <a href="#">Submission Guide</a></li>
                        <li>Read and understand the <strong>Image Intellectual Property Rules</strong></li>
                    </ul>
                    <p><b>By uploading images to Discogs you agree that the image meets one of the following requirements:</b></p>
                    <ol>
                        <li>1. Image is Public Domain; or</li>
                        <li>2. You own the rights to the image and agree to make it available via a CC0 license; or</li>
                        <li>3. Image is already made available through a CC0 license; or</li>
                        <li>4. Fair Use – for the purpose of critical commentary or reselling under the First Sale Doctrine.</li>
                    </ol>
                    <p class="ip-warning">You may be held personally liable for image uploads that violate intellectual property protections.</p>
                    {{-- Tombol ini submit form beneran ke server --}}
                    <button type="button" class="btn-submit" onclick="submitForm()">I agree, Submit</button>
                </div>

            </div>
        </div>
        {{-- END PREVIEW PANEL --}}

        <form action="{{ route('releases.store') }}" method="POST" enctype="multipart/form-data" id="releaseForm">
        @csrf

        <div class="top-box">
            <h2>Add Release</h2>
            <div>
                <button type="button" class="btn">Save Draft</button>
                {{-- Ubah jadi type="button" supaya ga langsung submit --}}
                <button type="button" class="btn-green" onclick="showPreview()">Preview / Submit</button>
            </div>
        </div>

        <!-- Images -->
        <div class="sec">
            <div class="sec-title">Images <span class="info">ⓘ</span></div>
            <div class="image-grid">
                <div class="drop" id="dropZone" style="cursor: pointer;">
                    <p>
                        <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 -960 960 960" width="40px" fill="#000">
                            <path d="M440-320v-326L336-542l-56-58 200-200 200 200-56 58-104-104v326h-80ZM240-160q-33 0-56.5-23.5T160-240v-120h80v120h480v-120h80v120q0 33-23.5 56.5T720-160H240Z"/>
                        </svg>
                    </p>
                    <p>Drag and drop image files here</p>
                    <p>or</p>
                    <button type="button" class="btn btn-dark" id="browseBtn">Browse files</button>
                    <input type="file" name="release_image" id="fileInput" accept=".jpg,.jpeg,.gif,.png" style="display: none;">
                    <div id="filePreview" style="margin-top: 10px; font-weight: bold; color: var(--green);"></div>
                    <small>Accepted image formats are .jpg, .gif, .png. Images must be larger than 150 px wide and less than 4 MB.</small>
                </div>
                <div>
                    <div style="font-size:15px;font-weight:700;margin-bottom:18px;">Image Rules and Requirements</div>
                    <div class="rule"><div class="rule-no">1</div><div>Images must match the exact version of the release.</div></div>
                    <div class="rule"><div class="rule-no">2</div><div>Do not upload images with watermarks, or images of generic sleeves.</div></div>
                    <div class="rule"><div class="rule-no">3</div><div>Do not copy images from the Internet unless one of the Intellectual Property Rules requirements is met.</div></div>
                </div>
            </div>
        </div>

        <!-- ARTISTS -->
        <div class="sec">
            <div class="sec-title">Artists <span class="req">*</span></div>
            <div id="artistContainer">
                <div class="row artist-row">
                    <div class="grid3" style="align-items:center;">
                        <input type="text" class="input-medium" placeholder="Name" name="artists[]">
                        <div style="display:flex;align-items:center;gap:8px;">
                            <button type="button" class="btn-format btn-anv">Add ANV</button>
                            <input type="text" class="input-format anv-input" placeholder="ANV" style="display:none;margin-left:0;" name="anvs[]">
                        </div>
                        <div style="display:flex;align-items:center;gap:6px;">
                            <input type="text" class="input-format" placeholder="Join phrase (e.g. &, feat.)" name="joins[]">
                            <button type="button" class="btn-remove btn-remove-artist" title="Remove artist">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 -960 960 960" width="22px" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn-plus" id="addArtistBtn">+ Add artist</button>
        </div>

        <!-- Title -->
        <div class="sec">
            <div class="sec-title">Title <span class="req">*</span> <span class="info">ⓘ</span></div>
            <input type="text" class="input-medium" placeholder="Title" style="margin-left:-2px" name="title" id="inputTitle">
        </div>

        <!-- LABEL -->
        <div class="sec">
            <div class="sec-title">Label, Company, Catalog Number, Etc. <span class="req">*</span> <span class="info">ⓘ</span></div>
            <div id="labelContainer">
                <div class="row label-row">
                    <div class="grid3" style="align-items:center;">
                        <select name="label_types[]">
                            <option value="">Label</option>
                            @foreach($labels as $label)
                            <option value="{{ $label->label_id }}">{{ $label->name }}</option>
                            @endforeach
                        </select>
                        <input type="text" class="input-medium" placeholder="Name" name="label_names[]">
                        <div style="display:flex;align-items:center;gap:6px;">
                            <input type="text" class="input-medium" placeholder="Catalog Number" style="margin-left:0;" name="catalog_nos[]">
                            <button type="button" class="btn-remove btn-remove-label" title="Remove label">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 -960 960 960" width="22px" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn-plus" id="addLabelBtn">+ Add label</button>
        </div>

        <!-- BARCODES -->
        <div class="sec">
            <div class="sec-title">Barcodes and Other Identifiers <span class="info">ⓘ</span></div>
            <div id="barcodeContainer">
                <div class="row barcode-row">
                    <div class="grid3" style="align-items:center;">
                        <input type="text" name="identifiers_type[]" class="input-medium" placeholder="Type (e.g. Barcode, Matrix)">
                        <input type="text" name="identifiers_value[]" class="input-medium" placeholder="Value">
                        <div style="display:flex;align-items:center;gap:6px;">
                            <input type="text" name="identifiers_desc[]" class="input-medium" placeholder="Description (Optional)" style="margin-left:0;">
                            <button type="button" class="btn-remove btn-remove-barcode" title="Remove barcode">
                                <svg xmlns="http://www.w3.org/2000/svg" height="22px" viewBox="0 -960 960 960" width="22px" fill="currentColor"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <button type="button" class="btn-plus" id="addBarcodeBtn">+ Add barcode or other identifier</button>
        </div>

        <!-- FORMAT -->
        <div class="sec">
            <div class="sec-title">Format <span class="req">*</span> <span class="info">ⓘ</span></div>
            <div id="formatContainer"></div>
            <button type="button" class="btn-plus" id="addFormatBtn">+ Add Format</button>
        </div>

        <!-- Country -->
        <div class="sec">
            <div class="sec-title">Country <span class="info">ⓘ</span></div>
            <select name="country" id="inputCountry" style="max-width:300px;">
                <option value=""></option>
                @foreach($countries as $c)
                    <option value="{{ $c->country }}">{{ $c->country }}</option>
                @endforeach
            </select>
        </div>

        <!-- Released -->
        <div class="sec">
            <div class="sec-title">Released <span class="info">ⓘ</span></div>
            <input type="date" name="release_date" id="inputDate" class="input-medium" placeholder="Date" style="margin-left:-2px">
        </div>

        <!-- Tracklist -->
        <div class="sec">
            <div class="tracklist-header">
                <span class="sec-title">Tracklist <span class="req">*</span> <span class="info">ⓘ</span></span>
                <div>
                    <a href="#" class="mini-link">Edit all Track Artists/Credits</a>
                    <span class="separator">|</span>
                    <a href="#" class="mini-link">Save all Track Artists/Credits</a>
                </div>
            </div>
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
                <tbody id="trackBody">
                    @for($i=0; $i<4; $i++)
                    <tr>
                        <td class="drag">↕</td>
                        <td><input type="text" class="input-track small" placeholder="#" name="track_positions[]" value="{{ $i + 1 }}"></td>
                        <td><a href="#" class="add-link"><span>+</span> Add</a></td>
                        <td>
                            <input type="text" name="track_titles[]" class="input-track" placeholder="Track Title">
                            <div class="credits">Credits <a href="#" class="add-link"><span>+</span> Add</a></div>
                        </td>
                        <td><input type="text" name="track_durations[]" class="input-track small" placeholder="0:00"></td>
                        <td class="arrow">▼</td>
                    </tr>
                    @endfor
                </tbody>
            </table>
            <div class="track-footer">
                <select style="width:auto;">
                    <option>1</option><option>2</option><option>3</option><option>4</option><option>5</option>
                </select>
                <button type="button" id="addTracksBtn">Add Tracks</button>
                <span class="separator">|</span>
                <button type="button">Auto-number Tracks</button>
                <button type="button">Add Artist Per Track</button>
                <button type="button">Add Credit Per Track</button>
            </div>
        </div>

        <!-- Genres -->
        <div class="sec">
            <div class="sec-title">Genres <span class="req">*</span> <span class="info">ⓘ</span></div>
            <div class="genre-grid">
                @foreach($genres as $g)
                <label>
                    <input type="checkbox" name="genres[]" value="{{ $g->name }}" class="genre-check"> {{ $g->name }}
                </label>
                @endforeach
            </div>
        </div>

        <!-- Notes -->
        <div class="sec">
            <div class="sec-title">Notes <span class="info">ⓘ</span></div>
            <textarea name="notes" id="inputNotes" rows="5"></textarea>
        </div>

        <div class="sec">
            <div class="sec-title">Submission Notes <span class="req">*</span> <span class="info">ⓘ</span></div>
            <textarea name="submission_notes" id="inputSubNotes" rows="5" required></textarea>
        </div>

        <div class="sec">
            <label><input type="checkbox"> Add to My Collection</label>
        </div>

        <div class="sec">
            <div class="sec-title">Rating</div>
            <div class="rating">
                <label><input type="radio" name="rating" value="0" checked><br>No rating</label>
                @for($i = 1; $i <= 5; $i++)
                <label><input type="radio" name="rating" value="{{ $i }}"><br>{{ $i }}</label>
                @endfor
            </div>
        </div>

        <div style="text-align:right;margin-top:22px;">
            <button type="button" class="btn">Save Draft</button>
            <button type="button" class="btn btn-green" onclick="showPreview()">Preview / Submit</button>
        </div>

        </form>
    </div><!-- /main-release -->

    <!-- Sidebar -->
    <div class="side-guide">
        <div class="side-card">
            <div class="side-title">ⓘ Guidelines Reference</div>
            @for($i=1;$i<=13;$i++)
            <a href="#" class="guide-link">
                <span>{{$i}}.
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

</div><!-- /release-wrap -->

<script>

/* ══════════════════════════════════════════
   PREVIEW PANEL LOGIC
══════════════════════════════════════════ */
function showPreview() {
    // 1. Artist
    const artistInputs = document.querySelectorAll('[name="artists[]"]');
    const artists = [...artistInputs].map(i => i.value.trim()).filter(Boolean).join(', ');

    // 2. Title
    const title = document.getElementById('inputTitle').value.trim();

    // 3. Label + Catalog
    const labelRows = document.querySelectorAll('.label-row');
    const labelParts = [];
    labelRows.forEach(row => {
        const select = row.querySelector('select[name="label_types[]"]');
        const catNo  = row.querySelector('[name="catalog_nos[]"]');
        const selectedText = select ? select.options[select.selectedIndex]?.text : '';
        const cat = catNo ? catNo.value.trim() : '';
        if (selectedText && selectedText !== 'Label') {
            labelParts.push(selectedText + (cat ? ' — ' + cat : ''));
        }
    });

    // 4. Format
    const formatSelects = document.querySelectorAll('[name="formats[]"]');
    const formats = [...formatSelects].map(s => s.value).filter(Boolean).join(', ');

    // 5. Country
    const countryEl = document.getElementById('inputCountry');
    const country = countryEl ? countryEl.value : '';

    // 6. Date
    const dateEl = document.getElementById('inputDate');
    const date = dateEl ? dateEl.value : '';

    // 7. Genres
    const genreChecks = document.querySelectorAll('.genre-check:checked');
    const genres = [...genreChecks].map(c => c.value).join(', ');

    // 8. Notes
    const notes = document.getElementById('inputNotes').value.trim();

    // 9. Submission Notes
    const subNotes = document.getElementById('inputSubNotes').value.trim();

    // 10. Tracks
    const trackTitles    = document.querySelectorAll('[name="track_titles[]"]');
    const trackPositions = document.querySelectorAll('[name="track_positions[]"]');
    const trackDurations = document.querySelectorAll('[name="track_durations[]"]');

    // 11. Image preview
    const fileInput = document.getElementById('fileInput');
    const prevImg   = document.getElementById('prevImg');
    const prevVinyl = document.getElementById('prevVinyl');
    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();
        reader.onload = e => {
            prevImg.src = e.target.result;
            prevImg.style.display = 'block';
            prevVinyl.style.display = 'none';
        };
        reader.readAsDataURL(fileInput.files[0]);
    } else {
        prevImg.style.display = 'none';
        prevVinyl.style.display = 'flex';
    }

    // ── Isi panel preview ──
    document.getElementById('prevTitle').textContent =
        (artists || 'Unknown Artist') + ' – ' + (title || 'Untitled');

    document.getElementById('prevLabel').textContent  = labelParts.join(', ') || '–';
    document.getElementById('prevFormat').textContent = formats || '–';
    document.getElementById('prevCountry').textContent = country || '–';
    document.getElementById('prevDate').textContent   = date || '–';
    document.getElementById('prevGenres').textContent = genres || '–';

    // Notes
    if (notes) {
        document.getElementById('prevNotes').textContent = notes;
        document.getElementById('prevNotesRow').style.display = '';
    } else {
        document.getElementById('prevNotesRow').style.display = 'none';
    }

    // Tracks
    const trackSection = document.getElementById('prevTracklistSection');
    const trackTable   = document.getElementById('prevTrackTable');
    trackTable.innerHTML = '';
    let hasTrack = false;
    trackTitles.forEach((t, i) => {
        if (t.value.trim()) {
            hasTrack = true;
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${trackPositions[i]?.value || (i + 1)}</td>
                <td>${t.value.trim()}</td>
                <td>${trackDurations[i]?.value || ''}</td>
            `;
            trackTable.appendChild(tr);
        }
    });
    trackSection.style.display = hasTrack ? 'block' : 'none';

    // Submission Notes
    const subSection = document.getElementById('prevSubNotesSection');
    if (subNotes) {
        document.getElementById('prevSubNotes').textContent = subNotes;
        subSection.style.display = 'block';
    } else {
        subSection.style.display = 'none';
    }

    // Tampilkan panel & scroll ke atas
    const panel = document.getElementById('previewPanel');
    panel.style.display = 'block';
    panel.scrollIntoView({ behavior: 'smooth', block: 'start' });
}

function closePreview() {
    document.getElementById('previewPanel').style.display = 'none';
}

function submitForm() {
    document.getElementById('releaseForm').submit();
}

/* ══════════════════════════════════════════
   FILE UPLOAD
══════════════════════════════════════════ */
document.addEventListener('DOMContentLoaded', function() {
    const dropZone  = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const browseBtn = document.getElementById('browseBtn');
    const filePreview = document.getElementById('filePreview');

    if (browseBtn && fileInput) {
        browseBtn.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            fileInput.click();
        });

        dropZone.addEventListener('click', function () { fileInput.click(); });

        fileInput.addEventListener('change', function () {
            if (fileInput.files.length > 0) {
                filePreview.textContent = "Selected file: " + fileInput.files[0].name;
            } else {
                filePreview.textContent = "";
            }
        });

        dropZone.addEventListener('dragover', function (e) {
            e.preventDefault();
            dropZone.style.background = '#e3f2fd';
        });
        dropZone.addEventListener('dragleave', function () { dropZone.style.background = ''; });
        dropZone.addEventListener('drop', function (e) {
            e.preventDefault();
            dropZone.style.background = '';
            if (e.dataTransfer.files.length > 0) {
                fileInput.files = e.dataTransfer.files;
                filePreview.textContent = "Dropped file: " + e.dataTransfer.files[0].name;
            }
        });
    }
});

/* ══════════════════════════════════════════
   HELPER
══════════════════════════════════════════ */
function removeIcon(size) {
    size = size || '22px';
    return `<svg xmlns="http://www.w3.org/2000/svg" height="${size}" viewBox="0 -960 960 960" width="${size}" fill="currentColor" style="pointer-events:none;">
        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
    </svg>`;
}

function refreshRemove(containerId, btnClass) {
    const rows = document.querySelectorAll(`#${containerId} .row`);
    rows.forEach(row => {
        const btn = row.querySelector(`.${btnClass}`);
        if (btn) btn.style.visibility = rows.length > 1 ? 'visible' : 'hidden';
    });
}

/* ══════════════════════════════════════════
   FORMAT
══════════════════════════════════════════ */
const FORMAT_TYPES = ['Vinyl','CD','Cassette','DVD','Blu-ray','SACD','Lathe Cut','Flexi-disc','Shellac','Box Set','All Media'];
const SIZE_OPTS    = ['LP','16"','14"','12"','11"','10"','9"','8"','7"','6½"','6"','5½"','5"','4"','3½"','3"','2"','1"'];
const SPEED_OPTS   = ['8⅓ RPM','16⅔ RPM','33⅓ RPM','45 RPM','78 RPM','80 RPM'];
const DESC_OPTS    = ['Advanced','Album','Mini-Album','EP','Maxi-Single','Record Store Day','Single','Compilation','Bioplastic','Card Backed','Club Edition','Deluxe Edition','Enhanced','Etched','Jukebox','Limited Edition','Mispress','Misprint','Mixed','Mixtape','Numbered','Partially Mixed','Partially Unofficial','Picture Disc','Promo','Reissue','Remastered','Repress','Sampler','Special Cut','Special Edition','Styrene','Test Pressing','Tour Recording','Transcription','Unofficial Release','White Label'];
const CHAN_OPTS    = ['Stereo','Mono','Quadraphonic','Ambisonic'];
let formatCount = 0;

function makeCheckboxes(arr, inputName) {
    if (!arr || arr.length === 0) return '<span style="color:#999;font-size:12px;">No options available</span>';
    return arr.map(o => `<label><input type="checkbox" name="${inputName}" value="${o}"> ${o}</label>`).join('');
}

function makeFormatEntry(defaultFormat) {
    formatCount++;
    const id = 'fmt-' + formatCount;
    const typeOpts = FORMAT_TYPES.map(f =>
        `<option${f === (defaultFormat || 'Vinyl') ? ' selected' : ''}>${f}</option>`
    ).join('');

    const div = document.createElement('div');
    div.className = 'format-entry';
    div.id = id;
    div.innerHTML = `
        <div class="format-header">
            <select class="fmt-type-select" name="formats[]">${typeOpts}</select>
            <div class="qty-wrap">
                <span>Qty:</span>
                <button type="button" class="qty-btn" data-dir="-1">−</button>
                <input type="number" class="qty-input" name="qtys[]" value="1" min="1" max="99">
                <button type="button" class="qty-btn" data-dir="1">+</button>
            </div>
            <button type="button" class="toggle-format-btn" data-target="${id}"><span class="chevron">▼</span></button>
            <button type="button" class="btn-remove-format" data-id="${id}" title="Remove format">${removeIcon('20px')}</button>
        </div>
        <div class="format-panel" id="panel-${id}">
            <div class="format-grid">
                <div><b style="font-size:14px;">Size <span style="color:#cc0000">*</span></b><br>${makeCheckboxes(SIZE_OPTS, 'format_sizes[]')}</div>
                <div><b style="font-size:14px;">Speed</b><br>${makeCheckboxes(SPEED_OPTS, 'format_speeds[]')}<br><b style="font-size:14px;">Shape</b><br><label><input type="checkbox" name="format_shapes[]" value="Shape"> Shape</label><br><b style="font-size:14px;">Sides</b><br><label><input type="checkbox" name="format_sides[]" value="Single Sided"> Single Sided</label></div>
                <div><b style="font-size:14px;">Description</b><br>${makeCheckboxes(DESC_OPTS, 'format_descriptions[]')}</div>
                <div><b style="font-size:14px;">Channels</b><br>${makeCheckboxes(CHAN_OPTS, 'format_channels[]')}<br><b style="font-size:14px;">Free Text</b><br><input type="text" class="format-free-input" name="format_free_texts[]" placeholder="e.g. Green vinyl"></div>
            </div>
        </div>`;
    return div;
}

function refreshFormatRemove() {
    const entries = document.querySelectorAll('.format-entry');
    entries.forEach(e => {
        const btn = e.querySelector('.btn-remove-format');
        if (btn) btn.style.visibility = entries.length > 1 ? 'visible' : 'hidden';
    });
}

document.getElementById('formatContainer').appendChild(makeFormatEntry('Vinyl'));
refreshFormatRemove();

document.getElementById('addFormatBtn').addEventListener('click', function () {
    document.getElementById('formatContainer').appendChild(makeFormatEntry('Vinyl'));
    refreshFormatRemove();
});

document.getElementById('formatContainer').addEventListener('click', function (e) {
    const toggleBtn = e.target.closest('.toggle-format-btn');
    if (toggleBtn) {
        const id    = toggleBtn.dataset.target;
        const panel = document.getElementById('panel-' + id);
        const isOpen = panel.classList.toggle('open');
        toggleBtn.classList.toggle('open', isOpen);
        return;
    }
    const removeBtn = e.target.closest('.btn-remove-format');
    if (removeBtn) {
        const id = removeBtn.dataset.id;
        if (document.querySelectorAll('.format-entry').length > 1) {
            document.getElementById(id).remove();
            refreshFormatRemove();
        }
        return;
    }
    const qtyBtn = e.target.closest('.qty-btn');
    if (qtyBtn) {
        const entry = qtyBtn.closest('.format-entry');
        const inp   = entry.querySelector('.qty-input');
        let v = parseInt(inp.value) || 1;
        v += parseInt(qtyBtn.dataset.dir);
        inp.value = Math.max(1, Math.min(99, v));
        return;
    }
});

/* ══════════════════════════════════════════
   ARTIST
══════════════════════════════════════════ */
function makeArtistRow() {
    const div = document.createElement('div');
    div.className = 'row artist-row';
    div.innerHTML = `
        <div class="grid3" style="align-items:center;">
            <input type="text" name="artists[]" class="input-medium" placeholder="Name">
            <div style="display:flex;align-items:center;gap:8px;">
                <button type="button" class="btn-format btn-anv">Add ANV</button>
                <input type="text" name="anvs[]" class="input-format anv-input" placeholder="ANV" style="display:none;margin-left:0;">
            </div>
            <div style="display:flex;align-items:center;gap:6px;">
                <input type="text" name="joins[]" class="input-format" placeholder="Join phrase (e.g. &, feat.)">
                <button type="button" class="btn-remove btn-remove-artist" title="Remove artist">${removeIcon()}</button>
            </div>
        </div>`;
    return div;
}

document.getElementById('addArtistBtn').addEventListener('click', function () {
    document.getElementById('artistContainer').appendChild(makeArtistRow());
    refreshRemove('artistContainer', 'btn-remove-artist');
});
refreshRemove('artistContainer', 'btn-remove-artist');

/* ══════════════════════════════════════════
   LABEL
══════════════════════════════════════════ */
function makeLabelRow() {
    const div = document.createElement('div');
    div.className = 'row label-row';
    div.innerHTML = `
        <div class="grid3" style="align-items:center;">
            <select name="label_types[]">
                <option value="">Label</option>
                <option>Series</option><option>Record Company</option><option>Licensed To</option>
                <option>Licensed From</option><option>Marketed By</option><option>Distributed By</option>
                <option>Manufactured By</option><option>Pressed By</option><option>Published By</option>
            </select>
            <input type="text" class="input-medium" placeholder="Name" name="label_names[]">
            <div style="display:flex;align-items:center;gap:6px;">
                <input type="text" class="input-medium" placeholder="Catalog Number" style="margin-left:0;" name="catalog_nos[]">
                <button type="button" class="btn-remove btn-remove-label" title="Remove label">${removeIcon()}</button>
            </div>
        </div>`;
    return div;
}

document.getElementById('addLabelBtn').addEventListener('click', function () {
    document.getElementById('labelContainer').appendChild(makeLabelRow());
    refreshRemove('labelContainer', 'btn-remove-label');
});
refreshRemove('labelContainer', 'btn-remove-label');

/* ══════════════════════════════════════════
   BARCODE
══════════════════════════════════════════ */
function makeBarcodeRow() {
    const div = document.createElement('div');
    div.className = 'row barcode-row';
    div.innerHTML = `
        <div class="grid3" style="align-items:center;">
            <select name="identifiers_type[]">
                <option value="">-- Type --</option>
                <option value="Barcode">Barcode</option>
                <option value="Rights Society">Rights Society</option>
                <option value="Matrix / Runout">Matrix / Runout</option>
                <option value="Other">Other</option>
            </select>
            <input type="text" name="identifiers_value[]" class="input-medium" placeholder=" ">
            <div style="display:flex;align-items:center;gap:6px;">
                <div style="display:flex;align-items:center;gap:8px;">
                    <button type="button" class="btn-format btn-anv">Add Description</button>
                    <input type="text" name="identifiers_desc[]" class="input-format anv-input" placeholder="Description" style="display:none;margin-left:0;">
                </div>
                <button type="button" class="btn-remove btn-remove-barcode" title="Remove identifier">${removeIcon()}</button>
            </div>
        </div>`;
    return div;
}

document.getElementById('addBarcodeBtn').addEventListener('click', function () {
    document.getElementById('barcodeContainer').appendChild(makeBarcodeRow());
    refreshRemove('barcodeContainer', 'btn-remove-barcode');
});

/* ══════════════════════════════════════════
   TRACKLIST
══════════════════════════════════════════ */
document.getElementById('addTracksBtn').addEventListener('click', function () {
    const numInput = this.previousElementSibling;
    const count = parseInt(numInput.value) || 1;
    const tbody = document.getElementById('trackBody');
    for (let i = 0; i < count; i++) {
        const rowCount = tbody.querySelectorAll('tr').length;
        const tr = document.createElement('tr');
        tr.innerHTML = `
            <td class="drag">↕</td>
            <td><input type="text" name="track_positions[]" class="input-track small" placeholder="#" value="${rowCount + 1}"></td>
            <td><a href="#" class="add-link"><span>+</span> Add</a></td>
            <td>
                <input type="text" name="track_titles[]" class="input-track" placeholder="Track Title">
                <div class="credits">Credits <a href="#" class="add-link"><span>+</span> Add</a></div>
            </td>
            <td><input type="text" name="track_durations[]" class="input-track small" placeholder="0:00"></td>
            <td class="arrow">▼</td>`;
        tbody.appendChild(tr);
    }
});

/* ══════════════════════════════════════════
   EVENT DELEGATION
══════════════════════════════════════════ */
document.addEventListener('click', function (e) {
    if (e.target.classList.contains('btn-anv')) {
        const row   = e.target.closest('.row');
        const input = row.querySelector('.anv-input');
        const hidden = input.style.display === 'none';
        input.style.display = hidden ? 'inline-block' : 'none';
        if (!hidden) input.value = '';
        const isDesc = e.target.textContent.includes('Description');
        e.target.textContent = hidden
            ? (isDesc ? 'Remove Description' : 'Remove ANV')
            : (isDesc ? 'Add Description' : 'Add ANV');
        return;
    }
    if (e.target.closest('.btn-remove-artist')) {
        const c = document.getElementById('artistContainer');
        if (c.querySelectorAll('.row').length > 1) e.target.closest('.row').remove();
        refreshRemove('artistContainer', 'btn-remove-artist');
        return;
    }
    if (e.target.closest('.btn-remove-label')) {
        const c = document.getElementById('labelContainer');
        if (c.querySelectorAll('.row').length > 1) e.target.closest('.row').remove();
        refreshRemove('labelContainer', 'btn-remove-label');
        return;
    }
    if (e.target.closest('.btn-remove-barcode')) {
        e.target.closest('.row').remove();
        return;
    }
});
</script>

@endsection