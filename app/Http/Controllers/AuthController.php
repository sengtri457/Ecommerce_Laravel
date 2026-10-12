<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\User;
use App\Models\WishlistItem;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    /**
     * Show login form.
     */
    public function showLogin(): View
    {
        return view('auth.login', [
            'pageTitle' => 'Sign In - '.setting('site_name', 'Molla'),
        ]);
    }

    /**
     * Handle login authentication.
     */
    public function login(Request $request): RedirectResponse
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();
            $this->mergeGuestData(Auth::id());

            $user = Auth::user();
            $targetRoute = $user->isAdmin() ? route('admin.dashboard') : route('account.dashboard');

            return redirect()->intended($targetRoute)->with('success', 'Welcome back, '.$user->name.'!');
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Show registration form.
     */
    public function showRegister(): View
    {
        return view('auth.register', [
            'pageTitle' => 'Create Account - '.setting('site_name', 'Molla'),
        ]);
    }

    /**
     * Handle user registration.
     */
    public function register(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100|unique:users,email',
            'phone' => 'nullable|string|max:30',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'] ?? null,
            'password' => Hash::make($validated['password']),
            'role' => 'customer',
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        $this->mergeGuestData($user->id);

        return redirect()->route('account.dashboard')->with('success', 'Your account has been created successfully!');
    }

    /**
     * Handle logout.
     */
    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home')->with('info', 'You have been signed out.');
    }

    /**
     * Merge guest cart and wishlist data into authenticated user safely.
     */
    private function mergeGuestData(int $userId): void
    {
        $token = get_cart_session_token();

        // 1. Merge Shopping Cart
        $guestCart = Cart::where('session_token', $token)->first();
        if ($guestCart) {
            $userCart = Cart::where('user_id', $userId)->where('id', '!=', $guestCart->id)->first();
            if ($userCart) {
                foreach ($guestCart->items as $item) {
                    $existingItem = $userCart->items()->where('product_id', $item->product_id)->first();
                    if ($existingItem) {
                        $existingItem->increment('quantity', $item->quantity);
                    } else {
                        $item->update(['cart_id' => $userCart->id]);
                    }
                }
                $guestCart->delete();
            } else {
                $guestCart->update(['user_id' => $userId]);
            }
        }

        // 2. Merge Wishlist without duplicate product entries
        $existingProductIds = WishlistItem::where('user_id', $userId)->pluck('product_id')->all();

        WishlistItem::where('session_token', $token)
            ->whereNotIn('product_id', $existingProductIds)
            ->update(['user_id' => $userId]);

        WishlistItem::where('session_token', $token)->delete();
    }
}
