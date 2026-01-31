<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up - OurDapur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <style>
        body {
            /* Warm Orange/Brown Gradient Background */
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("images/register.jpg") }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container {
            width: 400px;
            background: #FFF;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            padding: 40px 30px;
            border-top: 5px solid #F97316;
        }
        .signup-text {
            color: #78350F; /* Brown */
            font-weight: 800;
            font-size: 2rem;
            text-align: center;
            margin-bottom: 25px;
        }
        .input-group { width: 100%; height: 50px; margin-bottom: 25px; }
        .input-group input {
            width: 100%; height: 100%;
            border: 2px solid #fed7aa;
            padding: 15px 20px;
            font-size: 1rem;
            border-radius: 30px;
            outline: none;
            transition: .3s;
        }
        .input-group input:focus { border-color: #F97316; }
        
        .btn {
            display: block; width: 100%; padding: 15px;
            border: none; background: #F97316; border-radius: 30px;
            font-size: 1.2rem; color: #FFF; cursor: pointer; transition: .3s; font-weight: 600;
        }
        .btn:hover { background: #C2410C; transform: translateY(-2px); }
        
        .login-register-text { color: #57534e; text-align: center; }
        .login-register-text a { color: #EA580C; font-weight: 700; text-decoration: none; }
        .error-msg { color: #dc2626; text-align: center; margin-bottom: 10px; font-size: 0.9rem; }
    </style>
</head>
<body>
<div class="container">
    <p class="signup-text" style="font-size: 1.5rem; font-weight: 700;">Create Account</p>
    
    <form action="{{ route('register') }}" method="POST">
        @csrf
        
        @if ($errors->any())
            <div class="error-msg">{{ $errors->first() }}</div>
        @endif

        <div class="input-group">
            <input type="text" name="name" placeholder="Full Name" required value="{{ old('name') }}">
        </div>
        
        <div class="input-group">
            <input type="email" name="email" placeholder="Email" required value="{{ old('email') }}">
        </div>
        
        <div class="input-group">
            <input type="password" name="password" placeholder="Password" required>
        </div>

        <div class="input-group">
            <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
        </div>
        
        <div class="input-group">
            <button name="submit" class="btn" type="submit">Register</button>
        </div>
        
        <p class="login-register-text">
            Already have an account? <a href="{{ route('login') }}">Login Here</a>
        </p>
    </form>
</div>
</body>
</html>