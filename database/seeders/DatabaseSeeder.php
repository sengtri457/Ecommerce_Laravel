<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            SettingsSeeder::class,
            MenuSeeder::class,
            CategorySeeder::class,
            BrandSeeder::class,
            AttributeSeeder::class,
            ProductSeeder::class,
            HeroSlideSeeder::class,
            PromoBannerSeeder::class,
            HomeContentSeeder::class,
            ShippingAndCouponSeeder::class,
            UserSeeder::class,
            BlogSeeder::class,
            PageSeeder::class,
        ]);
    }
}
