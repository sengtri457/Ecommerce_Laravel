<?php

namespace App\Http\Controllers;

use App\Models\NewsletterSubscriber;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class NewsletterController extends Controller
{
    /**
     * Subscribe email to newsletter.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate(['email' => 'required|email']);

        NewsletterSubscriber::updateOrCreate(
            ['email' => $request->email],
            ['is_active' => true]
        );

        return back()->with('success', 'Thank you for subscribing to our newsletter!');
    }
}
