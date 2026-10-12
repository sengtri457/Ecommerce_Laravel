@extends('layouts.admin')

@section('title', 'Edit Slide: ' . $slide->title)
@section('header_title', 'Edit Hero Slide')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ route('admin.slides.update', $slide) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Slide Headline Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $slide->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control @error('subtitle') is-invalid @enderror" value="{{ old('subtitle', $slide->subtitle) }}">
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Price Prefix (Optional)</label>
                            <input type="text" name="price_prefix" class="form-control" value="{{ old('price_prefix', $slide->price_prefix) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Featured Price (Optional)</label>
                            <input type="text" name="price" class="form-control" value="{{ old('price', $slide->price) }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Call To Action Button Text</label>
                            <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $slide->button_text) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Button Destination URL</label>
                            <input type="text" name="button_url" class="form-control" value="{{ old('button_url', $slide->button_url) }}">
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Upload New Image File (Optional)</label>
                            <input type="file" name="image_file" class="form-control-file border p-2 rounded w-100 bg-white" accept="image/*">
                            <small class="text-muted">Choose a new file to replace current slide image.</small>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Or Asset Path / URL</label>
                            <input type="text" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $slide->image) }}">
                            <small class="text-muted">Current image path in store.</small>
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $slide->sort_order) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Background Tint Color</label>
                            <input type="text" name="background_color" class="form-control" value="{{ old('background_color', $slide->background_color) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_active" id="is_active" value="1" class="custom-control-input" {{ old('is_active', $slide->is_active) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Active & Visible in Slideshow</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.slides.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">Update Slide</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
