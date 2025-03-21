<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\RegisteredUserController;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class RegisteredUserControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test successful user registration.
     */
    public function test_user_can_register_successfully()
    {
        Event::fake(); // Prevent actual event firing like email verification

        $request = Request::create('/register', 'POST', [
            'firstName' => 'John',
            'lastName' => 'Doe',
            'email' => 'john@example.com',
            'phone' => '1234567890',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        // Required to avoid session errors during redirect
        Session::start();

        $controller = new RegisteredUserController();
        $response = $controller->store($request);

        $this->assertAuthenticated(); // User is logged in
        $this->assertDatabaseHas('users', [
            'email' => 'john@example.com',
            'firstName' => 'John',
            'lastName' => 'Doe',
        ]);

        Event::assertDispatched(Registered::class); // Event dispatched
        $this->assertEquals(302, $response->status()); // Redirect response
    }

    /**
     * Test registration fails if email is already taken.
     */
    public function test_registration_fails_with_duplicate_email()
    {
        User::factory()->create(['email' => 'john@example.com']);

        $this->expectException(ValidationException::class);

        $request = Request::create('/register', 'POST', [
            'firstName' => 'Jane',
            'lastName' => 'Doe',
            'email' => 'john@example.com', // duplicate email
            'phone' => '1112223333',
            'password' => 'password123',
            'password_confirmation' => 'password123',
        ]);

        Session::start();

        $controller = new RegisteredUserController();
        $controller->store($request); // Should throw ValidationException
    }

    /**
     * Test registration fails if password confirmation does not match.
     */
    public function test_registration_fails_when_password_confirmation_does_not_match()
    {
        $this->expectException(ValidationException::class);

        $request = Request::create('/register', 'POST', [
            'firstName' => 'Alex',
            'lastName' => 'Smith',
            'email' => 'alex@example.com',
            'phone' => '9998887777',
            'password' => 'password123',
            'password_confirmation' => 'wrongpass',
        ]);

        Session::start();

        $controller = new RegisteredUserController();
        $controller->store($request); // Should throw ValidationException
    }
}
