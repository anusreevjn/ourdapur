@extends('layouts.admin')

@section('content')
<div class="card" style="max-width: 800px;">
    <h3 style="margin-bottom: 10px;">Recipe Scraper Automation</h3>
    <p style="color: #78716c; margin-bottom: 25px;">Paste a URL from a recipe blog to automatically import ingredients.</p>

    <form action="{{ url('/test-scrape') }}" method="GET"> <div style="display: flex; gap: 10px;">
            <input type="url" name="url" placeholder="https://example.com/recipe/nasi-lemak" 
                   style="flex: 1; padding: 12px; border: 2px solid #fed7aa; border-radius: 8px; outline: none;">
            
            <button type="submit" 
                    style="background: #F97316; color: white; border: none; padding: 0 25px; border-radius: 8px; font-weight: 600; cursor: pointer;">
                Start Scraping
            </button>
        </div>
    </form>
    
    <div style="margin-top: 30px; background: #fff7ed; padding: 20px; border-radius: 8px;">
        <h4 style="color: #C2410C;">Console Output:</h4>
        <pre style="margin-top: 10px; font-size: 0.9rem; color: #444;">Waiting for input...</pre>
    </div>
</div>
@endsection