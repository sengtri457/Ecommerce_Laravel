<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * Get the active cart.
     */
    private function getCart(): ?Cart
    {
        $token = get_cart_session_token();
        $userId = Auth::id();

        return Cart::with(['items.product', 'coupon'])
            ->where(function ($q) use ($token, $userId) {
                if ($userId) {
                    $q->where('user_id', $userId)->orWhere('session_token', $token);
                } else {
                    $q->where('session_token', $token);
                }
            })->first();
    }

    /**
     * Display checkout page.
     */
    public function index(): View|RedirectResponse
    {
        $cart = $this->getCart();

        if (! $cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('info', 'Your cart is empty. Add products before checking out.');
        }

        $shippingMethods = ShippingMethod::active()->get();
        $savedAddresses = Auth::check() ? Auth::user()->addresses : collect();

        return view('checkout.index', [
            'pageTitle' => 'Checkout - '.setting('site_name', 'Molla'),
            'cart' => $cart,
            'shippingMethods' => $shippingMethods,
            'savedAddresses' => $savedAddresses,
        ]);
    }

    /**
     * Place order.
     */
    public function store(Request $request): RedirectResponse
    {
        $cart = $this->getCart();

        if (! $cart || $cart->items->count() === 0) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty.');
        }

        $request->validate([
            'customer_name' => 'required|string|max:100',
            'customer_email' => 'required|email|max:100',
            'customer_phone' => 'required|string|max:30',
            'shipping_address' => 'required|string|max:500',
            'shipping_method_id' => 'required|exists:shipping_methods,id',
            'payment_method' => 'required|string|in:cod,bank_transfer',
            'notes' => 'nullable|string|max:1000',
        ]);

        $shipping = ShippingMethod::findOrFail($request->shipping_method_id);
        $subtotal = $cart->subtotal();
        $discount = $cart->discount();
        $shippingCost = (float) $shipping->cost;
        $total = max(0.0, $subtotal - $discount + $shippingCost);

        $order = DB::transaction(function () use ($cart, $request, $shipping, $subtotal, $discount, $shippingCost, $total) {
            $orderNumber = 'ORD-'.strtoupper(Str::random(10));

            $order = Order::create([
                'order_number' => $orderNumber,
                'user_id' => Auth::id(),
                'shipping_method_id' => $shipping->id,
                'coupon_id' => $cart->coupon_id,
                'customer_name' => $request->customer_name,
                'customer_email' => $request->customer_email,
                'customer_phone' => $request->customer_phone,
                'shipping_address' => $request->shipping_address,
                'subtotal' => $subtotal,
                'shipping_cost' => $shippingCost,
                'discount' => $discount,
                'total' => $total,
                'payment_method' => $request->payment_method,
                'status' => 'pending',
                'notes' => $request->notes,
            ]);

            foreach ($cart->items as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'product_name' => $item->product->name,
                    'unit_price' => $item->unit_price,
                    'quantity' => $item->quantity,
                    'line_total' => (float) $item->unit_price * (int) $item->quantity,
                ]);

                // Reduce stock
                Product::where('id', $item->product_id)->decrement('stock', $item->quantity);
            }

            // Coupon usage tracking
            if ($cart->coupon) {
                $cart->coupon->increment('used_count');
            }

            // Clear cart
            $cart->items()->delete();
            $cart->update(['coupon_id' => null]);

            return $order;
        });

        return redirect()->route('checkout.success', $order->order_number)->with('success', 'Your order was successfully placed!');
    }

    /**
     * Display order success confirmation page.
     */
    public function success(string $number): View
    {
        $order = Order::where('order_number', $number)
            ->with(['items.product.images', 'shippingMethod', 'coupon'])
            ->firstOrFail();

        return view('checkout.success', [
            'pageTitle' => 'Order Confirmed - '.$order->order_number,
            'order' => $order,
        ]);
    }
}
