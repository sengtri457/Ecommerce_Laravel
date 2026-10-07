@extends('layouts.app')

@section('content')
    <div class="page-content py-5">
        <div class="container text-center">
            <div class="card p-5 mx-auto shadow-sm" style="max-width: 700px; border-radius: 8px;">
                <div class="mb-4">
                    <i class="icon-check text-success" style="font-size: 5rem;"></i>
                </div>
                <h2 class="mb-2">Thank you for your order!</h2>
                <p class="text-muted mb-4">Your order has been placed and is currently being processed by our logistics hub.</p>

                <div class="bg-light p-4 rounded text-left mb-4">
                    <div class="row mb-2">
                        <div class="col-6"><strong>Order Number:</strong></div>
                        <div class="col-6 text-right font-weight-bold text-primary">{{ $order->order_number }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Customer Name:</strong></div>
                        <div class="col-6 text-right">{{ $order->customer_name }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Shipping Address:</strong></div>
                        <div class="col-6 text-right">{{ $order->shipping_address }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Payment Method:</strong></div>
                        <div class="col-6 text-right">{{ strtoupper($order->payment_method) }}</div>
                    </div>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Order Status:</strong></div>
                        <div class="col-6 text-right"><span class="badge badge-warning text-uppercase">{{ $order->status }}</span></div>
                    </div>
                    <hr>
                    <div class="row mb-2">
                        <div class="col-6"><strong>Total Amount:</strong></div>
                        <div class="col-6 text-right font-weight-bold text-dark" style="font-size: 1.3rem;">{{ money($order->total) }}</div>
                    </div>
                </div>

                <div class="text-left mb-4">
                    <h4 class="mb-3">Order Summary:</h4>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Item</th>
                                <th>Qty</th>
                                <th>Line Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($order->items as $item)
                                <tr>
                                    <td>{{ $item->product_name }}</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>{{ money($item->line_total) }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div>
                    <a href="{{ route('shop.index') }}" class="btn btn-primary btn-round">
                        <span>Continue Shopping</span>
                        <i class="icon-long-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection
