<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductReview;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Store a product review.
     */
    public function store(Request $request, string $slug): RedirectResponse
    {
        $product = Product::active()->where('slug', $slug)->firstOrFail();

        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'rating' => 'required|integer|min:1|max:5',
            'title' => 'nullable|string|max:200',
            'body' => 'required|string|min:5|max:2000',
        ]);

        ProductReview::create([
            'product_id' => $product->id,
            'user_id' => Auth::id(),
            'name' => $validated['name'],
            'rating' => $validated['rating'],
            'title' => $validated['title'] ?? null,
            'body' => $validated['body'],
            'is_approved' => true,
        ]);

        return back()->with('success', 'Thank you! Your product review has been submitted.');
    }
}
