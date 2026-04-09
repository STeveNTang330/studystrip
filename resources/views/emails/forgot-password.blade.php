<!DOCTYPE html>
<html>
<head>
    <title>Reset Kata Sandi StudyStrip</title>
</head>
<body style="font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #0F3460; padding: 20px; margin: 0;">
    <div style="max-width: 500px; margin: 0 auto; background: #1A1A3A; padding: 30px; border-radius: 15px; border: 1px solid rgba(255,255,255,0.1); text-align: center;">
        
        <h2 style="color: white; margin-top: 0; font-family: sans-serif; letter-spacing: 2px;">
            STUDY<span style="color: #F9A826;">strip</span>
        </h2>
        
        <p style="color: #ccc; font-size: 16px; text-align: left;">Halo Pejuang StudyStrip,</p>
        
        <p style="color: #aaa; line-height: 1.6; text-align: left;">
            Kami menerima permintaan untuk memulihkan akses akun kamu. Jika ini memang kamu, silakan klik tombol di bawah ini untuk membuat kata sandi baru:
        </p>
        
        <div style="margin: 30px 0;">
            <a href="{{ url('reset-password/'.$token) }}" style="background-color: #F9A826; color: #1A1A3A; padding: 12px 25px; text-decoration: none; border-radius: 8px; font-weight: bold; display: inline-block;">
                RESET KATA SANDI
            </a>
        </div>

        <p style="color: #777; font-size: 12px; line-height: 1.5; text-align: left;">
            Jika kamu tidak pernah meminta pemulihan ini, abaikan saja email ini. Data dan markas komikmu tetap aman bersama kami.
        </p>
        
        <hr style="border: none; border-top: 1px solid #333; margin: 20px 0;">
        <p style="color: #666; font-size: 11px;">
            &copy; 2026 StudyStrip. Batam, Indonesia.
        </p>
    </div>
</body>
</html>