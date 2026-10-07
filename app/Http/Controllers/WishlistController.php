<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\WishlistItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * Display wishlist items.
     */
    public function index(): View
    {
        $token = get_cart_session_token();
        $userId = Auth::id();

        $wishlistItems = WishlistItem::with(['product.images', 'product.category'])
            ->where(function ($q) use ($token, $userId) {
                if ($userId) {
                    $q->where('user_id', $userId)->orWhere('session_token', $token);
                } else {
                    $q->where('session_token', $token);
                }
            })
            ->latest()
            ->get();

        return view('wishlist.index', [
            'pageTitle' => 'My Wishlist - '.setting('site_name', 'Molla'),
            'wishlistItems' => $wishlistItems,
        ]);
    }

    /**
     * Toggle a product in/out of the wishlist.
     */
    public function toggle(Request $request): RedirectResponse
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        $productId = $request->product_id;

        $token = get_cart_session_token();
        $userId = Auth::id();

        $existing = WishlistItem::where(function ($q) use ($token, $userId) {
            if ($userId) {
                $q->where('user_id', $userId)->orWhere('session_token', $token);
            } else {
                $q->where('session_token', $token);
            }
        })->where('product_id', $productId)->first();

        if ($existing) {
            $existing->delete();

            return back()->with('info', 'Item removed from your wishlist.');
        }

        WishlistItem::create([
            'session_token' => $token,
            'user_id' => $userId,
            'product_id' => $productId,
        ]);

        return back()->with('success', 'Item added to your wishlist!');
    }
}
