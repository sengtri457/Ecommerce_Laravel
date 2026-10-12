@props(['section'])

@if($section->resolved_products->isNotEmpty())
    <div class="py-5 my-4" style="background-color: transparent;">
        <div class="container">
            <div class="d-flex align-items-baseline justify-content-between pb-3 mb-4" style="border-bottom: 1px solid #E6E6E2;">
                <div>
                    <h2 class="title mb-0 d-inline-block" style="font-size: 2.2rem; color: #1A1A1A; font-family: 'Playfair Display', serif;">
                        {{ $section->title }}
                    </h2>
                    @if($section->subtitle)
                        <span class="text-muted ml-3 font-italic" style="font-size: 1.3rem;">
                            — {{ $section->subtitle }}
                        </span>
                    @endif
                </div>

                <div>
                    <a href="{{ route('shop.index') }}" class="text-primary font-weight-500 text-uppercase d-inline-flex align-items-center" style="font-size: 1.15rem; letter-spacing: 0.08em;">
                        <span>View All</span>
                        <i class="icon-long-arrow-right ml-2"></i>
                    </a>
                </div>
            </div>

            <div class="row">
                @foreach($section->resolved_products as $product)
                    <div class="col-6 col-md-4 col-lg-3 mb-4">
                        <x-product-card :product="$product" />
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endif
