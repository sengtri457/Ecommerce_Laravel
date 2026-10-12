@extends('layouts.admin')

@section('title', 'Add Promo Banner')
@section('header_title', 'New Promo Banner')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ route('admin.banners.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Banner Headline Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" placeholder="e.g. Modern Linen Minimalist" required autofocus>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle') }}" placeholder="e.g. Trending Now">
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Description / Text Highlight</label>
                    <textarea name="description" class="form-control" rows="2">{{ old('description') }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Button Text</label>
                            <input type="text" name="button_text" class="form-control" value="{{ old('button_text', 'Shop Now') }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Button URL Destination</label>
                            <input type="text" name="button_url" class="form-control" value="{{ old('button_url', '/shop') }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Upload Banner Image File (Recommended)</label>
                            <input type="file" name="image_file" class="form-control-file border p-2 rounded w-100 bg-white" accept="image/*">
                            <small class="text-muted">Choose an image from your device. Takes priority over text path.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Or Asset Path / URL</label>
                            <input type="text" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image') }}" placeholder="e.g. assets/images/mainImages/BannerWomen.avif">
                            <small class="text-muted">Optional: specify if not uploading a file from your device.</small>
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Display Position</label>
                            <select name="position" class="form-control">
                                <option value="home_middle">Home Middle Section</option>
                                <option value="home_top">Home Top Section</option>
                                <option value="home_bottom">Home Bottom Section</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', 1) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_active" id="is_active" value="1" class="custom-control-input" checked>
                        <label class="custom-control-label" for="is_active">Active & Visible on Store</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">Create Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
