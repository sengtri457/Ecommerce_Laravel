@extends('layouts.admin')

@section('title', 'Manage Products')
@section('header_title', 'Product Catalog')

@section('content')
<div class="stat-card mb-4">
    <div class="row align-items-center mb-3">
        <div class="col-md-8">
            <form action="{{ route('admin.products.index') }}" method="GET" class="form-inline">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control mr-2 mb-2" placeholder="Search by name or SKU...">
                <select name="category_id" class="form-control mr-2 mb-2">
                    <option value="">All Categories</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-outline-primary-2 mb-2">Filter</button>
                @if(request()->anyFilled(['q', 'category_id']))
                    <a href="{{ route('admin.products.index') }}" class="btn btn-link text-muted mb-2 ml-2">Clear</a>
                @endif
            </form>
        </div>
        <div class="col-md-4 text-md-right">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">
                <i class="la la-plus"></i> New Product
            </a>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-admin mb-0">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Category</th>
                    <th>SKU</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $product)
                    <tr>
                        <td>
                            <div class="d-flex align-items-center">
                                <img src="{{ asset($product->primary_image) }}" alt="{{ $product->name }}" class="rounded border mr-2 flex-shrink-0" style="width: 44px; height: 44px; object-fit: cover;">
                                <div>
                                    <div class="font-weight-bold">{{ $product->name }}</div>
                                    <small class="text-muted">{{ Str::limit($product->short_description, 40) }}</small>
                                </div>
                            </div>
                        </td>
                        <td>{{ $product->category->name ?? 'None' }}</td>
                        <td><code>{{ $product->sku }}</code></td>
                        <td>
                            @if($product->sale_price)
                                <span class="text-danger font-weight-bold">{{ money($product->sale_price) }}</span>
                                <del class="text-muted ml-1">{{ money($product->price) }}</del>
                            @else
                                {{ money($product->price) }}
                            @endif
                        </td>
                        <td>
                            <span class="badge {{ $product->stock <= 5 ? 'badge-danger' : 'badge-light' }}">
                                {{ $product->stock }}
                            </span>
                        </td>
                        <td>
                            <span class="badge {{ $product->is_active ? 'badge-success' : 'badge-secondary' }}">
                                {{ $product->is_active ? 'Active' : 'Inactive' }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn-sm btn-outline-secondary px-2 py-1 mr-1">Edit</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this product?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger px-2 py-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No products found matching criteria.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $products->links() }}
    </div>
</div>
@endsection
