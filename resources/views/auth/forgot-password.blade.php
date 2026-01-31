<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Forgot Password - OurDapur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body {
            /* Warm Orange/Brown Gradient Background */
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("images/forgot.jpg") }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .container { 
            width: 400px; background: #FFF; border-radius: 12px; 
            box-shadow: 0 4px 20px rgba(0,0,0,0.05); padding: 40px 30px; 
            border-top: 5px solid #F97316;
        }
        .header-text { 
            text-align: center; margin-bottom: 20px; color: #78350F; 
            font-weight: 700; font-size: 1.5rem; 
        }
        .input-group { width: 100%; height: 50px; margin-bottom: 25px; }
        .input-group input { 
            width: 100%; height: 100%; border: 2px solid #fed7aa; 
            padding: 15px 20px; font-size: 1rem; border-radius: 30px; outline: none; transition: .3s; 
        }
        .input-group input:focus { border-color: #F97316; }
        
        .btn { 
            display: block; width: 100%; padding: 15px 20px; border: none; 
            background: #F97316; border-radius: 30px; color: #FFF; 
            font-size: 1.1rem; cursor: pointer; transition: .3s; font-weight: 600;
        }
        .btn:hover { background: #C2410C; }
        
        .status-msg { color: #15803d; background: #dcfce7; padding: 10px; border-radius: 6px; text-align: center; margin-bottom: 15px; font-size: 0.9rem; }
        .back-link { display: block; text-align: center; margin-top: 15px; color: #78716c; text-decoration: none; font-size: 0.9rem; }
        .back-link:hover { color: #F97316; }
    </style>
</head>
<body>
    <div class="container">
        <p class="header-text">Reset Password</p>
        
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            
            @if (session('status'))
                <div class="success-msg">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="error-msg">{{ $errors->first() }}</div>
            @endif

            <p style="text-align:center; margin-bottom: 20px; color: #666; font-size: 0.9rem;">
                Enter your email address and we will send you a link to reset your password.
            </p>

            <div class="input-group">
                <input type="email" name="email" placeholder="Enter your email" required>
            </div>
            
            <div class="input-group">
                <button type="submit" class="btn">Send Reset Link</button>
            </div>
            
            <a href="{{ route('login') }}" class="back-link">← Back to Login</a>
        </form>
    </div>
</body>
</html>