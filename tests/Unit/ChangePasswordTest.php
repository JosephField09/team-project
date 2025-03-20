<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;

class PasswordChangeTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_change_password_with_valid_current_password()
    {
        //  Create a user with a known password
        $user = User::factory()->create([
            'password' => Hash::make('RealPassword')
        ]);

        //  Attempt to change the password
        $response = $this->actingAs($user)->patch('/password', [
            'current_password' => 'RealPassword',
            'password' => 'Newpassword',
            'password_confirmation' => 'Newpassword',
        ]);

        // Assert: Verify password changed
        $response->assertRedirect(); // Since the method returns back()
        $this->assertTrue(Hash::check('Newpassword', $user->fresh()->password));
    }

    /** @test */
    public function user_cannot_change_password_with_invalid_current_password()
    {
        $user = User::factory()->create([
            'password' => Hash::make('RealPassword')
        ]);

        $response = $this->actingAs($user)->patch('/password', [
            'current_password' => 'Wrongpassword',
            'password' => 'Newpassword',
            'password_confirmation' => 'Newpassword',
        ]);

        // Assert: Error is returned and password is NOT updated
        $response->assertSessionHasErrors('current_password');
        $this->assertFalse(Hash::check('Newpassword', $user->fresh()->password));
    }

    /** @test */
    public function password_must_be_confirmed()
    {
        $user = User::factory()->create([
            'password' => Hash::make('RealPassword')
        ]);

        $response = $this->actingAs($user)->patch('/password', [
            'current_password' => 'RealPassword',
            'password' => 'Newpassword',
            'password_confirmation' => 'Failedconfirmation',
        ]);

        // Assert: Validation error
        $response->assertSessionHasErrors('password');
    }
}
