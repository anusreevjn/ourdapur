<?php

namespace App\Http\Controllers;

use App\Models\Recipe; // Import the model
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    public function index()
    {
        // 1. Get all recipes from database
        $recipes = Recipe::all();

        // 2. Send them to the 'welcome' view
        return view('welcome', compact('recipes'));
    }
}