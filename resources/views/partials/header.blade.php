<header class="header header-10 header-intro-clearance">
    <div class="header-top">
        <div class="container">
            <div class="header-left">
                <a href="tel:{{ $settings['phone'] ?? '' }}"><i class="icon-phone"></i>Call: {{ $settings['phone'] ?? '+0123 456 789' }}</a>
            </div>

            <div class="header-right">
                <ul class="top-menu">
                    <li>
                        <a href="#">Links</a>
                        <ul>
                            <li>
                                <div class="header-dropdown">
                                    <a href="#">USD</a>
                                    <div class="header-menu">
                                        <ul>
                                            <li><a href="#">USD</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="login">
                                @auth
                                    <div class="header-dropdown">
                                        <a href="{{ route('account.dashboard') }}"><i class="icon-user"></i> {{ Auth::user()->name }}</a>
                                        <div class="header-menu">
                                            <ul>
                                                <li><a href="{{ route('account.dashboard') }}">Dashboard</a></li>
                                                <li><a href="{{ route('account.orders') }}">My Orders</a></li>
                                                <li><a href="{{ route('account.profile') }}">Profile</a></li>
                                                <li>
                                                    <form action="{{ route('logout') }}" method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-link text-left p-0 border-0" style="font-size: 1.2rem; color: #777;">Logout</button>
                                                    </form>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                @else
                                    <a href="{{ route('login') }}"><i class="icon-user"></i> Sign in / Sign up</a>
                                @endauth
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <div class="header-middle">
        <div class="container">
            <div class="header-left">
                <button class="mobile-menu-toggler">
                    <span class="sr-only">Toggle mobile menu</span>
                    <i class="icon-bars"></i>
                </button>
                
                <a href="{{ route('home') }}" class="logo">
                    <img src="{{ asset($settings['site_logo'] ?? 'assets/images/demos/demo-13/logo.png') }}" alt="{{ $settings['site_name'] ?? 'Molla' }}" width="105" height="25">
                </a>
            </div>

            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block">
                    <a href="#" class="search-toggle" role="button"><i class="icon-search"></i></a>
                    <form action="{{ route('search') }}" method="GET">
                        <div class="header-search-wrapper search-wrapper-wide">
                            <div class="select-custom">
                                <select id="cat" name="category">
                                    <option value="">All Departments</option>
                                    @if(isset($rootCategories))
                                        @foreach($rootCategories as $category)
                                            <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search product ..." value="{{ request('q') }}" required>
                            <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="header-right">
                <div class="header-dropdown-link">
                    <div class="dropdown compare-dropdown">
                        <a href="{{ route('compare.index') }}" class="dropdown-toggle" title="Compare Products">
                            <i class="icon-random"></i>
                            <span class="compare-count">{{ $compareCount ?? 0 }}</span>
                            <span class="compare-txt">Compare</span>
                        </a>
                    </div>

                    <a href="{{ route('wishlist.index') }}" class="wishlist-link">
                        <i class="icon-heart-o"></i>
                        <span class="wishlist-count">{{ $wishlistCount ?? 0 }}</span>
                        <span class="wishlist-txt">Wishlist</span>
                    </a>

                    <div class="dropdown cart-dropdown">
                        <a href="{{ route('cart.index') }}" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">{{ $cartCount ?? 0 }}</span>
                            <span class="cart-txt">Cart</span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right">
                            <div class="dropdown-cart-products">
                                @if(isset($miniCartItems) && $miniCartItems->count() > 0)
                                    @foreach($miniCartItems as $item)
                                        <div class="product">
                                            <div class="product-cart-details">
                                                <h4 class="product-title">
                                                    <a href="{{ route('product.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                                                </h4>

                                                <span class="cart-product-info">
                                                    <span class="cart-product-qty">{{ $item->quantity }}</span>
                                                    x {{ money($item->unit_price) }}
                                                </span>
                                            </div>

                                            <figure class="product-image-container">
                                                <a href="{{ route('product.show', $item->product->slug) }}" class="product-image">
                                                    <img src="{{ asset($item->product->primary_image) }}" alt="{{ $item->product->name }}">
                                                </a>
                                            </figure>
                                            <form action="{{ route('cart.remove') }}" method="POST" class="d-inline">
                                                @csrf
                                                <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                                <button type="submit" class="btn-remove" title="Remove Product" style="border: none; background: none;">
                                                    <i class="icon-close"></i>
                                                </button>
                                            </form>
                                        </div>
                                    @endforeach
                                @else
                                    <p class="text-center py-2 mb-0">Your cart is empty.</p>
                                @endif
                            </div>

                            @if(isset($miniCartItems) && $miniCartItems->count() > 0)
                                <div class="dropdown-cart-total">
                                    <span>Total</span>
                                    <span class="cart-total-price">{{ money($miniCartSubtotal ?? 0) }}</span>
                                </div>

                                <div class="dropdown-cart-action">
                                    <a href="{{ route('cart.index') }}" class="btn btn-primary">View Cart</a>
                                    <a href="{{ route('checkout.index') }}" class="btn btn-outline-primary-2"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
