<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    @include('partials.seo')
    
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/images/icons/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/images/icons/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/images/icons/favicon-16x16.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/favicon.ico') }}">
    <meta name="theme-color" content="#ffffff">

    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }}">
    <!-- Brand Fonts: Playfair Display & Inter -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,500;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Plugins CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/owl-carousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/magnific-popup/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery.countdown.css') }}">
    
    <!-- Main CSS File -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/skins/skin-demo-13.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/demos/demo-13.css') }}">

    <!-- Clothes™ Brand System Styles -->
    <style>
        :root {
            --brand-canvas: #FAFAF8;
            --brand-charcoal: #1A1A1A;
            --brand-terracotta: #A35C49;
            --brand-terracotta-dark: #8c4e3e;
            --brand-surface: #F4F4F0;
            --brand-border: #E6E6E2;
            --brand-sage: #2B5B3C;
        }

        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, sans-serif !important;
            background-color: var(--brand-canvas);
            color: var(--brand-charcoal);
        }

        h1, h2, h3, .title, .intro-title, .banner-title, .cta-title {
            font-family: 'Playfair Display', Georgia, serif;
            letter-spacing: -0.01em;
        }

        /* Universal Reset: Eliminate all legacy template blue (#39f, #278bf0, #0080ff) */
        ::-moz-selection { background-color: var(--brand-terracotta); color: #ffffff; }
        ::selection { background-color: var(--brand-terracotta); color: #ffffff; }

        a {
            color: #1A1A1A;
            transition: color 0.25s ease;
        }
        a:hover, a:focus {
            color: var(--brand-terracotta) !important;
            text-decoration: none;
        }

        .text-primary,
        a.text-primary,
        .intro-slide .text-primary,
        .product-price,
        .new-price,
        .read-more,
        .entry-title a:hover,
        .entry-cats a:hover,
        .page-link:hover,
        .breadcrumb-item a:hover {
            color: var(--brand-terracotta) !important;
        }

        .read-more:hover, .read-more:focus {
            box-shadow: 0 1px 0 0 var(--brand-terracotta) !important;
            color: var(--brand-terracotta-dark) !important;
        }

        /* Buttons & Badges */
        .btn-primary, 
        .bg-primary, 
        .badge-primary, 
        .header-search .btn-primary,
        .cart-dropdown .btn-primary {
            background-color: var(--brand-terracotta) !important;
            border-color: var(--brand-terracotta) !important;
            color: #ffffff !important;
        }

        .btn-primary:hover, .btn-primary:focus {
            background-color: var(--brand-terracotta-dark) !important;
            border-color: var(--brand-terracotta-dark) !important;
        }

        .btn-outline-primary-2 {
            color: var(--brand-terracotta) !important;
            border-color: var(--brand-terracotta) !important;
            background-color: transparent !important;
        }

        .btn-outline-primary-2:hover, .btn-outline-primary-2:focus {
            color: #ffffff !important;
            background-color: var(--brand-terracotta) !important;
            border-color: var(--brand-terracotta) !important;
        }

        /* Forms & Inputs */
        .form-control:focus {
            border-color: var(--brand-terracotta) !important;
            box-shadow: 0 0 0 0.2rem rgba(163, 92, 73, 0.15) !important;
        }

        /* Navigation & Tabs */
        .header .header-bottom,
        .menu > li.active > a,
        .menu > li:hover > a {
            border-bottom-color: var(--brand-terracotta);
            color: var(--brand-terracotta) !important;
        }

        .nav.nav-pills .nav-link:hover,
        .nav.nav-pills .nav-link:focus,
        .nav.nav-pills .nav-item .nav-link.active,
        .nav.nav-tabs .nav-link:hover,
        .nav.nav-tabs .nav-link.active {
            color: var(--brand-terracotta) !important;
            border-bottom-color: var(--brand-terracotta) !important;
        }
        .nav.nav-border-anim .nav-link:before {
            background-color: var(--brand-terracotta) !important;
        }

        /* Carousel Navigation & Dots */
        .owl-theme .owl-dots .owl-dot:hover span,
        .owl-theme .owl-dots .owl-dot.active span,
        .owl-theme.owl-light .owl-dots .owl-dot.active span {
            background-color: var(--brand-terracotta) !important;
            border-color: var(--brand-terracotta) !important;
        }
        .owl-theme .owl-nav [class*='owl-']:not(.disabled):hover,
        .owl-simple .owl-nav [class*='owl-']:not(.disabled):hover {
            color: var(--brand-terracotta) !important;
            border-color: var(--brand-terracotta) !important;
        }

        /* Counts & Floating badges */
        .wishlist-count, .cart-count {
            background-color: var(--brand-terracotta) !important;
        }

        #scroll-top {
            background-color: var(--brand-charcoal);
        }
        #scroll-top:hover {
            background-color: var(--brand-terracotta);
        }

        /* PO Section VI: "W E L C O M E" Typewriter Intro Preloader */
        #clothes-preloader {
            position: fixed;
            top: 0;
            left: 0;
            width: 100vw;
            height: 100vh;
            background-color: var(--brand-canvas);
            z-index: 999999;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            transition: opacity 0.6s ease, visibility 0.6s ease;
        }
        #clothes-preloader.fade-out {
            opacity: 0;
            visibility: hidden;
            pointer-events: none;
        }
        .preloader-welcome-text {
            font-family: 'Playfair Display', serif;
            font-size: 2.2rem;
            letter-spacing: 0.65em;
            color: var(--brand-charcoal);
            text-transform: uppercase;
            display: inline-block;
            border-right: 2px solid var(--brand-terracotta);
            white-space: nowrap;
            animation: typewriterBlink 0.75s step-end infinite;
        }
        .preloader-tagline {
            font-family: 'Inter', sans-serif;
            font-size: 0.85rem;
            letter-spacing: 0.2em;
            text-transform: uppercase;
            color: var(--brand-terracotta);
            margin-top: 1.2rem;
            opacity: 0.85;
        }
        @keyframes typewriterBlink {
            from, to { border-color: transparent; }
            50% { border-color: var(--brand-terracotta); }
        }
    </style>
    @stack('styles')
</head>

    <div class="page-wrapper">
        @include('partials.header')
        @include('partials.main-nav')

        <x-flash-message />

        @yield('content')

        @include('partials.footer')
    </div>

    <button id="scroll-top" title="Back to Top"><i class="icon-arrow-up"></i></button>

    <!-- Mobile Menu -->
    <div class="mobile-menu-overlay"></div>

    <div class="mobile-menu-container mobile-menu-light">
        <div class="mobile-menu-wrapper">
            <span class="mobile-menu-close"><i class="icon-close"></i></span>
            
            <form action="{{ route('search') }}" method="get" class="mobile-search">
                <label for="mobile-search" class="sr-only">Search</label>
                <input type="search" class="form-control" name="q" id="mobile-search" placeholder="Search in..." required>
                <button class="btn btn-primary" type="submit"><i class="icon-search"></i></button>
            </form>

            <ul class="nav nav-pills-mobile nav-border-anim" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" id="mobile-menu-link" data-toggle="tab" href="#mobile-menu-tab" role="tab" aria-controls="mobile-menu-tab" aria-selected="true">Menu</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="mobile-cats-link" data-toggle="tab" href="#mobile-cats-tab" role="tab" aria-controls="mobile-cats-tab" aria-selected="false">Categories</a>
                </li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane fade show active" id="mobile-menu-tab" role="tabpanel" aria-labelledby="mobile-menu-link">
                    <nav class="mobile-nav">
                        <ul class="mobile-menu">
                            @auth
                                <li class="bg-light">
                                    <a href="{{ route('account.dashboard') }}" class="font-weight-bold text-primary">
                                        <i class="icon-user"></i> My Account ({{ Auth::user()->name }})
                                    </a>
                                </li>
                                @if(Auth::user()->isAdmin())
                                    <li class="bg-light">
                                        <a href="{{ route('admin.dashboard') }}" class="font-weight-bold text-danger">
                                            <i class="la la-shield"></i> Admin Dashboard
                                        </a>
                                    </li>
                                @endif
                            @else
                                <li class="bg-light">
                                    <a href="{{ route('login') }}" class="font-weight-bold text-primary">
                                        <i class="icon-user"></i> Sign In
                                    </a>
                                </li>
                                <li class="bg-light">
                                    <a href="{{ route('register') }}" class="font-weight-bold">
                                        <i class="la la-user-plus"></i> Create Account
                                    </a>
                                </li>
                            @endauth

                            @if(isset($mainMenu) && $mainMenu->items)
                                @foreach($mainMenu->items as $item)
                                    <li>
                                        <a href="{{ url($item->url) }}">{{ $item->label }}</a>
                                        @if($item->children && $item->children->count() > 0)
                                            <ul>
                                                @foreach($item->children as $child)
                                                    <li><a href="{{ url($child->url) }}">{{ $child->label }}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endforeach
                            @endif
                        </ul>
                    </nav>
                </div>
                <div class="tab-pane fade" id="mobile-cats-tab" role="tabpanel" aria-labelledby="mobile-cats-link">
                    <nav class="mobile-cats-nav">
                        <ul class="mobile-cats-menu">
                            @if(isset($rootCategories))
                                @foreach($rootCategories as $cat)
                                    <li><a href="{{ route('shop.category', $cat->slug) }}">{{ $cat->name }}</a></li>
                                @endforeach
                            @endif
                        </ul>
                    </nav>
                </div>
            </div>

            <div class="social-icons">
                @if(isset($footerSocialMenu) && $footerSocialMenu->items)
                    @foreach($footerSocialMenu->items as $social)
                        <a href="{{ $social->url }}" class="social-icon" target="_blank" title="{{ $social->label }}"><i class="{{ $social->icon ?: 'icon-share' }}"></i></a>
                    @endforeach
                @endif
            </div>
        </div>
    </div>

    <!-- Plugins JS File -->
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.hoverIntent.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/superfish.min.js') }}"></script>
    <script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap-input-spinner.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.plugin.min.js') }}"></script>
    <script src="{{ asset('assets/js/jquery.countdown.min.js') }}"></script>
    
    <!-- Main JS File -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <script src="{{ asset('assets/js/demos/demo-13.js') }}"></script>
    @stack('scripts')
</body>
</html>
