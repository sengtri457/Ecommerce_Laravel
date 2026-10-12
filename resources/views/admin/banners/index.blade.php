@extends('layouts.admin')

@section('title', 'Promo Banners')
@section('header_title', 'Promotional Banners')

@section('content')
<div class="stat-card mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="font-weight-bold mb-1" style="font-size: 1.6rem;">Front Store Promotional Banners</h4>
            <span class="text-muted" style="font-size: 1.2rem;">Manage promotional cards, featured banners, and category callouts.</span>
        </div>
        <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">
            <i class="la la-plus"></i> Add New Banner
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-admin mb-0">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title & Subtitle</th>
                    <th>Position</th>
                    <th>Callout Link</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($banners as $banner)
                    <tr>
                        <td style="width: 120px;">
                            <img src="{{ asset($banner->image) }}" alt="{{ $banner->title }}" style="max-height: 60px; max-width: 100px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                        </td>
                        <td>
                            <div class="font-weight-bold" style="font-size: 1.4rem;">{{ $banner->title }}</div>
                            <small class="text-muted">{{ $banner->subtitle ?? 'No subtitle' }}</small>
                        </td>
                        <td><span class="badge badge-light">{{ $banner->position }}</span></td>
                        <td>
                            <a href="{{ url($banner->button_url ?? '#') }}" target="_blank" class="badge badge-light">
                                {{ $banner->button_text ?? 'Shop Now' }} &rarr;
                            </a>
                        </td>
                        <td>{{ $banner->sort_order }}</td>
                        <td>
                            <span class="badge {{ $banner->is_active ? 'badge-success' : 'badge-secondary' }}">
                                {{ $banner->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-outline-secondary px-2 py-1 mr-1">Edit</a>
                            <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this banner?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger px-2 py-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No promotional banners configured yet.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-end">
        {{ $banners->links() }}
    </div>
</div>
@endsection
