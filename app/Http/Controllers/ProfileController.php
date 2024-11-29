<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = $request->user();

        return view('dashboard', [
            'user' => $user,
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

    public function destroyOther($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.dashboard', ['tab' => 'allUsers'])->with('success', 'User deleted successfully!');
    }
}
