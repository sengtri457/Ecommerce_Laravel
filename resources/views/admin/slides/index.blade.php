@extends('layouts.admin')

@section('title', 'Hero Slides & Carousel')
@section('header_title', 'Hero Slides & Banner Carousel')

@section('content')
<div class="stat-card mb-4">
    <div class="d-flex align-items-center justify-content-between mb-3">
        <div>
            <h4 class="font-weight-bold mb-1" style="font-size: 1.6rem;">Front Store Hero Slides</h4>
            <span class="text-muted" style="font-size: 1.2rem;">Manage the rotating main banners shown at the top of your homepage.</span>
        </div>
        <a href="{{ route('admin.slides.create') }}" class="btn btn-primary">
            <i class="la la-plus"></i> Add New Slide
        </a>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-admin mb-0">
            <thead>
                <tr>
                    <th>Image</th>
                    <th>Title & Subtitle</th>
                    <th>Price Highlight</th>
                    <th>Button</th>
                    <th>Order</th>
                    <th>Status</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($slides as $slide)
                    <tr>
                        <td style="width: 120px;">
                            <img src="{{ asset($slide->image) }}" alt="{{ $slide->title }}" style="max-height: 60px; max-width: 100px; object-fit: cover; border-radius: 4px; border: 1px solid #ddd;">
                        </td>
                        <td>
                            <div class="font-weight-bold" style="font-size: 1.4rem;">{{ $slide->title }}</div>
                            <small class="text-muted">{{ $slide->subtitle ?? 'No subtitle' }}</small>
                        </td>
                        <td>
                            @if($slide->price)
                                <span class="text-muted">{{ $slide->price_prefix }}</span>
                                <span class="font-weight-bold text-primary">{{ $slide->price }}</span>
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ url($slide->button_url ?? '#') }}" target="_blank" class="badge badge-light">
                                {{ $slide->button_text ?? 'Shop Now' }} &rarr;
                            </a>
                        </td>
                        <td>{{ $slide->sort_order }}</td>
                        <td>
                            <span class="badge {{ $slide->is_active ? 'badge-success' : 'badge-secondary' }}">
                                {{ $slide->is_active ? 'Active' : 'Hidden' }}
                            </span>
                        </td>
                        <td class="text-right">
                            <a href="{{ route('admin.slides.edit', $slide) }}" class="btn btn-sm btn-outline-secondary px-2 py-1 mr-1">Edit</a>
                            <form action="{{ route('admin.slides.destroy', $slide) }}" method="POST" class="d-inline" onsubmit="return confirm('Delete this hero slide?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger px-2 py-1">Delete</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="7" class="text-center py-4 text-muted">No slides found. Add your first hero slide to welcome visitors.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-3 d-flex justify-content-end">
        {{ $slides->links() }}
    </div>
</div>
@endsection
