<?php

namespace Database\Seeders;

use App\Models\Coupon;
use App\Models\ShippingMethod;
use Illuminate\Database\Seeder;

class ShippingAndCouponSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Shipping Methods
        ShippingMethod::create([
            'name' => 'Free Shipping',
            'cost' => 0.00,
            'min_order_total' => 50.00,
            'sort_order' => 1,
            'is_active' => true,
        ]);

        ShippingMethod::create([
            'name' => 'Standard Delivery',
            'cost' => 10.00,
            'min_order_total' => null,
            'sort_order' => 2,
            'is_active' => true,
        ]);

        ShippingMethod::create([
            'name' => 'Express Courier',
            'cost' => 20.00,
            'min_order_total' => null,
            'sort_order' => 3,
            'is_active' => true,
        ]);

        // 2. Coupons
        Coupon::create([
            'code' => 'WELCOME10',
            'type' => 'percent',
            'value' => 10.00,
            'min_total' => null,
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addYear(),
            'usage_limit' => 1000,
            'used_count' => 5,
            'is_active' => true,
        ]);

        Coupon::create([
            'code' => 'SAVE20',
            'type' => 'fixed',
            'value' => 20.00,
            'min_total' => 100.00,
            'starts_at' => now()->subDay(),
            'ends_at' => now()->addYear(),
            'usage_limit' => 500,
            'used_count' => 2,
            'is_active' => true,
        ]);
    }
}
