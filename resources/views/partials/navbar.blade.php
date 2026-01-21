<nav class="navbar">
    <div class="container navbar-content">
        <a href="{{ url('/') }}" class="logo">
            <img src="{{ asset('images/ourdapur.png') }}" alt="OurDapur Logo" style="height: 50px; width: auto;">
            <i></i>Our<span>Dapur</span>
        </a>

        <ul class="nav-links desktop-only">
            <li><a href="{{ route('home') }}" class="nav-link {{ request()->routeIs('home') ? 'active' : '' }}">Dashboard</a></li>
            <li><a href="{{ route('recipes.index') }}" class="nav-link {{ request()->routeIs('recipes.index') ? 'active' : '' }}">Recipes</a></li>
            <li><a href="{{ route('ai.index') }}" class="nav-link {{ request()->routeIs('ai.index') ? 'active' : '' }}">AI Chef</a></li>
            
            @auth
                @if(auth()->user()->is_admin)
                    <li><a href="{{ route('admin.dashboard') }}" class="nav-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}" style="color: red;">Admin Panel</a></li>
                @endif
                <li><a href="{{ route('bookmarks.index') }}" class="nav-link">My Bookmarks</a></li>
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

    <div class="mobile-menu" id="mobileMenu">
        <a href="{{ route('home') }}" class="mobile-link">Home</a>
        <a href="/#recipes" class="mobile-link">Recipes</a>
        <a href="{{ route('ai.index') }}" class="mobile-link">AI Chef</a>
        
        @auth
            @if(auth()->user()->is_admin)
                <a href="{{ route('admin.dashboard') }}" class="mobile-link" style="color: red;">Admin Panel</a>
            @endif
            <div class="mobile-auth">
                <a href="#" class="mobile-link">My Profile</a>
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit" class="btn-primary" style="width: 100%; margin-top: 10px;">Logout</button>
                </form>
            </div>
        @else
            <div class="mobile-auth">
                <a href="{{ route('login') }}" class="btn-secondary" style="display:block; text-align:center; margin-bottom: 10px;">Login</a>
                <a href="{{ route('register') }}" class="btn-primary" style="display:block; text-align:center;">Sign Up</a>
            </div>
        @endauth
    </div>
</nav>

<script>
    function toggleMobileMenu() {
        const menu = document.getElementById('mobileMenu');
        menu.classList.toggle('show');
    }
</script>