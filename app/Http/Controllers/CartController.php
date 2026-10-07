<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShippingMethod;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Get or create the active cart instance.
     */
    private function getCart(): Cart
    {
        $token = get_cart_session_token();
        $userId = Auth::id();

        $cart = Cart::where(function ($q) use ($token, $userId) {
            if ($userId) {
                $q->where('user_id', $userId)->orWhere('session_token', $token);
            } else {
                $q->where('session_token', $token);
            }
        })->first();

        if (! $cart) {
            $cart = Cart::create([
                'session_token' => $token,
                'user_id' => $userId,
            ]);
        } elseif ($userId && ! $cart->user_id) {
            $cart->update(['user_id' => $userId]);
        }

        return $cart;
    }

    /**
     * Display the shopping cart.
     */
    public function index(): View
    {
        $cart = $this->getCart();
        $cart->load(['items.product.images', 'coupon']);

        $shippingMethods = ShippingMethod::active()->get();
        $selectedShippingId = session('shipping_method_id', $shippingMethods->first()?->id);
        $selectedShipping = $shippingMethods->firstWhere('id', $selectedShippingId);
        $shippingCost = $selectedShipping ? (float) $selectedShipping->cost : 0.0;

        return view('cart.index', [
            'pageTitle' => 'Shopping Cart - '.setting('site_name', 'Molla'),
            'cart' => $cart,
            'shippingMethods' => $shippingMethods,
            'selectedShipping' => $selectedShipping,
            'shippingCost' => $shippingCost,
        ]);
    }

    /**
     * Add a product to the cart.
     */
    public function add(Request $request): RedirectResponse
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $product = Product::active()->findOrFail($request->product_id);
        $qtyToAdd = (int) ($request->quantity ?? 1);

        if ($product->stock <= 0) {
            return back()->with('error', 'Sorry, this product is out of stock.');
        }

        $cart = $this->getCart();
        $item = CartItem::where('cart_id', $cart->id)
            ->where('product_id', $product->id)
            ->first();

        if ($item) {
            $newQty = min($product->stock, $item->quantity + $qtyToAdd);
            $item->update([
                'quantity' => $newQty,
                'unit_price' => $product->final_price,
            ]);
        } else {
            CartItem::create([
                'cart_id' => $cart->id,
                'product_id' => $product->id,
                'quantity' => min($product->stock, $qtyToAdd),
                'unit_price' => $product->final_price,
            ]);
        }

        return back()->with('success', "Added {$product->name} to your shopping cart!");
    }

    /**
     * Update cart items quantity.
     */
    public function update(Request $request): RedirectResponse
    {
        $quantities = (array) $request->input('quantities', []);
        $cart = $this->getCart();

        foreach ($quantities as $itemId => $qty) {
            $qty = (int) $qty;
            $item = CartItem::where('cart_id', $cart->id)->where('id', $itemId)->first();
            if ($item) {
                if ($qty <= 0) {
                    $item->delete();
                } else {
                    $cappedQty = min($item->product->stock, $qty);
                    $item->update(['quantity' => $cappedQty]);
                }
            }
        }

        if ($request->filled('shipping_method_id')) {
            session(['shipping_method_id' => $request->shipping_method_id]);
        }

        return back()->with('success', 'Cart successfully updated.');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove(Request $request): RedirectResponse
    {
        $cart = $this->getCart();
        CartItem::where('cart_id', $cart->id)
            ->where('id', $request->cart_item_id)
            ->delete();

        return back()->with('success', 'Item removed from cart.');
    }

    /**
     * Apply coupon code.
     */
    public function coupon(Request $request): RedirectResponse
    {
        $request->validate(['code' => 'required|string']);
        $code = strtoupper(trim($request->code));

        $coupon = Coupon::valid()->where('code', $code)->first();
        if (! $coupon) {
            return back()->with('error', 'Invalid or expired coupon code.');
        }

        $cart = $this->getCart();
        if ($coupon->min_total && $cart->subtotal() < (float) $coupon->min_total) {
            return back()->with('error', 'Minimum order subtotal for this coupon is '.money($coupon->min_total));
        }

        $cart->update(['coupon_id' => $coupon->id]);

        return back()->with('success', "Coupon '{$coupon->code}' applied successfully!");
    }
}
