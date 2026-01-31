@extends('layouts.app')

@section('content')
<div class="container">
    <div class="section-header">
        <div>
            <h1 style="font-size: 2rem; font-weight: 700; color: var(--gray-900);">Admin Dashboard</h1>
            <p style="color: var(--gray-600);">Welcome to OurDapur Admin Panel</p>
        </div>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: 1.5rem; margin-bottom: 2rem;">
        
        <div class="stat-card">
            <div>
                <p>Total Recipes</p>
                <h3>{{ $stats['total_recipes'] }}</h3>
            </div>
            <div class="stat-icon orange">
                <i class="fas fa-utensils"></i>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <p>Total Reviews</p>
                <h3>{{ $stats['total_reviews'] }}</h3>
            </div>
            <div class="stat-icon blue">
                <i class="fas fa-star"></i>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <p>Average Rating</p>
                <h3>{{ $stats['avg_rating'] }}</h3>
            </div>
            <div class="stat-icon green">
                <i class="fas fa-chart-line"></i>
            </div>
        </div>

        <div class="stat-card">
            <div>
                <p>Cuisines</p>
                <h3>{{ $stats['total_cuisines'] }}</h3>
            </div>
            <div class="stat-icon orange">
                <i class="fas fa-globe-asia"></i>
            </div>
        </div>
    </div>
        <div class="card" style="margin-bottom: 2rem;">
        <h3 style="margin-bottom: 1rem; font-size: 1.25rem; font-weight: 700; color: #dc2626;">
            🛑 Pending Approvals
        </h3>
        
        @php
            // Fetch pending recipes directly in view for simplicity, or pass from controller
            $pendingRecipes = \App\Models\Recipe::where('is_approved', false)->latest()->get();
        @endphp

        @if($pendingRecipes->isEmpty())
            <div class="alert alert-success" style="background: #f0fdf4; color: #166534; padding: 1rem; border-radius: 0.5rem;">
                No pending recipes. All caught up!
            </div>
        @else
            <div class="table-container">
                <table class="data-table" style="width: 100%; border-collapse: collapse;">
                    <thead>
                        <tr style="background: #f9fafb; text-align: left;">
                            <th style="padding: 1rem;">Recipe</th>
                            <th style="padding: 1rem;">User</th>
                            <th style="padding: 1rem;">Date</th>
                            <th style="padding: 1rem;">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pendingRecipes as $recipe)
                            <tr style="border-bottom: 1px solid #e5e7eb;">
                                <td style="padding: 1rem; font-weight: 600;">{{ $recipe->title }}</td>
                                <td style="padding: 1rem;">{{ $recipe->user->name ?? 'Unknown' }}</td>
                                <td style="padding: 1rem;">{{ $recipe->created_at->format('d M Y') }}</td>
                                <td style="padding: 1rem;">
                                    <div style="display: flex; gap: 0.5rem;">
                                        <a href="{{ route('recipes.show', $recipe->id) }}" class="btn btn-secondary btn-sm">
                                            View
                                        </a>

                                        <form action="{{ route('admin.recipes.approve', $recipe->id) }}" method="POST">
                                            @csrf 
                                            @method('PATCH') <button type="submit" class="btn btn-primary btn-sm" style="background: #16a34a; border-color: #16a34a;">
                                                Approve
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
    <div class="card" style="max-width: 500px;">
        <h3 style="margin-bottom: 1.5rem; font-size: 1.25rem; font-weight: 700;">Recipes by Cuisine</h3>
        <div style="display: flex; flex-direction: column; gap: 1rem;">
            @foreach($cuisineStats as $stat)
            <div style="display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--gray-100); padding-bottom: 0.5rem;">
                <span style="font-weight: 500; color: var(--gray-600);">{{ $stat->cuisine }}</span>
                <span class="badge badge-gray">{{ $stat->total }}</span>
            </div>
            @endforeach
            
            @if($cuisineStats->isEmpty())
                <p style="color: var(--gray-400);">No data available.</p>
            @endif
        </div>
    </div>
</div>
@endsection