<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recipe;

class AdminController extends Controller
{
    public function dashboard() {
        // Fetch stats for the dashboard cards
        $stats = [
            'users' => User::count(),
            'recipes' => Recipe::count(),
            'pending_recipes' => Recipe::where('is_approved', false)->count(),
        ];
        
        // Fetch recent recipes for the list
        $recentRecipes = Recipe::latest()->take(5)->get();

        return view('admin.dashboard', compact('stats', 'recentRecipes'));
    }

    public function scraper() {
        return view('admin.scraper');
    }
}