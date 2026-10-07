@extends('layouts.account')

@section('account_content')
<div class="dashboard-content">
    <h3 class="title mb-4">My Orders</h3>

    @if($orders->count() > 0)
        <table class="table table-bordered text-center">
            <thead>
                <tr>
                    <th>Order #</th>
                    <th>Date</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orders as $ord)
                    <tr>
                        <td><strong>{{ $ord->order_number }}</strong></td>
                        <td>{{ $ord->created_at->format('M d, Y') }}</td>
                        <td><span class="badge badge-warning text-uppercase">{{ $ord->status }}</span></td>
                        <td>{{ money($ord->total) }}</td>
                        <td>
                            <a href="{{ route('account.orders.show', $ord->order_number) }}" class="btn btn-sm btn-outline-primary-2">
                                View Details
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <div class="mt-4">
            {{ $orders->links() }}
        </div>
    @else
        <x-empty-state 
            icon="icon-shopping-cart"
            title="No orders yet"
            message="You haven't completed any orders with our store yet."
            buttonText="Browse Catalog"
            :buttonUrl="route('shop.index')"
        />
    @endif
</div>
@endsection
