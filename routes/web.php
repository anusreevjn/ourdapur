<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AIController;
use App\Http\Controllers\RecipeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\ReviewController;

// --- PUBLIC ROUTES ---
// 1. Main Landing Page (Welcome)
Route::get('/', [RecipeController::class, 'home'])->name('welcome');
Route::get('/logout-success', function () {
    return view('auth.logout');
})->name('logout.success');
// 2. Recipe Browse Page (Index) - KEEP THIS AS IS
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');

// --- AUTH ROUTES ---
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
    
    // Password Reset
    Route::get('/forgot-password', function () { return view('auth.forgot-password'); })->name('password.request');
    Route::post('/forgot-password', function (Illuminate\Http\Request $request) {
        $request->validate(['email' => 'required|email']);
        $status = Password::sendResetLink($request->only('email'));
        return $status === Password::RESET_LINK_SENT ? back()->with(['status' => __($status)]) : back()->withErrors(['email' => __($status)]);
    })->name('password.email');
    Route::get('/reset-password/{token}', function ($token) { return view('auth.reset-password', ['token' => $token]); })->name('password.reset');
    Route::post('/reset-password', function (Illuminate\Http\Request $request) {
        $request->validate(['token' => 'required', 'email' => 'required|email', 'password' => 'required|min:8|confirmed']);
        $status = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->forceFill(['password' => Illuminate\Support\Facades\Hash::make($password)])->save();
            $user->setRememberToken(Illuminate\Support\Str::random(60));
        });
        return $status === Password::PASSWORD_RESET ? redirect()->route('login')->with('status', __($status)) : back()->withErrors(['email' => __($status)]);
    })->name('password.update');
});

Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

// --- AUTHENTICATED USER ROUTES ---
Route::middleware('auth')->group(function () {
    // Recipe Management
    // Use 'except' index/show because those are public above
    Route::get('/recipes/create', [RecipeController::class, 'create'])->name('recipes.create');
    Route::post('/recipes', [RecipeController::class, 'store'])->name('recipes.store');
    Route::resource('recipes', RecipeController::class)->except(['index', 'show']);
    Route::get('/my-recipes', [RecipeController::class, 'myRecipes'])->name('recipes.my');

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');

    // AI Chef
    Route::get('/ai-chef', [AIController::class, 'index'])->name('ai.index');
    Route::post('/ai-chef/suggest', [AIController::class, 'suggest'])->name('ai.suggest');

    // Reviews & Bookmarks
    Route::post('/recipes/{recipe}/review', [ReviewController::class, 'store'])->name('reviews.store'); // Fixed name
    Route::post('/recipes/{recipe}/bookmark', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
    Route::get('/my-bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
});

// --- ADMIN ROUTES ---
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
   // Recipe Actions
    Route::patch('/recipes/{recipe}/approve', [AdminController::class, 'approve'])->name('recipes.approve');
    // Admin Management Views
    Route::get('/users', [AdminController::class, 'users'])->name('users');
    Route::get('/users/{user}/edit', [AdminController::class, 'editUser'])->name('users.edit');
    Route::put('/users/{user}', [AdminController::class, 'updateUser'])->name('users.update');
    
    Route::delete('/users/{user}', [AdminController::class, 'deleteUser'])->name('users.delete');
    
    Route::get('/recipes', [AdminController::class, 'recipes'])->name('recipes'); // Admin list view
    
    Route::get('/reviews', [AdminController::class, 'reviews'])->name('reviews');
    Route::delete('/reviews/{review}', [ReviewController::class, 'destroy'])->name('reviews.delete');
    
    Route::get('/scraper', [AdminController::class, 'scraper'])->name('scraper');
    Route::get('/test-scrape', [AdminController::class, 'testScrape'])->name('test-scrape');
    Route::get('/recipes/{recipe}', [RecipeController::class, 'show'])->name('recipes.show');
});
