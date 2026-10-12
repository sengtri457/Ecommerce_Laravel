<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HeroSlide;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HeroSlideController extends Controller
{
    public function index(): View
    {
        $slides = HeroSlide::orderBy('sort_order')->paginate(10)->withQueryString();

        return view('admin.slides.index', compact('slides'));
    }

    public function create(): View
    {
        return view('admin.slides.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'price_prefix' => 'nullable|string|max:100',
            'price' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:10240',
            'background_color' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/slides'), $filename);
            $validated['image'] = 'uploads/slides/'.$filename;
        } else {
            $validated['image'] = str_replace('\\', '/', $validated['image'] ?? 'assets/images/demos/demo-13/slider/slide-1.jpg');
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active', true);
        $validated['button_text'] = $validated['button_text'] ?? 'Shop Now';
        $validated['button_url'] = $validated['button_url'] ?? '/shop';

        unset($validated['image_file']);
        HeroSlide::create($validated);

        return redirect()->route('admin.slides.index')->with('success', 'Hero slide created successfully!');
    }

    public function edit(HeroSlide $slide): View
    {
        return view('admin.slides.edit', compact('slide'));
    }

    public function update(Request $request, HeroSlide $slide): RedirectResponse
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string|max:255',
            'price_prefix' => 'nullable|string|max:100',
            'price' => 'nullable|string|max:100',
            'button_text' => 'nullable|string|max:100',
            'button_url' => 'nullable|string|max:255',
            'image' => 'nullable|string|max:255',
            'image_file' => 'nullable|image|max:10240',
            'background_color' => 'nullable|string|max:50',
            'sort_order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('image_file')) {
            $file = $request->file('image_file');
            $filename = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/slides'), $filename);
            $validated['image'] = 'uploads/slides/'.$filename;
        } elseif (! empty($validated['image'])) {
            $validated['image'] = str_replace('\\', '/', $validated['image']);
        } else {
            $validated['image'] = $slide->image;
        }

        $validated['sort_order'] = $validated['sort_order'] ?? 0;
        $validated['is_active'] = $request->boolean('is_active');

        unset($validated['image_file']);
        $slide->update($validated);

        return redirect()->route('admin.slides.index')->with('success', 'Hero slide updated successfully!');
    }

    public function destroy(HeroSlide $slide): RedirectResponse
    {
        $slide->delete();

        return redirect()->route('admin.slides.index')->with('success', 'Hero slide removed successfully!');
    }
}
