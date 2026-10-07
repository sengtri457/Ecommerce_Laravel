<?php

namespace Database\Seeders;

use App\Models\PromoBanner;
use Illuminate\Database\Seeder;

class PromoBannerSeeder extends Seeder
{
    public function run(): void
    {
        PromoBanner::create([
            'position' => 'home_promo',
            'subtitle' => 'Weekend Sale',
            'title' => 'Lighting & Accessories',
            'description' => '25% off',
            'button_text' => 'Shop Now',
            'button_url' => '/category/lighting',
            'image' => 'assets/images/demos/demo-13/banners/banner-1.jpg',
            'column_class' => 'col-md-3',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        PromoBanner::create([
            'position' => 'home_promo',
            'subtitle' => 'Amazing Value',
            'title' => 'Clothes Trending Spring Collection',
            'description' => 'from $12.99',
            'button_text' => 'Discover Now',
            'button_url' => '/category/clothing',
            'image' => 'assets/images/demos/demo-13/banners/banner-2.jpg',
            'column_class' => 'col-md-6',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        PromoBanner::create([
            'position' => 'home_promo',
            'subtitle' => 'Smart Offer',
            'title' => 'Anniversary Special',
            'description' => '15% off',
            'button_text' => 'Shop Now',
            'button_url' => '/shop?sale=1',
            'image' => 'assets/images/demos/demo-13/banners/banner-3.jpg',
            'column_class' => 'col-md-3',
            'sort_order' => 3,
            'is_active' => true,
        ]);
    }
}
