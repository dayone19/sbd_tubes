@extends('layouts.app')

@section('css')
    @vite('resources/css/advanced.css')
@endsection

@section('content')

<div class="wrapper advanced">
    <h1>Advanced Search</h1>

    <div class="box">
        <form>
            <div class="full">
                <label>Type</label>
                <select>
                    <option>All</option>
                </select>
            </div>

            <!-- GRID -->
            <div class="grid">
                <div>
                    <label>Title / Name</label>
                    <input type="text">
                </div>
                <div>
                    <label>Credit</label>
                    <input type="text">
                </div>

                <div>
                    <label>By Artist</label>
                    <input type="text">
                </div>
                <div>
                    <label>Genre</label>
                    <input type="text">
                </div>

                <div>
                    <label>On Label</label>
                    <input type="text">
                </div>
                <div>
                    <label>Style</label>
                    <input type="text">
                </div>

                <div>
                    <label>Track Title</label>
                    <input type="text">
                </div>
                <div>
                    <label>Country</label>
                    <input type="text">
                </div>

                <div>
                    <label>Catalog #</label>
                    <input type="text">
                </div>
                <div>
                    <label>Year</label>
                    <input type="text">
                </div>

                <div>
                    <label>Barcode</label>
                    <input type="text">
                </div>
                <div>
                    <label>Submitter</label>
                    <input type="text">
                </div>

                <div>
                    <label>ANV</label>
                    <input type="text">
                </div>
                <div>
                    <label>Contributor</label>
                    <input type="text">
                </div>

                <div>
                    <label>Format</label>
                    <input type="text">
                </div>
                <div>
                    <label>Matrix</label>
                    <input type="text">
                </div>
            </div>

            <!-- CHECKBOX -->
            <div class="checks">
                <label>
                    <span>Need Votes</span>
                    <input type="checkbox">
                </label>

                <label>
                    <span>Need Changes</span>
                    <input type="checkbox">
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