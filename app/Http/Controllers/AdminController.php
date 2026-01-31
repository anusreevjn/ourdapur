<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Recipe;
use App\Models\Review;
use Illuminate\Support\Facades\Http;
use DOMDocument;
use DOMXPath;

class AdminController extends Controller
{
    public function dashboard() {
        // Fetch stats for the dashboard cards
        $stats = [
            'users' => User::count(),
            'recipes' => Recipe::count(),
            'pending_recipes' => Recipe::where('is_approved', false)->count(),
            'total_recipes' => Recipe::count(),
            'total_reviews' => Review::count(),
            'avg_rating' => number_format(Review::avg('rating') ?? 0, 1),
            'total_cuisines' => Recipe::distinct('cuisine')->count('cuisine'),
    
        ];
        
        // Fetch recent recipes for the list
        $recentRecipes = Recipe::latest()->take(5)->get();

       $cuisineStats = Recipe::select('cuisine', \DB::raw('count(*) as total'))
            ->groupBy('cuisine')
            ->get();

        return view('admin.dashboard', compact('stats', 'cuisineStats'));
    }
    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function recipes()
    {
        $recipes = Recipe::paginate(10);
        return view('admin.recipes.index', compact('recipes'));
    }

    public function reviews()
    {
        $reviews = Review::with(['user', 'recipe'])->latest()->paginate(10);
        return view('admin.reviews.index', compact('reviews'));
    }
    public function scraper() {
        return view('admin.scraper');
    }
    public function testScrape(Request $request) {
        // 1. Validate URL
        $request->validate([
            'url' => 'required|url'
        ]);

        $url = $request->input('url');

        try {
            // 2. Fetch the HTML content pretending to be a real browser
            $response = Http::withHeaders([
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/91.0.4472.124 Safari/537.36'
            ])->get($url);

            if ($response->failed()) {
                return redirect()->route('admin.scraper')->with('error', 'Failed to load URL (Status: ' . $response->status() . ')');
            }

            $html = $response->body();

            // 3. Parse HTML to find JSON-LD (The "Gold Standard" for Recipe Data)
            $libxml_previous_state = libxml_use_internal_errors(true); // Suppress HTML5 errors
            $dom = new DOMDocument();
            $dom->loadHTML($html);
            libxml_clear_errors();
            libxml_use_internal_errors($libxml_previous_state);

            $xpath = new DOMXPath($dom);
            // Look for the specific script tag that holds recipe data
            $scripts = $xpath->query('//script[@type="application/ld+json"]');

            $recipeData = null;

            // 4. Loop through found scripts to find the one marked as "Recipe"
            foreach ($scripts as $script) {
                $json = json_decode($script->nodeValue, true);
                
                // Handle cases where the JSON is an array of objects (graph)
                $dataItems = isset($json['@graph']) ? $json['@graph'] : (isset($json[0]) ? $json : [$json]);

                foreach ($dataItems as $item) {
                    if (isset($item['@type']) && (
                        $item['@type'] === 'Recipe' || 
                        (is_array($item['@type']) && in_array('Recipe', $item['@type']))
                    )) {
                        $recipeData = $item;
                        break 2; // Break both loops
                    }
                }
            }

            if (!$recipeData) {
                return redirect()->route('admin.scraper')->with('error', 'Could not find standard recipe data on this page. (Site might strictly block bots or not use Schema.org)');
            }

            // 5. Format the extracted data for your view
            $cleanRecipe = [
                'title' => $recipeData['name'] ?? 'Untitled Recipe',
                'description' => $recipeData['description'] ?? '',
                'ingredients' => $recipeData['recipeIngredient'] ?? [],
                'instructions' => []
            ];

            // Normalize instructions (sometimes they are text, sometimes objects)
            if (isset($recipeData['recipeInstructions'])) {
                foreach ($recipeData['recipeInstructions'] as $step) {
                    if (is_string($step)) {
                        $cleanRecipe['instructions'][] = $step;
                    } elseif (is_array($step) && isset($step['text'])) {
                        $cleanRecipe['instructions'][] = $step['text'];
                    }
                }
            }

            // 6. Return the view WITH the data (Do not redirect)
            return view('admin.scraper', ['recipe' => $cleanRecipe]);

        } catch (\Exception $e) {
            return redirect()->route('admin.scraper')->with('error', 'Scraping Error: ' . $e->getMessage());
        }
    }
    public function profile() {
    return view('admin.profile', ['user' => auth()->user()]);
}

public function updateProfile(Request $request) {
    $user = auth()->user();
    $validated = $request->validate([
        'username' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,'.$user->id,
        'password' => 'nullable|min:8|confirmed',
    ]);

    $user->username = $validated['username'];
    $user->email = $validated['email'];
    if ($validated['password']) {
        $user->password = Hash::make($validated['password']);
    }
    $user->save();

    return back()->with('success', 'Admin profile updated successfully.');
}
// Add these functions to your AdminController class
public function approve(Recipe $recipe)
{
    $recipe->update(['is_approved' => true]);
    
    return back()->with('success', 'Recipe approved successfully!');
}
public function editUser(User $user)
{
    return view('admin.users.edit', compact('user'));
}

public function updateUser(Request $request, User $user)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $user->id,
        'password' => 'nullable|min:8',
        'is_admin' => 'nullable' // Checkbox sends '1' or null
    ]);

    $user->name = $request->name;
    $user->email = $request->email;
    
    // Handle Admin Toggle
    $user->is_admin = $request->has('is_admin');

    // Handle Password Update only if provided
    if ($request->filled('password')) {
        $user->password = \Illuminate\Support\Facades\Hash::make($request->password);
    }

    $user->save();

    return redirect()->route('admin.users')->with('success', 'User updated successfully.');
}
public function deleteUser(User $user)
    {
        // Prevent admin from deleting themselves
        if (auth()->id() === $user->id) {
            return back()->with('error', 'You cannot delete your own account.');
        }

        $user->delete();

        return back()->with('success', 'User deleted successfully.');
    }
}
