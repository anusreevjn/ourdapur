<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Logged Out - OurDapur</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components.css') }}">

    <style>
        body {
            /* Matches Login Background */
            background: linear-gradient(rgba(0,0,0,0.6), rgba(0,0,0,0.6)), url('{{ asset("images/logout.jpg") }}');
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
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
            padding: 40px 30px;
            border-top: 5px solid #F97316; /* Orange Top Border */
            text-align: center;
        }

        .btn {
            display: block; width: 100%;
            padding: 15px;
            border: none;
            background: #F97316;
            border-radius: 30px;
            font-size: 1.1rem;
            color: #FFF;
            cursor: pointer;
            transition: .3s;
            font-weight: 600;
            text-decoration: none;
            margin-top: 20px;
        }
        .btn:hover { background: #C2410C; transform: translateY(-2px); }
    </style>
</head>
<body>
    <div class="container">
        <div style="font-size: 3rem; margin-bottom: 1rem;">👋</div>

        <p style="color: #78350F; font-weight: 800; font-size: 1.8rem; margin-bottom: 15px;">
            See You Soon!
        </p>
        
        <p style="color: #57534e; font-size: 1rem; margin-bottom: 10px;">
            You have been successfully logged out.
        </p>

        <p style="color: #9ca3af; font-size: 0.9rem;">
            Redirecting to login in <span id="timer" style="color: #F97316; font-weight: bold;">10</span> seconds...
        </p>

        <a href="{{ route('login') }}" class="btn">Login Now</a>
    </div>

    <script>
        // Countdown Logic
        let timeLeft = 5;
        const timerElement = document.getElementById('timer');
        
        const countdown = setInterval(() => {
            timeLeft--;
            timerElement.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(countdown);
                window.location.href = "{{ route('login') }}";
            }
        }, 500);
    </script>
</body>
</html>