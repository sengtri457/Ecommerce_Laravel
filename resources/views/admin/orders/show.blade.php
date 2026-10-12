@extends('layouts.admin')

@section('title', 'Order #' . $order->order_number)
@section('header_title', 'Order Details')

@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="stat-card mb-4">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-3">
                <div>
                    <h4 class="font-weight-bold mb-1" style="font-size: 1.6rem;">Order #{{ $order->order_number }}</h4>
                    <span class="text-muted" style="font-size: 1.2rem;">Placed on {{ $order->created_at->format('F d, Y \a\t H:i') }}</span>
                </div>
                <div>
                    <span class="badge-status {{ $order->status }}" style="font-size: 1.3rem;">{{ $order->status }}</span>
                </div>
            </div>

            <h5 class="font-weight-bold mb-3">Order Items</h5>
            <div class="table-responsive mb-4">
                <table class="table table-admin mb-0">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th>Unit Price</th>
                            <th>Quantity</th>
                            <th class="text-right">Line Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($order->items as $item)
                            <tr>
                                <td>
                                    <div class="font-weight-bold">{{ $item->product_name }}</div>
                                    <small class="text-muted">SKU: {{ $item->product->sku ?? 'N/A' }}</small>
                                </td>
                                <td>{{ money($item->unit_price) }}</td>
                                <td>{{ $item->quantity }}</td>
                                <td class="text-right font-weight-bold">{{ money($item->line_total) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="row justify-content-end">
                <div class="col-md-5">
                    <div class="d-flex justify-content-between py-1" style="font-size: 1.3rem;">
                        <span class="text-muted">Subtotal:</span>
                        <span class="font-weight-bold">{{ money($order->subtotal) }}</span>
                    </div>
                    <div class="d-flex justify-content-between py-1" style="font-size: 1.3rem;">
                        <span class="text-muted">Shipping:</span>
                        <span class="font-weight-bold">{{ money($order->shipping_cost) }}</span>
                    </div>
                    @if($order->discount > 0)
                        <div class="d-flex justify-content-between py-1 text-danger" style="font-size: 1.3rem;">
                            <span>Discount:</span>
                            <span>-{{ money($order->discount) }}</span>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between py-2 border-top mt-2" style="font-size: 1.6rem;">
                        <span class="font-weight-bold">Total:</span>
                        <span class="font-weight-bold text-primary">{{ money($order->total) }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-4">
        <!-- Status Management Card -->
        <div class="stat-card mb-4">
            <h5 class="font-weight-bold mb-3">Fulfillment Status</h5>
            <form action="{{ route('admin.orders.status', $order) }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <select name="status" class="form-control">
                        @foreach(['pending', 'processing', 'completed', 'cancelled', 'declined'] as $st)
                            <option value="{{ $st }}" {{ $order->status === $st ? 'selected' : '' }}>
                                {{ ucfirst($st) }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary btn-block">Update Status</button>
            </form>
        </div>

        <!-- Customer & Shipping Card -->
        <div class="stat-card mb-4">
            <h5 class="font-weight-bold mb-3">Customer Information</h5>
            <div class="mb-2"><strong>Name:</strong> {{ $order->customer_name }}</div>
            <div class="mb-2"><strong>Email:</strong> <a href="mailto:{{ $order->customer_email }}">{{ $order->customer_email }}</a></div>
            <div class="mb-2"><strong>Phone:</strong> {{ $order->customer_phone ?? 'N/A' }}</div>
            <div class="mb-3"><strong>Payment:</strong> <span class="badge badge-light text-uppercase">{{ $order->payment_method }}</span></div>

            <hr>
            <h5 class="font-weight-bold mb-2">Shipping Destination</h5>
            <p class="text-muted mb-0" style="white-space: pre-line;">{{ $order->shipping_address }}</p>
        </div>

        <a href="{{ route('admin.orders.index') }}" class="btn btn-outline-secondary btn-block">
            <i class="la la-arrow-left"></i> Back to Orders
        </a>
    </div>
</div>
@endsection
