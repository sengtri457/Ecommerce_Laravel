<?php

namespace Database\Seeders;

use App\Models\HeroSlide;
use Illuminate\Database\Seeder;

class HeroSlideSeeder extends Seeder
{
    public function run(): void
    {
        HeroSlide::create([
            'subtitle' => 'The Autumn / Winter Capsule',
            'title' => "Minimalism in\nEveryday Wear",
            'price_prefix' => 'essentials from',
            'price' => 85.00,
            'button_text' => 'Explore Collection',
            'button_url' => '/shop',
            'image' => 'assets/images/mainImages/slide/banner1.avif',
            'background_color' => '#FAFAF8',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        HeroSlide::create([
            'subtitle' => 'Conscious Craftsmanship',
            'title' => "Tactile Quality &\nTimeless Silhouettes",
            'price_prefix' => 'starts at',
            'price' => 120.00,
            'button_text' => 'Shop Essentials',
            'button_url' => '/shop',
            'image' => 'assets/images/mainImages/slide/banner2.avif',
            'background_color' => '#F4F4F0',
            'sort_order' => 2,
            'is_active' => true,
        ]);
    }
}
