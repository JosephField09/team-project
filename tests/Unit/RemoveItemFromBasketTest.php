<?php

namespace Tests\Unit;

use App\Http\Controllers\BasketController;
use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RemoveItemFromBasketTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that an authenticated user can remove their own item from the basket.
     */
    public function test_authenticated_user_can_remove_their_own_cart_item()
    {
        // Arrange: create user, product, and cart item
        $user = User::factory()->create();
        $this->actingAs($user);

        $product = Product::factory()->create();

        $cartItem = Cart::create([
            'user_id' => $user->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'size' => 'M',
        ]);

        // Act: call remove method
        $controller = new BasketController();
        $response = $controller->remove($cartItem->id);

        // Assert: item is removed and redirected to basket
        $this->assertDatabaseMissing('carts', ['id' => $cartItem->id]);
        $this->assertEquals(302, $response->status());
    }
}
