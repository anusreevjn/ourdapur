@extends('layouts.app') {{-- CHANGE THIS to 'layouts.admin' if that is your main layout file --}}

@section('content')
<div class="container" style="padding: 2rem; max-width: 1200px; margin: 0 auto;">
    
    <div style="margin-bottom: 2rem; border-bottom: 1px solid #e5e7eb; padding-bottom: 1rem;">
        <h1 style="font-size: 1.8rem; font-weight: 800; color: #1f2937;">AI Recipe Scraper</h1>
        <p style="color: #6b7280; margin-top: 0.5rem;">Paste a URL from a recipe website (e.g., AllRecipes, FoodNetwork) to extract data automatically.</p>
    </div>

    <div style="background: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb;">
        
        <form action="{{ route('admin.test-scrape') }}" method="GET" style="display: flex; gap: 1rem; align-items: center;">
            <div style="flex-grow: 1;">
                <label for="url" style="display: block; font-size: 0.875rem; font-weight: 500; color: #374151; margin-bottom: 0.5rem;">Recipe URL</label>
                <input 
                    type="url" 
                    name="url" 
                    id="url" 
                    placeholder="https://www.allrecipes.com/recipe/..." 
                    required
                    style="width: 100%; padding: 0.75rem; border: 1px solid #d1d5db; border-radius: 0.5rem; font-size: 1rem;"
                    value="{{ request('url') }}"
                >
            </div>
            <div style="margin-top: 1.6rem;">
                <button type="submit" style="background-color: #2563eb; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; border: none; cursor: pointer; transition: background 0.2s;">
                    Scrape Recipe
                </button>
            </div>
        </form>

        {{-- ERROR MESSAGES --}}
        @if(session('error'))
            <div style="margin-top: 1.5rem; padding: 1rem; background-color: #fee2e2; color: #991b1b; border-radius: 0.5rem; border: 1px solid #fecaca;">
                <strong>Error:</strong> {{ session('error') }}
            </div>
        @endif
        
        @error('url')
            <div style="margin-top: 1rem; color: #dc2626; font-size: 0.875rem;">{{ $message }}</div>
        @enderror

    </div>

    @if(isset($recipe))
        <div style="margin-top: 2rem; background: white; padding: 2rem; border-radius: 0.75rem; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1); border: 1px solid #e5e7eb;">
            
            <div style="display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 2rem; padding-bottom: 1rem; border-bottom: 1px solid #e5e7eb;">
                <div>
                    <span style="background-color: #d1fae5; color: #065f46; padding: 0.25rem 0.75rem; border-radius: 9999px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase;">Success</span>
                    <h2 style="font-size: 1.5rem; font-weight: 700; color: #111827; margin-top: 0.5rem;">{{ $recipe['title'] ?? 'Scraped Recipe' }}</h2>
                    <p style="color: #6b7280; margin-top: 0.25rem; max-width: 600px;">{{ Str::limit($recipe['description'] ?? 'No description found.', 150) }}</p>
                </div>

                {{-- SAVE BUTTON FORM --}}
                {{-- REPLACEMENT FORM FOR scraper.blade.php --}}
<form action="{{ route('recipes.store') }}" method="POST">
    @csrf
    
    {{-- 1. Hidden Fields for Scraped Data --}}
    <input type="hidden" name="title" value="{{ $recipe['title'] ?? '' }}">
    <input type="hidden" name="description" value="{{ $recipe['description'] ?? '' }}">
    {{-- Note: We are saving ingredients/instructions as JSON strings. 
         Ensure your 'recipes.show' view knows how to decode them! --}}
    <input type="hidden" name="ingredients" value="{{ json_encode($recipe['ingredients'] ?? []) }}">
    <input type="hidden" name="instructions" value="{{ json_encode($recipe['instructions'] ?? []) }}">

    {{-- 2. New Dropdowns for REQUIRED Database Fields --}}
    <div style="background: #f9fafb; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem; border: 1px solid #e5e7eb;">
        <p style="font-size: 0.8rem; font-weight: 700; color: #4b5563; margin-bottom: 0.5rem; text-transform: uppercase;">Required Classification</p>
        
        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 1rem;">
            <div>
                <label style="display: block; font-size: 0.75rem; margin-bottom: 0.25rem;">Cuisine</label>
                <select name="cuisine" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                    <option value="">Select...</option>
                    <option value="Malay">Malay</option>
                    <option value="Chinese">Chinese</option>
                    <option value="Indian">Indian</option>
                    <option value="Western">Western</option>
                    <option value="Other">Other</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-size: 0.75rem; margin-bottom: 0.25rem;">Meal Type</label>
                <select name="meal_type" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                    <option value="">Select...</option>
                    <option value="Breakfast">Breakfast</option>
                    <option value="Lunch">Lunch</option>
                    <option value="Dinner">Dinner</option>
                    <option value="Snack">Snack</option>
                </select>
            </div>

            <div>
                <label style="display: block; font-size: 0.75rem; margin-bottom: 0.25rem;">Spice Level</label>
                <select name="spice_level" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                    <option value="None">None</option>
                    <option value="Mild">Mild</option>
                    <option value="Medium">Medium</option>
                    <option value="Spicy">Spicy</option>
                </select>
            </div>
        </div>
    </div>

    {{-- 3. Save Button --}}
    <button type="submit" style="background-color: #059669; color: white; padding: 0.75rem 1.5rem; border-radius: 0.5rem; font-weight: 600; border: none; cursor: pointer; display: flex; align-items: center; gap: 0.5rem; width: 100%; justify-content: center;">
        <span>Save to Database</span>
        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
            <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z"/>
        </svg>
    </button>
</form>
            </div>

            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 3rem;">
                <div>
                    <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; color: #374151; display: flex; align-items: center; gap: 0.5rem;">
                        Ingredients
                        <span style="background: #f3f4f6; padding: 0.1rem 0.5rem; border-radius: 1rem; font-size: 0.75rem;">{{ count($recipe['ingredients'] ?? []) }}</span>
                    </h3>
                    <ul style="list-style-type: none; padding: 0;">
                        @forelse($recipe['ingredients'] ?? [] as $ingredient)
                            <li style="padding: 0.5rem 0; border-bottom: 1px solid #f3f4f6; color: #4b5563;">
                                • {{ $ingredient }}
                            </li>
                        @empty
                            <li style="color: #9ca3af; font-style: italic;">No ingredients found.</li>
                        @endforelse
                    </ul>
                </div>

                <div>
                    <h3 style="font-size: 1.1rem; font-weight: 600; margin-bottom: 1rem; color: #374151; display: flex; align-items: center; gap: 0.5rem;">
                        Instructions
                        <span style="background: #f3f4f6; padding: 0.1rem 0.5rem; border-radius: 1rem; font-size: 0.75rem;">{{ count($recipe['instructions'] ?? []) }}</span>
                    </h3>
                    <div style="display: flex; flex-direction: column; gap: 1rem;">
                        @forelse($recipe['instructions'] ?? [] as $index => $step)
                            <div style="display: flex; gap: 1rem;">
                                <span style="background: #e5e7eb; color: #374151; width: 24px; height: 24px; border-radius: 50%; display: flex; align-items: center; justify-content: center; font-size: 0.75rem; font-weight: bold; flex-shrink: 0;">
                                    {{ $index + 1 }}
                                </span>
                                <p style="color: #4b5563; line-height: 1.5; margin: 0;">{{ $step }}</p>
                            </div>
                        @empty
                            <p style="color: #9ca3af; font-style: italic;">No instructions found.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection