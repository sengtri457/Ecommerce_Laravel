@props(['section'])

@php
    $products = $section->resolved_products;
@endphp

@if($products->count() > 0)
    <div class="bg-light pt-4 pb-5 mb-4">
        <div class="container">
            <div class="heading heading-flex heading-border mb-3">
                <div class="heading-left">
                    <h2 class="title">{{ $section->title }}</h2>
                    @if($section->subtitle)
                        <span class="heading-subtitle text-muted ml-2">/ {{ $section->subtitle }}</span>
                    @endif
                </div>

                <div class="heading-right">
                    <a href="{{ route('shop.index') }}" class="title-link">View More <i class="icon-long-arrow-right"></i></a>
                </div>
            </div>

            <div class="row">
                @foreach($products as $product)
                    <div class="col-6 col-md-4 col-lg-3 mb-3">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
