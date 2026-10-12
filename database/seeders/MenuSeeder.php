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
            'label' => 'Collections',
            'url' => '/shop',
            'sort_order' => 2,
        ]);

        MenuItem::create(['menu_id' => $mainMenu->id, 'parent_id' => $shop->id, 'label' => "Men's Collection", 'url' => '/category/men', 'sort_order' => 1]);
        MenuItem::create(['menu_id' => $mainMenu->id, 'parent_id' => $shop->id, 'label' => "Women's Collection", 'url' => '/category/women', 'sort_order' => 2]);
        MenuItem::create(['menu_id' => $mainMenu->id, 'parent_id' => $shop->id, 'label' => 'Kids & Youth', 'url' => '/category/kids', 'sort_order' => 3]);
        MenuItem::create(['menu_id' => $mainMenu->id, 'parent_id' => $shop->id, 'label' => 'All Wardrobe Pieces', 'url' => '/shop', 'sort_order' => 4]);

        $pages = MenuItem::create([
            'menu_id' => $mainMenu->id,
            'label' => 'Editorial',
            'url' => '/about',
            'sort_order' => 4,
        ]);

        MenuItem::create(['menu_id' => $mainMenu->id, 'parent_id' => $pages->id, 'label' => 'About Clothes™', 'url' => '/about', 'sort_order' => 1]);
        MenuItem::create(['menu_id' => $mainMenu->id, 'parent_id' => $pages->id, 'label' => 'Styling Lookbook & Blog', 'url' => '/blog', 'sort_order' => 2]);
        MenuItem::create(['menu_id' => $mainMenu->id, 'parent_id' => $pages->id, 'label' => 'Contact Concierge', 'url' => '/contact', 'sort_order' => 3]);
        MenuItem::create(['menu_id' => $mainMenu->id, 'parent_id' => $pages->id, 'label' => 'FAQ & Sizing', 'url' => '/faq', 'sort_order' => 4]);

        // 2. Header Promo Menu
        $promoMenu = Menu::create([
            'code' => 'header_promo',
            'name' => 'Header Promotion Link',
        ]);

        MenuItem::create([
            'menu_id' => $promoMenu->id,
            'label' => 'Complimentary Shipping Over $100',
            'url' => '/shop',
            'icon' => 'la la-truck',
            'sort_order' => 1,
        ]);

        // 3. Footer Menus
        $footerHelp = Menu::create([
            'code' => 'footer_help',
            'name' => 'Client Care',
        ]);
        MenuItem::create(['menu_id' => $footerHelp->id, 'label' => 'Payment Methods', 'url' => '/page/payment-methods', 'sort_order' => 1]);
        MenuItem::create(['menu_id' => $footerHelp->id, 'label' => '30-Day Hassle-Free Returns', 'url' => '/page/returns', 'sort_order' => 2]);
        MenuItem::create(['menu_id' => $footerHelp->id, 'label' => 'Complimentary Shipping Over $100', 'url' => '/page/shipping', 'sort_order' => 3]);
        MenuItem::create(['menu_id' => $footerHelp->id, 'label' => 'Terms & Conditions', 'url' => '/page/terms-conditions', 'sort_order' => 4]);
        MenuItem::create(['menu_id' => $footerHelp->id, 'label' => 'Privacy Policy', 'url' => '/page/privacy-policy', 'sort_order' => 5]);

        $footerAccount = Menu::create([
            'code' => 'footer_account',
            'name' => 'Private Capsule',
        ]);
        MenuItem::create(['menu_id' => $footerAccount->id, 'label' => 'Client Sign In', 'url' => '/login', 'sort_order' => 1]);
        MenuItem::create(['menu_id' => $footerAccount->id, 'label' => 'Shopping Bag', 'url' => '/cart', 'sort_order' => 2]);
        MenuItem::create(['menu_id' => $footerAccount->id, 'label' => 'Wishlist', 'url' => '/wishlist', 'sort_order' => 3]);
        MenuItem::create(['menu_id' => $footerAccount->id, 'label' => 'Order Status', 'url' => '/account/orders', 'sort_order' => 4]);

        $footerInfo = Menu::create([
            'code' => 'footer_info',
            'name' => 'Brand Story',
        ]);
        MenuItem::create(['menu_id' => $footerInfo->id, 'label' => 'About Clothes™', 'url' => '/about', 'sort_order' => 1]);
        MenuItem::create(['menu_id' => $footerInfo->id, 'label' => 'The Clothes™ Experience', 'url' => '/page/how-to-shop', 'sort_order' => 2]);
        MenuItem::create(['menu_id' => $footerInfo->id, 'label' => 'Editorial Journal', 'url' => '/blog', 'sort_order' => 3]);
        MenuItem::create(['menu_id' => $footerInfo->id, 'label' => 'Contact Concierge', 'url' => '/contact', 'sort_order' => 4]);

        // 4. Social Links
        $footerSocial = Menu::create([
            'code' => 'footer_social',
            'name' => 'Social Links',
        ]);
        MenuItem::create(['menu_id' => $footerSocial->id, 'label' => 'Instagram', 'url' => 'https://instagram.com', 'icon' => 'icon-instagram', 'sort_order' => 1]);
        MenuItem::create(['menu_id' => $footerSocial->id, 'label' => 'Pinterest', 'url' => 'https://pinterest.com', 'icon' => 'icon-pinterest', 'sort_order' => 2]);
        MenuItem::create(['menu_id' => $footerSocial->id, 'label' => 'Facebook', 'url' => 'https://facebook.com', 'icon' => 'icon-facebook-f', 'sort_order' => 3]);
    }
}
