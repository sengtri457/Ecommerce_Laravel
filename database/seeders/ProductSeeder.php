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
        $categories = Category::all()->keyBy('slug');
        $brands = Brand::all()->keyBy('slug');
        $colorValues = AttributeValue::whereHas('attribute', fn ($q) => $q->where('slug', 'color'))->get();
        $sizeValues = AttributeValue::whereHas('attribute', fn ($q) => $q->where('slug', 'size'))->get();

        $productDefinitions = [
            // Men's Collection
            [
                'name' => 'Essential Organic Heavyweight Crewneck Tee',
                'category' => 'men',
                'brand' => 'clothes-atelier',
                'price' => 29.99,
                'sale_price' => 24.99,
                'stock' => 50,
                'is_featured' => true,
                'is_new' => true,
                'short_description' => 'Crafted from 280 GSM long-staple organic cotton. Relaxed, structured drape designed for seamless daily wear.',
            ],
            [
                'name' => 'Textured Knit 1/4-Zip Polo Shirt',
                'category' => 'men',
                'brand' => 'clothes-atelier',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => true,
                'is_new' => false,
                'short_description' => 'Breathable open-stitch waffle knit with antiqued brass quarter-zip. Elegant versatility from desk to dinner.',
            ],
            [
                'name' => '450 GSM Heavy Fleece Drop-Shoulder Pullover',
                'category' => 'men',
                'brand' => 'clothes-atelier',
                'price' => 79.99,
                'sale_price' => 69.99,
                'stock' => 45,
                'is_featured' => true,
                'is_new' => true,
                'short_description' => 'Substantial 450 GSM custom brushed fleece. Double-layered structured hood with minimalist clean cuffs.',
            ],
            [
                'name' => 'Weather-Resistant Minimalist Shell Jacket',
                'category' => 'men',
                'brand' => 'nike-acg',
                'price' => 149.99,
                'sale_price' => 129.99,
                'stock' => 20,
                'is_featured' => true,
                'is_new' => true,
                'short_description' => 'DWR water-repellent matte exterior with taped seams. Architectural storm collar with ergonomic zip pulls.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],
            [
                'name' => 'Relaxed-Fit Pleated Linen Trousers',
                'category' => 'men',
                'brand' => 'linen-craft',
                'price' => 69.99,
                'sale_price' => null,
                'stock' => 35,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => '100% natural European flax linen. Double front pleat with concealed drawcord waistband for optimal comfort.',
            ],

            // Women's Collection
            [
                'name' => 'Effortless Linen Oversized Button-Down',
                'category' => 'women',
                'brand' => 'linen-craft',
                'price' => 79.99,
                'sale_price' => 64.99,
                'stock' => 40,
                'is_featured' => true,
                'is_new' => true,
                'short_description' => 'Airy breathable flax weave. Tailored drop shoulders with mother-of-pearl buttons for relaxed elegance.',
            ],
            [
                'name' => 'French Terry Minimalist Relaxed Sweatshirt',
                'category' => 'women',
                'brand' => 'modern-minimalist',
                'price' => 74.99,
                'sale_price' => null,
                'stock' => 30,
                'is_featured' => true,
                'is_new' => false,
                'short_description' => 'Premium looped-back French Terry cotton. Clean geometric lines with understated cuff finishing.',
            ],
            [
                'name' => 'Relaxed Wool-Blend Tailored Overcoat',
                'category' => 'women',
                'brand' => 'clothes-atelier',
                'price' => 189.99,
                'sale_price' => null,
                'stock' => 15,
                'is_featured' => true,
                'is_new' => false,
                'short_description' => 'Heavyweight double-faced wool blend. Unstructured drape evoking effortless contemporary luxury.',
            ],
            [
                'name' => 'Low-Profile Heritage Leather Sneaker',
                'category' => 'women',
                'brand' => 'adidas-originals',
                'price' => 119.99,
                'sale_price' => 99.99,
                'stock' => 25,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => 'Buttery soft full-grain leather upper with gum rubber outsole. The iconic wardrobe anchor for everyday styling.',
            ],

            // Kids & Youth
            [
                'name' => 'Kids Organic Cotton Everyday Crewneck',
                'category' => 'kids',
                'brand' => 'clothes-atelier',
                'price' => 22.99,
                'sale_price' => 18.99,
                'stock' => 50,
                'is_featured' => true,
                'is_new' => true,
                'short_description' => 'Super-soft combed organic cotton. Tagless neckline and reinforced stitching built for active daily movement.',
            ],
            [
                'name' => 'Kids Cozy Fleece Pullover Hoodie',
                'category' => 'kids',
                'brand' => 'clothes-atelier',
                'price' => 39.99,
                'sale_price' => null,
                'stock' => 40,
                'is_featured' => true,
                'is_new' => false,
                'short_description' => 'Plush organic cotton fleece. Ribbed cuffs and kangaroo pocket for cozy layering on cool days.',
            ],
            [
                'name' => 'Kids Durable Organic Cotton Play Shorts',
                'category' => 'kids',
                'brand' => 'clothes-atelier',
                'price' => 24.99,
                'sale_price' => 19.99,
                'stock' => 45,
                'is_featured' => false,
                'is_new' => true,
                'short_description' => 'Comfortable elasticized waistband with soft cotton drawstrings and deep side pockets.',
            ],
        ];

        foreach ($productDefinitions as $index => $def) {
            $cat = $categories->get($def['category']) ?? $categories->first();
            $brand = $brands->get($def['brand']) ?? $brands->first();

            $product = Product::create([
                'category_id' => $cat->id,
                'brand_id' => $brand->id,
                'name' => $def['name'],
                'slug' => Str::slug($def['name']).'-'.($index + 1),
                'sku' => 'CLT-'.strtoupper(Str::random(6)),
                'short_description' => $def['short_description'],
                'description' => '<p class="lead text-primary mb-2">'.$def['short_description'].'</p><p>Crafted following the Clothes™ conscious apparel standard. Designed with enduring fit, tactile fibers, and zero unnecessary visual clutter. Machine washable, preshrunk, and built for intentional daily wear.</p><ul><li><strong>Fabric Composition:</strong> 100% Certified Sustainable Materials</li><li><strong>Fit Profile:</strong> Modern relaxed silhouette (True to size)</li><li><strong>Care:</strong> Machine wash cold, hang dry recommended</li><li><strong>Guarantee:</strong> 30-Day Hassle-Free Returns</li></ul>',
                'price' => $def['price'],
                'sale_price' => $def['sale_price'],
                'stock' => $def['stock'],
                'is_featured' => $def['is_featured'],
                'is_new' => $def['is_new'],
                'is_active' => true,
            ]);

            // Add Product Images dynamically from public/assets/images/mainImages/products
            $mainProductImages = [
                'assets/images/mainImages/products/image1.jpg',
                'assets/images/mainImages/products/image2.jpg',
                'assets/images/mainImages/products/image3.jpg',
                'assets/images/mainImages/products/image4.avif',
            ];

            $diskMainProducts = glob(public_path('assets/images/mainImages/products/*.*'));
            if (! empty($diskMainProducts)) {
                $mainProductImages = array_map(function ($path) {
                    return 'assets/images/mainImages/products/'.basename($path);
                }, $diskMainProducts);
            }

            $primaryImgPath = $mainProductImages[$index % count($mainProductImages)];
            $secondaryImgPath = $mainProductImages[($index + 1) % count($mainProductImages)];

            ProductImage::create([
                'product_id' => $product->id,
                'path' => $primaryImgPath,
                'is_primary' => true,
                'sort_order' => 1,
            ]);

            ProductImage::create([
                'product_id' => $product->id,
                'path' => $secondaryImgPath,
                'is_primary' => false,
                'sort_order' => 2,
            ]);

            // Attach Color Attributes
            $selectedColors = $colorValues->random(min(3, $colorValues->count()));
            $product->attributeValues()->attach($selectedColors->pluck('id'));

            // Attach Size Attributes
            $selectedSizes = $sizeValues->random(min(4, $sizeValues->count()));
            $product->attributeValues()->attach($selectedSizes->pluck('id'));

            // Add verified reviews
            ProductReview::create([
                'product_id' => $product->id,
                'name' => 'Liam Bennett',
                'rating' => 5,
                'title' => 'Exceptional Fabric & Fit',
                'body' => 'Exceptional fabric quality. The drape is clean and it holds its structure after washing. Truly elevated essentials.',
                'is_approved' => true,
            ]);

            ProductReview::create([
                'product_id' => $product->id,
                'name' => 'Sophia Chen',
                'rating' => 5,
                'title' => 'Capsule Wardrobe Anchor',
                'body' => 'Color is rich and exactly as pictured. Fits effortlessly into my capsule wardrobe.',
                'is_approved' => true,
            ]);
        }
    }
}
