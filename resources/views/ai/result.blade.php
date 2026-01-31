<x-layout>
    <div class="container">
        <h1 style="font-size: 2rem; font-weight: 700; margin-bottom: 1.5rem; color: var(--gray-900);">
            AI Suggestions for: <span style="color: var(--primary-color);">"{{ $search }}"</span>
        </h1>

        @if(empty($recipes))
            <div class="alert alert-error" role="alert">
                <strong>Oops!</strong> The AI got confused. Please try again with different ingredients!
            </div>
        @else
            <div class="recipe-grid">
                @foreach($recipes as $recipe)
                    @php
                        $title = $recipe['title'] ?? 'Unknown Recipe';
                        $ingredients = $recipe['ingredients'] ?? [];
                        $instructions = $recipe['instructions'] ?? '';
                    @endphp

                    <div class="card" style="display: flex; flex-direction: column; height: 100%;">
                        <h2 style="font-size: 1.5rem; font-weight: 700; color: var(--primary-color); margin-bottom: 1rem;">
                            {{ $title }}
                        </h2>

                        <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Ingredients:</h3>
                        <ul style="list-style-type: disc; padding-left: 1.5rem; margin-bottom: 1.5rem; color: var(--gray-600);">
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

                        <h3 style="font-weight: 600; margin-bottom: 0.5rem;">Instructions:</h3>
                        <p style="color: var(--gray-800); white-space: pre-line; line-height: 1.6;">{{ $instructions }}</p>
                    </div>
                @endforeach
            </div>
        @endif

        <div style="margin-top: 3rem; text-align: center;">
            <a href="{{ route('ai.index') }}" class="btn btn-secondary">
                ← Try Again
            </a>
        </div>
    </div>
</x-layout>


