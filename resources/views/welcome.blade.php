@extends('layouts.app')

@section('content')

<section class="relative px-6 lg:pt-16 pb-24 text-center">
    <div class="container mx-auto max-w-4xl">
        <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-brand-100 text-brand-800 text-sm font-semibold mb-8 animate-bounce">
            <i class="fas fa-robot"></i>
            <span>Powered by AI Ingredient Analysis</span>
        </div>

        <h1 class="font-serif text-5xl md:text-7xl font-bold text-brand-900 mb-6 leading-tight">
            What's cooking in <br>
            <span class="text-transparent bg-clip-text bg-gradient-to-r from-brand-500 to-brand-600">
                your kitchen?
            </span>
        </h1>
        
        <p class="text-xl text-brand-900/60 mb-10 max-w-2xl mx-auto">
            Don't know what to cook? Scan your ingredients or search our community library to find the perfect meal in seconds.
        </p>

        <div class="bg-white p-2 rounded-full shadow-soft max-w-2xl mx-auto flex items-center border border-brand-100 hover:border-brand-300 transition-colors">
            <div class="pl-6 text-brand-300">
                <i class="fas fa-search text-xl"></i>
            </div>
            <input type="text" 
                   placeholder="Search for 'Nasi Lemak' or 'Chicken'..." 
                   class="w-full px-4 py-3 text-lg outline-none text-brand-900 placeholder-brand-900/30 bg-transparent">
            <button class="bg-brand-500 hover:bg-brand-600 text-white px-8 py-3 rounded-full font-semibold transition shadow-md">
                Search
            </button>
        </div>

        <div class="mt-8">
            <p class="text-sm text-brand-900/40 mb-3 font-medium">OR TRY THIS</p>
            <a href="{{ route('ai.index') }}" class="inline-flex items-center gap-2 text-brand-600 font-semibold hover:underline">
                <span>Use AI Ingredient Matcher</span>
                <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</section>

<section class="container mx-auto px-6 mb-20">
    <div class="flex justify-between items-end mb-8">
        <h3 class="font-serif text-3xl font-bold text-brand-900">Explore Cuisines</h3>
    </div>
    
    <div class="flex gap-6 overflow-x-auto pb-6 scrollbar-hide snap-x">
        @foreach(['Malaysian' => '🌶️', 'Indonesian' => '🥥', 'Korean' => '🥢', 'Japanese' => '🍣', 'Western' => '🍔'] as $cuisine => $emoji)
        <a href="#" class="snap-start flex-shrink-0 w-40 h-40 bg-white rounded-2xl shadow-sm border border-brand-100 flex flex-col items-center justify-center gap-3 hover-lift group hover:border-brand-500 transition-colors">
            <span class="text-4xl group-hover:scale-110 transition-transform duration-300">{{ $emoji }}</span>
            <span class="font-semibold text-brand-900 group-hover:text-brand-600">{{ $cuisine }}</span>
        </a>
        @endforeach
    </div>
</section>

<section class="container mx-auto px-6 mb-24">
    <div class="flex justify-between items-center mb-10">
        <div>
            <h2 class="font-serif text-3xl md:text-4xl font-bold text-brand-900 mb-2">Fresh from the Community</h2>
            <p class="text-brand-900/60">Discover the latest creations by our home chefs.</p>
        </div>
        <a href="#recipes" class="hidden md:inline-flex items-center gap-2 px-6 py-2 border-2 border-brand-900 rounded-full font-semibold hover:bg-brand-900 hover:text-white transition">
            View All <i class="fas fa-arrow-right"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach($recipes as $recipe)
        <div class="bg-white rounded-3xl shadow-soft border border-brand-100 overflow-hidden hover-lift flex flex-col h-full group">
            <div class="relative h-56 overflow-hidden">
                <img src="{{ $recipe->image_url ?? 'https://placehold.co/600x400' }}" 
                     alt="{{ $recipe->title }}" 
                     class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                
                <span class="absolute top-4 left-4 bg-white/90 backdrop-blur text-brand-800 text-xs font-bold px-3 py-1 rounded-full shadow-sm">
                    {{ $recipe->cuisine }}
                </span>
                
                <button class="absolute top-4 right-4 bg-white/90 backdrop-blur w-8 h-8 rounded-full flex items-center justify-center text-brand-300 hover:text-brand-500 hover:shadow-md transition">
                    <i class="far fa-bookmark"></i>
                </button>
            </div>

            <div class="p-6 flex flex-col flex-grow">
                <div class="flex items-center gap-4 text-xs font-semibold text-brand-900/40 mb-3">
                    <span class="flex items-center gap-1"><i class="fas fa-clock"></i> {{ $recipe->difficulty }}</span>
                    <span class="flex items-center gap-1"><i class="fas fa-user"></i> {{ $recipe->portion_size }} pax</span>
                </div>

                <h3 class="font-serif text-xl font-bold text-brand-900 mb-2 line-clamp-1">
                    {{ $recipe->title }}
                </h3>
                
                <p class="text-brand-900/60 text-sm leading-relaxed mb-6 line-clamp-2 flex-grow">
                    {{ $recipe->description }}
                </p>

                <div class="pt-4 border-t border-brand-50">
                    <button class="w-full py-3 rounded-xl bg-brand-50 text-brand-700 font-semibold hover:bg-brand-500 hover:text-white transition-colors">
                        View Recipe
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>
</section>

@endsection