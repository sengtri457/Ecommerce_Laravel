@extends('layouts.admin')

@section('title', 'Manage Orders')
@section('header_title', 'Customer Orders')

@section('content')
<div class="stat-card mb-4">
    <div class="row align-items-center mb-3">
        <div class="col-md-9">
            <form action="{{ route('admin.orders.index') }}" method="GET" class="form-inline">
                <input type="text" name="q" value="{{ request('q') }}" class="form-control mr-2 mb-2" placeholder="Search order #, customer, email...">
                <select name="status" class="form-control mr-2 mb-2">
                    <option value="">All Statuses</option>
                    <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                    <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>Processing</option>
                    <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                    <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                    <option value="declined" {{ request('status') == 'declined' ? 'selected' : '' }}>Declined</option>
                </select>
                <button type="submit" class="btn btn-outline-primary-2 mb-2">Filter</button>
                @if(request()->anyFilled(['q', 'status']))
                    <a href="{{ route('admin.orders.index') }}" class="btn btn-link text-muted mb-2 ml-2">Clear</a>
                @endif
            </form>
        </div>
    </div>

    <div class="table-responsive">
        <table class="table table-hover table-admin mb-0">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Customer</th>
                    <th>Date</th>
                    <th>Items</th>
                    <th>Total</th>
                    <th>Status</th>
                    <th>Payment Method</th>
                    <th class="text-right">Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td class="font-weight-bold">{{ $order->order_number }}</td>
                        <td>
                            <div>{{ $order->customer_name }}</div>
                            <small class="text-muted">{{ $order->customer_email }}</small>
                        </td>
                        <td>{{ $order->created_at->format('M d, Y H:i') }}</td>
                        <td>{{ $order->items->sum('quantity') }} items</td>
                        <td class="font-weight-bold">{{ money($order->total) }}</td>
                        <td><span class="badge-status {{ $order->status }}">{{ $order->status }}</span></td>
                        <td><span class="badge badge-light text-uppercase">{{ $order->payment_method }}</span></td>
                        <td class="text-right">
                            <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-sm btn-outline-primary-2 px-3 py-1">Details</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="8" class="text-center py-4 text-muted">No orders found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $orders->links() }}
    </div>
</div>
@endsection
