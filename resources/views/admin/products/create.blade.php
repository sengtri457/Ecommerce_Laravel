@extends('layouts.admin')

@section('title', 'Add New Product')
@section('header_title', 'Create New Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="stat-card">
            <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Product Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required autofocus>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">SKU (Optional)</label>
                            <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku') }}" placeholder="Auto-generated if empty">
                            @error('sku')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Category *</label>
                            <select name="category_id" class="form-control @error('category_id') is-invalid @enderror" required>
                                <option value="">Select Category</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ old('category_id') == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                                @endforeach
                            </select>
                            @error('category_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Brand</label>
                            <select name="brand_id" class="form-control @error('brand_id') is-invalid @enderror">
                                <option value="">None / Generic</option>
                                @foreach($brands as $brand)
                                    <option value="{{ $brand->id }}" {{ old('brand_id') == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Regular Price ($) *</label>
                            <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price') }}" required>
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Sale Price ($)</label>
                            <input type="number" step="0.01" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price') }}">
                            @error('sale_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Stock Quantity *</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', 10) }}" required>
                            @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Product Images Section -->
                <div class="card mb-4 border" style="background: #fafaf9;">
                    <div class="card-header bg-light py-2">
                        <h6 class="mb-0 font-weight-bold text-dark"><i class="la la-image mr-1"></i> Product Images</h6>
                    </div>
                    <div class="card-body">
                        <!-- Primary Image -->
                        <div class="row mb-3">
                            <div class="col-md-7">
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold">Primary Product Photo</label>
                                    <input type="file" name="primary_image_file" id="primary_image_file" class="form-control-file border p-2 rounded w-100 bg-white @error('primary_image_file') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted d-block mt-1">Upload main product photo (JPEG, PNG, WEBP up to 10MB).</small>
                                    @error('primary_image_file')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label class="small text-muted font-weight-bold">Or specify image path / URL</label>
                                    <input type="text" name="primary_image_url" id="primary_image_url" class="form-control form-control-sm" value="{{ old('primary_image_url') }}" placeholder="e.g. assets/images/demos/demo-13/products/product-1.jpg">
                                </div>
                            </div>
                            <div class="col-md-5 text-center">
                                <label class="small font-weight-bold text-muted d-block">Primary Preview</label>
                                <div class="border rounded p-1 bg-white d-inline-block shadow-sm" style="width: 140px; height: 140px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                    <img id="primary_preview" src="{{ asset('assets/images/demos/demo-13/products/product-1.jpg') }}" alt="Preview" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <!-- Gallery Images -->
                        <div class="form-group mb-0">
                            <label class="font-weight-bold">Additional Gallery Photos (Optional)</label>
                            <input type="file" name="gallery_images[]" id="gallery_images" class="form-control-file border p-2 rounded w-100 bg-white" accept="image/*" multiple>
                            <small class="text-muted d-block mt-1">You can select multiple photos at once for the product details carousel/gallery.</small>
                            @error('gallery_images.*')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            <div id="gallery_preview_container" class="d-flex flex-wrap gap-2 mt-2" style="gap: 10px;"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Short Summary</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description') }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Full Details & Specifications</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description') }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold d-block">Visibility & Attributes</label>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" name="is_active" id="is_active" value="1" class="custom-control-input" {{ old('is_active', true) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Active in Catalog</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" class="custom-control-input" {{ old('is_featured') ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_featured">Featured Product</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" name="is_new" id="is_new" value="1" class="custom-control-input" {{ old('is_new', true) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_new">New Arrival Tag</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">Create Product</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    // Primary image file preview
    document.getElementById('primary_image_file')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(evt) {
                document.getElementById('primary_preview').src = evt.target.result;
            };
            reader.readAsDataURL(file);
        }
    });

    // Primary image text URL preview
    document.getElementById('primary_image_url')?.addEventListener('input', function(e) {
        const val = e.target.value.trim();
        if (val) {
            const src = val.startsWith('http') || val.startsWith('/') ? val : '/' + val;
            document.getElementById('primary_preview').src = src;
        }
    });

    // Gallery images preview
    document.getElementById('gallery_images')?.addEventListener('change', function(e) {
        const container = document.getElementById('gallery_preview_container');
        container.innerHTML = '';
        Array.from(e.target.files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(evt) {
                const imgWrap = document.createElement('div');
                imgWrap.className = 'border rounded p-1 bg-white shadow-sm';
                imgWrap.style.width = '70px';
                imgWrap.style.height = '70px';
                imgWrap.style.overflow = 'hidden';
                imgWrap.style.display = 'inline-flex';
                imgWrap.style.alignItems = 'center';
                imgWrap.style.justifyContent = 'center';

                const img = document.createElement('img');
                img.src = evt.target.result;
                img.style.maxWidth = '100%';
                img.style.maxHeight = '100%';
                img.style.objectFit = 'cover';
                imgWrap.appendChild(img);
                container.appendChild(imgWrap);
            };
            reader.readAsDataURL(file);
        });
    });
</script>
@endpush