<!DOCTYPE html>
<html>
<head>
    <title>Login OTP - Kasir Digital</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #f8fafc; padding: 20px; text-align: center;">

    <div style="max-width: 400px; margin: auto; background-color: white; padding: 20px; border-radius: 10px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">

        <h2 style="color: #1e293b; font-size: 1.5rem; font-weight: bold;">Hello, {{ $member->full_name }}!</h2>

        <p style="color: #475569; font-size: 1rem;">Your One-Time Password (OTP) for login is:</p>

        <div style="background: #e2e8f0; padding: 10px 20px; display: inline-block; border-radius: 5px; font-size: 1.8rem; font-weight: bold; color: #1e293b;">
            {{ $otp }}
        </div>

        <p style="color: #64748b; font-size: 0.9rem; margin-top: 10px;">
            This OTP will expire in <strong>10 minutes</strong>. Please do not share this code with anyone.
        </p>

        <p style="color: #64748b; font-size: 0.9rem;">
            If you did not request this, please ignore this email.
        </p>

        <br>
        <p style="color: #1e293b; font-size: 1rem;"><strong>Kasir Digital Team</strong></p>
    </div>

</body>
</html>
