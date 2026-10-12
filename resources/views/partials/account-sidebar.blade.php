<aside class="col-md-4 col-lg-3">
    <ul class="nav nav-dashboard flex-column mb-3 mb-md-0" role="tablist">
        @if(auth()->user()->isAdmin())
            <li class="nav-item mb-2">
                <a class="nav-link bg-light text-primary font-weight-bold" href="{{ route('admin.dashboard') }}">
                    <i class="la la-shield mr-1"></i> Admin Dashboard &rarr;
                </a>
            </li>
        @endif
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('account.dashboard') ? 'active' : '' }}" href="{{ route('account.dashboard') }}">
                Dashboard
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('account.orders*') ? 'active' : '' }}" href="{{ route('account.orders') }}">
                Orders
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('account.addresses*') ? 'active' : '' }}" href="{{ route('account.addresses') }}">
                Addresses
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('account.profile') ? 'active' : '' }}" href="{{ route('account.profile') }}">
                Account Details
            </a>
        </li>
        <li class="nav-item">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="nav-link btn btn-link text-left w-100 border-0" style="cursor: pointer;">
                    Sign Out
                </button>
            </form>
        </li>
    </ul>
</aside>
