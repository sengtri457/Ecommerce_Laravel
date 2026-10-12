<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PromoBanner;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PromoBannerController extends Controller
{
    public function index(): View
    {
        $banners = PromoBanner::orderBy('sort_order')->paginate(10)->withQueryString();

        return view('admin.banners.index', compact('banners'));
    }

    public function create(): View
    {
        return view('admin.banners.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'position' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:10240',
            'background_color' => 'nullable|string|max:50',
            'column_class' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners'), $filename);
            $validated['image'] = 'uploads/banners/'.$filename;
        } else {
            $validated['image'] = str_replace('\\', '/', $validated['image'] ?? 'assets/images/demos/demo-13/banners/banner-1.jpg');
        }

        $validated['position'] = $validated['position'] ?? 'home_middle';
        $validated['button_text'] = $validated['button_text'] ?? 'Discover';
        $validated['button_url'] = $validated['button_url'] ?? '/shop';
        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);

        unset($validated['image_file']);
        PromoBanner::create($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Promo banner created successfully!');
    }

    public function edit(PromoBanner $banner): View
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, PromoBanner $banner): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'position' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:10240',
            'background_color' => 'nullable|string|max:50',
            'column_class' => 'nullable|string|max:100',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/banners'), $filename);
            $validated['image'] = 'uploads/banners/'.$filename;
        } elseif (! empty($validated['image'])) {
            $validated['image'] = str_replace('\\', '/', $validated['image']);
        } else {
            $validated['image'] = $banner->image;
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        unset($validated['image_file']);
        $banner->update($validated);

        return redirect()->route('admin.banners.index')->with('success', 'Promo banner updated successfully!');
    }

    public function destroy(PromoBanner $banner): RedirectResponse
    {
        $banner->delete();

        return redirect()->route('admin.banners.index')->with('success', 'Promo banner removed successfully!');
    }
}
