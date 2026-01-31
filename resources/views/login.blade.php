<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login - OurDapur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            /* Warm Orange/Brown Gradient Background */
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("images/login.jpg") }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        /* Fallback if image fails */
        body { background-color: #FFF7ED; }

        .container {
            width: 400px;
            background: #FFF;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            padding: 40px 30px;
            border-top: 5px solid #F97316; /* Orange Top Border */
        }
        .login-text {
            color: #78350F; /* Coffee Brown */
            font-weight: 800;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 25px;
        }
        .input-group { width: 100%; height: 50px; margin-bottom: 25px; }
        .input-group input {
            width: 100%; height: 100%;
            border: 2px solid #fed7aa; /* Light Orange Border */
            padding: 15px 20px;
            font-size: 1rem;
            border-radius: 30px;
            outline: none;
            transition: .3s;
            color: #431407;
        }
        .input-group input:focus { border-color: #F97316; box-shadow: 0 0 5px rgba(249, 115, 22, 0.3); }
        
        .btn {
            display: block; width: 100%;
            padding: 15px;
            border: none;
            background: #F97316; /* Main Orange */
            border-radius: 30px;
            font-size: 1.2rem;
            color: #FFF;
            cursor: pointer;
            transition: .3s;
            font-weight: 600;
        }
        .btn:hover { background: #C2410C; transform: translateY(-2px); } /* Burnt Orange on Hover */
        
        .login-register-text { color: #57534e; font-weight: 500; text-align: center; }
        .login-register-text a { text-decoration: none; color: #EA580C; font-weight: 700; }
        .login-register-text a:hover { text-decoration: underline; }
        
        .error-msg { 
            background: #fef2f2; border: 1px solid #ef4444; color: #b91c1c; 
            padding: 10px; border-radius: 8px; font-size: 0.9rem; text-align: center; margin-bottom: 20px; 
        }
    </style>
</head>
<body>
    <div class="container">
        <p class="login-text" style="font-size: 1.5rem; font-weight: 700;">Login to OurDapur</p>
        
        <form action="{{ route('login') }}" method="POST">
            @csrf
            
            @if ($errors->any())
                <div class="error-msg">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="input-group">
                <input type="email" placeholder="Email" name="email" required value="{{ old('email') }}">
            </div>
            <div class="input-group">
                <input type="password" placeholder="Password" name="password" required>
            </div>
            <div class="input-group">
                <button name="submit" class="btn" type="submit">Login</button>
            </div>
            <p class="login-register-text">
                Don't have an account? <a href="{{ route('register') }}">Register Here</a>
            </p>
            <p class="login-register-text" style="margin-top: 10px; font-size: 0.9rem;">
                <a href="{{ route('password.request') }}" style="color: #6b7280;">Forgot Password?</a>
            </p>
        </form>
    </div>
</body>
</html>