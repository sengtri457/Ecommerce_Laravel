<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Order;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminDashboardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_guests_cannot_access_admin_dashboard(): void
    {
        $response = $this->get('/admin');
        $response->assertRedirect('/login');
    }

    public function test_customer_cannot_access_admin_dashboard(): void
    {
        $customer = User::where('role', 'customer')->first();
        if (! $customer) {
            $customer = User::factory()->create(['role' => 'customer']);
        }

        $response = $this->actingAs($customer)->get('/admin');
        $response->assertStatus(403);
    }

    public function test_admin_can_access_admin_dashboard(): void
    {
        $admin = User::where('role', 'admin')->first();
        if (! $admin) {
            $admin = User::factory()->create(['role' => 'admin']);
        }

        $response = $this->actingAs($admin)->get('/admin');
        $response->assertStatus(200);
        $response->assertSee('Dashboard Overview');
        $response->assertSee('Catalog Products');
    }

    public function test_admin_login_redirects_directly_to_admin_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'admin@molla.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/admin');
    }

    public function test_customer_login_redirects_to_account_dashboard(): void
    {
        $response = $this->post('/login', [
            'email' => 'john@example.com',
            'password' => 'password',
        ]);

        $response->assertRedirect('/account');
    }

    public function test_admin_can_view_and_create_products(): void
    {
        $admin = User::where('role', 'admin')->first();
        $category = Category::first();

        $indexResponse = $this->actingAs($admin)->get('/admin/products');
        $indexResponse->assertStatus(200);
        $indexResponse->assertSee('Product Catalog');

        $createResponse = $this->actingAs($admin)->post('/admin/products', [
            'name' => 'Premium Merino Wool Cardigan',
            'category_id' => $category->id,
            'price' => 119.50,
            'stock' => 15,
            'short_description' => 'Ultra-soft cardigan.',
        ]);

        $createResponse->assertRedirect('/admin/products');
        $this->assertDatabaseHas('products', [
            'name' => 'Premium Merino Wool Cardigan',
            'price' => 119.50,
        ]);
    }

    public function test_admin_can_manage_orders(): void
    {
        $admin = User::where('role', 'admin')->first();
        $order = Order::first();

        if ($order) {
            $response = $this->actingAs($admin)->get('/admin/orders');
            $response->assertStatus(200);

            $showResponse = $this->actingAs($admin)->get("/admin/orders/{$order->id}");
            $showResponse->assertStatus(200);
            $showResponse->assertSee($order->order_number);

            $updateResponse = $this->actingAs($admin)->post("/admin/orders/{$order->id}/status", [
                'status' => 'processing',
            ]);
            $updateResponse->assertSessionHas('success');
            $this->assertDatabaseHas('orders', [
                'id' => $order->id,
                'status' => 'processing',
            ]);
        }
    }

    public function test_login_and_register_pages_load_for_guest_without_leaked_credentials(): void
    {
        $loginResponse = $this->get('/login');
        $loginResponse->assertStatus(200);
        $loginResponse->assertSee('Sign In');
        $loginResponse->assertDontSee('Admin Demo:');

        $registerResponse = $this->get('/register');
        $registerResponse->assertStatus(200);
        $registerResponse->assertSee('Sign Up');
        $registerResponse->assertSee('Register');
    }

    public function test_admin_can_manage_slides_and_settings(): void
    {
        $admin = User::where('role', 'admin')->first();

        $slidesResponse = $this->actingAs($admin)->get('/admin/slides');
        $slidesResponse->assertStatus(200);
        $slidesResponse->assertSee('Hero Slides');

        $settingsResponse = $this->actingAs($admin)->get('/admin/settings');
        $settingsResponse->assertStatus(200);
        $settingsResponse->assertSee('Store Settings & Branding');

        $updateSettings = $this->actingAs($admin)->post('/admin/settings', [
            'site_name' => 'Clothes Studio™',
            'phone' => '+1 (800) 999-8888',
        ]);
        $updateSettings->assertSessionHas('success');
        $this->assertDatabaseHas('settings', [
            'key' => 'site_name',
            'value' => 'Clothes Studio™',
        ]);
    }
}
