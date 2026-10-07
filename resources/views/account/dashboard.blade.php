@extends('layouts.account')

@section('account_content')
<div class="dashboard-content">
    <p>Hello <span class="font-weight-normal text-dark">{{ $user->name }}</span> (not <span class="font-weight-normal text-dark">{{ $user->name }}</span>? 
        <a href="#" onclick="event.preventDefault(); document.getElementById('logout-dash-form').submit();" class="text-primary">Log out</a>)
    </p>

    <form id="logout-dash-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
    </form>

    <div class="row mt-4 mb-4">
        <div class="col-md-6 mb-3">
            <div class="card p-4 bg-light border-0">
                <h4 class="mb-2">Total Orders</h4>
                <p class="display-4 text-primary font-weight-bold mb-0">{{ $totalOrders }}</p>
                <a href="{{ route('account.orders') }}" class="mt-2 text-muted">View all orders <i class="icon-long-arrow-right"></i></a>
            </div>
        </div>
        <div class="col-md-6 mb-3">
            <div class="card p-4 bg-light border-0">
                <h4 class="mb-2">Saved Addresses</h4>
                <p class="display-4 text-primary font-weight-bold mb-0">{{ $user->addresses->count() }}</p>
                <a href="{{ route('account.addresses') }}" class="mt-2 text-muted">Manage addresses <i class="icon-long-arrow-right"></i></a>
            </div>
        </div>
    </div>

    <h3 class="title mb-3">Recent Orders</h3>
    @if($recentOrders->count() > 0)
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentOrders as $ord)
                    <tr>
                        <td><strong>{{ $ord->order_number }}</strong></td>
                        <td>{{ $ord->created_at->format('M d, Y') }}</td>
                        <td><span class="badge badge-warning text-uppercase">{{ $ord->status }}</span></td>
                        <td>{{ money($ord->total) }}</td>
                        <td>
                            <a href="{{ route('account.orders.show', $ord->order_number) }}" class="btn btn-sm btn-outline-primary-2">View</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p class="text-muted">You have not placed any orders yet.</p>
    @endif
</div>
@endsection
