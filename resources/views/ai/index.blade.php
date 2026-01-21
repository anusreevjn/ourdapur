<x-layout>
    <div class="max-w-2xl mx-auto text-center">
        <h1 class="text-4xl font-bold mb-4">👨‍🍳 AI Chef</h1>
        <p class="mb-8 text-gray-600">Tell us what's in your fridge, and our AI will invent a recipe for you.</p>

        <form action="{{ route('ai.suggest') }}" method="POST" class="bg-white p-6 rounded-lg shadow-md">
            @csrf
            <label class="block text-left font-bold mb-2">Your Ingredients:</label>
            <textarea name="ingredients" rows="3" class="w-full border p-2 rounded mb-4" placeholder="e.g. Chicken, Rice, Soy Sauce, expired milk..."></textarea>
            
            <button type="submit" class="bg-purple-600 text-white px-6 py-2 rounded hover:bg-purple-700 w-full">
                ✨ Ask AI to Cook
            </button>
        </form>
    </div>
</x-layout>