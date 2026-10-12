<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title', 'Admin Portal') - {{ setting('site_name', 'Clothes™') }}</title>

    <link rel="stylesheet" href="{{ asset('assets/vendor/line-awesome/line-awesome/line-awesome/css/line-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        :root {
            --admin-primary: #a35c49;
            --admin-primary-hover: #8a4836;
            --admin-dark: #121614;
            --admin-sidebar: #171b19;
            --admin-surface: #ffffff;
            --admin-bg: #f7f7f5;
            --admin-border: #e8e8e4;
            --admin-muted: #64748b;
        }

        body {
            background-color: var(--admin-bg);
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: #212529;
            min-height: 100vh;
            overflow-x: hidden;
        }

        .admin-wrapper {
            display: flex;
            min-height: 100vh;
        }

        /* Sidebar Styling */
        .admin-sidebar {
            width: 270px;
            background: var(--admin-sidebar);
            color: #e2e8f0;
            flex-shrink: 0;
            display: flex;
            flex-direction: column;
            border-right: 1px solid rgba(255, 255, 255, 0.06);
            transition: all 0.25s ease-in-out;
            z-index: 1020;
        }

        .admin-sidebar .brand-box {
            padding: 1.25rem 1.5rem;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .sidebar-section-title {
            padding: 1rem 1.5rem 0.35rem;
            font-size: 1.1rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.08em;
            color: #64748b;
        }

        .admin-sidebar .nav-item {
            margin: 0.15rem 0.75rem;
        }

        .admin-sidebar .nav-link {
            color: #94a3b8;
            padding: 0.7rem 1rem;
            border-radius: 8px;
            font-size: 1.35rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        .admin-sidebar .nav-link i.nav-icon {
            font-size: 1.8rem;
            margin-right: 0.85rem;
            width: 22px;
            text-align: center;
        }

        .admin-sidebar .nav-link i.arrow-icon {
            margin-left: auto;
            font-size: 1.2rem;
            transition: transform 0.2s ease;
        }

        .admin-sidebar .nav-link[aria-expanded="true"] i.arrow-icon {
            transform: rotate(90deg);
        }

        .admin-sidebar .nav-link:hover {
            color: #ffffff;
            background: rgba(255, 255, 255, 0.05);
        }

        .admin-sidebar .nav-link.active {
            color: #ffffff;
            background: var(--admin-primary);
        }

        /* Submenu inside collapsed section */
        .sidebar-submenu {
            padding-left: 2.2rem;
            list-style: none;
            margin-bottom: 0.5rem;
        }

        .sidebar-submenu .nav-link {
            padding: 0.45rem 0.85rem;
            font-size: 1.25rem;
            color: #94a3b8;
        }

        .sidebar-submenu .nav-link:hover,
        .sidebar-submenu .nav-link.active {
            color: #ffffff;
            background: rgba(163, 92, 73, 0.25);
        }

        /* Content Area */
        .admin-content-area {
            flex-grow: 1;
            display: flex;
            flex-direction: column;
            min-width: 0;
        }

        /* Top Bar */
        .admin-topbar {
            background: #ffffff;
            padding: 0.85rem 2rem;
            border-bottom: 1px solid var(--admin-border);
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 1000;
            box-shadow: 0 1px 2px rgba(0,0,0,0.02);
        }

        .admin-main-body {
            padding: 2rem;
            flex-grow: 1;
        }

        /* Card and Components */
        .stat-card {
            background: #ffffff;
            border-radius: 10px;
            padding: 1.5rem;
            border: 1px solid var(--admin-border);
            box-shadow: 0 1px 3px rgba(0,0,0,0.03);
            height: 100%;
        }

        .table-admin {
            background: #ffffff;
            border-radius: 10px;
            overflow: hidden;
            border: 1px solid var(--admin-border);
        }

        .table-admin thead th {
            background: #fbfbfa;
            border-bottom: 1px solid var(--admin-border);
            font-size: 1.2rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: 0.05em;
            color: #64748b;
            padding: 0.85rem 1rem;
        }

        .table-admin tbody td {
            vertical-align: middle;
            padding: 0.85rem 1rem;
            border-top: 1px solid #f1f5f9;
            font-size: 1.3rem;
        }

        .badge-status {
            font-size: 1.1rem;
            padding: 0.35rem 0.75rem;
            border-radius: 20px;
            font-weight: 600;
            text-transform: uppercase;
        }

        .badge-status.pending { background: #fef3c7; color: #92400e; }
        .badge-status.processing { background: #dbeafe; color: #1e40af; }
        .badge-status.completed { background: #dcfce7; color: #166534; }
        .badge-status.cancelled { background: #fee2e2; color: #991b1b; }
        .badge-status.declined { background: #f1f5f9; color: #475569; }

        /* User Profile Dropdown */
        .admin-user-btn {
            background: transparent;
            border: 1px solid var(--admin-border);
            border-radius: 24px;
            padding: 0.35rem 0.85rem;
            display: flex;
            align-items: center;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .admin-user-btn:hover {
            background: #f8fafc;
            border-color: #cbd5e1;
        }

        .admin-user-avatar {
            width: 32px;
            height: 32px;
            border-radius: 50%;
            background: var(--admin-primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.3rem;
            margin-right: 0.65rem;
        }
    </style>
    @stack('styles')
</head>
<body>
    <div class="admin-wrapper">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar" id="adminSidebar">
            <div class="brand-box">
                <a href="{{ route('admin.dashboard') }}" class="text-white font-weight-bold d-flex align-items-center" style="font-size: 1.6rem; text-decoration: none;">
                    <span class="mr-2 px-2 py-1 bg-white text-dark rounded font-weight-bold" style="font-size: 1.1rem;">ADMIN</span>
                    <span class="text-truncate">{{ setting('site_name', 'Clothes™') }}</span>
                </a>
            </div>

            <nav class="mt-2 flex-grow-1" style="overflow-y: auto;">
                <!-- 1. Overview -->
                <div class="sidebar-section-title">Core</div>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                            <i class="la la-dashboard nav-icon"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                </ul>

                <!-- 2. E-Commerce / Catalog (Collapsible) -->
                @php
                    $isCatalogActive = request()->routeIs('admin.products.*') || request()->routeIs('admin.categories.*') || request()->routeIs('admin.orders.*');
                @endphp
                <div class="sidebar-section-title">Store Management</div>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link {{ $isCatalogActive ? 'active' : '' }}" data-toggle="collapse" href="#collapseCatalog" role="button" aria-expanded="{{ $isCatalogActive ? 'true' : 'false' }}" aria-controls="collapseCatalog">
                            <i class="la la-shopping-bag nav-icon"></i>
                            <span>Catalog & Orders</span>
                            <i class="la la-angle-right arrow-icon"></i>
                        </a>
                        <div class="collapse {{ $isCatalogActive ? 'show' : '' }}" id="collapseCatalog">
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="{{ route('admin.products.index') }}" class="nav-link {{ request()->routeIs('admin.products.index') ? 'active' : '' }}">
                                        All Products
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.products.create') }}" class="nav-link {{ request()->routeIs('admin.products.create') ? 'active' : '' }}">
                                        + Add Product
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.categories.index') }}" class="nav-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                                        Categories
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.orders.index') }}" class="nav-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                                        Customer Orders
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <!-- 3. Storefront & Banners (Collapsible) -->
                @php
                    $isContentActive = request()->routeIs('admin.slides.*') || request()->routeIs('admin.banners.*') || request()->routeIs('admin.settings.*');
                @endphp
                <div class="sidebar-section-title">Design & Settings</div>
                <ul class="nav flex-column mb-2">
                    <li class="nav-item">
                        <a class="nav-link {{ $isContentActive ? 'active' : '' }}" data-toggle="collapse" href="#collapseContent" role="button" aria-expanded="{{ $isContentActive ? 'true' : 'false' }}" aria-controls="collapseContent">
                            <i class="la la-sliders nav-icon"></i>
                            <span>Banners & Storefront</span>
                            <i class="la la-angle-right arrow-icon"></i>
                        </a>
                        <div class="collapse {{ $isContentActive ? 'show' : '' }}" id="collapseContent">
                            <ul class="sidebar-submenu">
                                <li>
                                    <a href="{{ route('admin.slides.index') }}" class="nav-link {{ request()->routeIs('admin.slides.*') ? 'active' : '' }}">
                                        Hero Slides
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.banners.index') }}" class="nav-link {{ request()->routeIs('admin.banners.*') ? 'active' : '' }}">
                                        Promo Banners
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('admin.settings.index') }}" class="nav-link {{ request()->routeIs('admin.settings.*') ? 'active' : '' }}">
                                        Branding & Settings
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

                <!-- 4. System & Access -->
                <div class="sidebar-section-title">Administration</div>
                <ul class="nav flex-column mb-3">
                    <li class="nav-item">
                        <a href="{{ route('admin.users.index') }}" class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                            <i class="la la-users nav-icon"></i>
                            <span>Users & Roles</span>
                        </a>
                    </li>
                </ul>
            </nav>

            <div class="p-3 border-top border-secondary">
                <a href="{{ route('home') }}" target="_blank" class="nav-link text-muted p-2 d-flex align-items-center" style="font-size: 1.25rem;">
                    <i class="la la-external-link mr-2"></i> Visit Front Store
                </a>
            </div>
        </aside>

        <!-- Main Content Area -->
        <div class="admin-content-area">
            <header class="admin-topbar">
                <div class="d-flex align-items-center">
                    <button class="btn btn-sm btn-link text-dark p-0 mr-3 d-lg-none" type="button" onclick="document.getElementById('adminSidebar').classList.toggle('d-none');">
                        <i class="la la-bars" style="font-size: 2rem;"></i>
                    </button>
                    <h3 class="mb-0 font-weight-bold" style="font-size: 1.8rem;">@yield('header_title', 'Overview')</h3>
                </div>

                <div class="d-flex align-items-center">
                    <!-- Quick action buttons in topbar -->
                    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-outline-primary-2 mr-3 d-none d-sm-inline-flex align-items-center" style="font-size: 1.2rem;">
                        <i class="la la-plus mr-1"></i> New Product
                    </a>

                    <!-- User Profile Dropdown -->
                    <div class="dropdown">
                        <div class="admin-user-btn dropdown-toggle" id="adminUserDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <div class="admin-user-avatar">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <div class="text-left mr-2 d-none d-md-block">
                                <div class="font-weight-bold text-dark" style="font-size: 1.25rem; line-height: 1.1;">{{ auth()->user()->name }}</div>
                                <small class="text-muted text-uppercase" style="font-size: 1rem;">{{ auth()->user()->role }}</small>
                            </div>
                        </div>

                        <div class="dropdown-menu dropdown-menu-right shadow-sm border-0 py-2" aria-labelledby="adminUserDropdown" style="min-width: 200px; border-radius: 8px;">
                            <div class="px-3 py-2 border-bottom">
                                <div class="font-weight-bold text-dark" style="font-size: 1.25rem;">{{ auth()->user()->name }}</div>
                                <small class="text-muted">{{ auth()->user()->email }}</small>
                            </div>
                            <a class="dropdown-item py-2" href="{{ route('home') }}" target="_blank">
                                <i class="la la-external-link mr-2"></i> Visit Live Store
                            </a>
                            <a class="dropdown-item py-2" href="{{ route('account.dashboard') }}">
                                <i class="la la-user mr-2"></i> Customer View
                            </a>
                            <a class="dropdown-item py-2" href="{{ route('admin.settings.index') }}">
                                <i class="la la-cog mr-2"></i> Store Settings
                            </a>
                            <div class="dropdown-divider"></div>
                            <form action="{{ route('logout') }}" method="POST" class="m-0">
                                @csrf
                                <button type="submit" class="dropdown-item py-2 text-danger">
                                    <i class="la la-sign-out mr-2"></i> Log Out
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </header>

            <main class="admin-main-body">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="font-size: 1.3rem;">
                        <i class="la la-check-circle mr-1"></i> {{ session('success') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="font-size: 1.3rem;">
                        <i class="la la-exclamation-circle mr-1"></i> {{ session('error') }}
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>

    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    @stack('scripts')
</body>
</html>
