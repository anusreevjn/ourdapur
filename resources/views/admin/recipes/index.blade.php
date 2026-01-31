@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--gray-900);">Recipes</h1>
            <p style="color: var(--gray-600);">Manage all recipes</p>
        </div>
        <a href="{{ route('recipes.create') }}" class="btn-primary">
            + Add Recipe
        </a>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        <div class="table-container">
            <table class="data-table">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Cuisine</th>
                        <th>Meal Type</th>
                        <th>Spice Level</th>
                        <th>Dietary</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recipes as $recipe)
                    <tr>
                        <td style="font-weight: 600; color: var(--gray-900);">{{ $recipe->title }}</td>
                        <td>{{ $recipe->cuisine }}</td>
                        <td>{{ $recipe->meal_type }}</td>
                        <td>{{ $recipe->spice_level }}</td>
                        <td>
                            <div style="display: flex; gap: 5px;">
                                @if($recipe->is_halal) 
                                    <span class="badge badge-orange">Halal</span> 
                                @endif
                                @if($recipe->is_vegetarian) 
                                    <span class="badge badge-gray">Veg</span> 
                                @endif
                            </div>
                        </td>
                        <td>
                            <div style="display: flex; gap: 8px; align-items: center;">
                                {{-- Edit Button: Uses btn-secondary to match "Cancel" buttons --}}
                                <a href="{{ route('recipes.edit', $recipe->id) }}" 
                                class="btn btn-secondary btn-sm">
                                Edit
                                </a>
                                
                                {{-- Delete Button: Uses btn + btn-danger for correct shape and red color --}}
                                <form action="{{ route('recipes.destroy', $recipe->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="btn btn-danger btn-sm" 
                                            onclick="return confirm('Delete recipe?')">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 3rem; color: var(--gray-400);">
                            No recipes found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <div style="margin-top: 1.5rem;">
        {{ $recipes->links() }}
    </div>
</div>
@endsection