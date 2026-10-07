<div class="dropdown category-dropdown {{ request()->is('/') ? 'show is-on' : '' }}" @if(request()->is('/')) data-visible="true" @endif>
    <a href="#" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="{{ request()->is('/') ? 'true' : 'false' }}" data-display="static" title="Browse Categories">
        Browse Categories
    </a>

    <div class="dropdown-menu {{ request()->is('/') ? 'show' : '' }}">
        <nav class="side-nav">
            <ul class="menu-vertical sf-arrows">
                @if(isset($rootCategories))
                    @foreach($rootCategories as $category)
                        <li class="{{ $category->children->count() > 0 ? 'megamenu-container' : '' }}">
                            <a class="{{ $category->children->count() > 0 ? 'sf-with-ul' : '' }}" href="{{ route('shop.category', $category->slug) }}">
                                {{ $category->name }}
                            </a>

                            @if($category->children->count() > 0)
                                <div class="megamenu">
                                    <div class="row no-gutters">
                                        <div class="col-md-8">
                                            <div class="menu-col">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="menu-title">{{ $category->name }} Subcategories</div>
                                                        <ul>
                                                            @foreach($category->children as $child)
                                                                <li>
                                                                    <a href="{{ route('shop.category', $child->slug) }}">{{ $child->name }}</a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="banner banner-overlay">
                                                <a href="{{ route('shop.category', $category->slug) }}" class="banner banner-menu">
                                                    <img src="{{ asset($category->image ?? 'assets/images/demos/demo-13/menu/banner-1.jpg') }}" alt="{{ $category->name }}">
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        </li>
                    @endforeach
                @endif
            </ul>
        </nav>
    </div>
</div>
