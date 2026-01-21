<!DOCTYPE html>
<html>
<body style="font-family: 'Poppins', sans-serif; background-color: #FFF7ED; padding: 40px;">
    
    <div style="max-width: 500px; margin: 0 auto; background: white; padding: 30px; border-radius: 12px; border-top: 5px solid #F97316; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
        
        <h1 style="color: #78350F; text-align: center; margin-bottom: 20px;">Reset Password</h1>
        
        <p style="color: #444; font-size: 16px; line-height: 1.6;">
            Hi there! 👋<br><br>
            We received a request to reset the password for your <b>OurDapur</b> account. 
            If you didn't ask for this, you can safely ignore this email.
        </p>

        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ url('reset-password/'.$token.'?email='.$email) }}" 
               style="background-color: #F97316; color: white; padding: 12px 24px; text-decoration: none; border-radius: 30px; font-weight: bold; font-size: 16px;">
               Reset My Password
            </a>
        </div>

        <p style="color: #888; font-size: 12px; text-align: center; margin-top: 30px;">
            If the button doesn't work, copy this link:<br>
            {{ url('reset-password/'.$token.'?email='.$email) }}
        </p>
    </div>

</body>
</html>