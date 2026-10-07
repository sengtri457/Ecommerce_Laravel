<?php

namespace App\Providers;

use App\Models\BlogCategory;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Models\Cart;
use App\Models\Category;
use App\Models\Menu;
use App\Models\Setting;
use App\Models\WishlistItem;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();

        // Global Layout and Header/Footer Composer
        View::composer(['layouts.app', 'partials.header', 'partials.main-nav', 'partials.category-sidebar', 'partials.footer'], function ($view) {
            try {
                $settings = Setting::getAll();

                $mainMenu = Menu::where('code', 'main')->with(['items.children'])->first();
                $promoMenu = Menu::where('code', 'header_promo')->with('items')->first();
                $footerHelpMenu = Menu::where('code', 'footer_help')->with('items')->first();
                $footerAccountMenu = Menu::where('code', 'footer_account')->with('items')->first();
                $footerInfoMenu = Menu::where('code', 'footer_info')->with('items')->first();
                $footerSocialMenu = Menu::where('code', 'footer_social')->with('items')->first();

                $rootCategories = Category::roots()->active()->with('children')->orderBy('sort_order')->get();

                // Cart resolution
                $token = get_cart_session_token();
                $userId = Auth::id();

                $cart = Cart::with(['items.product.images'])
                    ->where(function ($q) use ($token, $userId) {
                        if ($userId) {
                            $q->where('user_id', $userId)->orWhere('session_token', $token);
                        } else {
                            $q->where('session_token', $token);
                        }
                    })->first();

                $cartCount = $cart ? $cart->items->sum('quantity') : 0;
                $miniCartItems = $cart ? $cart->items : collect();
                $miniCartSubtotal = $cart ? $cart->subtotal() : 0.0;

                // Wishlist resolution
                $wishlistCount = WishlistItem::where(function ($q) use ($token, $userId) {
                    if ($userId) {
                        $q->where('user_id', $userId)->orWhere('session_token', $token);
                    } else {
                        $q->where('session_token', $token);
                    }
                })->count();

                // Compare resolution
                $compareList = session()->get('compare', []);
                $compareCount = is_array($compareList) ? count($compareList) : 0;

                $view->with([
                    'settings' => $settings,
                    'mainMenu' => $mainMenu,
                    'promoMenu' => $promoMenu,
                    'footerHelpMenu' => $footerHelpMenu,
                    'footerAccountMenu' => $footerAccountMenu,
                    'footerInfoMenu' => $footerInfoMenu,
                    'footerSocialMenu' => $footerSocialMenu,
                    'rootCategories' => $rootCategories,
                    'cartCount' => $cartCount,
                    'miniCartItems' => $miniCartItems,
                    'miniCartSubtotal' => $miniCartSubtotal,
                    'wishlistCount' => $wishlistCount,
                    'compareCount' => $compareCount,
                ]);
            } catch (\Throwable $e) {
                // Failsafe for migration/installer boots
            }
        });

        // Blog Sidebar Composer
        View::composer('partials.blog-sidebar', function ($view) {
            try {
                $blogCategories = BlogCategory::withCount('posts')->orderBy('sort_order')->get();
                $recentPosts = BlogPost::published()->take(4)->get();
                $blogTags = BlogTag::all();

                $view->with([
                    'blogCategories' => $blogCategories,
                    'recentPosts' => $recentPosts,
                    'blogTags' => $blogTags,
                ]);
            } catch (\Throwable $e) {
                // Failsafe
            }
        });
    }
}
