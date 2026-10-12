<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display the catalog shop listing with filters.
     */
    public function index(Request $request): View
    {
        $products = Product::active()
            ->with(['category', 'images'])
            ->withRatingSummary()
            ->filter($request->all())
            ->sort($request->input('sort'))
            ->paginate(12)
            ->withQueryString();

        return view('shop.index', [
            'pageTitle' => 'Shop Catalog - '.setting('site_name', 'Molla'),
            'products' => $products,
            'currentCategory' => null,
            ...$this->filterData(),
        ]);
    }

    /**
     * Display products filtered by a specific category.
     */
    public function category(string $slug, Request $request): View
    {
        $category = Category::active()->where('slug', $slug)->firstOrFail();
        $request->merge(['category' => $slug]);

        $products = Product::active()
            ->with(['category', 'images'])
            ->withRatingSummary()
            ->filter($request->all())
            ->sort($request->input('sort'))
            ->paginate(12)
            ->withQueryString();

        return view('shop.index', [
            'pageTitle' => $category->name.' - '.setting('site_name', 'Molla'),
            'products' => $products,
            'currentCategory' => $category,
            ...$this->filterData(),
        ]);
    }

    /**
     * Sidebar filter datasets (categories, brands, attributes).
     *
     * @return array<string, mixed>
     */
    private function filterData(): array
    {
        return [
            'filterCategories' => Category::active()->withCount('products')->get(),
            'filterBrands' => Brand::active()->get(),
            'filterAttributes' => Attribute::with('values')->get(),
        ];
    }
}
