@extends('layouts.admin')

@section('title', 'Store Settings & Logo')
@section('header_title', 'Store Settings & Branding')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="stat-card">
            <form action="{{ route('admin.settings.update') }}" method="POST">
                @csrf
                <div class="border-bottom pb-3 mb-4">
                    <h4 class="font-weight-bold mb-1" style="font-size: 1.6rem;">Branding & Identity</h4>
                    <p class="text-muted mb-0" style="font-size: 1.2rem;">Customize your store brand name, header logo, and footer identity.</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Store Brand Name *</label>
                            <input type="text" name="site_name" class="form-control" value="{{ $settings['site_name'] ?? 'Clothes™' }}" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Currency Symbol</label>
                            <input type="text" name="currency_symbol" class="form-control" value="{{ $settings['currency_symbol'] ?? '$' }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Header Logo Image Path</label>
                            <input type="text" name="site_logo" class="form-control" value="{{ $settings['site_logo'] ?? 'assets/images/mainImages/logoDevs.png' }}">
                            <small class="text-muted">Path to primary logo image in public directory.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Footer Logo Image Path</label>
                            <input type="text" name="site_logo_footer" class="form-control" value="{{ $settings['site_logo_footer'] ?? 'assets/images/mainImages/logoDevs.png' }}">
                        </div>
                    </div>
                </div>

                <div class="border-bottom pb-3 mb-4 mt-4">
                    <h4 class="font-weight-bold mb-1" style="font-size: 1.6rem;">Contact & Concierge Information</h4>
                    <p class="text-muted mb-0" style="font-size: 1.2rem;">Displayed in the top navigation bar and footer widgets.</p>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Concierge Phone Number</label>
                            <input type="text" name="phone" class="form-control" value="{{ $settings['phone'] ?? '+1 (800) 234-5678' }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Customer Support Email</label>
                            <input type="email" name="email" class="form-control" value="{{ $settings['email'] ?? 'concierge@clothesbrand.com' }}">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Physical Store Location / Address</label>
                    <input type="text" name="address" class="form-control" value="{{ $settings['address'] ?? '42 Crosby Street, SoHo, New York, NY 10012' }}">
                </div>

                <div class="border-bottom pb-3 mb-4 mt-4">
                    <h4 class="font-weight-bold mb-1" style="font-size: 1.6rem;">Footer & Copyright Text</h4>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Footer Brand Mission Statement</label>
                    <textarea name="footer_text" class="form-control" rows="3">{{ $settings['footer_text'] ?? '' }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold">Copyright Statement</label>
                    <input type="text" name="copyright_text" class="form-control" value="{{ $settings['copyright_text'] ?? 'Copyright © 2026 Clothes™. All Rights Reserved.' }}">
                </div>

                <div class="text-right">
                    <button type="submit" class="btn btn-primary px-5 py-2" style="font-size: 1.3rem;">
                        <i class="la la-save mr-1"></i> Save All Settings
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
