@extends('layouts.account')

@section('account_content')
<div class="dashboard-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="title mb-0">Order #{{ $order->order_number }}</h3>
        <a href="{{ route('account.orders') }}" class="btn btn-outline-dark-2 btn-sm">
            <i class="icon-arrow-left"></i> Back to Orders
        </a>
    </div>

    <div class="card p-4 bg-light mb-4">
        <div class="row">
            <div class="col-md-6 mb-2">
                <strong>Date:</strong> {{ $order->created_at->format('M d, Y H:i') }}
            </div>
            <div class="col-md-6 mb-2">
                <strong>Status:</strong> <span class="badge badge-warning text-uppercase">{{ $order->status }}</span>
            </div>
            <div class="col-md-6 mb-2">
                <strong>Customer:</strong> {{ $order->customer_name }} ({{ $order->customer_phone }})
            </div>
            <div class="col-md-6 mb-2">
                <strong>Payment Method:</strong> {{ strtoupper($order->payment_method) }}
            </div>
            <div class="col-12">
                <strong>Shipping Address:</strong> {{ $order->shipping_address }}
            </div>
        </div>
    </div>

    <h4 class="mb-3">Purchased Items</h4>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Unit Price</th>
                <th>Quantity</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
                <tr>
                    <td>{{ $item->product_name }}</td>
                    <td>{{ money($item->unit_price) }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ money($item->line_total) }}</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="3" class="text-right font-weight-bold">Subtotal:</td>
                <td>{{ money($order->subtotal) }}</td>
            </tr>
            @if($order->discount > 0)
                <tr class="text-success font-weight-bold">
                    <td colspan="3" class="text-right">Discount:</td>
                    <td>-{{ money($order->discount) }}</td>
                </tr>
            @endif
            <tr>
                <td colspan="3" class="text-right font-weight-bold">Shipping ({{ $order->shippingMethod?->name ?? 'Delivery' }}):</td>
                <td>{{ money($order->shipping_cost) }}</td>
            </tr>
            <tr class="font-weight-bold" style="font-size: 1.2rem;">
                <td colspan="3" class="text-right">Order Total:</td>
                <td class="text-primary">{{ money($order->total) }}</td>
            </tr>
        </tbody>
    </table>
</div>
@endsection
