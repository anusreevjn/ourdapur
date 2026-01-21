<x-layout>
    <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6 text-gray-800">My Bookmarked Recipes</h2>

        @if($recipes->isEmpty())
            <div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4" role="alert">
                <p>You haven't bookmarked any recipes yet.</p>
                <p class="mt-2"><a href="{{ route('recipes.index') }}" class="font-bold underline">Browse Recipes</a> to find some you like!</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($recipes as $recipe)
                    <div class="bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                        @if($recipe->image)
                             <img src="{{ asset('storage/' . $recipe->image) }}" alt="{{ $recipe->title }}" class="w-full h-48 object-cover">
                        @else
                             <div class="w-full h-48 bg-gray-200 flex items-center justify-center text-gray-400">
                                 <i class="fas fa-utensils fa-2x"></i>
                             </div>
                        @endif

                        <div class="p-4">
                            <h3 class="font-bold text-xl mb-2">{{ $recipe->title }}</h3>
                            <p class="text-gray-600 text-sm mb-4">{{ Str::limit($recipe->description, 100) }}</p>
                            
                            <div class="flex justify-between items-center mt-4">
                                <a href="{{ route('recipes.show', $recipe->id) }}" class="bg-orange-500 text-white px-4 py-2 rounded hover:bg-orange-600 transition">
                                    View
                                </a>
                                
                                <form action="{{ route('bookmarks.toggle', $recipe->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="text-red-500 hover:text-red-700 font-semibold text-sm">
                                        <i class="fas fa-trash-alt"></i> Remove
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