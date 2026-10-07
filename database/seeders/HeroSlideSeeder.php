<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        HeroSlide::create([
            'subtitle' => 'Trade-In Offer',
            'title' => 'MacBook Air Latest Model',
            'price_prefix' => 'from',
            'price' => 999.99,
            'button_text' => 'Shop Now',
            'button_url' => '/shop',
            'image' => 'assets/images/demos/demo-13/slider/slide-1.png',
            'background_color' => '#ffffff',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        HeroSlide::create([
            'subtitle' => 'Treandline Audio',
            'title' => 'Bose Noise Cancelling Headset',
            'price_prefix' => 'from',
            'price' => 279.99,
            'button_text' => 'Shop Now',
            'button_url' => '/shop',
            'image' => 'assets/images/demos/demo-13/slider/slide-2.jpg',
            'background_color' => '#f4f4f4',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        HeroSlide::create([
            'subtitle' => 'Home Theater Experience',
            'title' => 'Ultra HD 4K Smart Television',
            'price_prefix' => 'start at',
            'price' => 899.00,
            'button_text' => 'Shop Now',
            'button_url' => '/shop',
            'image' => 'assets/images/demos/demo-13/slider/slide-3.jpg',
            'background_color' => '#ececec',
            'sort_order' => 3,
            'is_active' => true,
        ]);
    }
}
