<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ShopController extends Controller
{
    /**
     * Display the catalog shop listing with filters.
     */
    public function index(Request $request): View
    {
        $query = $this->buildQuery($request);
        $products = $query->paginate(12)->withQueryString();

        $filterCategories = Category::active()->withCount('products')->get();
        $filterBrands = Brand::active()->get();
        $filterAttributes = Attribute::with('values')->get();

        return view('shop.index', [
            'pageTitle' => 'Shop Catalog - '.setting('site_name', 'Molla'),
            'products' => $products,
            'filterCategories' => $filterCategories,
            'filterBrands' => $filterBrands,
            'filterAttributes' => $filterAttributes,
            'currentCategory' => null,
        ]);
    }

    /**
     * Display the category catalog page.
     */
    public function category(string $slug, Request $request): View
    {
        $category = Category::active()->where('slug', $slug)->firstOrFail();
        $request->merge(['category' => $slug]);

        $query = $this->buildQuery($request);
        $products = $query->paginate(12)->withQueryString();

        $filterCategories = Category::active()->withCount('products')->get();
        $filterBrands = Brand::active()->get();
        $filterAttributes = Attribute::with('values')->get();

        return view('shop.index', [
            'pageTitle' => $category->name.' - '.setting('site_name', 'Molla'),
            'products' => $products,
            'filterCategories' => $filterCategories,
            'filterBrands' => $filterBrands,
            'filterAttributes' => $filterAttributes,
            'currentCategory' => $category,
        ]);
    }

    /**
     * Helper to build filtered and sorted Eloquent query.
     */
    private function buildQuery(Request $request): Builder
    {
        $query = Product::active()->with(['category', 'images']);

        // Filter by category (including children)
        if ($request->filled('category')) {
            $catSlug = $request->input('category');
            $cat = Category::where('slug', $catSlug)->orWhere('id', $catSlug)->first();
            if ($cat) {
                $categoryIds = $cat->children()->pluck('id')->push($cat->id);
                $query->whereIn('category_id', $categoryIds);
            }
        }

        // Filter by search query
        if ($request->filled('q')) {
            $searchTerm = '%'.$request->input('q').'%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'like', $searchTerm)
                    ->orWhere('sku', 'like', $searchTerm)
                    ->orWhere('short_description', 'like', $searchTerm);
            });
        }

        // Filter by Brands
        if ($request->filled('brand')) {
            $brandSlugs = (array) $request->input('brand');
            $query->whereHas('brand', function ($q) use ($brandSlugs) {
                $q->whereIn('slug', $brandSlugs);
            });
        }

        // Filter by Attributes
        if ($request->filled('attributes')) {
            $attributeValueIds = (array) $request->input('attributes');
            $query->whereHas('attributeValues', function ($q) use ($attributeValueIds) {
                $q->whereIn('attribute_values.id', $attributeValueIds);
            });
        }

        // Filter by Min & Max Price
        if ($request->filled('min_price')) {
            $query->where(function ($q) use ($request) {
                $min = (float) $request->input('min_price');
                $q->where('price', '>=', $min)
                    ->orWhere('sale_price', '>=', $min);
            });
        }

        if ($request->filled('max_price')) {
            $query->where(function ($q) use ($request) {
                $max = (float) $request->input('max_price');
                $q->where(function ($sq) use ($max) {
                    $sq->whereNull('sale_price')->where('price', '<=', $max);
                })->orWhere(function ($sq) use ($max) {
                    $sq->whereNotNull('sale_price')->where('sale_price', '<=', $max);
                });
            });
        }

        // Filter on sale only
        if ($request->boolean('sale')) {
            $query->whereNotNull('sale_price')->whereColumn('sale_price', '<', 'price');
        }

        // Sorting
        $sort = $request->input('sort', 'default');
        match ($sort) {
            'newest' => $query->latest('id'),
            'price_asc' => $query->orderByRaw('COALESCE(sale_price, price) ASC'),
            'price_desc' => $query->orderByRaw('COALESCE(sale_price, price) DESC'),
            'name' => $query->orderBy('name', 'asc'),
            'featured' => $query->orderByDesc('is_featured')->latest('id'),
            default => $query->latest('id'),
        };

        return $query;
    }
}
