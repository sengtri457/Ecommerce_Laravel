<?php

namespace Database\Seeders;

use App\Models\Menu;
use App\Models\MenuItem;
use Illuminate\Database\Seeder;

class MenuSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Main Navigation Menu
        $mainMenu = Menu::create([
            'code' => 'main',
            'name' => 'Main Navigation',
        ]);

        $home = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'label' => 'Home',
            'url' => '/',
            'sort_order' => 1,
        ]);

        $shop = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'label' => 'Shop',
            'url' => '/shop',
            'sort_order' => 2,
        ]);

        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $shop->id,
            'label' => 'All Products',
            'url' => '/shop',
            'sort_order' => 1,
        ]);
        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $shop->id,
            'label' => 'Electronics',
            'url' => '/category/electronics',
            'sort_order' => 2,
        ]);
        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $shop->id,
            'label' => 'Furniture',
            'url' => '/category/furniture',
            'sort_order' => 3,
        ]);
        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $shop->id,
            'label' => 'Cooking',
            'url' => '/category/cooking',
            'sort_order' => 4,
        ]);
        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $shop->id,
            'label' => 'Clothing',
            'url' => '/category/clothing',
            'sort_order' => 5,
        ]);

        $productMenu = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'label' => 'Product',
            'url' => '/shop',
            'sort_order' => 3,
        ]);

        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $productMenu->id,
            'label' => 'Featured Products',
            'url' => '/shop?sort=featured',
            'sort_order' => 1,
        ]);
        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $productMenu->id,
            'label' => 'On Sale',
            'url' => '/shop?sale=1',
            'sort_order' => 2,
        ]);

        $pages = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'label' => 'Pages',
            'url' => '/about',
            'sort_order' => 4,
        ]);

        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $pages->id,
            'label' => 'About Us',
            'url' => '/about',
            'sort_order' => 1,
        ]);
        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $pages->id,
            'label' => 'Contact Us',
            'url' => '/contact',
            'sort_order' => 2,
        ]);
        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $pages->id,
            'label' => 'FAQ',
            'url' => '/faq',
            'sort_order' => 3,
        ]);
        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $pages->id,
            'label' => 'Privacy Policy',
            'url' => '/page/privacy-policy',
            'sort_order' => 4,
        ]);
        MenuItem::create([
            'menu_id' => $mainMenu->id,
            'parent_id' => $pages->id,
            'label' => 'Terms and Conditions',
            'url' => '/page/terms-conditions',
            'sort_order' => 5,
        ]);

        $blog = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'label' => 'Blog',
            'url' => '/blog',
            'sort_order' => 5,
        ]);

        // 2. Header Promo Menu
        $promoMenu = Menu::create([
            'code' => 'header_promo',
            'name' => 'Header Promotion Link',
        ]);

        MenuItem::create([
            'menu_id' => $promoMenu->id,
            'label' => 'Clearance Up to 30% Off',
            'url' => '/shop?sale=1',
            'icon' => 'la la-lightbulb-o',
            'sort_order' => 1,
        ]);

        // 3. Footer Menus
        $footerHelp = Menu::create([
            'code' => 'footer_help',
            'name' => 'Customer Service',
        ]);
        MenuItem::create(['menu_id' => $footerHelp->id, 'label' => 'Payment Methods', 'url' => '/page/payment-methods', 'sort_order' => 1]);
        MenuItem::create(['menu_id' => $footerHelp->id, 'label' => 'Money-back guarantee!', 'url' => '/page/returns', 'sort_order' => 2]);
        MenuItem::create(['menu_id' => $footerHelp->id, 'label' => 'Returns', 'url' => '/page/returns', 'sort_order' => 3]);
        MenuItem::create(['menu_id' => $footerHelp->id, 'label' => 'Shipping', 'url' => '/page/shipping', 'sort_order' => 4]);
        MenuItem::create(['menu_id' => $footerHelp->id, 'label' => 'Terms and conditions', 'url' => '/page/terms-conditions', 'sort_order' => 5]);
        MenuItem::create(['menu_id' => $footerHelp->id, 'label' => 'Privacy Policy', 'url' => '/page/privacy-policy', 'sort_order' => 6]);

        $footerAccount = Menu::create([
            'code' => 'footer_account',
            'name' => 'My Account',
        ]);
        MenuItem::create(['menu_id' => $footerAccount->id, 'label' => 'Sign In', 'url' => '/login', 'sort_order' => 1]);
        MenuItem::create(['menu_id' => $footerAccount->id, 'label' => 'View Cart', 'url' => '/cart', 'sort_order' => 2]);
        MenuItem::create(['menu_id' => $footerAccount->id, 'label' => 'My Wishlist', 'url' => '/wishlist', 'sort_order' => 3]);
        MenuItem::create(['menu_id' => $footerAccount->id, 'label' => 'Track My Order', 'url' => '/account/orders', 'sort_order' => 4]);
        MenuItem::create(['menu_id' => $footerAccount->id, 'label' => 'Help', 'url' => '/faq', 'sort_order' => 5]);

        $footerInfo = Menu::create([
            'code' => 'footer_info',
            'name' => 'Information',
        ]);
        MenuItem::create(['menu_id' => $footerInfo->id, 'label' => 'About Molla', 'url' => '/about', 'sort_order' => 1]);
        MenuItem::create(['menu_id' => $footerInfo->id, 'label' => 'How to shop on Molla', 'url' => '/page/how-to-shop', 'sort_order' => 2]);
        MenuItem::create(['menu_id' => $footerInfo->id, 'label' => 'FAQ', 'url' => '/faq', 'sort_order' => 3]);
        MenuItem::create(['menu_id' => $footerInfo->id, 'label' => 'Contact us', 'url' => '/contact', 'sort_order' => 4]);
        MenuItem::create(['menu_id' => $footerInfo->id, 'label' => 'Log in', 'url' => '/login', 'sort_order' => 5]);

        // 4. Social Links
        $footerSocial = Menu::create([
            'code' => 'footer_social',
            'name' => 'Social Links',
        ]);
        MenuItem::create(['menu_id' => $footerSocial->id, 'label' => 'Facebook', 'url' => 'https://facebook.com', 'icon' => 'icon-facebook-f', 'sort_order' => 1]);
        MenuItem::create(['menu_id' => $footerSocial->id, 'label' => 'Twitter', 'url' => 'https://twitter.com', 'icon' => 'icon-twitter', 'sort_order' => 2]);
        MenuItem::create(['menu_id' => $footerSocial->id, 'label' => 'Instagram', 'url' => 'https://instagram.com', 'icon' => 'icon-instagram', 'sort_order' => 3]);
        MenuItem::create(['menu_id' => $footerSocial->id, 'label' => 'Youtube', 'url' => 'https://youtube.com', 'icon' => 'icon-youtube', 'sort_order' => 4]);
        MenuItem::create(['menu_id' => $footerSocial->id, 'label' => 'Pinterest', 'url' => 'https://pinterest.com', 'icon' => 'icon-pinterest', 'sort_order' => 5]);
    }
}
