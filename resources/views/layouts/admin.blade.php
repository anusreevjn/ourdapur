<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin - OurDapur</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <style>
        .admin-wrapper { display: flex; min-height: 100vh; }
        .sidebar { width: 260px; background: #FFF; border-right: 1px solid #fed7aa; padding: 20px; }
        .sidebar-brand { font-size: 1.5rem; font-weight: 800; color: #C2410C; margin-bottom: 40px; display: block; }
        .nav-item { display: block; padding: 12px 15px; color: #57534e; text-decoration: none; font-weight: 500; border-radius: 8px; margin-bottom: 5px; transition: .3s; }
        .nav-item:hover, .nav-item.active { background: #FFF7ED; color: #F97316; }
        .main-content { flex: 1; background: #fafaf9; padding: 30px; }
        .header { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .card { background: #FFF; border-radius: 12px; padding: 25px; box-shadow: 0 2px 10px rgba(0,0,0,0.05); border: 1px solid #f3f4f6; }
    </style>
</head>
<body>
    <div class="admin-wrapper">
        <aside class="sidebar">
            <a href="/" class="sidebar-brand">OurDapur Admin</a>
            <nav>
                <a href="{{ route('admin.dashboard') }}" class="nav-item active">Dashboard</a>
                <a href="#" class="nav-item">Manage Users</a>
                <a href="#" class="nav-item">Manage Recipes</a>
                <a href="{{ route('admin.scraper') }}" class="nav-item">Web Scraper</a>
                <a href="#" class="nav-item">Notifications</a>
            </nav>
        </aside>

        <main class="main-content">
            <header class="header">
                <h2 style="font-weight: 700; color: #431407;">Dashboard Overview</h2>
                <div class="user-profile">
                    <span style="font-weight: 600; color: #F97316;">Admin</span>
                </div>
            </header>
            
            {{ $slot }}
        </main>
    </div>
</body>
</html>