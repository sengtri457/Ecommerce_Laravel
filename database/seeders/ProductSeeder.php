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
                'images' => [
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/f4c13d11-8930-4ce8-bf50-8942a127ffd0/M+NK+TF+CLUB+PUFFER+VEST+650.png',
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/ffaac042-3eee-4f39-86a2-e51499de7db2/M+NK+TF+CLUB+PUFFER+VEST+650.png',  
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/795ba940-4835-4020-b544-6368a2987778/M+NK+TF+CLUB+PUFFER+VEST+650.png', 
],
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
                                'images' => [
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/5352feef-d615-49ff-aed7-1a6610c61a53/M+NK+TF+WR+WINTERIZED+FZ.png',
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/874714ad-6634-43fb-b55e-3ed6912eead7/M+NK+TF+WR+WINTERIZED+FZ.png',  
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/a19f75e0-dbf1-4b54-9ef9-386052898ab8/M+NK+TF+WR+WINTERIZED+FZ.png', 
],
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
                'images' => [
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/e6ad94bc-8335-47fe-a5d1-00b63b7dd006/M+NK+TF+24.7+OC+DOWN+FILL+JKT.png',
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/53485be6-5414-4401-a703-abe19f771c0c/M+NK+TF+24.7+OC+DOWN+FILL+JKT.png',  
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/9de27799-bbf0-4fb3-b9af-ce978f59c1eb/M+NK+TF+24.7+OC+DOWN+FILL+JKT.png', 
],
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
                 'images' => [
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/5352feef-d615-49ff-aed7-1a6610c61a53/M+NK+TF+WR+WINTERIZED+FZ.png',
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/874714ad-6634-43fb-b55e-3ed6912eead7/M+NK+TF+WR+WINTERIZED+FZ.png',  
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/a19f75e0-dbf1-4b54-9ef9-386052898ab8/M+NK+TF+WR+WINTERIZED+FZ.png', 
],
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
                'images'=> [
                                    'https://static.nike.com/a/images/t_web_pw_592_v2/f_auto/u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/872e7bf2-7baa-433a-94a6-bcae4fc283f6/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3373d20a-31fe-49ff-af29-5233379598c9/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1cedff5f-d641-45f0-ab6e-ec3eee350cfe/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/faa628ed-7571-4a0c-af16-9e40b9c5fcc1/M+ACG+CLOUD+TREKKER+PNT.png',
                ]
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
                    'images' => [
        'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/550fa2b5-cf85-485b-b3a0-e022aad4a7aa/M+NK+CLUB+NOVELTY+PUFFER+3.png',
        'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/b1a5c22a-c6ad-4321-a5a6-fd56432fb18b/M+NK+CLUB+NOVELTY+PUFFER+3.png',  
        'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1a6579a7-8cfa-4618-b35d-8e43aa6548c4/M+NK+CLUB+NOVELTY+PUFFER+3.png', 
    ],
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
                'images' => [
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/c0b59f22-0267-4f51-9409-16e8f855d785/M+NK+RPL+UNLIMITED+UTILITY+JKT.png',
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3608db94-875c-4b6d-b729-79f2be2d8a28/M+NK+RPL+UNLIMITED+UTILITY+JKT.png',  
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/9a65eb36-08b8-4652-8263-689d16e30c05/M+NK+RPL+UNLIMITED+UTILITY+JKT.png', 
],
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
                'images'=> [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3ec57dba-269f-4365-a12d-9e9ec6b5e3f7/M+NK+TF+24.7+OC+DOWN+FILL+VEST.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1d2aac27-1b82-4c57-9e2a-775e4a7e7a0e/M+NK+TF+24.7+OC+DOWN+FILL+VEST.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/d7bdfab1-0ffa-40e4-a594-9fc0ff769e39/M+NK+TF+24.7+OC+DOWN+FILL+VEST.png'
                ]
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
                                'images'=> [
                                    'https://static.nike.com/a/images/t_web_pw_592_v2/f_auto/u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/872e7bf2-7baa-433a-94a6-bcae4fc283f6/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3373d20a-31fe-49ff-af29-5233379598c9/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1cedff5f-d641-45f0-ab6e-ec3eee350cfe/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/faa628ed-7571-4a0c-af16-9e40b9c5fcc1/M+ACG+CLOUD+TREKKER+PNT.png',
                ]
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
                                'images' => [
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/550fa2b5-cf85-485b-b3a0-e022aad4a7aa/M+NK+CLUB+NOVELTY+PUFFER+3.png',
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/b1a5c22a-c6ad-4321-a5a6-fd56432fb18b/M+NK+CLUB+NOVELTY+PUFFER+3.png',  
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1a6579a7-8cfa-4618-b35d-8e43aa6548c4/M+NK+CLUB+NOVELTY+PUFFER+3.png', 
],
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
                                'images' => [
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/c0b59f22-0267-4f51-9409-16e8f855d785/M+NK+RPL+UNLIMITED+UTILITY+JKT.png',
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3608db94-875c-4b6d-b729-79f2be2d8a28/M+NK+RPL+UNLIMITED+UTILITY+JKT.png',  
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/9a65eb36-08b8-4652-8263-689d16e30c05/M+NK+RPL+UNLIMITED+UTILITY+JKT.png', 
],
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
 'images' => [
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/550fa2b5-cf85-485b-b3a0-e022aad4a7aa/M+NK+CLUB+NOVELTY+PUFFER+3.png',
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/b1a5c22a-c6ad-4321-a5a6-fd56432fb18b/M+NK+CLUB+NOVELTY+PUFFER+3.png',  
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1a6579a7-8cfa-4618-b35d-8e43aa6548c4/M+NK+CLUB+NOVELTY+PUFFER+3.png', 
],
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
                'images' => [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/e6ad94bc-8335-47fe-a5d1-00b63b7dd006/M+NK+TF+24.7+OC+DOWN+FILL+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/53485be6-5414-4401-a703-abe19f771c0c/M+NK+TF+24.7+OC+DOWN+FILL+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/9de27799-bbf0-4fb3-b9af-ce978f59c1eb/M+NK+TF+24.7+OC+DOWN+FILL+JKT.png',
                ],
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
                                'images'=> [
                                    'https://static.nike.com/a/images/t_web_pw_592_v2/f_auto/u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/872e7bf2-7baa-433a-94a6-bcae4fc283f6/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3373d20a-31fe-49ff-af29-5233379598c9/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1cedff5f-d641-45f0-ab6e-ec3eee350cfe/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/faa628ed-7571-4a0c-af16-9e40b9c5fcc1/M+ACG+CLOUD+TREKKER+PNT.png',
                ]
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
                                'images' => [
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/550fa2b5-cf85-485b-b3a0-e022aad4a7aa/M+NK+CLUB+NOVELTY+PUFFER+3.png',
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/b1a5c22a-c6ad-4321-a5a6-fd56432fb18b/M+NK+CLUB+NOVELTY+PUFFER+3.png',  
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1a6579a7-8cfa-4618-b35d-8e43aa6548c4/M+NK+CLUB+NOVELTY+PUFFER+3.png', 
],
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
                                'images' => [
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/c0b59f22-0267-4f51-9409-16e8f855d785/M+NK+RPL+UNLIMITED+UTILITY+JKT.png',
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3608db94-875c-4b6d-b729-79f2be2d8a28/M+NK+RPL+UNLIMITED+UTILITY+JKT.png',  
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/9a65eb36-08b8-4652-8263-689d16e30c05/M+NK+RPL+UNLIMITED+UTILITY+JKT.png', 
],
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
                                 'images' => [
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/e6ad94bc-8335-47fe-a5d1-00b63b7dd006/M+NK+TF+24.7+OC+DOWN+FILL+JKT.png',
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/53485be6-5414-4401-a703-abe19f771c0c/M+NK+TF+24.7+OC+DOWN+FILL+JKT.png',  
    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/9de27799-bbf0-4fb3-b9af-ce978f59c1eb/M+NK+TF+24.7+OC+DOWN+FILL+JKT.png', 
],
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
                'images'=> [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/b39a0fdf-0ec8-4ddf-a391-56c7ea1957be/W+NK+SF+DWN+WPFR+WRMST+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/b39a0fdf-0ec8-4ddf-a391-56c7ea1957be/W+NK+SF+DWN+WPFR+WRMST+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/2f402059-5b78-4f54-8742-bdcea35f8e86/W+NK+SF+DWN+WPFR+WRMST+JKT.png'
                ]
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
                'images' => [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1a7723e4-3dc5-42ac-bb0b-c9bf45d739a7/W+NSW+SWT+KT+VNECK+CREW.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/b2295d07-2a13-4b5b-80c4-1db8c0419c2f/W+NSW+SWT+KT+VNECK+CREW.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/5b99cb9d-2179-48d1-a3f8-184b937b65d8/W+NSW+SWT+KT+VNECK+CREW.png'
                ]
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
                  'images' => [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/961dfc11-9559-421d-a296-932e084b30da/W+NK+DF+24.7+IS+CUFF+PANT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3c40dae5-4dc7-40bf-9412-f1f17636b830/W+NK+DF+24.7+IS+CUFF+PANT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/979ccf74-ba31-448b-97db-f87d92311bb0/W+NK+DF+24.7+IS+CUFF+PANT.png'
                ]
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
                 'images' => [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/67475ce8-3de8-440d-8fe1-9743e4a261d6/W+NK+ARTICLE+FLC+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/34f1dd19-ca06-4609-a998-32b2962e964f/W+NK+ARTICLE+FLC+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/d78e3da6-f502-4257-8b3d-b56ec1066b27/W+NK+ARTICLE+FLC+JKT.png'
                ],
            ],
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
                'images'=> [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/b39a0fdf-0ec8-4ddf-a391-56c7ea1957be/W+NK+SF+DWN+WPFR+WRMST+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/b39a0fdf-0ec8-4ddf-a391-56c7ea1957be/W+NK+SF+DWN+WPFR+WRMST+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/2f402059-5b78-4f54-8742-bdcea35f8e86/W+NK+SF+DWN+WPFR+WRMST+JKT.png'
                ]
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
                 'images' => [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/67475ce8-3de8-440d-8fe1-9743e4a261d6/W+NK+ARTICLE+FLC+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/34f1dd19-ca06-4609-a998-32b2962e964f/W+NK+ARTICLE+FLC+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/d78e3da6-f502-4257-8b3d-b56ec1066b27/W+NK+ARTICLE+FLC+JKT.png'
                ],
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
                 'images' => [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/62805720-212a-4b6b-846a-fb57194dfcde/W+NK+SF+DWN+WPFR+WRMR+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/6447e451-7b48-403f-ac60-3540c0fcca16/W+NK+SF+DWN+WPFR+WRMR+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/cb6eabdb-20c5-45b4-9edb-5139a31e6775/W+NK+SF+DWN+WPFR+WRMR+JKT.png'
                ],
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
                'images'=> [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3bf37f52-0a0e-4862-a00c-587320244715/K+NSW+ADP+TF+PUFFER+MTRL+VNR.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/f1bfd273-4411-4b6f-9f9e-de799fcd88dd/K+NSW+ADP+TF+PUFFER+MTRL+VNR.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/9e26ccf2-46ed-4d13-8066-cd4942e74949/K+NSW+ADP+TF+PUFFER+MTRL+VNR.png'
                ]
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
                 'images'=> [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/d0250a2c-b0f9-4b03-8b42-e9d8b198ff87/K+NSW+DENIM+CARGO+PANT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/dfe6762f-12b9-499f-9187-cc109f01a335/K+NSW+DENIM+CARGO+PANT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/afa793ad-ab84-4c57-ba89-a8b18b9f1029/K+NSW+DENIM+CARGO+PANT.png'
                ]
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
                'images'=> [
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/6181f9fb-520e-42a8-b6e6-4c6ecded0a48/KB+K+NK+MAMBA+WVN+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/f1bfc8b6-3734-4628-afba-b2a4b7465949/KB+K+NK+MAMBA+WVN+JKT.png',
                    'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/b60df05d-e8cb-4c54-9079-73e2a4c76d4b/KB+K+NK+MAMBA+WVN+JKT.png'
                ]
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

            $defaultImages = [
                'https://static.nike.com/a/images/t_web_pw_592_v2/f_auto/u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/872e7bf2-7baa-433a-94a6-bcae4fc283f6/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/3373d20a-31fe-49ff-af29-5233379598c9/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/1cedff5f-d641-45f0-ab6e-ec3eee350cfe/M+ACG+CLOUD+TREKKER+PNT.png',
                'https://static.nike.com/a/images/t_web_pdp_535_v2/f_auto,u_9ddf04c7-2a9a-4d76-add1-d15af8f0263d,c_scale,fl_relative,w_1.0,h_1.0,fl_layer_apply/faa628ed-7571-4a0c-af16-9e40b9c5fcc1/M+ACG+CLOUD+TREKKER+PNT.png',
            ];

            // 1. Check if product definition specifies custom image URL(s)
            $imagesToSeed = [];
            if (! empty($def['images']) && is_array($def['images'])) {
                $imagesToSeed = $def['images'];
            } elseif (! empty($def['image_url'])) {
                $imagesToSeed = [$def['image_url']];
            } elseif (! empty($def['image'])) {
                $imagesToSeed = [$def['image']];
            } else {
                // Fallback to default URLs or local images
                $primaryImgPath = $defaultImages[$index % count($defaultImages)];
                $secondaryImgPath = $defaultImages[($index + 1) % count($defaultImages)];
                $imagesToSeed = [$primaryImgPath, $secondaryImgPath];
            }

            foreach ($imagesToSeed as $imgIndex => $imgPath) {
                ProductImage::create([
                    'product_id' => $product->id,
                    'path' => $imgPath,
                    'is_primary' => $imgIndex === 0,
                    'sort_order' => $imgIndex + 1,
                ]);
            }

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
