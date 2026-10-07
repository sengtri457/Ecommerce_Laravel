<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Feature;
use App\Models\HeroSlide;
use App\Models\HomeSection;
use App\Models\PromoBanner;
use Illuminate\Contracts\View\View;

class HomeController extends Controller
{
    /**
     * Display the dynamic eCommerce homepage.
     */
    public function index(): View
    {
        $slides = HeroSlide::active()->get();
        $featuredCategories = Category::active()->featured()->orderBy('sort_order')->get();
        $promoBanners = PromoBanner::active()->where('position', 'home_promo')->get();
        $features = Feature::active()->where('position', 'home_services')->get();
        $homeSections = HomeSection::active()->get();
        $brands = Brand::active()->get();
        $latestPosts = BlogPost::published()->with(['category', 'author'])->take(3)->get();

        return view('home.index', [
            'pageTitle' => setting('site_name', 'Molla').' - Home',
            'slides' => $slides,
            'featuredCategories' => $featuredCategories,
            'promoBanners' => $promoBanners,
            'features' => $features,
            'homeSections' => $homeSections,
            'brands' => $brands,
            'latestPosts' => $latestPosts,
        ]);
    }
}
