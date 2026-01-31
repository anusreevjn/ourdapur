@extends('layouts.app')

@section('content')

<section class="hero-section">
    <div style="display: inline-flex; align-items: center; gap: 8px; background: #fff7ed; color: #9a3412; padding: 8px 16px; rounded: 999px; font-weight: 600; font-size: 0.9rem; margin-bottom: 2rem; border-radius: 50px;">
        <i class="fas fa-robot"></i>
        <span>Powered by AI Ingredient Analysis</span>
    </div>

    <h1 class="hero-title">
        What's cooking in <br>
        <span>your kitchen?</span>
    </h1>
    
    <p class="hero-subtitle">
        Don't know what to cook? Scan your ingredients or search our community library to find the perfect meal in seconds.
    </p>

    <div class="search-bar-lg">
        <div style="padding: 0 0 0 1rem; display: flex; align-items: center; color: #cbd5e1;">
            <i class="fas fa-search"></i>
        </div>
        <input type="text" placeholder="Search for 'Nasi Lemak' or 'Chicken'...">
        <button class="btn-primary" style="padding: 0.75rem 2rem;">Search</button>
    </div>

    <div>
        <span style="font-size: 0.8rem; color: #9ca3af; font-weight: 600; display: block; margin-bottom: 0.5rem;">OR TRY THIS</span>
        <a href="{{ route('ai.index') }}" style="color: var(--primary-color); font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 0.5rem;">
            Use AI Ingredient Matcher <i class="fas fa-arrow-right"></i>
        </a>
    </div>
</section>

<section style="margin-bottom: 5rem;">
    <div class="container">
        <h3 style="font-size: 1.5rem; font-weight: 700; color: var(--gray-900); margin-bottom: 2rem; text-align: center;">Explore Cuisines</h3>
        
        <div class="cuisine-row">
            <a href="#" class="cuisine-card">
                <span class="cuisine-emoji">🌶️</span>
                <span class="cuisine-name">Malaysian</span>
            </a>
            <a href="#" class="cuisine-card">
                <span class="cuisine-emoji">🥥</span>
                <span class="cuisine-name">Indonesian</span>
            </a>
            <a href="#" class="cuisine-card">
                <span class="cuisine-emoji">🥢</span>
                <span class="cuisine-name">Korean</span>
            </a>
            <a href="#" class="cuisine-card">
                <span class="cuisine-emoji">🍣</span>
                <span class="cuisine-name">Japanese</span>
            </a>
        </div>
    </div>
</section>

<section class="container" style="margin-bottom: 5rem;">
    <div class="section-header">
        <div>
            <h2 style="font-size: 2rem; font-weight: 700; color: var(--gray-900);">Fresh from the Community</h2>
            <p style="color: var(--gray-600);">Discover the latest creations by our home chefs.</p>
        </div>
        <a href="{{ route('recipes.index') }}" class="btn-secondary" style="border-radius: 50px;">
            View All <i class="fas fa-arrow-right" style="margin-left: 5px;"></i>
        </a>
    </div>

    <div class="recipe-grid">
    @foreach($recipes as $recipe)
        <div class="recipe-card">
            <div class="recipe-img-container">
                <img src="{{ Str::startsWith($recipe->image ?? '', 'http') ? $recipe->image : ($recipe->image ? asset('storage/' . $recipe->image) : 'https://placehold.co/600x400?text=No+Image') }}" alt="{{ $recipe->title }}" class="recipe-img" onerror="this.onerror=null; this.src='https://placehold.co/600x400?text=No+Image';">
                
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
</section>

@endsection