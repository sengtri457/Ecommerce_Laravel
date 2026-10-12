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

                // Batch-load all menus in a single query
                $menus = Menu::with('items.children')->get()->keyBy('code');

                $rootCategories = Category::roots()->active()->with('children')->orderBy('sort_order')->get();

                // Cart resolution via model helper
                $cart = Cart::forCurrentSession()->with('items.product.images')->first();
                $cartCount = $cart ? $cart->items->sum('quantity') : 0;
                $miniCartItems = $cart ? $cart->items : collect();
                $miniCartSubtotal = $cart ? $cart->subtotal() : 0.0;

                // Wishlist & Compare counts
                $wishlistCount = WishlistItem::forCurrentSession()->count();
                $compareList = session()->get('compare', []);
                $compareCount = is_array($compareList) ? count($compareList) : 0;

                $view->with([
                    'settings' => $settings,
                    'mainMenu' => $menus->get('main'),
                    'promoMenu' => $menus->get('header_promo'),
                    'footerHelpMenu' => $menus->get('footer_help'),
                    'footerAccountMenu' => $menus->get('footer_account'),
                    'footerInfoMenu' => $menus->get('footer_info'),
                    'footerSocialMenu' => $menus->get('footer_social'),
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
