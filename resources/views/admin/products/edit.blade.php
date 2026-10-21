@extends('layouts.admin')

@section('title', 'Edit ' . $product->name)
@section('header_title', 'Edit Product')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-9">
        <div class="stat-card">
            <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Product Name *</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name', $product->name) }}" required>
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">SKU</label>
                            <input type="text" name="sku" class="form-control @error('sku') is-invalid @enderror" value="{{ old('sku', $product->sku) }}">
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
                                    <option value="{{ $cat->id }}" {{ old('category_id', $product->category_id) == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
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
                                    <option value="{{ $brand->id }}" {{ old('brand_id', $product->brand_id) == $brand->id ? 'selected' : '' }}>{{ $brand->name }}</option>
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
                            <input type="number" step="0.01" name="price" class="form-control @error('price') is-invalid @enderror" value="{{ old('price', $product->price) }}" required>
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Sale Price ($)</label>
                            <input type="number" step="0.01" name="sale_price" class="form-control @error('sale_price') is-invalid @enderror" value="{{ old('sale_price', $product->sale_price) }}">
                            @error('sale_price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group mb-3">
                            <label class="font-weight-bold">Stock Quantity *</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror" value="{{ old('stock', $product->stock) }}" required>
                            @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>
                </div>

                <!-- Product Images Management -->
                <div class="card mb-4 border" style="background: #fafaf9;">
                    <div class="card-header bg-light py-2 d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 font-weight-bold text-dark"><i class="la la-image mr-1"></i> Product Photos</h6>
                        <small class="text-muted">{{ $product->images->count() }} existing image(s)</small>
                    </div>
                    <div class="card-body">
                        @if($product->images->isNotEmpty())
                            <label class="font-weight-bold d-block mb-2">Current Photos</label>
                            <div class="row mb-3">
                                @foreach($product->images as $img)
                                    <div class="col-6 col-sm-4 col-md-3 mb-3 text-center">
                                        <div class="border rounded p-2 bg-white shadow-sm position-relative">
                                            @if($img->is_primary)
                                                <span class="badge badge-success position-absolute" style="top: 5px; left: 5px; font-size: 10px;">Primary</span>
                                            @endif
                                            <div style="height: 110px; display: flex; align-items: center; justify-content: center; overflow: hidden;" class="mb-2">
                                                <img src="{{ asset($img->path) }}" alt="Photo" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                            </div>
                                            <div class="d-flex flex-column gap-1">
                                                @if(!$img->is_primary)
                                                    <div class="custom-control custom-radio small text-left mb-1">
                                                        <input type="radio" name="make_primary" id="primary_{{ $img->id }}" value="{{ $img->id }}" class="custom-control-input">
                                                        <label class="custom-control-label" for="primary_{{ $img->id }}">Set Primary</label>
                                                    </div>
                                                @endif
                                                <div class="custom-control custom-checkbox small text-left text-danger">
                                                    <input type="checkbox" name="delete_images[]" id="del_{{ $img->id }}" value="{{ $img->id }}" class="custom-control-input">
                                                    <label class="custom-control-label font-weight-bold" for="del_{{ $img->id }}">Delete</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="my-3">
                        @endif

                        <!-- Upload/Replace Primary Image -->
                        <div class="row mb-3">
                            <div class="col-md-7">
                                <div class="form-group mb-2">
                                    <label class="font-weight-bold">{{ $product->images->isNotEmpty() ? 'Replace / Upload New Primary Photo' : 'Upload Primary Photo' }}</label>
                                    <input type="file" name="primary_image_file" id="primary_image_file" class="form-control-file border p-2 rounded w-100 bg-white @error('primary_image_file') is-invalid @enderror" accept="image/*">
                                    <small class="text-muted d-block mt-1">Leaves existing primary image intact if left blank.</small>
                                    @error('primary_image_file')<div class="invalid-feedback d-block">{{ $message }}</div>@enderror
                                </div>
                                <div class="form-group mb-0">
                                    <label class="small text-muted font-weight-bold">Or specify image path / URL</label>
                                    <input type="text" name="primary_image_url" id="primary_image_url" class="form-control form-control-sm" value="{{ old('primary_image_url') }}" placeholder="e.g. assets/images/demos/demo-13/products/product-1.jpg">
                                </div>
                            </div>
                            <div class="col-md-5 text-center">
                                <label class="small font-weight-bold text-muted d-block">New Primary Preview</label>
                                <div class="border rounded p-1 bg-white d-inline-block shadow-sm" style="width: 140px; height: 140px; overflow: hidden; display: flex; align-items: center; justify-content: center;">
                                    <img id="primary_preview" src="{{ asset($product->primary_image) }}" alt="Preview" style="max-width: 100%; max-height: 100%; object-fit: contain;">
                                </div>
                            </div>
                        </div>

                        <hr class="my-3">

                        <!-- Additional Gallery Upload -->
                        <div class="form-group mb-0">
                            <label class="font-weight-bold">Add More Gallery Photos (Optional)</label>
                            <input type="file" name="gallery_images[]" id="gallery_images" class="form-control-file border p-2 rounded w-100 bg-white" accept="image/*" multiple>
                            <small class="text-muted d-block mt-1">Select one or more photos to append to this product's gallery.</small>
                            @error('gallery_images.*')<div class="text-danger small mt-1">{{ $message }}</div>@enderror
                            <div id="gallery_preview_container" class="d-flex flex-wrap gap-2 mt-2" style="gap: 10px;"></div>
                        </div>
                    </div>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Short Summary</label>
                    <textarea name="short_description" class="form-control" rows="2">{{ old('short_description', $product->short_description) }}</textarea>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Full Details & Specifications</label>
                    <textarea name="description" class="form-control" rows="4">{{ old('description', $product->description) }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <label class="font-weight-bold d-block">Visibility & Attributes</label>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" name="is_active" id="is_active" value="1" class="custom-control-input" {{ old('is_active', $product->is_active) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_active">Active in Catalog</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" name="is_featured" id="is_featured" value="1" class="custom-control-input" {{ old('is_featured', $product->is_featured) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_featured">Featured Product</label>
                    </div>
                    <div class="custom-control custom-checkbox custom-control-inline">
                        <input type="checkbox" name="is_new" id="is_new" value="1" class="custom-control-input" {{ old('is_new', $product->is_new) ? 'checked' : '' }}>
                        <label class="custom-control-label" for="is_new">New Arrival Tag</label>
                    </div>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary">Cancel</a>
                    <button type="submit" class="btn btn-primary px-4">Save Changes</button>
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