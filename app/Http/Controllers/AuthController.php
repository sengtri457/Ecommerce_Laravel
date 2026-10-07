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
    public function showLogin(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('account.dashboard');
        }

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

            // Merge guest cart and wishlist
            $this->mergeGuestData(Auth::id());

            return redirect()->intended(route('account.dashboard'))->with('success', 'Welcome back, '.Auth::user()->name.'!');
        }

        return back()->withInput($request->only('email'))->withErrors([
            'email' => 'The provided credentials do not match our records.',
        ]);
    }

    /**
     * Show registration form.
     */
    public function showRegister(): View|RedirectResponse
    {
        if (Auth::check()) {
            return redirect()->route('account.dashboard');
        }

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

        // Merge guest cart and wishlist
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
     * Merge guest cart and wishlist data into authenticated user.
     */
    private function mergeGuestData(int $userId): void
    {
        $token = get_cart_session_token();

        // Merge cart
        $guestCart = Cart::where('session_token', $token)->first();
        if ($guestCart) {
            $guestCart->update(['user_id' => $userId]);
        }

        // Merge wishlist
        WishlistItem::where('session_token', $token)->update(['user_id' => $userId]);
    }
}
