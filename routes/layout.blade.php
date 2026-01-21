<nav class="bg-gray-800 p-4 text-white flex justify-between">
    <div class="flex space-x-4">
        <a href="/" class="font-bold text-xl">OurDapur</a>
        <a href="/recipes" class="hover:text-gray-300">Recipes</a>
        <a href="/ai-chef" class="hover:text-gray-300">AI Chef</a>
    </div>

    <div class="flex space-x-4">
        @auth
            <span>Hi, {{ Auth::user()->name }}</span>
            @if(Auth::user()->is_admin)
                <a href="/admin/dashboard" class="text-yellow-400">Admin Panel</a>
            @endif
            
            <form action="/logout" method="POST" class="inline">
                @csrf
                <button type="submit" class="text-red-400 hover:text-red-300">Logout</button>
            </form>
        @else
            <a href="/login" class="hover:text-gray-300">Login</a>
            <a href="/register" class="bg-blue-600 px-3 py-1 rounded hover:bg-blue-700">Register</a>
        @endauth
    </div>
</nav>