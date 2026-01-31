<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class ProfileController extends Controller
{
    // Show the profile edit form
    public function edit()
    {
        return view('profile.edit', [
            'user' => auth()->user()
        ]);
    }

    // Update the profile information
    public function update(Request $request)
    {
        $user = auth()->user();

        // 1. Validate the input
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
            // Password is optional. Only validate if the user typed something.
            'current_password' => ['nullable', 'required_with:password', 'current_password'], 
            'password' => ['nullable', 'confirmed', 'min:6'],
        ]);

        // 2. Update Name & Email
        $user->name = $validated['name'];
        $user->email = $validated['email'];

        // 3. Update Password (only if provided)
        if ($request->filled('password')) {
            $user->password = Hash::make($validated['password']);
        }

        $user->save();

        return back()->with('success', 'Profile updated successfully!');
    }
}
