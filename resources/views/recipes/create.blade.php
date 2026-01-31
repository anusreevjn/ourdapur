@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--gray-900);">Create Recipe</h1>
        </div>
        <a href="{{ route('admin.recipes') }}" class="btn-secondary">Cancel</a>
    </div>
        @if ($errors->any())
            <div class="alert alert-danger" style="color: red; margin-bottom: 1rem;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    <form action="{{ route('recipes.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <h3 style="margin-bottom: 1.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid var(--gray-200);">Basic Information</h3>
        
        <div class="form-group">
            <label class="form-label">Title *</label>
            <input type="text" name="title" required class="form-control">
        </div>

        <div class="form-group">
            <label class="form-label">Recipe Image</label>
            <input type="file" name="image" class="form-control" accept="image/*">
            <p style="font-size: 0.8rem; color: var(--gray-600); margin-top: 5px;">Upload a JPG or PNG (Max 5MB)</p>
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control"></textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Cuisine *</label>
                <select name="cuisine" class="form-control">
                    <option>Malaysian</option>
                    <option>Western</option>
                    <option>Japanese</option>
                    <option>Korean</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Meal Type *</label>
                <select name="meal_type" class="form-control">
                    <option>Breakfast</option>
                    <option>Lunch</option>
                    <option>Dinner</option>
                    <option>Dessert</option>
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Spice Level *</label>
                <select name="spice_level" class="form-control">
                    <option>None</option>
                    <option>Mild</option>
                    <option>Medium</option>
                    <option>Spicy</option>
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Prep (min)</label>
                <input type="number" name="prep_time" value="0" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Cook (min)</label>
                <input type="number" name="cook_time" value="0" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Servings *</label>
                <input type="number" name="servings" value="2" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Calories</label>
                <input type="number" name="calories" value="0" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Dietary Information</label>
            <div style="display: flex; gap: 1.5rem;">
                <label class="custom-check">
                    <input type="checkbox" name="is_vegetarian"> Vegetarian
                </label>
                <label class="custom-check">
                    <input type="checkbox" name="is_vegan"> Vegan
                </label>
                <label class="custom-check">
                    <input type="checkbox" name="is_halal"> Halal
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Ingredients (One per line)</label>
            <textarea name="ingredients" rows="5" class="form-control" placeholder="e.g. 200g Chicken&#10;1 Onion"></textarea>
        </div>

        <div class="form-group">
            <label class="form-label">Instructions (One per line)</label>
            <textarea name="instructions" rows="5" class="form-control" placeholder="e.g. Chop onion...&#10;Fry chicken..."></textarea>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem;">
            <a href="{{ auth()->user()->is_admin ? route('admin.recipes') : route('recipes.index') }}" class="btn-secondary">Cancel</a>
            <button type="submit" class="btn-primary">Create Recipe</button>
        </div>
    </div>
    </form>
</div>
@endsection