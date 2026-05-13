@extends('layouts.app')

@section('css')
    @vite('resources/css/advanced.css')
@endsection

@section('content')

<div class="wrapper advanced">
    <h1>Advanced Search</h1>

    <div class="box">
        <form action="{{ route('search') }}" method="GET">

            <div class="full">
                <label>Type</label>
                <select name="type">
                    <option value="all">All</option>
                    <option value="release">Release</option>
                    <option value="artist">Artist</option>
                    <option value="label">Label</option>
                </select>
            </div>

            <!-- GRID -->
            <div class="grid">
                <div>
                    <label>Title / Name</label>
                    <input type="text" name="title">
                </div>
                <div>
                    <label>Credit</label>
                    <input type="text" name="credit">
                </div>

                <div>
                    <label>By Artist</label>
                    <input type="text" name="artist">
                </div>
                <div>
                    <label>Genre</label>
                    <input type="text" name="genre">
                </div>

                <div>
                    <label>On Label</label>
                    <input type="text" name="label">
                </div>
                <div>
                    <label>Style</label>
                    <input type="text" name="style">
                </div>

                <div>
                    <label>Track Title</label>
                    <input type="text" name="track">
                </div>
                <div>
                    <label>Country</label>
                    <input type="text" name="country">
                </div>

                <div>
                    <label>Catalog #</label>
                    <input type="text" name="catalog">
                </div>
                <div>
                    <label>Year</label>
                    <input type="text" name="year">
                </div>

                <div>
                    <label>Barcode</label>
                    <input type="text" name="barcode">
                </div>
                <div>
                    <label>Submitter</label>
                    <input type="text" name="submitter">
                </div>

                <div>
                    <label>ANV</label>
                    <input type="text" name="anv">
                </div>
                <div>
                    <label>Contributor</label>
                    <input type="text" name="contributor">
                </div>

                <div>
                    <label>Format</label>
                    <input type="text" name="format">
                </div>
                <div>
                    <label>Matrix</label>
                    <input type="text" name="matrix">
                </div>
            </div>

            <!-- CHECKBOX -->
            <div class="checks">
                <label>
                    <span>Need Votes</span>
                    <input type="checkbox" name="need_votes" value="1">
                </label>

                <label>
                    <span>Need Changes</span>
                    <input type="checkbox" name="need_changes" value="1">
                </label>
            </div>

            <!-- FOOTER -->
            <div class="footer">
                <p>Need help? <a href="#">Check out our guide on searching.</a></p>
                <button type="submit" style="background-color: #2e7d32; color: white;
                border: none; padding: 8px 18px; border-radius: 3px;">Search</button>
            </div>
        </form>
    </div>
</div>

@endsection
