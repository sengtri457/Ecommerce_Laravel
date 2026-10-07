<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Product;
use Illuminate\Contracts\View\View;

class ProductController extends Controller
{
    /**
     * Display a specific product details page.
     */
    public function show(string $slug): View
    {
        $product = Product::active()
            ->where('slug', $slug)
            ->with(['images', 'category', 'brand', 'attributeValues.attribute', 'reviews.user'])
            ->firstOrFail();

        $relatedProducts = Product::active()
            ->where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->with(['images', 'category'])
            ->take(4)
            ->get();

        $shippingPolicy = Page::where('slug', 'shipping')->first();

        return view('product.show', [
            'pageTitle' => $product->name.' - '.setting('site_name', 'Molla'),
            'metaDescription' => $product->short_description,
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'shippingPolicy' => $shippingPolicy,
        ]);
    }
}
