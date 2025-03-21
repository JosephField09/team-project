<?php

namespace Tests\Unit;

use App\Http\Controllers\Auth\PasswordController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Tests\TestCase;

class PasswordChangeTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test a logged-in user can successfully change their password.
     */
    public function test_user_can_change_password_successfully()
    {
        // Create a user with a known password
        $user = User::factory()->create([
            'password' => Hash::make('oldpassword123')
        ]);

        // Simulate a password change request
        $request = Request::create('/password', 'PUT', [
            'current_password' => 'oldpassword123',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        // Attach the authenticated user to the request
        $request->setUserResolver(fn () => $user);

        // Call the controller method
        $controller = new PasswordController();
        $response = $controller->update($request);

        // Refresh the user to get updated data
        $user->refresh();

        // Assertions
        $this->assertTrue(Hash::check('newpassword123', $user->password));
        $this->assertEquals(302, $response->status());
    }

    /**
     * Test that changing password fails with wrong current password.
     */
    public function test_change_password_fails_with_incorrect_current_password()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create([
            'password' => Hash::make('correctpassword')
        ]);

        $request = Request::create('/password', 'PUT', [
            'current_password' => 'wrongpassword',
            'password' => 'newpassword123',
            'password_confirmation' => 'newpassword123',
        ]);

        $request->setUserResolver(fn () => $user);

        $controller = new PasswordController();
        $controller->update($request); // This should throw a ValidationException
    }

    /**
     * Test that password change fails when confirmation doesn't match.
     */
    public function test_change_password_fails_when_confirmation_does_not_match()
    {
        $this->expectException(ValidationException::class);

        $user = User::factory()->create([
            'password' => Hash::make('correctpassword')
        ]);

        $request = Request::create('/password', 'PUT', [
            'current_password' => 'correctpassword',
            'password' => 'newpassword123',
            'password_confirmation' => 'wrongconfirmation',
        ]);

        $request->setUserResolver(fn () => $user);

        $controller = new PasswordController();
        $controller->update($request); // This should throw a ValidationException
    }
}
