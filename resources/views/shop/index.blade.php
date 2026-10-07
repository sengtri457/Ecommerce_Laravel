@extends('layouts.app')

@section('content')
    @php
        $title = $currentCategory ? $currentCategory->name : (request('q') ? 'Search results for "' . request('q') . '"' : 'All Products');
        $subtitle = $currentCategory ? $currentCategory->description : 'Shop through our premium collections';
        $bannerImg = ($currentCategory && $currentCategory->banner_image) ? $currentCategory->banner_image : 'assets/images/page-header-bg.jpg';
        $crumbs = [
            ['label' => 'Shop', 'url' => route('shop.index')]
        ];
        if ($currentCategory) {
            $crumbs[] = ['label' => $currentCategory->name, 'url' => route('shop.category', $currentCategory->slug)];
        } elseif (request('q')) {
            $crumbs[] = ['label' => 'Search', 'url' => ''];
        }
    @endphp

    @include('partials.page-header', [
        'title' => $title,
        'subtitle' => $subtitle,
        'image' => $bannerImg,
        'breadcrumbs' => $crumbs
    ])

    <div class="page-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-9">
                    <div class="toolbox">
                        <div class="toolbox-left">
                            <div class="toolbox-info">
                                Showing <span>{{ $products->firstItem() ?? 0 }}-{{ $products->lastItem() ?? 0 }}</span> of <span>{{ $products->total() }}</span> Products
                            </div>
                        </div>

                        <div class="toolbox-right">
                            <div class="toolbox-sort">
                                <label for="sortby">Sort by:</label>
                                <div class="select-custom">
                                    <select name="sortby" id="sortby" class="form-control" onchange="window.location.href=this.value;">
                                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'default']) }}" {{ request('sort') == 'default' ? 'selected' : '' }}>Default</option>
                                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'newest']) }}" {{ request('sort') == 'newest' ? 'selected' : '' }}>Most Recent</option>
                                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_asc']) }}" {{ request('sort') == 'price_asc' ? 'selected' : '' }}>Price: Low to High</option>
                                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'price_desc']) }}" {{ request('sort') == 'price_desc' ? 'selected' : '' }}>Price: High to Low</option>
                                        <option value="{{ request()->fullUrlWithQuery(['sort' => 'featured']) }}" {{ request('sort') == 'featured' ? 'selected' : '' }}>Featured</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($products->count() > 0)
                        <div class="products mb-3">
                            <div class="row">
                                @foreach($products as $product)
                                    <div class="col-6 col-md-4 col-lg-4 mb-4">
                                        <x-product-card :product="$product" />
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <nav aria-label="Page navigation">
                            {{ $products->links() }}
                        </nav>
                    @else
                        <x-empty-state 
                            icon="icon-search"
                            title="No products found"
                            message="We couldn't find any products matching your selected filters or search terms."
                            buttonText="Clear Filters"
                            :buttonUrl="route('shop.index')"
                        />
                    @endif
                </div>

                @include('partials.shop-filters')
            </div>
        </div>
    </div>
@endsection
