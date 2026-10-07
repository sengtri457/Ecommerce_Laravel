<?php

namespace Database\Seeders;

use App\Models\Feature;
use App\Models\HomeSection;
use Illuminate\Database\Seeder;

class HomeContentSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Home services features strip
        Feature::create([
            'position' => 'home_services',
            'icon' => 'icon-rocket',
            'title' => 'Free Shipping',
            'description' => 'Orders $50 or more',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Feature::create([
            'position' => 'home_services',
            'icon' => 'icon-rotate-left',
            'title' => 'Free Returns',
            'description' => 'Within 30 days',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        Feature::create([
            'position' => 'home_services',
            'icon' => 'icon-info-circle',
            'title' => 'Get 20% Off 1 Item',
            'description' => 'When you sign up',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        Feature::create([
            'position' => 'home_services',
            'icon' => 'icon-life-ring',
            'title' => 'We Support',
            'description' => '24/7 amazing services',
            'sort_order' => 4,
            'is_active' => true,
        ]);

        // 2. About values features
        Feature::create([
            'position' => 'about_values',
            'icon' => 'icon-star',
            'title' => 'Top Quality Products',
            'description' => 'We curate only premium items from certified manufacturers and global designers.',
            'sort_order' => 1,
            'is_active' => true,
        ]);

        Feature::create([
            'position' => 'about_values',
            'icon' => 'icon-truck',
            'title' => 'Global Logistics',
            'description' => 'Fast, traceable shipping worldwide with partnerships across premier courier services.',
            'sort_order' => 2,
            'is_active' => true,
        ]);

        Feature::create([
            'position' => 'about_values',
            'icon' => 'icon-lock',
            'title' => 'Secure Payments',
            'description' => 'Multi-layer encrypted transactions ensuring total peace of mind for every customer.',
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // 3. Home Sections
        HomeSection::create([
            'title' => 'Featured Products',
            'subtitle' => 'Our Top Recommendations',
            'type' => 'featured',
            'item_limit' => 8,
            'sort_order' => 1,
            'is_active' => true,
        ]);

        HomeSection::create([
            'title' => 'New Arrivals',
            'subtitle' => 'Fresh In Store',
            'type' => 'new',
            'item_limit' => 8,
            'sort_order' => 2,
            'is_active' => true,
        ]);

        HomeSection::create([
            'title' => 'Deals & Outlet',
            'subtitle' => 'Save Big on Selected Items',
            'type' => 'on_sale',
            'item_limit' => 8,
            'sort_order' => 3,
            'is_active' => true,
        ]);
    }
}
