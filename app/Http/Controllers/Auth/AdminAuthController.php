<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class AdminAuthController extends Controller
{
    public function create()
    {
        return view('admin.auth.register');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Authenticate user and check if userType is 'admin'
        if (Auth::attempt($request->only('email', 'password'))) {
            $user = Auth::user();

            if ($user->userType === 'admin') {
                return redirect()->route('admin.dashboard');
            }

            // Log out the user if not an admin
            Auth::logout();
            return back()->withErrors(['email' => 'Username or password is incorrect']);
        }

        return back()->withErrors(['email' => 'Username or password is incorrect']);
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
