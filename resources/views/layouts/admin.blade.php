<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - OurDapur</title>
    
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
    
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 font-sans antialiased">

    @include('partials.navbar')

    <div class="flex min-h-[calc(100vh-64px)]">
        
        <aside class="w-64 bg-white border-r border-gray-200 hidden md:block">
            <div class="p-6">
                <h2 class="text-xs font-semibold text-gray-400 uppercase tracking-wider">Management</h2>
                <nav class="mt-4 space-y-2">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 bg-gray-100 rounded-lg hover:text-orange-600">
                        Dashboard
                    </a>
                    <a href="{{ route('admin.users') }}" class="flex items-center px-4 py-2 text-gray-600 rounded-lg hover:bg-orange-50 hover:text-orange-600">
                        Users
                    </a>
                    <a href="{{ route('admin.recipes') }}" class="flex items-center px-4 py-2 text-gray-600 rounded-lg hover:bg-orange-50 hover:text-orange-600">
                        Recipes
                    </a>
                    <a href="{{ route('admin.scraper') }}" class="flex items-center px-4 py-2 text-gray-600 rounded-lg hover:bg-orange-50 hover:text-orange-600">
                        Web Scraper
                    </a>
                     <a href="{{ route('admin.profile') }}" class="flex items-center px-4 py-2 text-gray-600 rounded-lg hover:bg-orange-50 hover:text-orange-600">
                        My Profile
                    </a>
                </nav>
            </div>
        </aside>

        <main class="flex-1 p-8 overflow-y-auto">
            <header class="mb-8">
                <h1 class="text-3xl font-bold text-gray-800">@yield('header')</h1>
            </header>

            @yield('content')
        </main>
    </div>

    @include('partials.footer')
</body>
</html>