<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Recipe;
use App\Models\Bookmark;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    // Toggle Bookmark (AJAX or Redirect)
    public function toggle(Recipe $recipe)
    {
        $user = Auth::user();
        
        // Check if exists
        $bookmark = Bookmark::where('user_id', $user->id)->where('recipe_id', $recipe->id)->first();

        if ($bookmark) {
            $bookmark->delete();
            return back()->with('success', 'Recipe removed from bookmarks.');
        } else {
            Bookmark::create([
                'user_id' => $user->id,
                'recipe_id' => $recipe->id
            ]);
            return back()->with('success', 'Recipe bookmarked!');
        }
    }

    // Show User's Bookmarks
    public function index()
    {
        // Get recipes that the user has bookmarked
        $recipes = Auth::user()->bookmarks()->with('recipe')->get()->pluck('recipe');
        return view('recipes.bookmarks', compact('recipes'));
    }
}