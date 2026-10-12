<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    public function run(): void
    {
        $settings = [
            'site_name' => 'Clothes™',
            'site_logo' => 'assets/images/mainImages/logoDevs.png',
            'site_logo_footer' => 'assets/images/mainImages/logoDevs.png',
            'phone' => '+1 (800) 234-5678',
            'email' => 'concierge@clothesbrand.com',
            'address' => '42 Crosby Street, SoHo, New York, NY 10012',
            'footer_text' => 'Clothes™ is built on the premise that everyday wear should be intentional, elevated, and timeless. Accessible conscious luxury designed for mindful living.',
            'currency_symbol' => '$',
            'payment_icons' => 'assets/images/payments.png',
            'copyright_text' => 'Copyright © 2026 Clothes™. All Rights Reserved.',
        ];

        foreach ($settings as $key => $value) {
            Setting::updateOrCreate(['key' => $key], ['value' => $value]);
        }
    }
}
