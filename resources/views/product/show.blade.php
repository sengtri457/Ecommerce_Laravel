@extends('layouts.app')

@section('content')
<nav aria-label="breadcrumb" class="breadcrumb-nav border-0 mb-0">
    <div class="container d-flex align-items-center">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('shop.index') }}">Products</a></li>
            @if($product->category)
                <li class="breadcrumb-item"><a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a></li>
            @endif
            <li class="breadcrumb-item active" aria-current="page">{{ $product->name }}</li>
        </ol>
    </div>
</nav>

<div class="page-content">
    <div class="container">
        <div class="product-details-top">
            <div class="row">
                <!-- Gallery Column -->
                <div class="col-md-6">
                    <div class="product-gallery product-gallery-vertical">
                        <div class="row">
                            <figure class="product-main-image">
                                <img id="product-zoom" src="{{ asset($product->primary_image) }}" data-zoom-image="{{ asset($product->primary_image) }}" alt="{{ $product->name }}">
                            </figure>

                            <div id="product-zoom-gallery" class="product-image-gallery">
                                @foreach($product->images as $img)
                                    <a class="product-gallery-item {{ $loop->first ? 'active' : '' }}" href="#" data-image="{{ asset($img->path) }}" data-zoom-image="{{ asset($img->path) }}">
                                        <img src="{{ asset($img->path) }}" alt="{{ $product->name }}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Product Details Column -->
                <div class="col-md-6">
                    <div class="product-details">
                        <h1 class="product-title">{{ $product->name }}</h1>

                        <div class="ratings-container">
                            <x-rating-stars :rating="$product->average_rating" :count="$product->approvedReviews->count()" />
                        </div>

                        <div class="product-price">
                            @if($product->has_discount)
                                <span class="new-price">{{ money($product->sale_price) }}</span>
                                <span class="old-price">{{ money($product->price) }}</span>
                            @else
                                {{ money($product->price) }}
                            @endif
                        </div>

                        <div class="product-content">
                            <p>{{ $product->short_description }}</p>
                        </div>

                        <form action="{{ route('cart.add') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">

                            @if($product->colorAttributes()->isNotEmpty())
                                <div class="details-filter-row details-row-size align-items-center mb-3">
                                    <label class="mb-0 mr-3" style="font-weight: 500; font-size: 1.4rem;">Color:</label>
                                    <div class="product-nav-colors d-flex flex-wrap align-items-center" style="gap: 8px;">
                                        @foreach($product->colorAttributes() as $col)
                                            <button type="button" 
                                                class="color-option-btn {{ $loop->first ? 'active' : '' }}" 
                                                data-color-id="{{ $col->id }}"
                                                data-color-name="{{ $col->value }}"
                                                title="{{ $col->value }}">
                                                <span class="color-swatch-circle" style="background-color: {{ $col->color_code ?? '#e0e0e0' }};"></span>
                                                <span class="color-name-label">{{ $col->value }}</span>
                                            </button>
                                        @endforeach
                                        <input type="hidden" name="color_id" id="selected-color-id" value="{{ $product->colorAttributes()->first()?->id }}">
                                    </div>
                                </div>
                            @endif

                            @if($product->optionAttributes()->isNotEmpty())
                                <div class="details-filter-row details-row-size">
                                    <label for="size">Options:</label>
                                    <div class="select-custom">
                                        <select name="attribute_value_id" id="size" class="form-control">
                                            @foreach($product->optionAttributes() as $sz)
                                                <option value="{{ $sz->id }}">{{ $sz->value }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            @endif

                            <div class="details-filter-row details-row-size">
                                <label for="qty">Qty:</label>
                                <div class="product-details-quantity">
                                    <input type="number" id="qty" name="quantity" class="form-control" value="1" min="1" max="{{ max(1, $product->stock) }}" step="1" required>
                                </div>
                                <span class="text-muted ml-3">({{ $product->stock > 0 ? $product->stock . ' in stock' : 'Out of stock' }})</span>
                            </div>

                            <div class="product-details-action">
                                <button type="submit" class="btn-product btn-cart" {{ $product->stock <= 0 ? 'disabled' : '' }}>
                                    <span>Add to Cart</span>
                                </button>
                            </div>
                        </form>

                        <div class="product-details-action mb-3">
                            <form action="{{ route('wishlist.toggle') }}" method="POST" class="d-inline mr-3">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-link p-0 text-muted" style="font-size: 1.3rem;">
                                    <i class="icon-heart-o"></i> <span>Add to Wishlist</span>
                                </button>
                            </form>

                            <form action="{{ route('compare.toggle') }}" method="POST" class="d-inline">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <button type="submit" class="btn btn-link p-0 text-muted" style="font-size: 1.3rem;">
                                    <i class="icon-random"></i> <span>Add to Compare</span>
                                </button>
                            </form>
                        </div>

                        <div class="product-details-footer">
                            <div class="product-cat">
                                <span>Category:</span>
                                @if($product->category)
                                    <a href="{{ route('shop.category', $product->category->slug) }}">{{ $product->category->name }}</a>
                                @endif
                            </div>

                            @if($product->brand)
                                <div class="product-cat ml-4">
                                    <span>Brand:</span>
                                    <a href="{{ route('shop.index', ['brand' => [$product->brand->slug]]) }}">{{ $product->brand->name }}</a>
                                </div>
                            @endif

                            <div class="product-cat ml-4">
                                <span>SKU:</span>
                                <span class="text-dark">{{ $product->sku }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Product Tabs -->
        <div class="product-details-tab">
            <ul class="nav nav-pills justify-content-center" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="product-desc-link" data-toggle="tab" href="#product-desc-tab" role="tab" aria-controls="product-desc-tab" aria-selected="true">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-info-link" data-toggle="tab" href="#product-info-tab" role="tab" aria-controls="product-info-tab" aria-selected="false">Additional information</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-shipping-link" data-toggle="tab" href="#product-shipping-tab" role="tab" aria-controls="product-shipping-tab" aria-selected="false">Shipping & Returns</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="product-review-link" data-toggle="tab" href="#product-review-tab" role="tab" aria-controls="product-review-tab" aria-selected="false">Reviews ({{ $product->approvedReviews->count() }})</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="product-desc-tab" role="tabpanel" aria-labelledby="product-desc-link">
                    <div class="product-desc-content">
                        <h3>Product Information</h3>
                        {!! $product->description !!}
                    </div>
                </div>

                <div class="tab-pane fade" id="product-info-tab" role="tabpanel" aria-labelledby="product-info-link">
                    <div class="product-desc-content">
                        <h3>Information & Attributes</h3>
                        <table class="table table-bordered">
                            <tbody>
                                <tr><th>SKU</th><td>{{ $product->sku }}</td></tr>
                                <tr><th>Category</th><td>{{ $product->category?->name }}</td></tr>
                                <tr><th>Brand</th><td>{{ $product->brand?->name ?? 'Generic' }}</td></tr>
                                @foreach($product->attributeValues as $val)
                                    <tr>
                                        <th>{{ $val->attribute?->name }}</th>
                                        <td>{{ $val->value }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="tab-pane fade" id="product-shipping-tab" role="tabpanel" aria-labelledby="product-shipping-link">
                    <div class="product-desc-content">
                        <h3>Delivery & Returns Policy</h3>
                        {!! $shippingPolicy?->content ?? '<p>Standard delivery in 2-4 business days. Free returns within 30 days of delivery.</p>' !!}
                    </div>
                </div>

                <div class="tab-pane fade" id="product-review-tab" role="tabpanel" aria-labelledby="product-review-link">
                    <div class="reviews">
                        <h3>Reviews ({{ $product->approvedReviews->count() }})</h3>
                        @foreach($product->approvedReviews as $review)
                            <div class="review mb-3 pb-3 border-bottom">
                                <div class="row no-gutters">
                                    <div class="col-auto">
                                        <h4><a href="#">{{ $review->name }}</a></h4>
                                        <div class="ratings-container">
                                            <x-rating-stars :rating="$review->rating" />
                                        </div>
                                        <span class="review-date">{{ $review->created_at->diffForHumans() }}</span>
                                    </div>
                                    <div class="col ml-4">
                                        @if($review->title)<h5>{{ $review->title }}</h5>@endif
                                        <div class="review-content">
                                            <p>{{ $review->body }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                        <!-- Add Review Form -->
                        <div class="reply mt-4">
                            <div class="heading">
                                <h3 class="title">Add a Review</h3>
                                <p class="title-desc">Your email address will not be published. Required fields are marked *</p>
                            </div>

                            <form action="{{ route('product.review', $product->slug) }}" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="reply-name">Name *</label>
                                        <input type="text" class="form-control" id="reply-name" name="name" value="{{ Auth::user()?->name }}" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="reply-rating">Rating (1-5 Stars) *</label>
                                        <select class="form-control" id="reply-rating" name="rating" required>
                                            <option value="5">5 Stars - Outstanding</option>
                                            <option value="4">4 Stars - Very Good</option>
                                            <option value="3">3 Stars - Average</option>
                                            <option value="2">2 Stars - Below Average</option>
                                            <option value="1">1 Star - Poor</option>
                                        </select>
                                    </div>
                                </div>

                                <label for="reply-title">Review Title</label>
                                <input type="text" class="form-control" id="reply-title" name="title" placeholder="Summary of your experience">

                                <label for="reply-message">Your Review *</label>
                                <textarea name="body" id="reply-message" cols="30" rows="4" class="form-control" required placeholder="Write your full review here..."></textarea>

                                <button type="submit" class="btn btn-outline-primary-2 btn-round">
                                    <span>Submit Review</span>
                                    <i class="icon-long-arrow-right"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if($relatedProducts->count() > 0)
            <h2 class="title text-center mb-4">You May Also Like</h2>
            <div class="row">
                @foreach($relatedProducts as $related)
                    <div class="col-6 col-md-4 col-lg-3 mb-3">
                        <x-product-card :product="$related" />
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Left-side Gallery Vertical Layout */
    .product-gallery-vertical .row {
        margin-left: -6px;
        margin-right: -6px;
        display: flex;
        flex-direction: row-reverse;
        align-items: flex-start;
    }
    .product-gallery-vertical .product-main-image {
        flex: 0 0 calc(80% - 12px);
        max-width: calc(80% - 12px);
        margin: 0 6px 1.5rem 6px;
        background: #fbfbf9;
        border: 1px solid var(--brand-border);
        border-radius: 8px;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        min-height: 480px;
    }
    .product-gallery-vertical .product-main-image img {
        max-width: 100%;
        max-height: 560px;
        width: auto;
        height: auto;
        object-fit: contain;
        transition: opacity 0.2s ease;
    }
    .product-gallery-vertical .product-image-gallery {
        flex: 0 0 calc(20% - 12px);
        max-width: calc(20% - 12px);
        margin: 0 6px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        align-content: flex-start;
    }
    .product-gallery-vertical .product-gallery-item {
        display: block;
        width: 100%;
        aspect-ratio: 1 / 1.15;
        background: #fbfbf9;
        border: 2px solid var(--brand-border) !important;
        border-radius: 6px;
        overflow: hidden;
        padding: 0 !important;
        margin: 0 !important;
        position: relative;
        cursor: pointer;
        transition: all 0.2s ease;
    }
    .product-gallery-vertical .product-gallery-item img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }
    .product-gallery-vertical .product-gallery-item:before,
    .product-gallery-vertical .product-gallery-item:after {
        display: none !important;
    }
    .product-gallery-vertical .product-gallery-item:hover {
        border-color: var(--brand-terracotta) !important;
        opacity: 0.9;
    }
    .product-gallery-vertical .product-gallery-item.active {
        border-color: var(--brand-terracotta) !important;
        box-shadow: 0 0 0 1px var(--brand-terracotta);
    }

    /* Color Selector Pill Buttons */
    .color-option-btn {
        display: inline-flex;
        align-items: center;
        background: #ffffff;
        border: 1.5px solid var(--brand-border);
        border-radius: 30px;
        padding: 6px 14px 6px 8px;
        cursor: pointer;
        transition: all 0.2s ease;
        outline: none;
    }
    .color-option-btn:hover {
        border-color: var(--brand-terracotta);
        transform: translateY(-1px);
    }
    .color-option-btn.active {
        border-color: var(--brand-terracotta);
        background: rgba(163, 92, 73, 0.06);
        box-shadow: 0 0 0 1px var(--brand-terracotta);
    }
    .color-swatch-circle {
        display: inline-block;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        border: 1px solid rgba(0, 0, 0, 0.15);
        margin-right: 8px;
        flex-shrink: 0;
    }
    .color-name-label {
        font-size: 1.25rem;
        font-weight: 500;
        color: var(--brand-charcoal);
        line-height: 1;
    }
    .color-option-btn.active .color-name-label {
        color: var(--brand-terracotta-dark);
        font-weight: 600;
    }
</style>
@endpush

@push('scripts')
<script>
    $(document).ready(function () {
        // Thumbnail click handler to switch main image smoothly
        $('.product-gallery-item').on('click', function (e) {
            e.preventDefault();
            var $this = $(this);
            var newImgSrc = $this.data('image') || $this.find('img').attr('src');
            var newZoomSrc = $this.data('zoom-image') || newImgSrc;

            $('.product-gallery-item').removeClass('active');
            $this.addClass('active');

            var $mainImg = $('#product-zoom');
            $mainImg.css('opacity', '0.25');
            setTimeout(function () {
                $mainImg.attr('src', newImgSrc);
                $mainImg.attr('data-zoom-image', newZoomSrc);
                $mainImg.css('opacity', '1');

                // Update elevateZoom if initialized
                var ez = $mainImg.data('elevateZoom');
                if (ez && typeof ez.swaptheimage === 'function') {
                    ez.swaptheimage(newImgSrc, newZoomSrc);
                }
            }, 100);
        });

        // Color selector active toggle
        $('.color-option-btn').on('click', function () {
            $('.color-option-btn').removeClass('active');
            $(this).addClass('active');
            var colorId = $(this).data('color-id');
            $('#selected-color-id').val(colorId);
        });
    });
</script>
@endpush
