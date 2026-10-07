<?php

namespace App\Http\Controllers;

use App\Models\Attribute;
use App\Models\Product;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CompareController extends Controller
{
    /**
     * Display comparison table.
     */
    public function index(): View
    {
        $productIds = session()->get('compare', []);
        $products = Product::whereIn('id', $productIds)
            ->with(['images', 'category', 'brand', 'attributeValues.attribute'])
            ->get();

        $attributes = Attribute::all();

        return view('compare.index', [
            'pageTitle' => 'Compare Products - '.setting('site_name', 'Molla'),
            'products' => $products,
            'attributes' => $attributes,
        ]);
    }

    /**
     * Toggle product into compare session list (max 4).
     */
    public function toggle(Request $request): RedirectResponse
    {
        $request->validate(['product_id' => 'required|exists:products,id']);
        $productId = (int) $request->product_id;

        $compare = session()->get('compare', []);

        if (in_array($productId, $compare)) {
            $compare = array_values(array_diff($compare, [$productId]));
            session()->put('compare', $compare);

            return back()->with('info', 'Item removed from compare list.');
        }

        if (count($compare) >= 4) {
            return back()->with('error', 'You can compare a maximum of 4 items at a time.');
        }

        $compare[] = $productId;
        session()->put('compare', $compare);

        return back()->with('success', 'Item added to compare list.');
    }
}
