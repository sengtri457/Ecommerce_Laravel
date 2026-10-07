@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Checkout',
        'subtitle' => 'Finalize your purchase safely and securely',
        'breadcrumbs' => [
            ['label' => 'Shop', 'url' => route('shop.index')],
            ['label' => 'Cart', 'url' => route('cart.index')],
            ['label' => 'Checkout', 'url' => route('checkout.index')]
        ]
    ])

    <div class="page-content">
        <div class="checkout">
            <div class="container">
                <form action="{{ route('checkout.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-8">
                            <h2 class="checkout-title">Billing & Shipping Details</h2>

                            @auth
                                @if($savedAddresses->count() > 0)
                                    <div class="card p-3 mb-4 bg-light">
                                        <label><strong>Use a Saved Address:</strong></label>
                                        <select class="form-control" onchange="applySavedAddress(this)">
                                            <option value="">-- Choose saved address --</option>
                                            @foreach($savedAddresses as $addr)
                                                <option value="{{ $addr->id }}"
                                                    data-name="{{ $addr->full_name }}"
                                                    data-phone="{{ $addr->phone }}"
                                                    data-address="{{ $addr->formatted_address }}"
                                                    {{ $addr->is_default ? 'selected' : '' }}>
                                                    {{ $addr->label }} ({{ $addr->formatted_address }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                @endif
                            @endauth

                            @php
                                $defAddr = Auth::check() ? Auth::user()->defaultAddress : null;
                            @endphp

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Full Name *</label>
                                    <input type="text" id="cust-name" name="customer_name" class="form-control" value="{{ old('customer_name', $defAddr?->full_name ?? Auth::user()?->name) }}" required>
                                </div>

                                <div class="col-sm-6">
                                    <label>Email Address *</label>
                                    <input type="email" id="cust-email" name="customer_email" class="form-control" value="{{ old('customer_email', Auth::user()?->email) }}" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-sm-6">
                                    <label>Phone *</label>
                                    <input type="tel" id="cust-phone" name="customer_phone" class="form-control" value="{{ old('customer_phone', $defAddr?->phone ?? Auth::user()?->phone) }}" required>
                                </div>

                                <div class="col-sm-6">
                                    <label>Street Address & City *</label>
                                    <input type="text" id="cust-address" name="shipping_address" class="form-control" placeholder="House number and street name, City, State, ZIP" value="{{ old('shipping_address', $defAddr?->formatted_address) }}" required>
                                </div>
                            </div>

                            <label>Order notes (optional)</label>
                            <textarea class="form-control" cols="30" rows="3" name="notes" placeholder="Notes about your order, e.g. special delivery instructions.">{{ old('notes') }}</textarea>
                        </div>

                        <aside class="col-lg-4">
                            <div class="summary">
                                <h3 class="summary-title">Your Order</h3>

                                <table class="table table-summary">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($cart->items as $item)
                                            <tr>
                                                <td><a href="{{ route('product.show', $item->product->slug) }}">{{ $item->product->name }}</a> x {{ $item->quantity }}</td>
                                                <td>{{ money($item->line_total) }}</td>
                                            </tr>
                                        @endforeach

                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>{{ money($cart->subtotal()) }}</td>
                                        </tr>

                                        @if($cart->coupon)
                                            <tr class="text-success font-weight-bold">
                                                <td>Coupon ({{ $cart->coupon->code }}):</td>
                                                <td>-{{ money($cart->discount()) }}</td>
                                            </tr>
                                        @endif

                                        <tr class="summary-shipping">
                                            <td>Shipping Option:</td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        @foreach($shippingMethods as $sm)
                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="ship-checkout-{{ $sm->id }}" name="shipping_method_id" value="{{ $sm->id }}" class="custom-control-input" {{ $loop->first ? 'checked' : '' }}>
                                                        <label class="custom-control-label" for="ship-checkout-{{ $sm->id }}">{{ $sm->name }}:</label>
                                                    </div>
                                                </td>
                                                <td>{{ $sm->cost > 0 ? money($sm->cost) : 'Free' }}</td>
                                            </tr>
                                        @endforeach

                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>{{ money($cart->total($shippingMethods->first()?->cost ?? 0)) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <div class="accordion-summary" id="accordion-payment">
                                    <div class="card">
                                        <div class="card-header" id="heading-1">
                                            <h2 class="card-title">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="pay-cod" name="payment_method" value="cod" class="custom-control-input" checked>
                                                    <label class="custom-control-label font-weight-bold" for="pay-cod">Cash on delivery (COD)</label>
                                                </div>
                                            </h2>
                                        </div>
                                    </div>

                                    <div class="card">
                                        <div class="card-header" id="heading-2">
                                            <h2 class="card-title">
                                                <div class="custom-control custom-radio">
                                                    <input type="radio" id="pay-bank" name="payment_method" value="bank_transfer" class="custom-control-input">
                                                    <label class="custom-control-label font-weight-bold" for="pay-bank">Direct bank transfer</label>
                                                </div>
                                            </h2>
                                        </div>
                                    </div>
                                </div>

                                <button type="submit" class="btn btn-outline-primary-2 btn-order btn-block mt-3">
                                    <span class="btn-text">Place Order</span>
                                    <span class="btn-hover-text">Proceed to Confirm</span>
                                </button>
                            </div>
                        </aside>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function applySavedAddress(select) {
            const opt = select.options[select.selectedIndex];
            if (!opt.value) return;
            document.getElementById('cust-name').value = opt.getAttribute('data-name') || '';
            document.getElementById('cust-phone').value = opt.getAttribute('data-phone') || '';
            document.getElementById('cust-address').value = opt.getAttribute('data-address') || '';
        }
    </script>
    @endpush
@endsection
