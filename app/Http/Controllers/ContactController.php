<?php

namespace App\Http\Controllers;

use App\Models\ContactMessage;
use App\Models\Page;
use App\Models\StoreLocation;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display contact page.
     */
    public function index(): View
    {
        $page = Page::active()->where('slug', 'contact')->first();
        $locations = StoreLocation::active()->get();

        return view('pages.contact', [
            'pageTitle' => 'Contact Us - '.setting('site_name', 'Molla'),
            'page' => $page,
            'locations' => $locations,
        ]);
    }

    /**
     * Store customer message.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:30',
            'subject' => 'nullable|string|max:150',
            'message' => 'required|string|min:5|max:2000',
        ]);

        ContactMessage::create($validated);

        return back()->with('success', 'Your message has been sent successfully! Our customer support will contact you shortly.');
    }
}
