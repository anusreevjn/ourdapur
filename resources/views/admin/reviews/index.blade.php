@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--gray-900);">Reviews</h1>
            <p style="color: var(--gray-600);">Moderate user reviews</p>
        </div>
    </div>

    <div class="card" style="padding: 0; overflow: hidden;">
        @if($reviews->isEmpty())
            <div style="padding: 3rem; text-align: center;">
                <h3 style="font-size: 1.125rem; font-weight: 500; color: var(--gray-900);">No reviews found</h3>
                <p style="color: var(--gray-500);">Wait for users to leave reviews on recipes.</p>
            </div>
        @else
            <div class="table-container">
                <table class="data-table">
                    <thead>
                        <tr>
                            <th>User</th>
                            <th>Recipe</th>
                            <th>Rating</th>
                            <th>Comment</th>
                            <th>Date</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($reviews as $review)
                        <tr>
                            <td style="font-weight: 600; color: var(--gray-900);">{{ $review->user->name }}</td>
                            <td>
                                <a href="{{ route('recipes.show', $review->recipe->id) }}" style="color: #2563eb; text-decoration: none; font-weight: 500;">
                                    {{ $review->recipe->title }}
                                </a>
                            </td>
                            <td style="color: var(--primary-color); font-weight: 700;">
                                ★ {{ $review->rating }}
                            </td>
                            <td style="color: var(--gray-600); max-width: 300px; overflow: hidden; text-overflow: ellipsis; white-space: nowrap;">
                                {{ $review->comment }}
                            </td>
                            <td style="color: var(--gray-500); font-size: 0.9rem;">
                                {{ $review->created_at->format('M d, Y') }}
                            </td>
                            <td>
                                <form action="{{ route('admin.reviews.delete', $review->id) }}" method="POST" style="display:inline;">
                                    @csrf @method('DELETE')
                                    <button type="submit" 
                                            class="btn-sm btn-danger" 
                                            style="border: none; cursor: pointer;"
                                            onclick="return confirm('Delete this review?')">
                                        Delete
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div style="margin-top: 1.5rem;">
        {{ $reviews->links() }}
    </div>
</div>
@endsection