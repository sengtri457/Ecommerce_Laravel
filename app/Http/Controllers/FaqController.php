<?php

namespace App\Http\Controllers;

use App\Models\FaqCategory;
use App\Models\Page;
use Illuminate\Contracts\View\View;

class FaqController extends Controller
{
    /**
     * Display FAQs page.
     */
    public function index(): View
    {
        $page = Page::active()->where('slug', 'faq')->first();
        $categories = FaqCategory::with('faqs')->orderBy('sort_order')->get();

        return view('pages.faq', [
            'pageTitle' => 'FAQ - '.setting('site_name', 'Molla'),
            'page' => $page,
            'categories' => $categories,
        ]);
    }
}
