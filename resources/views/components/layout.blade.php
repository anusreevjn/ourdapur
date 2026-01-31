<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OurDapur - AI Recipe Finder</title>
    
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">
</head>
<body>

    @include('partials.navbar')

    <main class="container" style="padding-top: 2rem; padding-bottom: 4rem; min-height: 80vh;">
        @if(session('status'))
            <div style="background: #d1fae5; color: #065f46; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                {{ session('status') }}
            </div>
        @endif
        @if(session('error'))
            <div style="background: #fee2e2; color: #991b1b; padding: 1rem; border-radius: 0.5rem; margin-bottom: 1rem;">
                {{ session('error') }}
            </div>
        @endif

        {{ $slot ?? '' }}
        @yield('content')
    </main>

    @include('partials.footer')

</body>
</html>