<x-layout>
    <div class="container" style="padding: 2rem 0;">
        <h2 style="font-size: 2rem; font-weight: 700; mb-8; color: var(--gray-900); margin-bottom: 2rem;">
            My Bookmarked Recipes
        </h2>

        @if($recipes->isEmpty())
            <div class="alert alert-error" role="alert">
                <p>You haven't bookmarked any recipes yet.</p>
                <p style="margin-top: 0.5rem;">
                    <a href="{{ route('recipes.index') }}" style="text-decoration: underline; font-weight: 600; color: inherit;">Browse Recipes</a> to find some you like!
                </p>
            </div>
        @else
            <div class="recipe-grid">
                @foreach($recipes as $recipe)
                    <div class="recipe-card">
                        <div class="recipe-img-container">
                            @if($recipe->image)
                                 <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="recipe-img">
                            @else
                                 <div style="width: 100%; height: 100%; background: var(--gray-200); display: flex; align-items: center; justify-content: center;">
                                     <span style="font-size: 2rem;">🍽️</span>
                                 </div>
                            @endif
                        </div>

                        <div class="recipe-content">
                            <h3 class="recipe-title">{{ $recipe->title }}</h3>
                            <p class="recipe-desc">{{ Str::limit($recipe->description, 100) }}</p>
                            
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-top: auto;">
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-primary btn-sm">
                                    View
                                </a>
                                
                                <form action="{{ route('bookmarks.toggle', $recipe->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        Remove
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
</x-layout>