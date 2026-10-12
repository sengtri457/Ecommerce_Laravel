@extends('layouts.admin')

@section('title', 'Categories')
@section('header_title', 'Department & Category Management')

@section('content')
<div class="row">
    <!-- Category List -->
    <div class="col-lg-8 mb-4">
        <div class="stat-card">
            <h5 class="font-weight-bold mb-3">Existing Categories</h5>
            <div class="table-responsive">
                <table class="table table-hover table-admin mb-0">
                    <thead>
                        <tr>
                            <th>Category</th>
                            <th>Slug</th>
                            <th>Products Count</th>
                            <th>Status</th>
                            <th class="text-right">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td class="font-weight-bold">{{ $category->name }}</td>
                                <td><code>{{ $category->slug }}</code></td>
                                <td>{{ $category->products_count }} products</td>
                                <td>
                                    <span class="badge {{ $category->is_active ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $category->is_active ? 'Active' : 'Disabled' }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this category?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger px-2 py-1" {{ $category->products_count > 0 ? 'disabled title="Cannot delete category with products"' : '' }}>
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-4 text-muted">No categories created yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="mt-3 d-flex justify-content-end">
                {{ $categories->links() }}
            </div>
        </div>
    </div>

    <!-- Create Category Form -->
    <div class="col-lg-4 mb-4">
        <div class="stat-card">
            <h5 class="font-weight-bold mb-3">Add Category</h5>
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label class="font-weight-bold">Category Name *</label>
                    <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
                    @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Parent Category</label>
                    <select name="parent_id" class="form-control">
                        <option value="">None (Top-Level)</option>
                        @foreach($parentCategories as $parent)
                            <option value="{{ $parent->id }}">{{ $parent->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group mb-3">
                    <label class="font-weight-bold">Description</label>
                    <textarea name="description" class="form-control" rows="3">{{ old('description') }}</textarea>
                </div>

                <div class="form-group mb-4">
                    <div class="custom-control custom-checkbox">
                        <input type="checkbox" name="is_active" id="is_active" value="1" class="custom-control-input" checked>
                        <label class="custom-control-label" for="is_active">Active & Visible</label>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary btn-block">Save Category</button>
            </form>
        </div>
    </div>
</div>
@endsection
