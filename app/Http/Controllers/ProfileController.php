<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use App\Models\User;
use App\Models\Order;
use App\Models\Category;

class ProfileController extends Controller
{
    public function add(Request $request): RedirectResponse
    {
        // Validate data
        $validated = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName'  => 'required|string|max:255',
            'email'     => 'required|email',
            'password'  => 'required|string|min:8',
            'phone'     => 'required|string|max:50',
            'userType'  => 'required|in:user,admin',
        ]);

        // Check if the email already exists
        if (User::where('email', $validated['email'])->exists()) {
            return redirect()
                ->back()
                ->withInput() 
                ->with('status', 'user-not-added');
        }
    
        // Create and save the user
        $user = new User;
        $user->firstName       = $validated['firstName'];
        $user->lastName        = $validated['lastName'];
        $user->email           = $validated['email'];
        $user->password        = Hash::make($validated['password']); 
        $user->phone           = $validated['phone'];
        $user->userType        = $validated['userType'];
        $user->isSubscribed    = 0; 
        $user->email_verified_at = null; 
        $user->save();
    
        // Redirect with success status
        return redirect()
            ->route('admin.dashboard', ['tab' => 'allUsers'])
            ->with('status', 'user-added');
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();
        // Pass users orders and the items within
        $orders = Order::where('user_id', Auth::id())
        ->with('orderItems.product') 
        ->get();

        return view('dashboard', [
            'user' => $user,
            'orders' => $orders,
            'activeTab' => 'account',
        ]);
    }

    public function editAdmin(): RedirectResponse
    {
        return redirect()->route('admin.dashboard',['tab' => 'settings'])->with('status', 'profile-updated');
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->update($request->validated());
        // Validate the input fields
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update the user's information
        $user->update([
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'email' => $validatedData['email'],
        ]);

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Update the admin's profile information.
     */
    public function updateAdmin(ProfileUpdateRequest $request): RedirectResponse
    {
        $user = $request->user();
        $user->update($request->validated());
        // Validate the input fields
        $validatedData = $request->validate([
            'firstName' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $user->id,
        ]);

        // Update the user's information
        $user->update([
            'firstName' => $validatedData['firstName'],
            'lastName' => $validatedData['lastName'],
            'email' => $validatedData['email'],
        ]);

        return Redirect::route('profile.editAdmin')->with('status', 'admin-updated');
    }

    /**
     * Sets users subscribed to true, allows user to subscribe.
     */
    public function subscribe(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user) {
            $user->update([
                'isSubscribed' => true,
            ]);

            return redirect()->back()->with('status', 'subscribed-successfully');
        }

        return redirect()->back()->withErrors(['message' => 'Unable to process subscription.']);
    }

    /**
     * Sets users subscribed to false, allows user to subscribe.
     */
    public function unsubscribe(Request $request): RedirectResponse
    {
        $user = $request->user();

        if ($user) {
            $user->update([
                'isSubscribed' => false,
            ]);

            return redirect()->back()->with('status', 'subscribed-successfully');
        }

        return redirect()->back()->withErrors(['message' => 'Unable to process subscription.']);
    }

    /**
     * Seacrh a specific user by name or email in the database
     */
    public function search(Request $request)
    {
        $search = $request->input('search');
        $tab = $request->input('tab'); 
    
        // Search where the first name or email is like search given and user is not admin and paginate
        $users = User::where(function ($query) use ($search) {
            $query->where('firstName', 'LIKE', '%' . $search . '%')
                  ->orWhere('email', 'LIKE', '%' . $search . '%');
        })
        ->where('userType', '!=', 'admin') 
        ->paginate(10);

        // Paginate categories
        $orders = Order::paginate(10);

        // Paginate categories
        $allcategories = Category::paginate(5);
    
        // Get the authenticated admin
        $admin = Auth::user();
    
        // Return the view with the tab, categories and admin
        return view('admin.dashboard', [
            'tab' => $tab,  
            'orders' => $orders,
            'users' => $users,
            'allcategories' => $allcategories,
            'admin' => $admin,
        ]);
    }
    
    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Delete a specific user's account from admin dashboard.
     */
    public function destroyOther($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'allUsers'])->with('success', 'User deleted successfully!');
    }
}
