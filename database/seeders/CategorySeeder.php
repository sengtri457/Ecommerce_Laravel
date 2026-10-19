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
            'image' => 'https://static.nike.com/a/images/w_1920,c_limit/5bafa096-f379-48a1-bb1c-8114a9f7c947/image.jpg',
            'is_active' => true,
        ]);

        Category::create([
            'name' => "Women's Collection",
            'slug' => 'women',
            'description' => 'Effortless drapery, breathable weaves, and elevated feminine wardrobe foundations.',
            'sort_order' => 2,
            'is_featured' => true,
            'image' => 'https://static.nike.com/a/images/w_1920,c_limit/cc5def12-b50f-4681-ae05-fb6f2d0867a9/image.jpg',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Kids & Youth',
            'slug' => 'kids',
            'description' => 'Durable organic cotton essentials crafted for play and movement.',
            'sort_order' => 3,
            'is_featured' => true,
            'image' => 'https://static.nike.com/a/images/t_web_pw_592_v2/f_auto/11d34345-8647-4c48-9261-83122fb4ec86/KB+K+NK+DF+MAMBA+FLC+PANT.png',
            'is_active' => true,
        ]);
    }
}
