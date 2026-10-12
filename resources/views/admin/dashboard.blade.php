@extends('layouts.admin')

@section('title', 'Admin Dashboard')
@section('header_title', 'Dashboard Overview')

@section('content')
<!-- KPI Telemetry Cards -->
<div class="row mb-4">
    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="stat-card d-flex align-items-center">
            <div class="rounded-circle p-3 mr-3 d-flex align-items-center justify-content-center" style="background: rgba(163, 92, 73, 0.12); width: 52px; height: 52px;">
                <i class="la la-money text-primary" style="font-size: 2.2rem;"></i>
            </div>
            <div>
                <div class="text-muted" style="font-size: 1.2rem;">Total Revenue</div>
                <div class="font-weight-bold" style="font-size: 2rem;">{{ money($metrics['total_sales']) }}</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="stat-card d-flex align-items-center">
            <div class="rounded-circle p-3 mr-3 d-flex align-items-center justify-content-center" style="background: rgba(59, 130, 246, 0.12); width: 52px; height: 52px;">
                <i class="la la-shopping-cart text-info" style="font-size: 2.2rem;"></i>
            </div>
            <div>
                <div class="text-muted" style="font-size: 1.2rem;">Orders</div>
                <div class="font-weight-bold" style="font-size: 2rem;">
                    {{ $metrics['orders_count'] }}
                    @if($metrics['pending_orders'] > 0)
                        <span class="badge badge-warning ml-1" style="font-size: 1rem;">{{ $metrics['pending_orders'] }} pending</span>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="stat-card d-flex align-items-center">
            <div class="rounded-circle p-3 mr-3 d-flex align-items-center justify-content-center" style="background: rgba(16, 185, 129, 0.12); width: 52px; height: 52px;">
                <i class="la la-box text-success" style="font-size: 2.2rem;"></i>
            </div>
            <div>
                <div class="text-muted" style="font-size: 1.2rem;">Catalog Products</div>
                <div class="font-weight-bold" style="font-size: 2rem;">{{ $metrics['products_count'] }}</div>
            </div>
        </div>
    </div>

    <div class="col-xl-3 col-sm-6 mb-3">
        <div class="stat-card d-flex align-items-center">
            <div class="rounded-circle p-3 mr-3 d-flex align-items-center justify-content-center" style="background: rgba(245, 158, 11, 0.12); width: 52px; height: 52px;">
                <i class="la la-users text-warning" style="font-size: 2.2rem;"></i>
            </div>
            <div>
                <div class="text-muted" style="font-size: 1.2rem;">Customers</div>
                <div class="font-weight-bold" style="font-size: 2rem;">{{ $metrics['customers_count'] }}</div>
            </div>
        </div>
    </div>
</div>

<div class="row">
    <!-- Recent Orders Section -->
    <div class="col-lg-8 mb-4">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                <div>
                    <h4 class="font-weight-bold mb-1" style="font-size: 1.6rem;">Recent Orders</h4>
                    <span class="text-muted" style="font-size: 1.2rem;">Fulfillment pipeline and incoming orders</span>
                </div>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-sm btn-outline-secondary" style="font-size: 1.2rem;">View All Orders</a>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-admin mb-0">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Customer</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Date</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentOrders as $order)
                            <tr>
                                <td class="font-weight-bold">{{ $order->order_number }}</td>
                                <td>{{ $order->customer_name }}</td>
                                <td class="font-weight-bold">{{ money($order->total) }}</td>
                                <td><span class="badge-status {{ $order->status }}">{{ $order->status }}</span></td>
                                <td>{{ $order->created_at->format('M d, Y') }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-xs btn-outline-secondary px-2 py-1">View</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No orders found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Collapsible Categories Quick Panel -->
    <div class="col-lg-4 mb-4">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                <h4 class="font-weight-bold mb-0" style="font-size: 1.6rem;">Store Categories</h4>
                <button class="btn btn-sm btn-outline-primary-2" type="button" data-toggle="collapse" data-target="#collapseAddCategory" aria-expanded="false" aria-controls="collapseAddCategory">
                    <i class="la la-plus"></i> New Category
                </button>
            </div>

            <!-- Collapsible Add Category Form -->
            <div class="collapse mb-3" id="collapseAddCategory">
                <div class="p-3 bg-light rounded border mb-3">
                    <h5 class="font-weight-bold mb-2" style="font-size: 1.3rem;">Create Category</h5>
                    <form action="{{ route('admin.categories.store') }}" method="POST">
                        @csrf
                        <div class="form-group mb-2">
                            <input type="text" name="name" class="form-control" placeholder="Category Name" required>
                        </div>
                        <div class="form-group mb-2">
                            <input type="text" name="description" class="form-control" placeholder="Short description (optional)">
                        </div>
                        <button type="submit" class="btn btn-sm btn-primary btn-block">Save Category</button>
                    </form>
                </div>
            </div>

            <ul class="list-unstyled mb-0" style="max-height: 240px; overflow-y: auto;">
                @forelse($categories as $cat)
                    <li class="d-flex align-items-center justify-content-between py-2 border-bottom">
                        <span class="font-weight-500" style="font-size: 1.3rem;">{{ $cat->name }}</span>
                        <span class="badge badge-light" style="font-size: 1.15rem;">{{ $cat->products_count }} products</span>
                    </li>
                @empty
                    <li class="text-muted py-3 text-center">No categories found.</li>
                @endforelse
            </ul>
        </div>
    </div>
</div>

<div class="row">
    <!-- Catalog Highlight with Add Product trigger -->
    <div class="col-12">
        <div class="stat-card">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                <div>
                    <h4 class="font-weight-bold mb-1" style="font-size: 1.6rem;">Recent Products in Catalog</h4>
                    <span class="text-muted" style="font-size: 1.2rem;">Latest added wardrobe essentials and stock indicators</span>
                </div>
                <div>
                    <a href="{{ route('admin.products.create') }}" class="btn btn-sm btn-primary mr-2" style="font-size: 1.2rem;">
                        <i class="la la-plus"></i> Add Product
                    </a>
                    <a href="{{ route('admin.products.index') }}" class="btn btn-sm btn-outline-secondary" style="font-size: 1.2rem;">
                        All Products &rarr;
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover table-admin mb-0">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Status</th>
                            <th class="text-right">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentProducts as $prod)
                            <tr>
                                <td class="font-weight-bold">{{ $prod->name }}</td>
                                <td>{{ $prod->category->name ?? 'Uncategorized' }}</td>
                                <td>{{ money($prod->price) }}</td>
                                <td>
                                    <span class="{{ $prod->stock <= 5 ? 'text-danger font-weight-bold' : '' }}">
                                        {{ $prod->stock }} units
                                    </span>
                                </td>
                                <td>
                                    <span class="badge {{ $prod->is_active ? 'badge-success' : 'badge-secondary' }}">
                                        {{ $prod->is_active ? 'Active' : 'Draft' }}
                                    </span>
                                </td>
                                <td class="text-right">
                                    <a href="{{ route('admin.products.edit', $prod) }}" class="btn btn-xs btn-outline-primary-2 px-2 py-1">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-4 text-muted">No products found.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
