@extends('layouts.app')

@section('content')

<style>
*{ box-sizing:border-box;}
body{font-family:Arial, Helvetica, sans-serif;background:#fff;color:#111;}
.main{display:flex;padding:25px 10px;gap:30px;}
.content { flex: 1; }
.page-title {font-size: 24px;font-weight: 700;margin-bottom: 20px;}
.alert-info {font-size: 15px;margin-bottom: 20px;line-height: 1.5;}
.settings-box {border: 1px solid #d8d8d8;background: white;margin-bottom: 25px;}
.section-header {background: #efefef;padding: 10px 15px;font-size: 16px;font-weight: bold;border-bottom: 1px solid #d8d8d8;display: flex;align-items: center;gap: 8px;}
.section-content { padding: 20px 15px; }
.form-group { margin-bottom: 20px; }
.form-group label {display: block;font-size: 14px;font-weight: bold;margin-bottom: 8px;}
.form-group label span { color: #666; margin-left: 3px; font-style: italic; font-weight: normal; }
.form-group label span.required { color: #cc0000; font-style: normal; font-weight: bold; }select, .input-full {width: 100%;max-width: 450px;padding: 4px;border: 1px solid #999;font-size: 14px; }
.btn-save-green { background: #008800; color: white; border: 1px solid #006600; padding: 6px 12px; font-size: 14px; font-weight: bold;border-radius: 4px;cursor: pointer;display: inline-flex;align-items: center;gap: 6px;}
.instruction-italic {font-style: italic;font-size: 13.5px;color: #555;margin-bottom: 15px;line-height: 1.4;}
.link-blue { color: #336699; text-decoration: none; }
.link-blue:hover { text-decoration: underline; }
.icon-check { color: #008800; font-size: 18px; }
.input-small {width: 100%;max-width: 150px;padding: 4px;border: 1px solid #999;font-size: 14px;}
.optional{font-style:italic;color:#666;font-weight:normal;margin-left:8px;}
.section-title-inner {font-size: 18px;font-weight: bold;margin: 25px 0 15px 0;}
.checkbox-group {display: flex;align-items: center;gap: 10px;font-size: 14px;margin-top: 30px;}
.btn-save-disabled {background: #f1f1f1;color: #999;border: 1px solid #ccc;padding: 8px 15px;font-size: 14px;font-weight: bold;border-radius: 4px;cursor: not-allowed;display: inline-flex;align-items: center;gap: 8px; margin-top: 20px;}
</style>

<div class="main">

    @include('components.sidebarSet')

    <div class="content">
        <h1 class="page-title">Marketplace Settings for Buyers</h1>

        <p class="alert-info">
            You must fill in these fields before you can purchase items for sale. 
            You must <b>save</b> your changes at the end of the form.
        </p>

        <div class="settings-box">
            <div class="section-header">Default Currency Display</div>
            <div class="section-content">
                <div class="form-group">
                    <label>Currency</label>
                    <select>
                        <option>Euro (€)</option>
                        <option>US Dollar ($)</option>
                        <option>Indonesian Rupiah (Rp)</option>
                    </select>
                </div>
                
                <button class="btn-save-green">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="white">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                    Save Currency
                </button>
            </div>
        </div>

        <div class="settings-box">
            <div class="section-header">
                Shipping Information 
                <span class="icon-check">✔</span>
            </div>
            <div class="section-content">
                <p class="instruction-italic">
                    If you plan to use PayPal to pay, be sure that this shipping address matches your shipping address on file with PayPal! Check out our <a href="#" class="link-blue">Safe Buying Tips</a> for more.
                </p>

                <div class="form-group">
                    <label>Full Name <span class="required">*</span></label>
                    <input type="text" class="input-full">
                </div>

                <div class="form-group">
                    <label>Country <span class="required">*</span></label>
                    <select>
                        <option>Select your country</option>
                        <option>Indonesia</option>
                        <option>United Kingdom</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Address <span class="required">*</span></label>
                    <input type="text" class="input-full" style="margin-bottom: 8px;">
                    <br>
                    <input type="text" class="input-full">
                </div>

                <div class="form-group">
                    <label>City/Town <span class="required">*</span></label>
                    <input type="text" class="input-small" style="max-width: 250px;">
                </div>

                <div class="form-group">
                    <label>Region/State <span class="optional">optional</span></label>
                    <input type="text" class="input-small" style="max-width: 250px;">
                </div>

                <div class="form-group">
                    <label>Postal Code <span class="required" >*</span></label>
                    <input type="text" class="input-small">
                </div>

                <div class="section-title-inner">For the seller:</div>

                <div class="form-group">
                    <label>Contact Phone Number <span class="optional">optional</span></label>
                    <input type="text" class="input-small" style="max-width: 250px;">
                </div>

                <div class="form-group">
                    <label>Paypal Email Address <span class="optional">optional</span></label>
                    <input type="email" class="input-small" style="max-width: 250px;">
                </div>

                <div class="checkbox-group">
                    <input type="checkbox" id="policy">
                    <label for="policy" style="font-weight: normal; margin-bottom: 0;">
                        I agree to the Discogs <a href="#" class="link-blue">Buyer Policy</a> <span class="required">*</span>
                    </label>
                </div>

                <button type="button" id="btn-shipping" class="btn-save-disabled">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="currentColor">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                    Save Shipping Information
                </button>
            </div>
        </div>

         <div class="settings-box">
            <div class="section-header">
                Shipping Information 
                <span class="icon-check">✔</span>
            </div>
            <div class="section-content">
                <div class="form-group">
                    <label>Full Name <span class="required">*</span></label>
                    <input type="text" class="input-full">
                </div>

                <div class="form-group">
                    <label>Country <span class="required">*</span></label>
                    <select>
                        <option>Select your country</option>
                        <option>Indonesia</option>
                        <option>United Kingdom</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Address <span class="required">*</span></label>
                    <input type="text" class="input-full" style="margin-bottom: 8px;">
                    <br>
                    <input type="text" class="input-full">
                </div>

                <div class="form-group">
                    <label>City/Town <span class="required">*</span></label>
                    <input type="text" class="input-small" style="max-width: 250px;">
                </div>

                <div class="form-group">
                    <label>Region/State <span class="optional">optional</span></label>
                    <input type="text" class="input-small" style="max-width: 250px;">
                </div>

                <div class="form-group">
                    <label>Postal Code <span class="required" >*</span></label>
                    <input type="text" class="input-small">
                </div>

                <button type="button" class="btn-save-green">
                    <svg width="14" height="14" viewBox="0 0 24 24" fill="#ccc">
                        <path d="M9 16.17L4.83 12l-1.42 1.41L9 19 21 7l-1.41-1.41z"/>
                    </svg>
                    Save Billing Information
                </button>
            </div>
        </div>
    </div>

</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('policy');
        const button = document.getElementById('btn-shipping');

        checkbox.addEventListener('change', function() {
            if (this.checked) {
                // Jika dicentang, ubah class ke tombol hijau
                button.classList.remove('btn-save-disabled');
                button.classList.add('btn-save-green');
                button.style.cursor = 'pointer';
            } else {
                // Jika tidak dicentang, kembalikan ke abu-abu
                button.classList.remove('btn-save-green');
                button.classList.add('btn-save-disabled');
                button.style.cursor = 'not-allowed';
            }
        });
    });
</script>
@endsection