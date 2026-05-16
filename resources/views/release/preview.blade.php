@extends('layouts.app')

@section('title', 'Preview/Submit Release')

@section('content') 

<style>
  * { margin: 0; padding: 0; box-sizing: border-box; }
  body { font-family: Arial, Helvetica, sans-serif; font-size: 13px; color: #333; background: #fff; }
  a { color: #0066cc; text-decoration: none; }
  a:hover { text-decoration: underline; }
 
  /* PAGE HEADER - 95% width, flex row, title+links left, help+kbd right */
  .page-header {background: #fff;padding: 10px 16px 6px 16px;display: flex;justify-content: space-between;align-items: flex-end; width: 85%;max-width: 1400px;margin: 0 auto;}
  .content {padding: 12px 0;background: #fff;width: 85%;max-width: 1400px;margin: 0 auto;}
  .page-header-left h1 { font-size: 15px; font-weight: bold; color: #333; margin-bottom: 4px; margin-top: 6px;}
  .page-header-left h1 a { color: #1a6ebf; font-weight: bold; }
  .page-header-left h1 span.dash { color: #333; font-weight: bold; }
  .page-header-left h1 span.draft { color: #333; font-weight: bold; }
  .page-header-links { font-size: 12px; }
  .page-header-links a { margin-right: 10px; color: #1a6ebf; }
  .page-header-right { font-size: 12px; display: flex; align-items: center; gap: 14px; white-space: nowrap;  margin-right: -80px;}
  .page-header-right label { display: flex; align-items: center; gap: 4px; color: #1a6ebf; cursor: pointer; }
  .page-header-right label input[type=checkbox] { accent-color: #1a6ebf; }
  .page-header-right .kbd-link { color: #1a6ebf; cursor: pointer; display: flex; align-items: center; gap: 4px; }
  .page-header-right .kbd-icon { font-size: 13px; }
 
  /* CONTENT AREA */
  .content { padding: 12px 16px; background: #fff; }
 
  /* PANEL */
  .panel { border: 1px solid #ccc; margin-bottom: 12px; background: #fff; width: 85%; margin-left: 0px; margin-right: auto; }
  .panel-header { background: #e0e0e0; border-bottom: 1px solid #ccc; padding: 6px 10px; font-weight: bold; font-size: 13px; display: flex; justify-content: space-between; align-items: center; color: #333; }
  .panel-close { cursor: pointer; color: #555; font-size: 15px; font-weight: normal; line-height: 1; }
  .panel-body { padding: 24px;background: #fff;}
 
  /* RELEASE INFO */
  .release-info { display: flex; gap: 16px; align-items: flex-start; }
  .release-thumb-wrap { display: flex; flex-direction: column; align-items: center; flex-shrink: 0; }
  .release-thumb { width: 140px; height: 140px; background: #e8e8e8; border: 1px solid #bbb; display: flex; align-items: center; justify-content: center; }
  .vinyl-placeholder { width: 120px; height: 120px; border-radius: 50%; background: repeating-radial-gradient(circle at 50% 50%, #888 0px, #666 2px, #555 4px, #444 6px, #555 8px, #666 10px, #777 12px); display: flex; align-items: center; justify-content: center; }
  .vinyl-center { width: 18px; height: 18px; border-radius: 50%; background: #ccc; border: 1px solid #aaa; }
  .add-image { font-size: 11px; color: #1a6ebf; text-align: center; margin-top: 4px; cursor: pointer; }
  .release-details { flex: 1; }
  .release-title { font-size: 17px; font-weight: bold; margin-bottom: 8px; color: #333; }
  .release-title a { color: #1a6ebf; font-weight: bold; }
  .release-table { border-collapse: collapse; }
  .release-table td { padding: 2px 10px 2px 0; vertical-align: top; font-size: 13px; background: #fff; color: #333; }
  .release-table td:first-child { color: #333; font-weight: normal; min-width: 80px; }
 
  /* TRACKLIST */
  .tracklist-section { margin-top: 14px; padding-top: 10px; }
  .tracklist-label { font-weight: bold; font-size: 13px; margin-bottom: 6px; border-bottom: 1px solid #ddd;}
  .tracklist-table { width: 100%; border-collapse: collapse; }
  .tracklist-table td { padding: 3px 6px; font-size: 13px; background: #fff; color: #333; }
  .tracklist-table td:first-child { width: 30px; }
  .tracklist-table td:last-child { text-align: right; }
 
  /* SUBMISSION NOTES */
  .submission-notes-area { margin-top: 14px; margin-bottom: 12px; }
  .section-label { font-weight: bold; font-size: 13px; margin-bottom: 4px; }
  textarea {width: 100%; height: 50px; border: 1px solid #aaa; padding: 5px; font-family: Arial, sans-serif; font-size: 12px; outline: none;background: #fff; border-radius: 6px; resize: none;}
  textarea:focus { border-color: #1a6ebf; }
 
  /* BEFORE SUBMIT */
  .before-submit { background: #f5f5f5; border-radius: 6px; padding: 10px 14px; margin-top: 12px; }
  .before-submit .title { font-weight: bold; margin-bottom: 6px; font-size: 13px; }
  .before-submit ul { padding-left: 20px; margin-bottom: 8px; }
  .before-submit ul li { margin-bottom: 3px; line-height: 1.5; }
  .before-submit p { margin-bottom: 6px; line-height: 1.6; }
  .before-submit ol { padding-left: 20px; margin-bottom: 8px; }
  .before-submit ol li { margin-bottom: 3px; line-height: 1.5; }
  .before-submit .ip-warning { font-weight: bold; margin-bottom: 10px; line-height: 1.5; }
 
  /* SUBMIT BUTTON */
  .btn-submit { background: #228B22; color: #fff; border: 1px solid #3a6018; padding: 8px 18px; font-size: 13px; cursor: pointer; font-weight: bold; border-radius: 3px; }
  .btn-submit:hover { background: #228B22; }
</style>
</head>
<body>
 
<!-- PAGE HEADER: title+links LEFT, Turn on Help+Keyboard Shortcuts RIGHT -->
<div class="page-header">
  <div class="page-header-left">
    <h1>Edit <a href="#">Ariana Grande</a> <span class="dash"> &nbsp;-&nbsp; </span><a href="#">Eternal Sunshine</a> <span class="draft">(Draft)</span></h1>
    <div class="page-header-links">
      <a href="#">Release History</a>
      <a href="#">Edit Images</a>
      <a href="#">Quick Start Guide</a>
      <a href="#">Submission Guidelines</a>
    </div>
  </div>
  <div class="page-header-right">
    <label><input type="checkbox" checked> Turn on Help</label>
    <span class="kbd-link"><span class="kbd-icon">⌨</span> Keyboard Shortcuts</span>
  </div>
</div>
 
<!-- CONTENT -->
<div class="content">
  <div class="panel">
    <div class="panel-header">
      Preview / Submit
      <span class="panel-close">&#x2715;</span>
    </div>
    <div class="panel-body">
 
      <!-- RELEASE INFO -->
      <div class="release-info">
        <div class="release-thumb-wrap">
          <div class="release-thumb">
            <div class="vinyl-placeholder"><div class="vinyl-center"></div></div>
          </div>
          <div class="add-image">Add an image</div>
        </div>
        <div class="release-details">
          <div class="release-title"><a href="#">Ariana Grande</a> – Eternal Sunshine</div>
          <table class="release-table">
            <tr><td>Label:</td><td><a href="#">Bureau B</a> — G9795</td></tr>
            <tr><td>Format:</td><td>Vinyl, LP</td></tr>
            <tr><td>Country:</td><td></td></tr>
            <tr><td>Released:</td><td></td></tr>
            <tr><td>Genres:</td><td>Funk / Soul, Pop</td></tr>
            <tr><td>Styles:</td><td>Soul</td></tr>
          </table>
        </div>
      </div>
 
      <!-- TRACKLIST -->
      <div class="tracklist-section">
        <div class="tracklist-label">Tracklist</div>
        <table class="tracklist-table">
          <tr>
            <td>1</td>
            <td>We Cant Be Friends</td>
            <td>4:00</td>
          </tr>
        </table>
      </div>
 
      <!-- SUBMISSION NOTES -->
      <div class="submission-notes-area">
        <div class="section-label">Submission Notes:</div>
        <textarea rows="3">Guddd</textarea>
      </div>
 
      <!-- BEFORE SUBMIT -->
      <div class="before-submit">
        <div class="title">Before you submit:</div>
        <ul>
          <li>Test all hyperlinks and make sure they link to the correct artist/label</li>
          <li>Read and understand the <a href="#">Submission Guide</a></li>
          <li>Read and understand the <strong>Image Intellectual Property Rules:</strong></li>
        </ul>
        <p><b>By uploading images to Discogs you agree that the image meets one of the following requirements:</b></p>
        <ol>
          <li>1. Image is Public Domain (expired copyright or public from inception); or</li>
          <li>2. You own the rights to the image and agree to make it available via a CC0 No Rights Reserved license; or</li>
          <li>3. Image is already made available through a CC0 No Rights Reserved license; or</li>
          <li>4. Fair Use – any image representing a physical or digital product in the Discogs Database for the purpose of critical commentary or for the purpose of reselling a physical product under the First Sale Doctrine.</li>
        </ol>
        <p class="ip-warning">You may be held personally liable for image uploads that violate rights' holders intellectual property protections. If you are not sure if the image may be uploaded, then do not complete the upload.</p>
        <button class="btn-submit">I agree, Submit</button>
      </div>
 
    </div>
  </div>
</div>





@endsection