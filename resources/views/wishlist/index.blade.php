@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'My Wishlist',
        'subtitle' => 'Saved items to purchase later',
        'breadcrumbs' => [
            ['label' => 'Shop', 'url' => route('shop.index')],
            ['label' => 'Wishlist', 'url' => route('wishlist.index')]
        ]
    ])

    <div class="page-content">
        <div class="container">
            @if($wishlistItems->count() > 0)
                <table class="table table-wishlist table-mobile">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Stock Status</th>
                            <th></th>
                            <th></th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($wishlistItems as $item)
                            <tr>
                                <td class="product-col">
                                    <div class="product">
                                        <figure class="product-media">
                                            <a href="{{ route('product.show', $item->product->slug) }}">
                                                <img src="{{ asset($item->product->primary_image) }}" alt="{{ $item->product->name }}">
                                            </a>
                                        </figure>

                                        <h3 class="product-title">
                                            <a href="{{ route('product.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                                        </h3>
                                    </div>
                                </td>
                                <td class="price-col">
                                    @if($item->product->has_discount)
                                        <span class="new-price">{{ money($item->product->sale_price) }}</span>
                                        <span class="old-price">{{ money($item->product->price) }}</span>
                                    @else
                                        {{ money($item->product->price) }}
                                    @endif
                                </td>
                                <td class="stock-col">
                                    @if($item->product->stock > 0)
                                        <span class="in-stock text-success font-weight-bold">In stock</span>
                                    @else
                                        <span class="out-of-stock text-danger font-weight-bold">Out of stock</span>
                                    @endif
                                </td>
                                <td class="action-col">
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                        <input type="hidden" name="quantity" value="1">
                                        <button type="submit" class="btn btn-block btn-outline-primary-2" {{ $item->product->stock <= 0 ? 'disabled' : '' }}>
                                            <i class="icon-cart-plus"></i> Add to Cart
                                        </button>
                                    </form>
                                </td>
                                <td class="remove-col">
                                    <form action="{{ route('wishlist.toggle') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="product_id" value="{{ $item->product->id }}">
                                        <button type="submit" class="btn-remove" title="Remove Item" style="border: none; background: none; cursor: pointer;">
                                            <i class="icon-close"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <x-empty-state 
                    icon="icon-heart-o"
                    title="Your wishlist is empty"
                    message="Save your favorite items here to purchase later."
                    buttonText="Explore Products"
                    :buttonUrl="route('shop.index')"
                />
            @endif
        </div>
    </div>
@endsection
