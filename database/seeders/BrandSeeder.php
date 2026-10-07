<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    public function run(): void
    {
        $brands = [
            ['name' => 'Apple', 'slug' => 'apple', 'logo' => 'assets/images/brands/1.png'],
            ['name' => 'Samsung', 'slug' => 'samsung', 'logo' => 'assets/images/brands/2.png'],
            ['name' => 'Sony', 'slug' => 'sony', 'logo' => 'assets/images/brands/3.png'],
            ['name' => 'Nike', 'slug' => 'nike', 'logo' => 'assets/images/brands/4.png'],
            ['name' => 'Canon', 'slug' => 'canon', 'logo' => 'assets/images/brands/5.png'],
            ['name' => 'Asus', 'slug' => 'asus', 'logo' => 'assets/images/brands/6.png'],
            ['name' => 'Bose', 'slug' => 'bose', 'logo' => 'assets/images/brands/7.png'],
            ['name' => 'Philips', 'slug' => 'philips', 'logo' => 'assets/images/brands/8.png'],
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
