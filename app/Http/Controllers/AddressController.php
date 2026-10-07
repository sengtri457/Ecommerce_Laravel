<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display user addresses.
     */
    public function index(): View
    {
        $addresses = Auth::user()->addresses()->orderByDesc('is_default')->get();

        return view('account.addresses', [
            'pageTitle' => 'My Addresses - '.setting('site_name', 'Molla'),
            'addresses' => $addresses,
        ]);
    }

    /**
     * Store new address.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'label' => 'required|string|max:50',
            'full_name' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'line1' => 'required|string|max:200',
            'line2' => 'nullable|string|max:200',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'is_default' => 'nullable|boolean',
        ]);

        $isDefault = $request->boolean('is_default');
        if ($isDefault) {
            Auth::user()->addresses()->update(['is_default' => false]);
        }

        Auth::user()->addresses()->create(array_merge($validated, ['is_default' => $isDefault]));

        return back()->with('success', 'Address added successfully.');
    }

    /**
     * Update address.
     */
    public function update(Request $request, int $id): RedirectResponse
    {
        $address = Auth::user()->addresses()->findOrFail($id);

        $validated = $request->validate([
            'label' => 'required|string|max:50',
            'full_name' => 'required|string|max:100',
            'phone' => 'required|string|max:30',
            'line1' => 'required|string|max:200',
            'line2' => 'nullable|string|max:200',
            'city' => 'required|string|max:100',
            'state' => 'nullable|string|max:100',
            'postal_code' => 'required|string|max:20',
            'country' => 'required|string|max:100',
            'is_default' => 'nullable|boolean',
        ]);

        $isDefault = $request->boolean('is_default');
        if ($isDefault) {
            Auth::user()->addresses()->where('id', '!=', $address->id)->update(['is_default' => false]);
        }

        $address->update(array_merge($validated, ['is_default' => $isDefault]));

        return back()->with('success', 'Address updated successfully.');
    }

    /**
     * Delete address.
     */
    public function destroy(int $id): RedirectResponse
    {
        Auth::user()->addresses()->where('id', $id)->delete();

        return back()->with('success', 'Address removed successfully.');
    }
}
