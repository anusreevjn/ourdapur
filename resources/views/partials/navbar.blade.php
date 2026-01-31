<nav class="navbar">
    <div class="container navbar-content">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/ourdapur.png') }}" alt="OurDapur" style="height: 45px; width: auto; margin-right: 10px;">
            <span>OurDapur</span>
        </a>

        <ul class="nav-links desktop-only">
            @auth
                @if(auth()->user()->is_admin)
                    <li>
                        <a href="{{ route('admin.dashboard') }}" 
                           class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">
                           Dashboard
                        </a>
                    </li>
                    
                    <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle">Recipes</a>
                        <ul class="dropdown-menu">
                             <li>
                        <a href="{{ route('admin.recipes') }}" class="nav-link {{ Request::routeIs('admin.recipes*') ? 'active' : '' }}">
                           All Recipes
                        </a>
                    </li>
                            <li><a href="{{ route('recipes.create') }}" class="nav-link {{ Request::routeIs('recipes.create') ? 'active' : '' }}">Add New Recipe</a></li>
                            <li><a href="{{ route('admin.dashboard') }}#pending-approvals" class="nav-link {{ Request::routeIs('admin.dashboard') ? 'active' : '' }}">Approve Recipes</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="{{ route('admin.reviews') }}" 
                           class="nav-link {{ Request::routeIs('admin.reviews') ? 'active' : '' }}">
                           Reviews
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users') }}" 
                           class="nav-link {{ Request::routeIs('admin.users') ? 'active' : '' }}">
                           Users
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admin.scraper') }}" 
                           class="nav-link {{ Request::routeIs('admin.scraper') ? 'active' : '' }}">
                           Scraper
                        </a>
                    </li>
                @else
                    <li><a href="{{ route('welcome') }}" class="nav-link {{ Request::routeIs('welcome') ? 'active' : '' }}">Home</a></li>
                    <li class="dropdown">
                        <a href="#" class="nav-link dropdown-toggle">Recipes</a>
                        <ul class="dropdown-menu">
                            <li><a href="{{ route('recipes.index') }}" class="nav-link {{ Request::routeIs('recipes.index') ? 'active' : '' }}">Browse Recipes</a></li>
                            <li><a href="{{ route('recipes.my') }}" class="nav-link {{ Request::routeIs('recipes.my') ? 'active' : '' }}">My Recipes</a></li>
                            <li><a href="{{ route('recipes.create') }}" class="nav-link {{ Request::routeIs('recipes.create') ? 'active' : '' }}">Create Recipe</a></li>
                        </ul>
                    </li>
                    <li><a href="{{ route('ai.index') }}" class="nav-link {{ Request::routeIs('ai.index') ? 'active' : '' }}">AI Chef</a></li>
                    <li><a href="{{ route('bookmarks.index') }}" class="nav-link {{ Request::routeIs('bookmarks.index') ? 'active' : '' }}">Bookmarks</a></li>
                @endif
            @else
                <li><a href="{{ route('welcome') }}" class="nav-link {{ Request::routeIs('welcome') ? 'active' : '' }}">Home</a></li>
                <li><a href="{{ route('recipes.index') }}" class="nav-link {{ Request::routeIs('recipes.index') ? 'active' : '' }}">Recipes</a></li>
                <li><a href="{{ route('ai.index') }}" class="nav-link {{ Request::routeIs('ai.index') ? 'active' : '' }}">AI Chef</a></li>
            @endauth
        </ul>

        <div class="auth-buttons desktop-only">
            @auth
                <a href="{{ route('profile.edit') }}" class="btn-secondary">My Profile</a>
                <form method="POST" action="{{ route('logout') }}" style="display:inline;">
                    @csrf
                    <button type="submit" class="btn-primary">Logout</button>
                </form>
            @else
                <a href="{{ route('login') }}" class="btn-secondary">Login</a>
                <a href="{{ route('register') }}" class="btn-primary">Sign Up</a>
            @endauth
        </div>

        <button class="mobile-menu-btn" onclick="toggleMobileMenu()">
            <i class="fas fa-bars"></i>
        </button>
    </div>

    <div id="mobileMenu" class="mobile-menu">
        @auth
            <div style="padding-bottom: 0.5rem; border-bottom: 1px solid #f3f4f6; font-weight: 600; color: var(--primary-color);">
                Hi, {{ Auth::user()->name }}
            </div>

            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="mobile-link">Dashboard</a>
                <a href="{{ route('admin.recipes') }}" class="mobile-link">Manage Recipes</a>
                <a href="{{ route('recipes.create') }}" class="mobile-link" style="padding-left: 2rem;">+ Add Recipe</a>
                <a href="{{ route('admin.dashboard') }}" class="mobile-link" style="padding-left: 2rem;">Approve Recipes</a>
                <a href="{{ route('admin.reviews') }}" class="mobile-link">Reviews</a>
                <a href="{{ route('admin.users') }}" class="mobile-link">Users</a>
                <a href="{{ route('admin.scraper') }}" class="mobile-link">Web Scraper</a>
            @else
                <a href="{{ route('welcome') }}" class="mobile-link">Home</a>
                <a href="{{ route('recipes.index') }}" class="mobile-link">Browse Recipes</a>
                <a href="{{ route('recipes.create') }}" class="mobile-link" style="color: var(--primary-color); font-weight: 700;">+ Submit Recipe</a>
                <a href="{{ route('ai.index') }}" class="mobile-link">AI Chef</a>
                <a href="{{ route('bookmarks.index') }}" class="mobile-link">Bookmarks</a>
            @endif

            <form method="POST" action="{{ route('logout') }}" style="margin-top: 0.5rem;">
                @csrf
                <button type="submit" class="btn-primary" style="width: 100%;">Logout</button>
            </form>
        @else
            <a href="{{ route('welcome') }}" class="mobile-link">Home</a>
            <a href="{{ route('recipes.index') }}" class="mobile-link">Browse Recipes</a>
            <div style="display: flex; gap: 1rem; margin-top: 1rem;">
                <a href="{{ route('login') }}" class="btn-secondary" style="flex: 1; text-align: center;">Login</a>
                <a href="{{ route('register') }}" class="btn-primary" style="flex: 1; text-align: center;">Sign Up</a>
            </div>
        @endauth
    </div>
</nav>
<script>

    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        
        // Check if the menu is currently hidden or has no display style set
        if (menu.style.display === 'none' || menu.style.display === '') {
            menu.style.display = 'flex'; // Show it
        } else {
            menu.style.display = 'none'; // Hide it
        }
    }

    function closeMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        if (menu) {
            menu.style.display = 'none';
        }
    }

    // Hide mobile menu automatically when resizing to desktop/tablet widths
    window.addEventListener('resize', function() {
        if (window.innerWidth >= 768) {
            closeMobileMenu();
        }
    });

    // Ensure mobile menu is hidden on initial load for larger viewports
    document.addEventListener('DOMContentLoaded', function() {
        if (window.innerWidth >= 768) {
            closeMobileMenu();
        }
    });

</script>