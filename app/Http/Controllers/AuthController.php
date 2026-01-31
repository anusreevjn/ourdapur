<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Mail\WelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail; // Import Mail Facade

class AuthController extends Controller
{
    // Show Register Form
    public function showRegister() {
        return view('register');
    }

    // Handle Registration
    public function register(Request $request) {
        // 1. Validate Form
        $fields = $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:6'
        ]);

        // 2. Create User in Database
        $user = User::create([
            'name' => $fields['name'],
            'email' => $fields['email'],
            'password' => Hash::make($fields['password']),
        ]);

        // 3. Log the user in immediately
        Auth::login($user);

        // 4. Send the Welcome Email
        // Laragon will catch this in its "fake" inbox
        Mail::to($user->email)->send(new WelcomeEmail($user));

        // 5. Redirect to Home
        return redirect('/')->with('success', 'Welcome! Your account has been created.');
    }

    // Show Login Form
    public function showLogin() {
        return view('login'); // Make sure you have a login.blade.php
    }

    // Handle Login logic
    public function login(Request $request) {
        $fields = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt($fields)) {
            $request->session()->regenerate();
            return redirect('/')->with('success', 'You are logged in!');
        }

        return back()->withErrors(['email' => 'Invalid credentials.']);
    }

    // Handle Logout
    
    public function logout(Request $request){
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // CHANGE THIS LINE:
    return redirect()->route('logout.success');
    }
}