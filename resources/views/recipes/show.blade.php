@extends('layouts.app')

@section('content')
<div class="container" style="padding-top: 2rem;">
    <div class="card" style="display: flex; gap: 2rem; margin-bottom: 2rem; flex-wrap: wrap;">
        <div style="flex: 1; min-width: 300px;">
            <img src="{{ $recipe->image ?? 'https://placehold.co/600x400' }}" 
                 alt="{{ $recipe->title }}" 
                 style="width: 100%; border-radius: 1rem; object-fit: cover;">
        </div>

        <div style="flex: 1; min-width: 300px;">
            <span class="badge badge-primary">{{ $recipe->cuisine }}</span>
            <h1 style="font-size: 2.5rem; font-weight: 800; color: #431407; margin: 0.5rem 0;">{{ $recipe->title }}</h1>
            <p style="color: #666; margin-bottom: 1.5rem;">{{ $recipe->description }}</p>
            
            <div style="display: flex; gap: 2rem; margin-bottom: 2rem; font-weight: 600; color: #555;">
                <span><i class="far fa-clock"></i> {{ $recipe->prep_time }} mins</span>
                <span><i class="fas fa-utensils"></i> {{ $recipe->servings }} pax</span>
                <span><i class="fas fa-fire"></i> {{ $recipe->calories }} kcal</span>
            </div>

            <div style="display: flex; gap: 1rem;">
                <form action="{{ route('bookmarks.toggle', $recipe->id) }}" method="POST">
                    @csrf
                    <button type="submit" class="btn-primary">
                        <i class="far fa-bookmark"></i> Bookmark Recipe
                    </button>
                </form>
                <a href="{{ route('recipes.index') }}" class="btn-secondary">Back to List</a>
            </div>
        </div>
    </div>

    </div>
@endsection