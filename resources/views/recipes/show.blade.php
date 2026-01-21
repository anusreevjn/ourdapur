<div class="mt-12 bg-white p-6 rounded shadow">
    <h3 class="text-2xl font-bold mb-4">Reviews ({{ $recipe->reviews->count() }})</h3>
    
    <div class="mb-6">
        <span class="text-yellow-500 text-xl">
            @for($i=1; $i<=5; $i++)
                <i class="fas fa-star {{ $i <= $recipe->average_rating ? '' : 'text-gray-300' }}"></i>
            @endfor
        </span>
        <span class="text-gray-600 ml-2">({{ number_format($recipe->average_rating, 1) }} / 5.0)</span>
    </div>

    @auth
        <form action="{{ route('reviews.store', $recipe->id) }}" method="POST" class="mb-8 border-b pb-8">
            @csrf
            <div class="mb-4">
                <label class="block font-bold mb-2">Rate this recipe:</label>
                <select name="rating" class="border p-2 rounded w-32">
                    <option value="5">5 Stars</option>
                    <option value="4">4 Stars</option>
                    <option value="3">3 Stars</option>
                    <option value="2">2 Stars</option>
                    <option value="1">1 Star</option>
                </select>
            </div>
            <div class="mb-4">
                <textarea name="comment" rows="3" class="w-full border p-2 rounded" placeholder="Share your thoughts..."></textarea>
            </div>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Submit Review</button>
        </form>
    @else
        <p class="mb-8 text-gray-500">Please <a href="{{ route('login') }}" class="text-blue-500 underline">login</a> to leave a review.</p>
    @endauth

    @foreach($recipe->reviews as $review)
        <div class="mb-4">
            <div class="flex items-center justify-between">
                <h5 class="font-bold">{{ $review->user->name }}</h5>
                <span class="text-xs text-gray-500">{{ $review->created_at->diffForHumans() }}</span>
            </div>
            <div class="text-yellow-500 text-sm mb-1">
                @for($i=1; $i<=5; $i++)
                    <i class="fas fa-star {{ $i <= $review->rating ? '' : 'text-gray-300' }}"></i>
                @endfor
            </div>
            <p class="text-gray-700">{{ $review->comment }}</p>
        </div>
    @endforeach
</div>