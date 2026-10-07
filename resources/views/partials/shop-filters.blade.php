<aside class="col-lg-3 order-lg-first">
    <div class="sidebar sidebar-shop">
        <form action="{{ route('shop.index') }}" method="GET" id="shop-filter-form">
            @if(request('q'))
                <input type="hidden" name="q" value="{{ request('q') }}">
            @endif
            @if(request('sort'))
                <input type="hidden" name="sort" value="{{ request('sort') }}">
            @endif

            <div class="widget widget-clean">
                <label>Filters:</label>
                <a href="{{ route('shop.index') }}" class="sidebar-filter-clear">Clean All</a>
            </div>

            <!-- Categories Widget -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-1" role="button" aria-expanded="true" aria-controls="widget-1">
                        Category
                    </a>
                </h3>

                <div class="collapse show" id="widget-1">
                    <div class="widget-body">
                        <div class="filter-items filter-items-count">
                            @if(isset($filterCategories))
                                @foreach($filterCategories as $fCat)
                                    <div class="filter-item">
                                        <div class="custom-control custom-radio">
                                            <input type="radio" class="custom-control-input" id="cat-{{ $fCat->id }}" name="category" value="{{ $fCat->slug }}" {{ request('category') == $fCat->slug ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="custom-control-label" for="cat-{{ $fCat->id }}">{{ $fCat->name }}</label>
                                        </div>
                                        <span class="item-count">{{ $fCat->products_count }}</span>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Brand Widget -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-2" role="button" aria-expanded="true" aria-controls="widget-2">
                        Brand
                    </a>
                </h3>

                <div class="collapse show" id="widget-2">
                    <div class="widget-body">
                        <div class="filter-items">
                            @if(isset($filterBrands))
                                @foreach($filterBrands as $fBrand)
                                    <div class="filter-item">
                                        <div class="custom-control custom-checkbox">
                                            <input type="checkbox" class="custom-control-input" id="brand-{{ $fBrand->id }}" name="brand[]" value="{{ $fBrand->slug }}" {{ in_array($fBrand->slug, (array) request('brand', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                            <label class="custom-control-label" for="brand-{{ $fBrand->id }}">{{ $fBrand->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <!-- Price Filter -->
            <div class="widget widget-collapsible">
                <h3 class="widget-title">
                    <a data-toggle="collapse" href="#widget-3" role="button" aria-expanded="true" aria-controls="widget-3">
                        Price
                    </a>
                </h3>

                <div class="collapse show" id="widget-3">
                    <div class="widget-body">
                        <div class="row">
                            <div class="col-6">
                                <input type="number" name="min_price" class="form-control" placeholder="Min $" value="{{ request('min_price') }}">
                            </div>
                            <div class="col-6">
                                <input type="number" name="max_price" class="form-control" placeholder="Max $" value="{{ request('max_price') }}">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-outline-primary-2 btn-sm btn-block mt-2">Filter Price</button>
                    </div>
                </div>
            </div>

            <!-- Attributes (Colors & Sizes) -->
            @if(isset($filterAttributes))
                @foreach($filterAttributes as $attr)
                    <div class="widget widget-collapsible">
                        <h3 class="widget-title">
                            <a data-toggle="collapse" href="#widget-attr-{{ $attr->id }}" role="button" aria-expanded="true" aria-controls="widget-attr-{{ $attr->id }}">
                                {{ $attr->name }}
                            </a>
                        </h3>

                        <div class="collapse show" id="widget-attr-{{ $attr->id }}">
                            <div class="widget-body">
                                <div class="filter-items">
                                    @foreach($attr->values as $val)
                                        <div class="filter-item">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" class="custom-control-input" id="val-{{ $val->id }}" name="attributes[]" value="{{ $val->id }}" {{ in_array($val->id, (array) request('attributes', [])) ? 'checked' : '' }} onchange="this.form.submit()">
                                                <label class="custom-control-label" for="val-{{ $val->id }}">{{ $val->value }}</label>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </form>
    </div>
</aside>
