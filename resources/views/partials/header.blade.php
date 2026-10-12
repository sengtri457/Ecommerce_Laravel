<header class="header header-10 header-intro-clearance">
    <div class="header-top">
        <div class="container d-flex align-items-center justify-content-between">
            <div class="header-left">
                <a href="tel:{{ $settings['phone'] ?? '' }}" class="text-muted" style="font-size: 1.25rem;">
                    <i class="icon-phone mr-1"></i> Concierge: {{ $settings['phone'] ?? '+1 (800) 234-5678' }}
                </a>
            </div>

            <div class="header-right">
                <div class="header-auth-links d-flex align-items-center">
                    @auth
                        <div class="header-dropdown mr-2">
                            <a href="{{ route('account.dashboard') }}" class="font-weight-500" style="font-size: 1.3rem;">
                                <i class="icon-user mr-1"></i> {{ Auth::user()->name }}
                            </a>
                            <div class="header-menu">
                                <ul>
                                    @if(Auth::user()->isAdmin())
                                        <li><a href="{{ route('admin.dashboard') }}" class="font-weight-bold text-primary"><i class="la la-shield"></i> Admin Portal</a></li>
                                    @endif
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
                        <a href="{{ route('login') }}" class="text-dark font-weight-500 mr-3 d-inline-flex align-items-center" style="font-size: 1.3rem;">
                            <i class="icon-user mr-1 text-primary"></i> Sign In
                        </a>
                        <span class="text-muted mr-3">|</span>
                        <a href="{{ route('register') }}" class="text-primary font-weight-bold d-inline-flex align-items-center" style="font-size: 1.3rem;">
                            Register
                        </a>
                    @endauth
                </div>
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
                    <img src="{{ asset($settings['site_logo'] ?? 'assets/images/mainImages/logoDevs.png') }}" alt="{{ $settings['site_name'] ?? 'Clothes™' }}" style="max-height: 48px; width: auto; object-fit: contain;">
                </a>
            </div>

            <div class="header-center">
                <div class="header-search header-search-extended header-search-visible header-search-no-radius d-none d-lg-block w-100" style="max-width: 520px;">
                    <form action="{{ route('search') }}" method="GET">
                        <div class="header-search-wrapper search-wrapper-wide" style="border-radius: 30px; overflow: hidden; border: 1px solid #e6e6e2; background: #fff;">
                            <label for="q" class="sr-only">Search</label>
                            <input type="search" class="form-control" name="q" id="q" placeholder="Search wardrobe essentials, linen, footwear..." value="{{ request('q') }}" required style="border: none; padding-left: 20px;">
                            <button class="btn btn-primary" type="submit" style="border-radius: 0 30px 30px 0; min-width: 50px;"><i class="icon-search"></i></button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="header-right">
                <div class="header-dropdown-link d-flex align-items-center">
                    @auth
                        <a href="{{ route('account.dashboard') }}" class="wishlist-link mr-4" title="My Account">
                            <i class="icon-user"></i>
                            <span class="wishlist-txt">{{ Str::words(Auth::user()->name, 1, '') }}</span>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="wishlist-link mr-4" title="Sign In / Register">
                            <i class="icon-user"></i>
                            <span class="wishlist-txt">Sign In</span>
                        </a>
                    @endauth

                    <a href="{{ route('wishlist.index') }}" class="wishlist-link mr-4" title="Wishlist">
                        <i class="icon-heart-o"></i>
                        <span class="wishlist-count">{{ $wishlistCount ?? 0 }}</span>
                        <span class="wishlist-txt">Wishlist</span>
                    </a>

                    <div class="dropdown cart-dropdown">
                        <a href="{{ route('cart.index') }}" class="dropdown-toggle" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" data-display="static">
                            <i class="icon-shopping-cart"></i>
                            <span class="cart-count">{{ $cartCount ?? 0 }}</span>
                            <span class="cart-txt">Bag</span>
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
                                    <p class="text-center py-2 mb-0">Your bag is empty.</p>
                                @endif
                            </div>

                            @if(isset($miniCartItems) && $miniCartItems->count() > 0)
                                <div class="dropdown-cart-total">
                                    <span>Total</span>
                                    <span class="cart-total-price">{{ money($miniCartSubtotal ?? 0) }}</span>
                                </div>

                                <div class="dropdown-cart-action">
                                    <a href="{{ route('cart.index') }}" class="btn btn-outline-primary-2">View Bag</a>
                                    <a href="{{ route('checkout.index') }}" class="btn btn-primary"><span>Checkout</span><i class="icon-long-arrow-right"></i></a>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
