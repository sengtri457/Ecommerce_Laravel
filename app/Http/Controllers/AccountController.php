<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AccountController extends Controller
{
    /**
     * Dashboard home.
     */
    public function dashboard(): View
    {
        $user = Auth::user();
        $recentOrders = $user->orders()->with('items')->latest()->take(5)->get();
        $totalOrders = $user->orders()->count();

        return view('account.dashboard', [
            'pageTitle' => 'My Dashboard - '.setting('site_name', 'Molla'),
            'user' => $user,
            'recentOrders' => $recentOrders,
            'totalOrders' => $totalOrders,
        ]);
    }

    /**
     * Orders list.
     */
    public function orders(): View
    {
        $orders = Auth::user()->orders()->with('items')->latest()->paginate(10);

        return view('account.orders', [
            'pageTitle' => 'My Orders - '.setting('site_name', 'Molla'),
            'orders' => $orders,
        ]);
    }

    /**
     * Order detail.
     */
    public function order(string $number): View
    {
        $order = Auth::user()->orders()
            ->where('order_number', $number)
            ->with(['items.product.images', 'shippingMethod', 'coupon'])
            ->firstOrFail();

        return view('account.order', [
            'pageTitle' => 'Order #'.$order->order_number,
            'order' => $order,
        ]);
    }

    /**
     * Profile page.
     */
    public function profile(): View
    {
        return view('account.profile', [
            'pageTitle' => 'Account Details - '.setting('site_name', 'Molla'),
            'user' => Auth::user(),
        ]);
    }

    /**
     * Update profile and password.
     */
    public function updateProfile(Request $request): RedirectResponse
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:100',
            'phone' => 'nullable|string|max:30',
            'current_password' => 'nullable|string|required_with:password',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if ($request->filled('password')) {
            if (! Hash::check($request->current_password, $user->password)) {
                return back()->withErrors(['current_password' => 'Current password does not match.']);
            }
            $user->password = Hash::make($request->password);
        }

        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->save();

        return back()->with('success', 'Your profile details have been updated.');
    }
}
