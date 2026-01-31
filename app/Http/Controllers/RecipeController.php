<?php

namespace App\Http\Controllers;

use App\Models\Recipe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RecipeController extends Controller
{
    // 1. Show all recipes (Browse Page with filters)
    public function index(Request $request)
    {
        $query = Recipe::query();
        if (!auth()->check() || !auth()->user()->is_admin) {
        $query->where('is_approved', true);
    }
        // Filters
        if ($request->has('cuisine')) {
            $query->whereIn('cuisine', $request->cuisine);
        }
        if ($request->has('meal_type')) {
            $query->whereIn('meal_type', $request->meal_type);
        }
        if ($request->has('spice_level')) {
            $query->whereIn('spice_level', $request->spice_level);
        }
        if ($request->has('diet')) {
            foreach ($request->diet as $preference) {
                $query->where($preference, true);
            }
        }

        // Search
        if ($request->has('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                  ->orWhere('description', 'like', '%' . $search . '%');
            });
        }

        $recipes = $query->paginate(12);
        return view('recipes.index', compact('recipes'));
    }
    

    // 3. Save New Recipe (MISSING IN YOUR FILE)
    
    // 2. Welcome Page (Home)
    public function home()
    {
        $recipes = Recipe::latest()->take(3)->get(); 
        return view('welcome', compact('recipes'));
    }

    // 3. Show Single Recipe
    public function show(Recipe $recipe)
    {
        return view('recipes.show', compact('recipe'));
    }

    // 4. Show Create Form
    public function create()
    {
        return view('recipes.create');
    }

    // 5. Store New Recipe (Create Logic)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'required|string',
            'instructions' => 'nullable|string',
            'cuisine' => 'required|string',
            'meal_type' => 'required|string',
            'spice_level' => 'required|string',
            'prep_time' => 'nullable|integer',
            'cook_time' => 'nullable|integer',
            'servings' => 'nullable|integer',
            'calories' => 'nullable|integer',
            'image' => 'nullable|image|max:5120', 
        ]);

        // Handle Checkboxes manually
        $validated['is_halal'] = $request->has('is_halal');
        $validated['is_vegetarian'] = $request->has('is_vegetarian');
        $validated['is_vegan'] = $request->has('is_vegan');
        $validated['is_gluten_free'] = $request->has('is_gluten_free');

        $validated['user_id'] = auth()->id();
        if (auth()->user()->is_admin) {
        $validated['is_approved'] = true;
    } else {
        $validated['is_approved'] = false;
    }
        // Assign to current user
        $validated['user_id'] = Auth::id();
        // Auto-approve if Admin, otherwise pending
        $validated['is_approved'] = auth()->user()->is_admin ? true : false;

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }

        Recipe::create($validated);
       if (auth()->user()->is_admin) {
        return redirect()->route('admin.recipes')->with('success', 'Recipe created and auto-approved!');
    }
    
    return redirect()->route('recipes.index')->with('success', 'Recipe submitted for approval.');
}
      
    // 6. Show Edit Form
    public function edit(Recipe $recipe)
    {
        // Optional: Ensure only owner or admin can edit
        if (Auth::id() !== $recipe->user_id && !Auth::user()->is_admin) {
             abort(403);
        }
        return view('recipes.edit', compact('recipe'));
    }

    // 7. Update Recipe (Edit Logic)
    public function update(Request $request, Recipe $recipe)
    {
        // Ensure only owner or admin can update
        if (Auth::id() !== $recipe->user_id && !Auth::user()->is_admin) {
             abort(403);
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'ingredients' => 'nullable|string',
            'instructions' => 'nullable|string',
            'cuisine' => 'required|string',
            'meal_type' => 'required|string',
            'spice_level' => 'required|string',
            'prep_time' => 'nullable|integer',
            'cook_time' => 'nullable|integer',
            'servings' => 'nullable|integer',
            'calories' => 'nullable|integer',
            'image' => 'nullable|image|max:5120', 
        ]);

        // Fix the "on" vs boolean issue
        $validated['is_halal'] = $request->has('is_halal');
        $validated['is_vegetarian'] = $request->has('is_vegetarian');
        $validated['is_vegan'] = $request->has('is_vegan');
        $validated['is_gluten_free'] = $request->has('is_gluten_free');

        // Handle Image Upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('recipes', 'public');
        }

        $recipe->update($validated);

        if (Auth::user()->is_admin) {
            return redirect()->route('admin.recipes')->with('success', 'Recipe updated successfully!');
        }
        return redirect()->route('recipes.show', $recipe)->with('success', 'Recipe updated!');
    }

    // 8. Delete Recipe
    public function destroy(Recipe $recipe)
    {
        if (Auth::id() !== $recipe->user_id && !Auth::user()->is_admin) {
            abort(403);
       }
       
        $recipe->delete();
        return back()->with('success', 'Recipe deleted successfully.');
    }
            public function myRecipes()
        {
            // Get recipes created by the logged-in user (both pending and approved)
            $recipes = Recipe::where('user_id', auth()->id())->latest()->paginate(12);
            
            // Reuse the existing index view, but maybe pass a flag to show status badges
            return view('recipes.index', compact('recipes'))->with('myRecipes', true);
        }
}