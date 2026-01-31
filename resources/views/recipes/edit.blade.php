@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--gray-900);">Edit Recipe</h1>
        </div>
        <a href="{{ route('admin.recipes') }}" class="btn-secondary">Cancel</a>
    </div>

   <form action="{{ route('recipes.update', $recipe->id) }}" method="POST" enctype="multipart/form-data" id="editRecipeForm">
    @csrf
    @method('PUT')
        
    <div class="card" style="max-width: 800px; margin: 0 auto;">
        <h3 style="margin-bottom: 1.5rem; padding-bottom: 0.5rem; border-bottom: 1px solid var(--gray-200);">Basic Information</h3>
        
        <div class="form-group">
            <label class="form-label">Title *</label>
            <input type="text" name="title" value="{{ old('title', $recipe->title) }}" required class="form-control">
        </div>

       <div class="form-group">
            <label class="form-label">Change Image (Optional)</label>
            @if($recipe->image)
                <div style="margin-bottom: 10px;">
                    <img src="{{ Str::startsWith($recipe->image, 'http') ? $recipe->image : asset('storage/' . $recipe->image) }}" 
                         alt="Current Image" 
                         style="width: 80px; height: 80px; object-fit: cover; border-radius: var(--radius-lg); border: 1px solid var(--gray-200);">
                </div>
            @endif
            <input type="file" name="image" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label class="form-label">Description</label>
            <textarea name="description" rows="3" class="form-control">{{ old('description', $recipe->description) }}</textarea>
        </div>

        <div style="display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 1rem; margin-bottom: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Cuisine *</label>
                <select name="cuisine" class="form-control">
                    @foreach(['Malaysian', 'Western', 'Japanese', 'Korean', 'Indonesian'] as $option)
                        <option value="{{ $option }}" {{ $recipe->cuisine == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Meal Type *</label>
                <select name="meal_type" class="form-control">
                    @foreach(['Breakfast', 'Lunch', 'Dinner', 'Dessert', 'Snack'] as $option)
                        <option value="{{ $option }}" {{ $recipe->meal_type == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label class="form-label">Spice Level *</label>
                <select name="spice_level" class="form-control">
                    @foreach(['None', 'Mild', 'Medium', 'Spicy', 'Very Spicy'] as $option)
                        <option value="{{ $option }}" {{ $recipe->spice_level == $option ? 'selected' : '' }}>{{ $option }}</option>
                    @endforeach
                </select>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(4, 1fr); gap: 1rem; margin-bottom: 1.5rem;">
            <div class="form-group">
                <label class="form-label">Prep (min)</label>
                <input type="number" name="prep_time" value="{{ old('prep_time', $recipe->prep_time) }}" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Cook (min)</label>
                <input type="number" name="cook_time" value="{{ old('cook_time', $recipe->cook_time) }}" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Servings *</label>
                <input type="number" name="servings" value="{{ old('servings', $recipe->servings) }}" class="form-control">
            </div>
            <div class="form-group">
                <label class="form-label">Calories</label>
                <input type="number" name="calories" value="{{ old('calories', $recipe->calories) }}" class="form-control">
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Dietary Information</label>
            <div style="display: flex; gap: 1.5rem; flex-wrap: wrap;">
                <label class="custom-check">
                    <input type="checkbox" name="is_vegetarian" {{ $recipe->is_vegetarian ? 'checked' : '' }}> Vegetarian
                </label>
                <label class="custom-check">
                    <input type="checkbox" name="is_vegan" {{ $recipe->is_vegan ? 'checked' : '' }}> Vegan
                </label>
                <label class="custom-check">
                    <input type="checkbox" name="is_halal" {{ $recipe->is_halal ? 'checked' : '' }}> Halal
                </label>
                <label class="custom-check">
                    <input type="checkbox" name="is_gluten_free" {{ $recipe->is_gluten_free ? 'checked' : '' }}> Gluten Free
                </label>
            </div>
        </div>

        <div class="form-group">
            <label class="form-label">Ingredients</label>
            <div id="ingredients-container" style="display: flex; flex-direction: column; gap: 10px;"></div>
            <button type="button" onclick="addIngredient()" class="btn-secondary btn-sm" style="margin-top: 10px;">
                + Add Ingredient
            </button>
            <textarea name="ingredients" id="ingredients-final" class="hidden" style="display:none;"></textarea>
            <div id="old-ingredients" data-val="{{ $recipe->ingredients }}" style="display:none;"></div>
        </div>

        <div class="form-group">
            <label class="form-label">Instructions</label>
            <div id="instructions-container" style="display: flex; flex-direction: column; gap: 15px;"></div>
            <button type="button" onclick="addInstruction()" class="btn-secondary btn-sm" style="margin-top: 10px;">
                + Add Instruction
            </button>
            <textarea name="instructions" id="instructions-final" class="hidden" style="display:none;"></textarea>
            <div id="old-instructions" data-val="{{ $recipe->instructions }}" style="display:none;"></div>
        </div>

        <div style="display: flex; justify-content: flex-end; gap: 1rem; margin-top: 2rem; padding-top: 1rem; border-top: 1px solid var(--gray-200);">
            <a href="{{ route('admin.recipes') }}" class="btn-secondary">Cancel</a>
            <button type="submit" onclick="prepareSubmission()" class="btn-primary">Save Changes</button>
        </div>
    </div>
    </form>
</div>

<script>
    function parseList(str) {
        if (!str) return [];
        return str.split('\n').filter(item => item.trim() !== '');
    }

    // --- Ingredients Logic ---
    const ingContainer = document.getElementById('ingredients-container');
    const oldIngData = document.getElementById('old-ingredients').dataset.val;
    let ingredients = parseList(oldIngData);

    if (ingredients.length === 0) ingredients.push(''); 

    function renderIngredients() {
        ingContainer.innerHTML = '';
        ingredients.forEach((ing, index) => {
            const row = document.createElement('div');
            row.style.display = 'flex';
            row.style.gap = '10px';
            row.innerHTML = `
                <input type="text" value="${ing}" oninput="updateIngredient(${index}, this.value)" class="form-control" placeholder="e.g. 200g Chicken Breast">
                <button type="button" onclick="removeIngredient(${index})" class="btn-danger btn-sm" style="padding: 0 10px;">X</button>
            `;
            ingContainer.appendChild(row);
        });
    }

    function addIngredient() { ingredients.push(''); renderIngredients(); }
    function updateIngredient(index, val) { ingredients[index] = val; }
    function removeIngredient(index) { ingredients.splice(index, 1); renderIngredients(); }

    // --- Instructions Logic ---
    const insContainer = document.getElementById('instructions-container');
    const oldInsData = document.getElementById('old-instructions').dataset.val;
    let instructions = parseList(oldInsData);

    if (instructions.length === 0) instructions.push('');

    function renderInstructions() {
        insContainer.innerHTML = '';
        instructions.forEach((ins, index) => {
            const row = document.createElement('div');
            row.style.display = 'flex';
            row.style.gap = '10px';
            row.style.alignItems = 'flex-start';
            row.innerHTML = `
                <div style="background: var(--gray-900); color: white; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; border-radius: 50%; font-size: 0.8rem; flex-shrink: 0; margin-top: 8px;">${index + 1}</div>
                <textarea rows="2" oninput="updateInstruction(${index}, this.value)" class="form-control" placeholder="Step description...">${ins}</textarea>
                <button type="button" onclick="removeInstruction(${index})" class="btn-danger btn-sm" style="margin-top: 5px;">X</button>
            `;
            insContainer.appendChild(row);
        });
    }

    function addInstruction() { instructions.push(''); renderInstructions(); }
    function updateInstruction(index, val) { instructions[index] = val; }
    function removeInstruction(index) { instructions.splice(index, 1); renderInstructions(); }

    function prepareSubmission() {
        document.getElementById('ingredients-final').value = ingredients.join('\n');
        document.getElementById('instructions-final').value = instructions.join('\n');
    }

    renderIngredients();
    renderInstructions();
</script>
@endsection