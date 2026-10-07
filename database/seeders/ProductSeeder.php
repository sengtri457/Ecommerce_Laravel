<?php

namespace Database\Seeders;

use App\Models\AttributeValue;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use App\Models\ProductReview;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $categories = Category::all();
        $brands = Brand::all();
        $colorValues = AttributeValue::whereHas('attribute', fn ($q) => $q->where('slug', 'color'))->get();
        $sizeValues = AttributeValue::whereHas('attribute', fn ($q) => $q->where('slug', 'size'))->get();
        $storageValues = AttributeValue::whereHas('attribute', fn ($q) => $q->where('slug', 'storage'))->get();

        $productDefinitions = [
            [
                'name' => 'Apple MacBook Pro 16" M3 Pro',
                'category' => 'computers',
                'brand' => 'apple',
                'price' => 2499.00,
                'sale_price' => 2299.00,
                'stock' => 15,
                'is_featured' => true,
                'is_new' => true,
                'img' => 1,
                'has_storage' => true,
            ],
            [
                'name' => 'Bose QuietComfort 45 Wireless',
                'category' => 'tv-audio',
                'brand' => 'bose',
                'price' => 329.00,
                'sale_price' => 279.00,
                'stock' => 30,
                'is_featured' => true,
                'is_new' => false,
                'img' => 2,
                'has_color' => true,
            ],
            [
                'name' => 'Samsung Galaxy S24 Ultra 512GB',
                'category' => 'smart-phones',
                'brand' => 'samsung',
                'price' => 1299.00,
                'sale_price' => 1149.00,
                'stock' => 20,
                'is_featured' => true,
                'is_new' => true,
                'img' => 3,
                'has_color' => true,
                'has_storage' => true,
            ],
            [
                'name' => 'Sony Alpha A7 IV Full-Frame Camera',
                'category' => 'cameras',
                'brand' => 'sony',
                'price' => 2498.00,
                'sale_price' => null,
                'stock' => 8,
                'is_featured' => true,
                'is_new' => true,
                'img' => 4,
            ],
            [
                'name' => 'Ergonomic Executive Office Chair',
                'category' => 'chairs',
                'brand' => null,
                'price' => 249.00,
                'sale_price' => 199.00,
                'stock' => 25,
                'is_featured' => false,
                'is_new' => false,
                'img' => 5,
                'has_color' => true,
            ],
            [
                'name' => 'Contemporary Velvet 3-Seater Sofa',
                'category' => 'sofas',
                'brand' => null,
                'price' => 899.00,
                'sale_price' => 749.00,
                'stock' => 5,
                'is_featured' => true,
                'is_new' => false,
                'img' => 6,
                'has_color' => true,
            ],
            [
                'name' => 'KitchenAid Artisan Stand Mixer 5-Qt',
                'category' => 'mixers',
                'brand' => 'philips',
                'price' => 449.00,
                'sale_price' => 399.00,
                'stock' => 18,
                'is_featured' => true,
                'is_new' => false,
                'img' => 7,
                'has_color' => true,
            ],
            [
                'name' => 'Non-Stick Ceramic Cookware 10-Piece',
                'category' => 'cookware',
                'brand' => null,
                'price' => 159.00,
                'sale_price' => 129.00,
                'stock' => 40,
                'is_featured' => false,
                'is_new' => true,
                'img' => 8,
            ],
            [
                'name' => 'Nike Air Zoom Pegasus 40 Running Shoes',
                'category' => 'shoes-boots',
                'brand' => 'nike',
                'price' => 130.00,
                'sale_price' => null,
                'stock' => 50,
                'is_featured' => true,
                'is_new' => true,
                'img' => 9,
                'has_color' => true,
                'has_size' => true,
            ],
            [
                'name' => 'Classic Cotton Trench Coat for Women',
                'category' => 'women-clothing',
                'brand' => null,
                'price' => 189.00,
                'sale_price' => 149.00,
                'stock' => 22,
                'is_featured' => false,
                'is_new' => false,
                'img' => 10,
                'has_color' => true,
                'has_size' => true,
            ],
            [
                'name' => 'Slim Fit Casual Oxford Shirt',
                'category' => 'men-clothing',
                'brand' => null,
                'price' => 59.00,
                'sale_price' => 45.00,
                'stock' => 60,
                'is_featured' => false,
                'is_new' => false,
                'img' => 11,
                'has_color' => true,
                'has_size' => true,
            ],
            [
                'name' => 'Asus ROG Zephyrus G16 Gaming Laptop',
                'category' => 'laptops',
                'brand' => 'asus',
                'price' => 1999.00,
                'sale_price' => 1799.00,
                'stock' => 12,
                'is_featured' => true,
                'is_new' => true,
                'img' => 12,
                'has_storage' => true,
            ],
            [
                'name' => 'Sony Bravia XR 65" 4K OLED Smart TV',
                'category' => 'televisions',
                'brand' => 'sony',
                'price' => 1899.00,
                'sale_price' => 1699.00,
                'stock' => 10,
                'is_featured' => true,
                'is_new' => false,
                'img' => 13,
            ],
            [
                'name' => 'Modern Minimalist Bedside Lamp',
                'category' => 'lighting',
                'brand' => 'philips',
                'price' => 69.00,
                'sale_price' => 49.00,
                'stock' => 35,
                'is_featured' => true,
                'is_new' => false,
                'img' => 14,
                'has_color' => true,
            ],
            [
                'name' => 'Canon EOS R6 Mark II Mirrorless Camera',
                'category' => 'cameras',
                'brand' => 'canon',
                'price' => 2399.00,
                'sale_price' => null,
                'stock' => 7,
                'is_featured' => false,
                'is_new' => true,
                'img' => 15,
            ],
            [
                'name' => 'Smart Robotic Vacuum Cleaner with Mop',
                'category' => 'home-appliances',
                'brand' => 'samsung',
                'price' => 499.00,
                'sale_price' => 399.00,
                'stock' => 20,
                'is_featured' => true,
                'is_new' => false,
                'img' => 16,
            ],
            [
                'name' => 'Hydrating Anti-Aging Face Serum',
                'category' => 'healthy-beauty',
                'brand' => null,
                'price' => 75.00,
                'sale_price' => null,
                'stock' => 80,
                'is_featured' => false,
                'is_new' => true,
                'img' => 17,
            ],
            [
                'name' => 'Waterproof Lightweight Hiking Backpack 40L',
                'category' => 'travel-outdoor',
                'brand' => 'nike',
                'price' => 110.00,
                'sale_price' => 89.00,
                'stock' => 30,
                'is_featured' => false,
                'is_new' => false,
                'img' => 18,
                'has_color' => true,
            ],
            [
                'name' => 'Aromatherapy Essential Oil Diffuser Gift Set',
                'category' => 'gift-ideas',
                'brand' => null,
                'price' => 45.00,
                'sale_price' => 35.00,
                'stock' => 45,
                'is_featured' => false,
                'is_new' => false,
                'img' => 19,
            ],
            [
                'name' => 'Apple iPad Air 11-inch M2 128GB',
                'category' => 'computers',
                'brand' => 'apple',
                'price' => 599.00,
                'sale_price' => null,
                'stock' => 25,
                'is_featured' => true,
                'is_new' => true,
                'img' => 20,
                'has_color' => true,
                'has_storage' => true,
            ],
            [
                'name' => 'Bose SoundLink Flex Bluetooth Speaker',
                'category' => 'tv-audio',
                'brand' => 'bose',
                'price' => 149.00,
                'sale_price' => 129.00,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => false,
                'img' => 1,
                'has_color' => true,
            ],
            [
                'name' => 'Samsung 34" Odyssey OLED Curved Gaming Monitor',
                'category' => 'computers',
                'brand' => 'samsung',
                'price' => 1199.00,
                'sale_price' => 999.00,
                'stock' => 14,
                'is_featured' => true,
                'is_new' => false,
                'img' => 2,
            ],
            [
                'name' => 'Industrial Wood and Metal Dining Table',
                'category' => 'furniture',
                'brand' => null,
                'price' => 649.00,
                'sale_price' => 549.00,
                'stock' => 6,
                'is_featured' => false,
                'is_new' => false,
                'img' => 3,
            ],
            [
                'name' => 'Nike Dri-FIT Men\'s Training Hoodie',
                'category' => 'men-clothing',
                'brand' => 'nike',
                'price' => 65.00,
                'sale_price' => null,
                'stock' => 40,
                'is_featured' => false,
                'is_new' => true,
                'img' => 4,
                'has_color' => true,
                'has_size' => true,
            ],
        ];

        foreach ($productDefinitions as $index => $def) {
            $cat = $categories->firstWhere('slug', $def['category']) ?? $categories->first();
            $brand = $def['brand'] ? $brands->firstWhere('slug', $def['brand']) : null;
            $slug = Str::slug($def['name']);

            $product = Product::create([
                'category_id' => $cat->id,
                'brand_id' => $brand?->id,
                'name' => $def['name'],
                'slug' => $slug,
                'sku' => 'SKU-'.strtoupper(Str::random(6)),
                'short_description' => 'High quality premium craftsmanship with state-of-the-art performance. Perfect for everyday lifestyle and modern convenience.',
                'description' => '<p>'.$def['name'].' provides superior performance, exquisite design, and unmatched durability. Built from high-grade materials to meet international standards and guarantee exceptional satisfaction.</p><ul><li>Premium grade materials and ergonomic engineering</li><li>1-Year official manufacturer warranty</li><li>Fast, hassle-free 30-day return policy</li></ul>',
                'price' => $def['price'],
                'sale_price' => $def['sale_price'],
                'stock' => $def['stock'],
                'is_new' => $def['is_new'],
                'is_featured' => $def['is_featured'],
                'is_active' => true,
            ]);

            // Seed primary and secondary images
            $imgNum = $def['img'];
            $altImgNum = ($imgNum % 20) + 1;

            ProductImage::create([
                'product_id' => $product->id,
                'path' => "assets/images/demos/demo-13/products/product-{$imgNum}.jpg",
                'is_primary' => true,
                'sort_order' => 1,
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'path' => "assets/images/demos/demo-13/products/product-{$altImgNum}.jpg",
                'is_primary' => false,
                'sort_order' => 2,
            ]);

            // Link attributes
            if (! empty($def['has_color'])) {
                $product->attributeValues()->attach($colorValues->take(3)->pluck('id'));
            }
            if (! empty($def['has_size'])) {
                $product->attributeValues()->attach($sizeValues->take(3)->pluck('id'));
            }
            if (! empty($def['has_storage'])) {
                $product->attributeValues()->attach($storageValues->take(3)->pluck('id'));
            }

            // Seed reviews for some products
            if ($index % 2 === 0) {
                ProductReview::create([
                    'product_id' => $product->id,
                    'user_id' => null,
                    'name' => 'Sarah Connor',
                    'rating' => 5,
                    'title' => 'Fantastic purchase!',
                    'body' => 'Exceeded all expectations. Quality is top notch and delivery was lightning fast.',
                    'is_approved' => true,
                ]);

                ProductReview::create([
                    'product_id' => $product->id,
                    'user_id' => null,
                    'name' => 'Michael Scott',
                    'rating' => 4,
                    'title' => 'Very satisfied',
                    'body' => 'Works exactly as described. Beautiful styling and premium feel.',
                    'is_approved' => true,
                ]);
            }
        }
    }
}
