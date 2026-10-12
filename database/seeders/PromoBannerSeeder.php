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
            'subtitle' => 'The Menswear Edit',
            'title' => "Structured Silhouettes &\nOrganic Textures",
            'description' => 'Explore the collection',
            'button_text' => 'Discover Men',
            'button_url' => '/category/men',
            'image' => 'assets/images/mainImages/bannerMen.gif',
            'column_class' => 'col-md-6',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        PromoBanner::create([
            'position' => 'home_promo',
            'subtitle' => 'The Womenswear Capsule',
            'title' => "Effortless Drapery &\nBreathable Weaves",
            'description' => 'Mindful daily luxury',
            'button_text' => 'Discover Women',
            'button_url' => '/category/women',
            'image' => 'assets/images/mainImages/BannerWomen.avif',
            'column_class' => 'col-md-6',
            'sort_order' => 2,
            'is_active' => true,
        ]);
    }
}
