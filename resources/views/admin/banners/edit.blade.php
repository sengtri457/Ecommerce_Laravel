@extends('layouts.admin')

@section('title', 'Edit Promo Banner: ' . $banner->title)
@section('header_title', 'Edit Promo Banner')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        <div class="stat-card">
            <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Banner Headline Title *</label>
                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $banner->title) }}" required>
                    @error('title')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Subtitle</label>
                    <input type="text" name="subtitle" class="form-control" value="{{ old('subtitle', $banner->subtitle) }}">
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Description / Text Highlight</label>
                    <textarea name="description" class="form-control" rows="2">{{ old('description', $banner->description) }}</textarea>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Button Text</label>
                            <input type="text" name="button_text" class="form-control" value="{{ old('button_text', $banner->button_text) }}">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Button URL Destination</label>
                            <input type="text" name="button_url" class="form-control" value="{{ old('button_url', $banner->button_url) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3 p-3 bg-light rounded border">
                    <label class="font-weight-bold d-block mb-1">Banner Image</label>
                    <div class="mb-2">
                        <small class="text-muted d-block mb-1">Upload New Image File (recommended):</small>
                        <input type="file" name="image_file" class="form-control-file @error('image_file') is-invalid @enderror" accept="image/*">
                        @error('image_file')<div class="text-danger small">{{ $message }}</div>@enderror
                    </div>
                    <div>
                        <small class="text-muted d-block mb-1">Or Existing Asset / URL Path:</small>
                        <input type="text" name="image" class="form-control @error('image') is-invalid @enderror" value="{{ old('image', $banner->image) }}" placeholder="assets/images/... or https://...">
                        @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                    </div>
                    @if($banner->image)
                        <div class="mt-2">
                            <small class="text-muted d-block">Current Preview:</small>
                            <img src="{{ str_starts_with($banner->image, 'http') ? $banner->image : asset($banner->image) }}" alt="Preview" class="rounded mt-1 border" style="max-height: 80px; max-width: 200px; object-fit: cover;">
                        </div>
                    @endif
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Display Position</label>
                            <select name="position" class="form-control">
                                <option value="home_middle" {{ $banner->position == 'home_middle' ? 'selected' : '' }}>Home Middle Section</option>
                                <option value="home_top" {{ $banner->position == 'home_top' ? 'selected' : '' }}>Home Top Section</option>
                                <option value="home_bottom" {{ $banner->position == 'home_bottom' ? 'selected' : '' }}>Home Bottom Section</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Sort Order</label>
                            <input type="number" name="sort_order" class="form-control" value="{{ old('sort_order', $banner->sort_order) }}">
                        </div>
                    </div>
                </div>

                <div class="form-group mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_active" id="is_active" value="1" class="custom-control-input" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Active & Visible on Store</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.banners.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">Update Banner</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
