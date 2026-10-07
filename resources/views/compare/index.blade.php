@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Compare Products',
        'subtitle' => 'Side by side comparison of technical specifications',
        'breadcrumbs' => [
            ['label' => 'Shop', 'url' => route('shop.index')],
            ['label' => 'Compare', 'url' => route('compare.index')]
        ]
    ])

    <div class="page-content">
        <div class="container">
            @if($products->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-compare text-center">
                        <tbody>
                            <tr>
                                <th class="text-left bg-light" style="width: 200px;">Product</th>
                                @foreach($products as $p)
                                    <td>
                                        <figure class="product-media mx-auto" style="max-width: 150px;">
                                            <a href="{{ route('product.show', $p->slug) }}">
                                                <img src="{{ asset($p->primary_image) }}" alt="{{ $p->name }}">
                                            </a>
                                        </figure>
                                        <h4 class="product-title mt-2">
                                            <a href="{{ route('product.show', $p->slug) }}">{{ $p->name }}</a>
                                        </h4>
                                    </td>
                                @endforeach
                            </tr>

                            <tr>
                                <th class="text-left bg-light">Price</th>
                                @foreach($products as $p)
                                    <td>
                                        <div class="product-price justify-content-center">
                                            @if($p->has_discount)
                                                <span class="new-price text-primary font-weight-bold">{{ money($p->sale_price) }}</span>
                                                <span class="old-price line-through text-muted ml-2">{{ money($p->price) }}</span>
                                            @else
                                                <span class="text-dark font-weight-bold">{{ money($p->price) }}</span>
                                            @endif
                                        </div>
                                    </td>
                                @endforeach
                            </tr>

                            <tr>
                                <th class="text-left bg-light">Availability</th>
                                @foreach($products as $p)
                                    <td>
                                        @if($p->stock > 0)
                                            <span class="text-success font-weight-bold">In stock ({{ $p->stock }})</span>
                                        @else
                                            <span class="text-danger font-weight-bold">Out of stock</span>
                                        @endif
                                    </td>
                                @endforeach
                            </tr>

                            <tr>
                                <th class="text-left bg-light">Brand</th>
                                @foreach($products as $p)
                                    <td>{{ $p->brand?->name ?? 'N/A' }}</td>
                                @endforeach
                            </tr>

                            @foreach($attributes as $attr)
                                <tr>
                                    <th class="text-left bg-light">{{ $attr->name }}</th>
                                    @foreach($products as $p)
                                        @php
                                            $vals = $p->attributeValues->where('attribute_id', $attr->id)->pluck('value')->implode(', ');
                                        @endphp
                                        <td>{{ $vals ?: '-' }}</td>
                                    @endforeach
                                </tr>
                            @endforeach

                            <tr>
                                <th class="text-left bg-light">Action</th>
                                @foreach($products as $p)
                                    <td>
                                        <form action="{{ route('cart.add') }}" method="POST" class="mb-2">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $p->id }}">
                                            <input type="hidden" name="quantity" value="1">
                                            <button type="submit" class="btn btn-primary btn-sm btn-round btn-block" {{ $p->stock <= 0 ? 'disabled' : '' }}>
                                                Add to Cart
                                            </button>
                                        </form>

                                        <form action="{{ route('compare.toggle') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="product_id" value="{{ $p->id }}">
                                            <button type="submit" class="btn btn-outline-danger btn-sm btn-round btn-block">
                                                Remove
                                            </button>
                                        </form>
                                    </td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                </div>
            @else
                <x-empty-state 
                    icon="icon-random"
                    title="No products in comparison"
                    message="Add up to 4 products to evaluate and compare features side-by-side."
                    buttonText="Browse Products"
                    :buttonUrl="route('shop.index')"
                />
            @endif
        </div>
    </div>
@endsection
