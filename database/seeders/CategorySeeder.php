<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // Category show focused strictly on Men, Women, and Kids
        Category::create([
            'name' => "Men's Collection",
            'slug' => 'men',
            'description' => 'Structured silhouettes, tactile essentials, and relaxed daily wear for men.',
            'sort_order' => 1,
            'is_featured' => true,
            'image' => 'assets/images/mainImages/products/image1.jpg',
            'is_active' => true,
        ]);

        Category::create([
            'name' => "Women's Collection",
            'slug' => 'women',
            'description' => 'Effortless drapery, breathable weaves, and elevated feminine wardrobe foundations.',
            'sort_order' => 2,
            'is_featured' => true,
            'image' => 'assets/images/mainImages/products/image2.jpg',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Kids & Youth',
            'slug' => 'kids',
            'description' => 'Durable organic cotton essentials crafted for play and movement.',
            'sort_order' => 3,
            'is_featured' => true,
            'image' => 'assets/images/mainImages/products/image3.jpg',
            'is_active' => true,
        ]);
    }
}
