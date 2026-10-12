@props(['product'])

<div class="product product-7 text-center" style="background: #ffffff; border: 1px solid #f0f0ec; border-radius: 6px; overflow: hidden; transition: all 0.3s ease;">
    <figure class="product-media mb-0" style="position: relative; overflow: hidden; background: #f8f8f6; aspect-ratio: 3 / 4;">
        @if ($product->has_discount)
            <span class="product-label" style="position: absolute; top: 12px; left: 12px; z-index: 2; background: #A35C49; color: #fff; font-size: 1.05rem; letter-spacing: 0.08em; text-transform: uppercase; padding: 3px 9px; border-radius: 2px; font-weight: 600;">
                -{{ $product->discount_percent }}%
            </span>
        @elseif ($product->is_new)
            <span class="product-label" style="position: absolute; top: 12px; left: 12px; z-index: 2; background: #1A1A1A; color: #fff; font-size: 1.05rem; letter-spacing: 0.08em; text-transform: uppercase; padding: 3px 9px; border-radius: 2px; font-weight: 500;">
                New
            </span>
        @endif

        <a href="{{ route('product.show', $product->slug) }}" style="display: block; width: 100%; height: 100%;">
            <img src="{{ asset($product->primary_image) }}" alt="{{ $product->name }}" class="product-image" style="width: 100%; height: 100%; object-fit: cover; transition: transform 0.5s ease;">
        </a>

        <div class="product-action-vertical" style="position: absolute; top: 12px; right: 12px; z-index: 3;">
            <form action="{{ route('wishlist.toggle') }}" method="POST" class="d-inline">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <button type="submit" class="btn-product-icon btn-wishlist" title="Save to wishlist" style="border: 1px solid #e6e6e2; background: rgba(255,255,255,0.95); width: 34px; height: 34px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s ease;">
                    <i class="icon-heart-o" style="font-size: 1.4rem; color: #1A1A1A;"></i>
                </button>
            </form>
        </div>

        <div class="product-action" style="position: absolute; bottom: 0; left: 0; right: 0; z-index: 3;">
            <form action="{{ route('cart.add') }}" method="POST" style="width: 100%; margin: 0;">
                @csrf
                <input type="hidden" name="product_id" value="{{ $product->id }}">
                <input type="hidden" name="quantity" value="1">
                <button type="submit" class="btn-product btn-cart" style="width: 100%; border: none; background: rgba(26,26,26,0.92); color: #fff; padding: 11px 15px; font-size: 1.15rem; letter-spacing: 0.08em; text-transform: uppercase; font-weight: 500; cursor: pointer; transition: background 0.2s ease;">
                    <span>Add to Bag</span>
                </button>
            </form>
        </div>
    </figure>

    <div class="product-body p-3 text-left">
        <div class="product-cat mb-1">
            @if ($product->category)
                <a href="{{ route('shop.category', $product->category->slug) }}" class="text-muted" style="font-size: 1.15rem; text-transform: uppercase; letter-spacing: 0.08em;">
                    {{ $product->category->name }}
                </a>
            @endif
        </div>
        <h3 class="product-title mb-2" style="font-size: 1.45rem; line-height: 1.35; font-weight: 500;">
            <a href="{{ route('product.show', $product->slug) }}" style="color: #1A1A1A;">
                {{ $product->name }}
            </a>
        </h3>
        <div class="product-price mb-2 d-flex align-items-center" style="font-size: 1.35rem; font-weight: 600;">
            @if ($product->has_discount)
                <span class="new-price text-primary mr-2">{{ money($product->sale_price) }}</span>
                <span class="old-price text-muted text-decoration-line-through" style="font-size: 1.2rem; font-weight: 400;">{{ money($product->price) }}</span>
            @else
                <span style="color: #1A1A1A;">{{ money($product->price) }}</span>
            @endif
        </div>
        @if($product->reviews_count > 0)
            <x-rating-stars :rating="$product->average_rating" :count="$product->reviews_count" />
        @endif
    </div>
</div>
