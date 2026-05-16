@extends('layouts.app')

@section('css')
    @vite('resources/css/advanced.css')
@endsection

@section('content')

<div class="wrapper advanced">
    <h1>Advanced Search</h1>

    <div class="box">
        <form action="{{ route('advanced.results') }}" method="GET" id="advancedSearchForm">
            
        
            <div class="full" style="margin-bottom: 20px;">
                <label style="display: block; margin-bottom: 8px; font-weight: bold;">Type</label>
                <select name="type" id="typeSelect" style="width: 200px; padding: 10px 12px; font-size: 15px; line-height: 1.2; height: 40px; border: 1px solid #ccc; border-radius: 4px; background-color: #fff; color: #333; cursor: pointer; outline: none;">
                    <option value="all" {{ request('type') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="artist" {{ request('type') == 'artist' ? 'selected' : '' }}>Artist</option>
                    <option value="label" {{ request('type') == 'label' ? 'selected' : '' }}>Labels</option>
                    <option value="release" {{ request('type') == 'release' ? 'selected' : '' }}>Releases</option>
                    <option value="master" {{ request('type') == 'master' ? 'selected' : '' }}>Master Releases</option>
                </select>
            </div>

            <div class="grid">
                <div>
                    <label>Title / Name</label>
                    <input type="text" name="title" value="{{ request('title') }}">
                </div>
                <div>
                    <label>Credit</label>
                    <input type="text" name="credit" value="{{ request('credit') }}" class="dynamic-input">
                </div>

                <div>
                    <label>By Artist</label>
                    <input type="text" name="artist" value="{{ request('artist') }}" class="dynamic-input">
                </div>
                <div>
                    <label>Genre</label>
                    <input type="text" name="genre" value="{{ request('genre') }}" class="dynamic-input">
                </div>

                <div>
                    <label>On Label</label>
                    <input type="text" name="label" value="{{ request('label') }}" class="dynamic-input">
                </div>
                <div>
                    <label>Style</label>
                    <input type="text" name="style" value="{{ request('style') }}" class="dynamic-input">
                </div>

                <div>
                    <label>Track Title</label>
                    <input type="text" name="track" value="{{ request('track') }}" class="dynamic-input">
                </div>
                <div>
                    <label>Country</label>
                    <input type="text" name="country" value="{{ request('country') }}" class="dynamic-input">
                </div>

                <div>
                    <label>Catalog #</label>
                    <input type="text" name="catno" value="{{ request('catno') }}" class="dynamic-input">
                </div>
                <div>
                    <label>Year</label>
                    <input type="text" name="year" value="{{ request('year') }}" class="dynamic-input">
                </div>

                <div>
                    <label>Barcode</label>
                    <input type="text" name="barcode" value="{{ request('barcode') }}" class="dynamic-input">
                </div>
                <div>
                    <label>Submitter</label>
                    <input type="text" name="submitter" value="{{ request('submitter') }}" class="dynamic-input">
                </div>

                <div>
                    <label>ANV</label>
                    <input type="text" name="anv" value="{{ request('anv') }}" class="dynamic-input">
                </div>
                <div>
                    <label>Contributor</label>
                    <input type="text" name="contributor" value="{{ request('contributor') }}" class="dynamic-input">
                </div>

                <div>
                    <label>Format</label>
                    <input type="text" name="format" value="{{ request('format') }}" class="dynamic-input">
                </div>
                <div>
                    <label>Matrix</label>
                    <input type="text" name="matrix" value="{{ request('matrix') }}" class="dynamic-input">
                </div>
            </div>

            <div class="checks" style="display: flex; gap: 40px; margin: 25px 0; font-family: inherit;">
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 14px; color: #333;">
                    <input type="checkbox" name="need_votes" value="1" {{ request('need_votes') ? 'checked' : '' }} style="width: 16px; height: 16px; cursor: pointer;">
                    <span>Need Vote</span>
                </label>
                <label style="display: flex; align-items: center; gap: 10px; cursor: pointer; font-size: 14px; color: #333;">
                    <input type="checkbox" name="need_changes" value="1" {{ request('need_changes') ? 'checked' : '' }} style="width: 16px; height: 16px; cursor: pointer;">
                    <span>Need Changes</span>
                </label>
            </div>

            <div class="footer">
                <p>Need help? <a href="#">Check out our guide on searching.</a></p>
                <button type="submit" style="background-color: #2e7d32; color: white;
                border: none; padding: 8px 18px; border-radius: 3px;">Search</button>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const typeSelect = document.getElementById('typeSelect');
        const dynamicInputs = document.querySelectorAll('.dynamic-input');

        function updateInputs() {
            const selectedType = typeSelect.value;
            const isLocked = (selectedType === 'artist' || selectedType === 'label');

            dynamicInputs.forEach(input => {
                input.disabled = isLocked;
                if (isLocked) {
                    input.style.backgroundColor = '#f0f0f0';
                    input.style.cursor = 'not-allowed';
                    input.value = ''; 
                } else {
                    input.style.backgroundColor = '';
                    input.style.cursor = '';
                }
            });
        }

        typeSelect.addEventListener('change', updateInputs);
        updateInputs();
    });
</script>

@endsection
