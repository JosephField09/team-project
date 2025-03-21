<?php

namespace Tests\Unit;

use App\Http\Controllers\BasketController;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Tests\TestCase;

class AddItemToBasketTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an authenticated user can add an item to the basket.
     */
    public function test_authenticated_user_can_add_item_to_basket()
    {
        // Arrange: create user and product
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        // Create a mock request with quantity and size
        $request = Request::create('/basket/add/' . $product->id, 'POST', [
            'quantity' => 2,
            'size' => 'M'
        ]);

        $request->setUserResolver(fn() => $user);

        // Act: call the controller method
        $controller = new BasketController();
        $controller->add($product->id, $request);

        // Assert: item exists in the cart
        $this->assertDatabaseHas('carts', [
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 2,
            'size' => 'M'
        ]);
    }
}
