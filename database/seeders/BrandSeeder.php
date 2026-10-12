<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Clothes™ Atelier', 'slug' => 'clothes-atelier', 'logo' => 'assets/images/brands/1.png'],
            ['name' => 'Nike ACG', 'slug' => 'nike-acg', 'logo' => 'assets/images/brands/4.png'],
            ['name' => 'Adidas Originals', 'slug' => 'adidas-originals', 'logo' => 'assets/images/brands/2.png'],
            ['name' => 'New Balance Heritage', 'slug' => 'new-balance', 'logo' => 'assets/images/brands/3.png'],
            ['name' => 'Linen Craft Guild', 'slug' => 'linen-craft', 'logo' => 'assets/images/brands/5.png'],
            ['name' => 'Modern Minimalist Co.', 'slug' => 'modern-minimalist', 'logo' => 'assets/images/brands/6.png'],
        ];

        foreach ($brands as $brand) {
            Brand::create([
                'name' => $brand['name'],
                'slug' => $brand['slug'],
                'logo' => $brand['logo'],
                'is_active' => true,
            ]);
        }
    }
}
