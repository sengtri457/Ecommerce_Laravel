<?php

use App\Models\Setting;
use Illuminate\Support\Str;

if (! function_exists('money')) {
    /**
     * Format currency amount using the system currency symbol.
     */
    function money(float|int|string|null $amount): string
    {
        $amount = (float) ($amount ?? 0);
        $symbol = '$';

        try {
            if (class_exists(Setting::class)) {
                $symbol = Setting::get('currency_symbol', '$');
            }
        } catch (Throwable $e) {
            $symbol = '$';
        }

        return $symbol.number_format($amount, 2);
    }
}

if (! function_exists('setting')) {
    /**
     * Get a setting value by key.
     */
    function setting(string $key, mixed $default = null): mixed
    {
        return Setting::get($key, $default);
    }
}

if (! function_exists('get_cart_session_token')) {
    /**
     * Get or initialize the persistent session token for guest cart/wishlist.
     */
    function get_cart_session_token(): string
    {
        if (! session()->has('cart_token')) {
            session()->put('cart_token', (string) Str::uuid());
        }

        return (string) session()->get('cart_token');
    }
}
