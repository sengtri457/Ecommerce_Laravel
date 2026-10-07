<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\ShippingMethod;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Admin
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@molla.com',
            'phone' => '+1 (555) 019-2834',
            'role' => 'admin',
            'password' => Hash::make('password'),
        ]);

        // 2. Customer 1 (John Doe)
        $john = User::create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'phone' => '+1 (555) 234-5678',
            'role' => 'customer',
            'password' => Hash::make('password'),
        ]);

        Address::create([
            'user_id' => $john->id,
            'label' => 'Home',
            'full_name' => 'John Doe',
            'phone' => '+1 (555) 234-5678',
            'line1' => '742 Evergreen Terrace',
            'city' => 'Springfield',
            'state' => 'OR',
            'postal_code' => '97477',
            'country' => 'United States',
            'is_default' => true,
        ]);

        // 3. Customer 2 (Jane Smith)
        $jane = User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@example.com',
            'phone' => '+1 (555) 876-5432',
            'role' => 'customer',
            'password' => Hash::make('password'),
        ]);

        Address::create([
            'user_id' => $jane->id,
            'label' => 'Office',
            'full_name' => 'Jane Smith',
            'phone' => '+1 (555) 876-5432',
            'line1' => '100 Market Street, Suite 400',
            'city' => 'San Francisco',
            'state' => 'CA',
            'postal_code' => '94105',
            'country' => 'United States',
            'is_default' => true,
        ]);

        // 4. Seed sample past order for John
        $product = Product::first();
        $shipping = ShippingMethod::first();

        if ($product && $shipping) {
            $order = Order::create([
                'order_number' => 'ORD-'.strtoupper(uniqid()),
                'user_id' => $john->id,
                'shipping_method_id' => $shipping->id,
                'customer_name' => $john->name,
                'customer_email' => $john->email,
                'customer_phone' => $john->phone,
                'shipping_address' => '742 Evergreen Terrace, Springfield, OR 97477, United States',
                'subtotal' => $product->final_price,
                'shipping_cost' => $shipping->cost,
                'discount' => 0.00,
                'total' => $product->final_price + $shipping->cost,
                'payment_method' => 'cod',
                'status' => 'completed',
                'notes' => 'Leave at the front porch.',
            ]);

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'product_name' => $product->name,
                'unit_price' => $product->final_price,
                'quantity' => 1,
                'line_total' => $product->final_price,
            ]);
        }
    }
}
