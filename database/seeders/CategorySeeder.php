<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        // 1. Root Categories
        $electronics = Category::create([
            'name' => 'Electronics',
            'slug' => 'electronics',
            'sort_order' => 1,
            'is_active' => true,
        ]);
        Category::create(['parent_id' => $electronics->id, 'name' => 'Computers', 'slug' => 'computers', 'sort_order' => 1, 'is_active' => true]);
        Category::create(['parent_id' => $electronics->id, 'name' => 'Laptops', 'slug' => 'laptops', 'sort_order' => 2, 'is_active' => true]);
        Category::create(['parent_id' => $electronics->id, 'name' => 'Cameras', 'slug' => 'cameras', 'sort_order' => 3, 'is_active' => true]);

        $furniture = Category::create([
            'name' => 'Furniture',
            'slug' => 'furniture',
            'sort_order' => 2,
            'is_featured' => true,
            'image' => 'assets/images/demos/demo-13/cats/6.jpg',
            'is_active' => true,
        ]);
        Category::create(['parent_id' => $furniture->id, 'name' => 'Chairs', 'slug' => 'chairs', 'sort_order' => 1, 'is_active' => true]);
        Category::create(['parent_id' => $furniture->id, 'name' => 'Sofas', 'slug' => 'sofas', 'sort_order' => 2, 'is_active' => true]);

        $cooking = Category::create([
            'name' => 'Cooking',
            'slug' => 'cooking',
            'sort_order' => 3,
            'is_featured' => true,
            'image' => 'assets/images/demos/demo-13/cats/5.jpg',
            'is_active' => true,
        ]);
        Category::create(['parent_id' => $cooking->id, 'name' => 'Mixers', 'slug' => 'mixers', 'sort_order' => 1, 'is_active' => true]);
        Category::create(['parent_id' => $cooking->id, 'name' => 'Cookware', 'slug' => 'cookware', 'sort_order' => 2, 'is_active' => true]);

        $clothing = Category::create([
            'name' => 'Clothing',
            'slug' => 'clothing',
            'sort_order' => 4,
            'is_active' => true,
        ]);
        Category::create(['parent_id' => $clothing->id, 'name' => 'Women', 'slug' => 'women-clothing', 'sort_order' => 1, 'is_active' => true]);
        Category::create(['parent_id' => $clothing->id, 'name' => 'Men', 'slug' => 'men-clothing', 'sort_order' => 2, 'is_active' => true]);

        Category::create([
            'name' => 'Home Appliances',
            'slug' => 'home-appliances',
            'sort_order' => 5,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Healthy & Beauty',
            'slug' => 'healthy-beauty',
            'sort_order' => 6,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Shoes & Boots',
            'slug' => 'shoes-boots',
            'sort_order' => 7,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Travel & Outdoor',
            'slug' => 'travel-outdoor',
            'sort_order' => 8,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Smart Phones',
            'slug' => 'smart-phones',
            'sort_order' => 9,
            'is_featured' => true,
            'image' => 'assets/images/demos/demo-13/cats/3.jpg',
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'TV & Audio',
            'slug' => 'tv-audio',
            'sort_order' => 10,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Gift Ideas',
            'slug' => 'gift-ideas',
            'sort_order' => 11,
            'is_active' => true,
        ]);

        // Featured Categories for the 6 popular categories grid
        Category::create([
            'name' => 'Computer & Laptop',
            'slug' => 'computer-laptop',
            'image' => 'assets/images/demos/demo-13/cats/1.jpg',
            'sort_order' => 12,
            'is_featured' => true,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Lighting',
            'slug' => 'lighting',
            'image' => 'assets/images/demos/demo-13/cats/2.jpg',
            'sort_order' => 13,
            'is_featured' => true,
            'is_active' => true,
        ]);

        Category::create([
            'name' => 'Televisions',
            'slug' => 'televisions',
            'image' => 'assets/images/demos/demo-13/cats/4.jpg',
            'sort_order' => 14,
            'is_featured' => true,
            'is_active' => true,
        ]);
    }
}
