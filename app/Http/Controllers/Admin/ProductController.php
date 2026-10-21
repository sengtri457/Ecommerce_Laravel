<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with(['category', 'brand', 'images']);

        if ($request->filled('q')) {
            $query->where('name', 'like', '%'.$request->q.'%')
                ->orWhere('sku', 'like', '%'.$request->q.'%');
        }

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        $products = $query->latest()->paginate(10)->withQueryString();
        $categories = Category::orderBy('name')->get();

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create(): View
    {
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();

        return view('admin.products.create', compact('categories', 'brands'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|lt:price',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'is_new' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'primary_image_file' => 'nullable|image|max:10240',
            'primary_image_url' => 'nullable|string|max:255',
            'gallery_images.*' => 'nullable|image|max:10240',
        ]);

        $validated['slug'] = Str::slug($validated['name']).'-'.Str::lower(Str::random(5));
        $validated['sku'] = $validated['sku'] ?? 'SKU-'.strtoupper(Str::random(8));
        $validated['is_new'] = $request->boolean('is_new');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        unset($validated['primary_image_file'], $validated['primary_image_url'], $validated['gallery_images']);

        $product = Product::create($validated);

        if ($request->hasFile('primary_image_file')) {
            $file = $request->file('primary_image_file');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);
            $product->images()->create([
                'path' => 'uploads/products/'.$filename,
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        } elseif ($request->filled('primary_image_url')) {
            $product->images()->create([
                'path' => str_replace('\\', '/', $request->primary_image_url),
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        }

        if ($request->hasFile('gallery_images')) {
            foreach ($request->file('gallery_images') as $index => $gFile) {
                if ($gFile) {
                    $filename = time().'_'.uniqid().'_'.($index + 1).'.'.$gFile->getClientOriginalExtension();
                    $gFile->move(public_path('uploads/products'), $filename);
                    $product->images()->create([
                        'path' => 'uploads/products/'.$filename,
                        'is_primary' => false,
                        'sort_order' => $index + 1,
                    ]);
                }
            }
        }

        return redirect()->route('admin.products.index')->with('success', "Product '{$product->name}' created successfully!");
    }

    public function edit(Product $product): View
    {
        $product->load('images');
        $categories = Category::orderBy('name')->get();
        $brands = Brand::orderBy('name')->get();

        return view('admin.products.edit', compact('product', 'categories', 'brands'));
    }

    public function update(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'brand_id' => 'nullable|exists:brands,id',
            'price' => 'required|numeric|min:0',
            'sale_price' => 'nullable|numeric|lt:price',
            'stock' => 'required|integer|min:0',
            'sku' => 'nullable|string|max:100|unique:products,sku,'.$product->id,
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'is_new' => 'nullable|boolean',
            'is_featured' => 'nullable|boolean',
            'is_active' => 'nullable|boolean',
            'primary_image_file' => 'nullable|image|max:10240',
            'primary_image_url' => 'nullable|string|max:255',
            'gallery_images.*' => 'nullable|image|max:10240',
            'delete_images' => 'nullable|array',
            'delete_images.*' => 'integer|exists:product_images,id',
            'make_primary' => 'nullable|integer|exists:product_images,id',
        ]);

        $validated['is_new'] = $request->boolean('is_new');
        $validated['is_featured'] = $request->boolean('is_featured');
        $validated['is_active'] = $request->boolean('is_active');

        if ($request->filled('delete_images')) {
            $imagesToDelete = ProductImage::where('product_id', $product->id)
                ->whereIn('id', $request->delete_images)
                ->get();

            foreach ($imagesToDelete as $delImg) {
                if (str_starts_with($delImg->path, 'uploads/products/')) {
                    $filePath = public_path($delImg->path);
                    if (file_exists($filePath)) {
                        @unlink($filePath);
                    }
                }
                $delImg->delete();
            }
        }

        if ($request->filled('make_primary')) {
            $product->images()->update(['is_primary' => false]);
            $product->images()->where('id', $request->make_primary)->update(['is_primary' => true]);
        }

        if ($request->hasFile('primary_image_file')) {
            $file = $request->file('primary_image_file');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/products'), $filename);

            $product->images()->update(['is_primary' => false]);
            $product->images()->create([
                'path' => 'uploads/products/'.$filename,
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        } elseif ($request->filled('primary_image_url')) {
            $product->images()->update(['is_primary' => false]);
            $product->images()->create([
                'path' => str_replace('\\', '/', $request->primary_image_url),
                'is_primary' => true,
                'sort_order' => 0,
            ]);
        }

        if ($request->hasFile('gallery_images')) {
            $currentMaxOrder = (int) $product->images()->max('sort_order');
            foreach ($request->file('gallery_images') as $index => $gFile) {
                if ($gFile) {
                    $currentMaxOrder++;
                    $filename = time().'_'.uniqid().'_'.$currentMaxOrder.'.'.$gFile->getClientOriginalExtension();
                    $gFile->move(public_path('uploads/products'), $filename);
                    $product->images()->create([
                        'path' => 'uploads/products/'.$filename,
                        'is_primary' => false,
                        'sort_order' => $currentMaxOrder,
                    ]);
                }
            }
        }

        unset(
            $validated['primary_image_file'],
            $validated['primary_image_url'],
            $validated['gallery_images'],
            $validated['delete_images'],
            $validated['make_primary']
        );

        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', "Product '{$product->name}' updated successfully!");
    }

    public function destroy(Product $product): RedirectResponse
    {
        $name = $product->name;

        foreach ($product->images as $img) {
            if (str_starts_with($img->path, 'uploads/products/')) {
                $filePath = public_path($img->path);
                if (file_exists($filePath)) {
                    @unlink($filePath);
                }
            }
        }

        $product->delete();

        return redirect()->route('admin.products.index')->with('success', "Product '{$name}' removed successfully!");
    }
}
