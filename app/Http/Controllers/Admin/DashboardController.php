<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\View\View;

class DashboardController extends Controller
{
    /**
     * Display the Admin Dashboard metrics and latest records.
     */
    public function index(): View
    {
        $metrics = [
            'total_sales' => Order::where('status', '!=', 'cancelled')->sum('total'),
            'orders_count' => Order::count(),
            'pending_orders' => Order::where('status', 'pending')->count(),
            'products_count' => Product::count(),
            'low_stock_count' => Product::where('stock', '<=', 5)->count(),
            'customers_count' => User::where('role', 'customer')->count(),
            'categories_count' => Category::count(),
        ];

        $recentOrders = Order::with('user')
            ->latest()
            ->take(6)
            ->get();

        $recentProducts = Product::with('category')
            ->latest()
            ->take(6)
            ->get();

        $recentUsers = User::latest()
            ->take(5)
            ->get();

        $categories = Category::withCount('products')->orderBy('name')->get();

        return view('admin.dashboard', compact('metrics', 'recentOrders', 'recentProducts', 'recentUsers', 'categories'));
    }
}
