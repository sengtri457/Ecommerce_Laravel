@extends('layouts.app')

@section('content')
    @include('partials.page-header', [
        'title' => 'Shopping Cart',
        'subtitle' => 'Review your chosen items and proceed to checkout',
        'breadcrumbs' => [
            ['label' => 'Shop', 'url' => route('shop.index')],
            ['label' => 'Shopping Cart', 'url' => route('cart.index')]
        ]
    ])

    <div class="page-content">
        <div class="cart">
            <div class="container">
                @if($cart->items->count() > 0)
                    <div class="row">
                        <div class="col-lg-9">
                            <form action="{{ route('cart.update') }}" method="POST" id="cart-update-form">
                                @csrf
                                <table class="table table-cart table-mobile">
                                    <thead>
                                        <tr>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total</th>
                                            <th></th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach($cart->items as $item)
                                            <tr>
                                                <td class="product-col">
                                                    <div class="product">
                                                        <figure class="product-media">
                                                            <a href="{{ route('product.show', $item->product->slug) }}">
                                                                <img src="{{ asset($item->product->primary_image) }}" alt="{{ $item->product->name }}">
                                                            </a>
                                                        </figure>

                                                        <h3 class="product-title">
                                                            <a href="{{ route('product.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                                                        </h3>
                                                    </div>
                                                </td>
                                                <td class="price-col">{{ money($item->unit_price) }}</td>
                                                <td class="quantity-col">
                                                    <div class="cart-product-quantity" style="max-width: 80px;">
                                                        <input type="number" class="form-control" name="quantities[{{ $item->id }}]" value="{{ $item->quantity }}" min="1" max="{{ max(1, $item->product->stock) }}" step="1" required>
                                                    </div>
                                                </td>
                                                <td class="total-col">{{ money($item->line_total) }}</td>
                                                <td class="remove-col">
                                                    <button type="button" class="btn-remove" onclick="document.getElementById('remove-item-{{ $item->id }}').submit();" style="border: none; background: none; cursor: pointer;">
                                                        <i class="icon-close"></i>
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="cart-bottom">
                                    <div class="cart-discount">
                                        <!-- Coupon Form handled separately below -->
                                    </div>

                                    <button type="submit" class="btn btn-outline-dark-2"><span>UPDATE CART</span><i class="icon-refresh"></i></button>
                                </div>
                            </form>

                            <!-- Standalone Coupon Form -->
                            <div class="row mt-3">
                                <div class="col-md-6">
                                    <form action="{{ route('cart.coupon') }}" method="POST">
                                        @csrf
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="code" required placeholder="Coupon code (e.g. WELCOME10)" value="{{ $cart->coupon?->code }}">
                                            <div class="input-group-append">
                                                <button class="btn btn-outline-primary-2" type="submit"><i class="icon-long-arrow-right"></i> Apply</button>
                                            </div>
                                        </div>
                                    </form>
                                    @if($cart->coupon)
                                        <small class="text-success mt-1 d-block">
                                            <i class="icon-check"></i> Coupon <strong>{{ $cart->coupon->code }}</strong> active (Discount: {{ money($cart->discount()) }})
                                        </small>
                                    @endif
                                </div>
                            </div>

                            <!-- Hidden remove forms -->
                            @foreach($cart->items as $item)
                                <form id="remove-item-{{ $item->id }}" action="{{ route('cart.remove') }}" method="POST" class="d-none">
                                    @csrf
                                    <input type="hidden" name="cart_item_id" value="{{ $item->id }}">
                                </form>
                            @endforeach
                        </div>

                        <!-- Cart Summary Column -->
                        <aside class="col-lg-3">
                            <div class="summary summary-cart">
                                <h3 class="summary-title">Cart Total</h3>

                                <table class="table table-summary">
                                    <tbody>
                                        <tr class="summary-subtotal">
                                            <td>Subtotal:</td>
                                            <td>{{ money($cart->subtotal()) }}</td>
                                        </tr>

                                        @if($cart->coupon)
                                            <tr class="summary-discount text-success">
                                                <td>Discount ({{ $cart->coupon->code }}):</td>
                                                <td>-{{ money($cart->discount()) }}</td>
                                            </tr>
                                        @endif

                                        <tr class="summary-shipping">
                                            <td>Shipping:</td>
                                            <td>&nbsp;</td>
                                        </tr>

                                        @foreach($shippingMethods as $method)
                                            <tr class="summary-shipping-row">
                                                <td>
                                                    <div class="custom-control custom-radio">
                                                        <input type="radio" id="ship-{{ $method->id }}" name="shipping_method_choice" value="{{ $method->id }}" class="custom-control-input" {{ $selectedShipping?->id == $method->id ? 'checked' : '' }} onchange="document.getElementById('shipping-input-hidden').value = this.value; document.getElementById('cart-update-form').submit();">
                                                        <label class="custom-control-label" for="ship-{{ $method->id }}">{{ $method->name }}:</label>
                                                    </div>
                                                </td>
                                                <td>{{ $method->cost > 0 ? money($method->cost) : 'Free' }}</td>
                                            </tr>
                                        @endforeach

                                        <tr class="summary-total">
                                            <td>Total:</td>
                                            <td>{{ money($cart->total($shippingCost)) }}</td>
                                        </tr>
                                    </tbody>
                                </table>

                                <input type="hidden" id="shipping-input-hidden" name="shipping_method_id" form="cart-update-form" value="{{ $selectedShipping?->id }}">

                                <a href="{{ route('checkout.index') }}" class="btn btn-primary btn-order btn-block">
                                    PROCEED TO CHECKOUT
                                </a>
                            </div>

                            <a href="{{ route('shop.index') }}" class="btn btn-outline-dark-2 btn-block mb-3">
                                <span>CONTINUE SHOPPING</span><i class="icon-refresh"></i>
                            </a>
                        </aside>
                    </div>
                @else
                    <x-empty-state 
                        icon="icon-shopping-cart"
                        title="Your cart is currently empty"
                        message="Explore our rich catalog and add some amazing products to your bag."
                        buttonText="Start Shopping"
                        :buttonUrl="route('shop.index')"
                    />
                @endif
            </div>
        </div>
    </div>
@endsection
