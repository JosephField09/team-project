<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    /**
     * Show the registration form for admins.
     */
    public function create()
{
    // Check if the user is logged in
    if (auth()->check()) {
        // Get the logged-in user
        $user = auth()->user();

        // Check if the user is an admin
        if ($user->userType === 'admin') {
            // Redirect to the admin dashboard view
            return redirect()->route('admin.dashboard');
        }

        // If the user is not an admin, redirect to the home page
        return redirect()->route('home');
    }

    // If no user is logged in, show the register page
    return view('admin.auth.register');
}

    /**
     * Handle admin registration.
     */
    public function register(Request $request)
    {
        // Validate the request data
        $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'phone' => 'required|string|max:15',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create a new User
        $user = User::create([
            'firstName' => $request->firstName,
            'lastName' => $request->lastName,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'userType' => 'admin', 
        ]);

        // Log in the newly registered admin
        Auth::login($user);

        return redirect()->route('admin.dashboard')->with('success', 'Admin registered successfully.');
    }
}
