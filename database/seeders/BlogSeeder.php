<?php

namespace Database\Seeders;

use App\Models\BlogCategory;
use App\Models\BlogComment;
use App\Models\BlogPost;
use App\Models\BlogTag;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BlogSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::first();

        // 1. Categories
        $categories = [
            'Technology Trends',
            'Lifestyle & Design',
            'Smart Home Gadgets',
            'Guides & Reviews',
        ];
        $categoryModels = [];
        foreach ($categories as $index => $name) {
            $categoryModels[] = BlogCategory::create([
                'name' => $name,
                'slug' => Str::slug($name),
                'sort_order' => $index + 1,
            ]);
        }

        // 2. Tags
        $tags = ['Tech', 'Gadgets', 'Home', 'Lifestyle', 'Deals', 'Smart Living'];
        $tagModels = [];
        foreach ($tags as $tagName) {
            $tagModels[] = BlogTag::create([
                'name' => $tagName,
                'slug' => Str::slug($tagName),
            ]);
        }

        // 3. Blog Posts
        $postsData = [
            [
                'title' => 'Top 10 Ultra-Portable Laptops for Creators in 2026',
                'excerpt' => 'Looking for peak computing power without compromising battery life? Here are the top machines reviewed.',
                'cat' => 0,
                'img' => 1,
            ],
            [
                'title' => 'Minimalist Home Office Setup: Aesthetics and Ergonomics',
                'excerpt' => 'How to craft a clutter-free, inspiring workspace that boosts daily productivity.',
                'cat' => 1,
                'img' => 2,
            ],
            [
                'title' => 'Why Smart Lighting is Transforming Modern Urban Living',
                'excerpt' => 'From circadian rhythm scheduling to vibrant ambiance, explore the benefits of connected illumination.',
                'cat' => 2,
                'img' => 3,
            ],
            [
                'title' => 'Noise-Cancelling Headphones: Which Flagship Reigns Supreme?',
                'excerpt' => 'We put the latest wireless ANC headphones to the ultimate commuting and office noise test.',
                'cat' => 3,
                'img' => 4,
            ],
            [
                'title' => 'The Rise of Foldable Smartphones and What Comes Next',
                'excerpt' => 'A deep dive into foldable display durability, multitasking perks, and mobile hardware roadmaps.',
                'cat' => 0,
                'img' => 1,
            ],
            [
                'title' => 'Sustainable Cookware: Healthier Meals, Longer Lifespan',
                'excerpt' => 'Why chefs and home cooks alike are switching to ceramic non-toxic pans and cast iron skillets.',
                'cat' => 1,
                'img' => 2,
            ],
            [
                'title' => 'Building an Automated Smart Living Ecosystem on a Budget',
                'excerpt' => 'Step-by-step guidance on setting up smart plugs, climate controls, and robotic vacuums seamlessly.',
                'cat' => 2,
                'img' => 3,
            ],
            [
                'title' => 'The Essential Guide to Wireless Charging Standards',
                'excerpt' => 'Qi2, MagSafe, and fast-charging pucks explained with speed metrics and device compatibility.',
                'cat' => 3,
                'img' => 4,
            ],
        ];

        foreach ($postsData as $index => $data) {
            $category = $categoryModels[$data['cat']];
            $post = BlogPost::create([
                'blog_category_id' => $category->id,
                'author_id' => $admin?->id,
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'content' => '<p>'.$data['excerpt'].'</p><p>Sed pretium, ligula sollicitudin laoreet viverra, tortor libero sodales leo, eget blandit nunc tortor eu nibh. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Morbi blandit cursus risus.</p><blockquote><p>Innovation is anything, but business as usual. Craftsmanship and intelligent design empower every moment.</p></blockquote><p>Vivamus vestibulum ntulla nec ante. Praesent placerat risus quis eros. Fusce pellentesque suscipit nibh. Integer vitae libero ac risus egestas placerat. Vestibulum commodo felis quis tortor.</p>',
                'image' => "assets/images/demos/demo-13/blog/post-{$data['img']}.jpg",
                'is_published' => true,
                'published_at' => now()->subDays(10 - $index),
            ]);

            // Attach tags
            $post->tags()->attach([$tagModels[$index % 6]->id, $tagModels[($index + 1) % 6]->id]);

            // Add comments for first post
            if ($index === 0) {
                $c1 = BlogComment::create([
                    'blog_post_id' => $post->id,
                    'name' => 'Alex Turner',
                    'email' => 'alex@turner.com',
                    'body' => 'Incredible breakdown! The battery benchmarks were particularly eye-opening.',
                    'is_approved' => true,
                ]);

                BlogComment::create([
                    'blog_post_id' => $post->id,
                    'parent_id' => $c1->id,
                    'name' => 'Editorial Staff',
                    'email' => 'staff@molla.com',
                    'body' => 'Thanks Alex! Glad the real-world battery tests provided clarity.',
                    'is_approved' => true,
                ]);

                BlogComment::create([
                    'blog_post_id' => $post->id,
                    'name' => 'Emma Watson',
                    'email' => 'emma@watson.com',
                    'body' => 'Bookmarking this before my upcoming hardware upgrade!',
                    'is_approved' => true,
                ]);
            }
        }
    }
}
