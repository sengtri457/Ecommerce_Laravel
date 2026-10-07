<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Molla eCommerce',
            'site_logo' => 'assets/images/demos/demo-13/logo.png',
            'site_logo_footer' => 'assets/images/demos/demo-13/logo-footer.png',
            'phone' => '+0123 456 789',
            'email' => 'contact@molla.com',
            'address' => '70 Washington Square South, New York, NY 10012, United States',
            'footer_text' => 'Praesent dapibus, neque id cursus ucibus, tortor neque egestas augue, eu vulputate magna eros eu erat. Aliquam erat volutpat. Nam dui mi, tincidunt quis, accumsan porttitor, facilisis luctus, metus.',
            'currency_symbol' => '$',
            'payment_icons' => 'assets/images/payments.png',
            'copyright_text' => 'Copyright © 2026 Molla Store. All Rights Reserved.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
