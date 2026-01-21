<?php
use App\Http\Controllers\AIController;
use App\Http\Controllers\RecipeController;
use Illuminate\Support\Facades\Route;
use Symfony\Component\BrowserKit\HttpBrowser;
use Symfony\Component\HttpClient\HttpClient;
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;


Route::get('/', [RecipeController::class, 'index'])->name('home');
Route::middleware('guest')->group(function () {
    Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/register', [AuthController::class, 'register']);
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Logout Route (Only for logged in users)
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');
// ... existing AI routes ...
    Route::post('/recipes/{id}/review', [RecipeController::class, 'storeReview'])->name('recipes.review');
    Route::post('/recipes/{id}/bookmark', [RecipeController::class, 'toggleBookmark'])->name('recipes.bookmark');
Route::get('/ai-chef', [AIController::class, 'index'])->name('ai.index');
Route::post('/ai-chef/suggest', [AIController::class, 'suggest'])->name('ai.suggest');

Route::get('/test-scrape', function () {
    // 1. Initialize the browser
    $browser = new HttpBrowser(HttpClient::create());

    // 2. Request a real website (e.g., GitHub's explore page)
    $crawler = $browser->request('GET', 'https://github.com/explore');

    // 3. Scrape the main heading (h1)
    // We wrap this in a try-catch in case the site blocks us or changes
    try {
        $title = $crawler->filter('h1')->text();
        return "<h1>Scraping Successful!</h1><p>The title on GitHub Explore is: <strong>" . $title . "</strong></p>";
    } catch (\Exception $e) {
        return "Scraping failed: " . $e->getMessage();
    }
});
/// 1. Show the "Forgot Password" Form
Route::get('/forgot-password', function () {
    return view('auth.forgot-password');
})->middleware('guest')->name('password.request');

// 2. Handle the Form Submission (Send the Email)
Route::post('/forgot-password', function (Illuminate\Http\Request $request) {
    // Validate email exists
    $request->validate(['email' => 'required|email']);

    // Send the link using Laravel's built-in system
    $status = Password::sendResetLink($request->only('email'));

    // Return success or error message
    return $status === Password::RESET_LINK_SENT
                ? back()->with(['status' => __($status)])
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.email');

// 3. Show the "Reset Password" Form (After clicking the email link)
Route::get('/reset-password/{token}', function ($token) {
    return view('auth.reset-password', ['token' => $token]);
})->middleware('guest')->name('password.reset');

// 4. Handle the Password Update
Route::post('/reset-password', function (Illuminate\Http\Request $request) {
    $request->validate([
        'token' => 'required',
        'email' => 'required|email',
        'password' => 'required|min:8|confirmed',
    ]);

    $status = Password::reset(
        $request->only('email', 'password', 'password_confirmation', 'token'),
        function ($user, $password) {
            $user->forceFill(['password' => Illuminate\Support\Facades\Hash::make($password)])->save();
            $user->setRememberToken(Illuminate\Support\Str::random(60));
        }
    );

    return $status === Password::PASSWORD_RESET
                ? redirect()->route('login')->with('status', __($status))
                : back()->withErrors(['email' => __($status)]);
})->middleware('guest')->name('password.update');
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    Route::get('/scraper', [AdminController::class, 'scraper'])->name('scraper');
});
Route::get('/recipes', [RecipeController::class, 'index'])->name('recipes.index');
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
Route::middleware('auth')->group(function () {
    Route::post('/recipes/{recipe}/bookmark', [BookmarkController::class, 'toggle'])->name('bookmarks.toggle');
    Route::get('/my-bookmarks', [BookmarkController::class, 'index'])->name('bookmarks.index');
});
Route::post('/recipes/{recipe}/review', [ReviewController::class, 'store'])->name('reviews.store')->middleware('auth');