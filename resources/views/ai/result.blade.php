<x-layout>
    <h1 class="text-3xl font-bold mb-6">AI Suggestions for: "{{ $search }}"</h1>

    @if(empty($recipes))
        <div class="bg-red-100 text-red-700 p-4 rounded">
            Sorry, the AI got confused. Please try again with different ingredients!
        </div>
    @else
        <div class="grid gap-6 md:grid-cols-2">
            @foreach($recipes as $recipe)
                @php
                    $title = $recipe['title'] ?? 'Unknown Recipe';
                    $ingredients = $recipe['ingredients'] ?? [];
                    $instructions = $recipe['instructions'] ?? '';
                @endphp

                <div class="bg-white p-6 rounded-lg shadow border border-gray-200">
                    <h2 class="text-xl font-bold text-purple-700 mb-2">{{ $title }}</h2>

                    <h3 class="font-bold mt-4">Ingredients:</h3>
                    <ul class="list-disc pl-5 text-sm text-gray-600 mb-4">
                        @if(is_array($ingredients))
                            @forelse($ingredients as $ing)
                                <li>{{ $ing }}</li>
                            @empty
                                <li>No ingredients provided.</li>
                            @endforelse
                        @else
                            <li>{{ $ingredients }}</li>
                        @endif
                    </ul>

                    <h3 class="font-bold">Instructions:</h3>
                    <p class="text-gray-700 text-sm whitespace-pre-line">{{ $instructions }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <a href="{{ route('ai.index') }}" class="block mt-8 text-center text-blue-600 underline">← Try Again</a>
</x-layout>


