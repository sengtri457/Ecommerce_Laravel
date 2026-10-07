<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ShippingMethod;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MollaStoreTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed();
    }

    public function test_homepage_loads_successfully(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('MacBook Air');
        $response->assertSee('Browse Categories');
        $response->assertSee('Explore Popular Categories');
    }

    public function test_shop_and_category_pages_load(): void
    {
        $response = $this->get('/shop');
        $response->assertStatus(200);
        $response->assertSee('Shop Catalog');

        $category = Category::first();
        if ($category) {
            $catResponse = $this->get('/category/'.$category->slug);
            $catResponse->assertStatus(200);
            $catResponse->assertSee($category->name);
        }

        $searchResponse = $this->get('/search?q=Apple');
        $searchResponse->assertStatus(200);
    }

    public function test_product_detail_page_loads(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        $response = $this->get('/product/'.$product->slug);
        $response->assertStatus(200);
        $response->assertSee($product->name);
        $response->assertSee('Add to Cart');
    }

    public function test_cart_operations_and_coupon(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        // Add to cart
        $addResponse = $this->post('/cart/add', [
            'product_id' => $product->id,
            'quantity' => 2,
        ]);
        $addResponse->assertSessionHas('success');

        // View cart
        $cartResponse = $this->get('/cart');
        $cartResponse->assertStatus(200);
        $cartResponse->assertSee($product->name);

        // Apply coupon
        $coupon = Coupon::first();
        if ($coupon) {
            $couponResponse = $this->post('/cart/coupon', [
                'code' => $coupon->code,
            ]);
            $couponResponse->assertSessionHas('success');
        }
    }

    public function test_wishlist_and_compare_toggle(): void
    {
        $product = Product::first();
        $this->assertNotNull($product);

        // Wishlist toggle
        $wishResponse = $this->post('/wishlist/toggle', [
            'product_id' => $product->id,
        ]);
        $wishResponse->assertSessionHas('success');

        $getWishlist = $this->get('/wishlist');
        $getWishlist->assertStatus(200);
        $getWishlist->assertSee($product->name);

        // Compare toggle
        $compResponse = $this->post('/compare/toggle', [
            'product_id' => $product->id,
        ]);
        $compResponse->assertSessionHas('success');

        $getCompare = $this->get('/compare');
        $getCompare->assertStatus(200);
        $getCompare->assertSee($product->name);
    }

    public function test_checkout_places_order_and_reduces_stock(): void
    {
        $product = Product::where('stock', '>', 5)->first();
        $this->assertNotNull($product);
        $initialStock = $product->stock;
        $shipping = ShippingMethod::first();

        // Add item to cart
        $this->post('/cart/add', [
            'product_id' => $product->id,
            'quantity' => 1,
        ]);

        $checkoutPage = $this->get('/checkout');
        $checkoutPage->assertStatus(200);

        // Submit checkout
        $response = $this->post('/checkout', [
            'customer_name' => 'Test Customer',
            'customer_email' => 'customer@test.com',
            'customer_phone' => '1234567890',
            'shipping_address' => '123 Delivery Road, NY',
            'shipping_method_id' => $shipping->id,
            'payment_method' => 'cod',
            'notes' => 'Handle with care',
        ]);

        $response->assertRedirect();
        $product->refresh();
        $this->assertEquals($initialStock - 1, $product->stock);
    }

    public function test_user_authentication_and_account_dashboard(): void
    {
        $user = User::where('role', 'customer')->first();
        $this->assertNotNull($user);

        // Login
        $loginResponse = $this->post('/login', [
            'email' => $user->email,
            'password' => 'password',
        ]);
        $loginResponse->assertRedirect();
        $this->assertAuthenticatedAs($user);

        // Access dashboard
        $dashResponse = $this->get('/account');
        $dashResponse->assertStatus(200);
        $dashResponse->assertSee($user->name);

        // Access orders
        $ordersResponse = $this->get('/account/orders');
        $ordersResponse->assertStatus(200);
    }

    public function test_blog_and_content_pages(): void
    {
        $this->get('/blog')->assertStatus(200);
        $this->get('/about')->assertStatus(200)->assertSee('About');
        $this->get('/contact')->assertStatus(200)->assertSee('Contact');
        $this->get('/faq')->assertStatus(200)->assertSee('FAQ');
        $this->get('/page/privacy-policy')->assertStatus(200);

        // Contact message submit
        $contactResponse = $this->post('/contact', [
            'name' => 'Alice Cooper',
            'email' => 'alice@test.com',
            'phone' => '555-1234',
            'subject' => 'Product inquiry',
            'message' => 'Hello, I have a question about bulk purchasing.',
        ]);
        $contactResponse->assertSessionHas('success');

        // Newsletter subscription
        $newsResponse = $this->post('/newsletter', [
            'email' => 'subscriber@test.com',
        ]);
        $newsResponse->assertSessionHas('success');
    }
}
