@props(['product'])

<div class="product">
    <figure class="product-media">
        @if ($product->has_discount)
            <span class="product-label label-sale">Sale</span>
        @elseif ($product->is_new)
            <span class="product-label label-new">New</span>
        @elseif ($product->is_featured)
            <span class="product-label label-top">Top</span>
        @endif

        <a href="{{ route('product.show', $product->slug) }}">
            <img src="{{ asset($product->primary_image) }}" alt="{{ $product->name }}" class="product-image">
        </a>

        <div class="product-action-vertical">
            <form action="{{ route('wishlist.toggle') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn-product-icon btn-wishlist btn-expandable" title="Add to wishlist" style="border: none; background: none;">
                    <span>add to wishlist</span>
                </button>
            </form>
            <form action="{{ route('compare.toggle') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn-product-icon btn-compare" title="Compare" style="border: none; background: none;">
                    <span>Compare</span>
                </button>
            </form>
        </div>

        <div class="product-action">
            <form action="{{ route('cart.add') }}" method="POST" style="width: 100%;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-product btn-cart" style="width: 100%; border: none; background: transparent; cursor: pointer;">
                    <span>add to cart</span>
                </button>
            </form>
        </div>
    </figure>

    <div class="product-body">
        <div class="product-cat">
            @if ($product->category)
                <a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a>
            @endif
        </div>
        <h3 class="product-title">
            <a href="{{ route('product.show', $product->slug) }}">{{ $product->name }}</a>
        </h3>
        <div class="product-price">
            @if ($product->has_discount)
                <span class="new-price">{{ money($product->sale_price) }}</span>
                <span class="old-price">{{ money($product->price) }}</span>
            @else
                {{ money($product->price) }}
            @endif
        </div>
        <x-rating-stars :rating="$product->average_rating" :count="$product->reviews_count ?? $product->reviews->where('is_approved', true)->count()" />
    </div>
</div>
