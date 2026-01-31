<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Reset Password - OurDapur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600&display=swap" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Poppins', sans-serif; }
        body {
            /* Warm Orange/Brown Gradient Background */
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("images/reset.jpg") }}');
            background-size: cover;
            background-position: center;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .container { width: 400px; background: #FFF; border-radius: 12px; padding: 40px 30px; border-top: 5px solid #F97316; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        .header-text { text-align: center; margin-bottom: 20px; color: #78350F; font-weight: 700; font-size: 1.5rem; }
        .input-group { width: 100%; height: 50px; margin-bottom: 25px; }
        .input-group input { width: 100%; height: 100%; border: 2px solid #fed7aa; padding: 15px 20px; border-radius: 30px; outline: none; }
        .input-group input:focus { border-color: #F97316; }
        .btn { display: block; width: 100%; padding: 15px; border: none; background: #F97316; border-radius: 30px; color: #FFF; font-size: 1.1rem; cursor: pointer; font-weight: 600; }
        .btn:hover { background: #C2410C; }
    </style>
</head>
<body>
    <div class="container">
        <p class="header-text">New Password</p>
        
        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group">
                <input type="email" name="email" placeholder="Email Address" required>
            </div>
            
            <div class="input-group">
                <input type="password" name="password" placeholder="New Password" required>
            </div>

            <div class="input-group">
                <input type="password" name="password_confirmation" placeholder="Confirm Password" required>
            </div>
            
            <div class="input-group">
                <button type="submit" class="btn">Update Password</button>
            </div>
        </form>
    </div>
</body>
</html>