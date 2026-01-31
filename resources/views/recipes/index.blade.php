@extends('layouts.app')

@section('content')

<div class="page-with-sidebar">
    
    <aside class="sidebar">
            <div style="background: white; padding: 1.5rem; border-radius: 1rem; border: 1px solid #e5e7eb;">
                
                <form action="{{ route('recipes.index') }}" method="GET" id="filterForm">
                    @if(request('search'))
                        <input type="hidden" name="search" value="{{ request('search') }}">
                    @endif

                    <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 1.5rem;">
                        <h3 style="font-size: 1.25rem; font-weight: 700; color: #431407; margin: 0;">Filters</h3>
                        <a href="{{ route('recipes.index') }}" style="font-size: 0.85rem; color: #dc2626; text-decoration: none;">Reset</a>
                    </div>
                    
                    <div class="filter-group">
                        <h4 class="filter-title">Cuisine</h4>
                        <div class="filter-pills">
                            @foreach(['Malaysian', 'Indonesian', 'Korean', 'Japanese', 'Western'] as $c)
                                <label class="pill-label">
                                    <input type="checkbox" name="cuisine[]" value="{{ $c }}" {{ in_array($c, request('cuisine', [])) ? 'checked' : '' }}>
                                    <span>{{ $c }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-group">
                        <h4 class="filter-title">Meal Type</h4>
                        <div class="filter-pills">
                            @foreach(['Breakfast', 'Lunch/Dinner', 'Snacks', 'Desserts', 'Drinks'] as $m)
                                <label class="pill-label">
                                    <input type="checkbox" name="meal_type[]" value="{{ $m }}" {{ in_array($m, request('meal_type', [])) ? 'checked' : '' }}>
                                    <span>{{ $m }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-group">
                        <h4 class="filter-title">Spice Level</h4>
                        <div class="filter-pills">
                            @foreach(['No Spice', 'Mild', 'Medium', 'Spicy', 'Very Spicy'] as $s)
                                <label class="pill-label">
                                    <input type="checkbox" name="spice_level[]" value="{{ $s }}" {{ in_array($s, request('spice_level', [])) ? 'checked' : '' }}>
                                    <span>{{ $s }}</span>
                                </label>
                            @endforeach
                        </div>
                    </div>

                    <div class="filter-group">
                        <h4 class="filter-title">Diet Preferences</h4>
                        <div style="display: flex; flex-direction: column; gap: 0.5rem;">
                            <label class="custom-check">
                                <input type="checkbox" name="diet[]" value="is_vegetarian" {{ in_array('is_vegetarian', request('diet', [])) ? 'checked' : '' }}>
                                <span>Vegetarian</span>
                            </label>
                            <label class="custom-check">
                                <input type="checkbox" name="diet[]" value="is_vegan" {{ in_array('is_vegan', request('diet', [])) ? 'checked' : '' }}>
                                <span>Vegan</span>
                            </label>
                            <label class="custom-check">
                                <input type="checkbox" name="diet[]" value="is_halal" {{ in_array('is_halal', request('diet', [])) ? 'checked' : '' }}>
                                <span>Halal</span>
                            </label>
                            <label class="custom-check">
                                <input type="checkbox" name="diet[]" value="is_gluten_free" {{ in_array('is_gluten_free', request('diet', [])) ? 'checked' : '' }}>
                                <span>Gluten Free</span>
                            </label>
                        </div>
                    </div>
                    
                    <button type="submit" class="btn-primary" style="width: 100%; justify-content: center; margin-top: 1rem;">Apply Filters</button>
                </form>
            </div>
        </aside>
    <div class="main-content">
        
        <div style="margin-bottom: 2rem; position: relative;">
            <input type="text" 
                   placeholder="Search recipes (e.g. Nasi Goreng)..." 
                   style="width: 100%; padding: 1rem 1.5rem; border: 1px solid #e5e7eb; border-radius: 50px; outline: none; font-size: 1rem; box-shadow: 0 2px 4px rgba(0,0,0,0.05);">
            <button style="position: absolute; right: 8px; top: 6px; background: var(--primary-color); color: white; border: none; padding: 0.6rem 1.5rem; border-radius: 50px; cursor: pointer;">
                Search
            </button>
        </div>

        <div class="section-header">
            <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--gray-900);">Browse Recipes</h2>
            <span style="color: var(--gray-600);">Showing 3 recipes</span>
        </div>

        <div class="recipe-grid">
    @foreach($recipes as $recipe)
        <div class="recipe-card">
            <div class="recipe-img-container">
                <img src="{{ Str::startsWith($recipe->image ?? '', 'http') ? $recipe->image : ($recipe->image ? asset('storage/' . $recipe->image) : 'https://placehold.co/600x400?text=No+Image') }}" 
                    alt="{{ $recipe->title }}" 
                    class="recipe-img"
                    onerror="this.onerror=null; this.src='https://placehold.co/600x400?text=No+Image';">
                
                <span class="badge badge-primary" style="position: absolute; top: 1rem; left: 1rem; background: rgba(255,255,255,0.9);">
                    {{ $recipe->cuisine }}
                </span>
            </div>
            
            <div class="recipe-content">
                <div class="recipe-meta">
                    <span><i class="far fa-clock"></i> {{ $recipe->prep_time ?? 'N/A' }} min</span>
                    <span><i class="fas fa-user"></i> {{ $recipe->servings ?? 'N/A' }} pax</span>
                </div>
                
                <h3 class="recipe-title">{{ $recipe->title }}</h3>
                
                <p class="recipe-desc">{{ Str::limit($recipe->description, 80) }}</p>
                
                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn-secondary" style="width: 100%; justify-content: center; text-decoration: none;">
                    View Recipe
                </a>
            </div>
        </div>
    @endforeach
</div>
    </div>
</div>

@endsection