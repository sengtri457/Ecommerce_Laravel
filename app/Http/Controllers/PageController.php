<?php

namespace App\Http\Controllers;

use App\Models\Feature;
use App\Models\Page;
use App\Models\TeamMember;
use App\Models\Testimonial;
use Illuminate\Contracts\View\View;

class PageController extends Controller
{
    /**
     * Display About page.
     */
    public function about(): View
    {
        $page = Page::active()->where('slug', 'about')->firstOrFail();
        $features = Feature::active()->where('position', 'about_values')->get();
        $team = TeamMember::active()->get();
        $testimonials = Testimonial::active()->get();

        return view('pages.about', [
            'pageTitle' => $page->title.' - '.setting('site_name', 'Molla'),
            'metaDescription' => $page->meta_description,
            'page' => $page,
            'features' => $features,
            'team' => $team,
            'testimonials' => $testimonials,
        ]);
    }

    /**
     * Display generic legal / policy content page.
     */
    public function show(string $slug): View
    {
        $page = Page::active()->where('slug', $slug)->firstOrFail();

        return view('pages.show', [
            'pageTitle' => $page->title.' - '.setting('site_name', 'Molla'),
            'metaDescription' => $page->meta_description,
            'page' => $page,
        ]);
    }
}
