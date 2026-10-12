@extends('layouts.admin')

@section('title', 'Add Hero Slide')
@section('header_title', 'New Hero Slide')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ route('admin.slides.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Slide Headline Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Autumn / Winter Capsule 2026" required autofocus>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle') }}" placeholder="e.g. Conscious Essentials">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Price Prefix (Optional)</label>
                            <input type="text" name="price_prefix" class="form-control" value="{{ old('price_prefix', 'from') }}" placeholder="from, starting at, etc.">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Featured Price (Optional)</label>
                            <input type="text" name="price" class="form-control" value="{{ old('price') }}" placeholder="e.g. $29.99">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Call To Action Button Text</label>
                            <input type="text" name="button_text" class="form-control" value="{{ old('button_text', 'Shop The Capsule') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Button Destination URL</label>
                            <input type="text" name="button_url" class="form-control" value="{{ old('button_url', '/shop') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Upload Slide Image File (Recommended)</label>
                            <input type="file" name="image_file" class="form-control-file border p-2 rounded w-100 bg-white" accept="image/*">
                            <small class="text-muted">Choose an image from your device (.jpg, .png, .avif, .gif). Takes priority over text path.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Or Asset Path / URL</label>
                            <input type="text" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" placeholder="e.g. assets/images/mainImages/slide/banner1.avif">
                            <small class="text-muted">Optional: specify if not uploading a file from your device.</small>
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 1) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Background Tint Color</label>
                            <input type="text" name="background_color" class="form-control" value="{{ old('background_color', '#f5f5f3') }}" placeholder="e.g. #ebe8e2">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_active" id="is_active" value="1" class="custom-control-input" checked>
                        <label class="custom-control-label" for="is_active">Active & Visible in Slideshow</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.slides.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">Save Slide</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
