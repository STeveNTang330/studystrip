<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Kata Sandi - StudyStrip</title>

    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=3">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        /* --- BACKGROUND GRADASI HALUS --- */
        body {
            margin: 0; padding: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcfcfc;
            background-image:
                radial-gradient(circle at 10% 90%, rgba(163, 116, 255, 0.65) 0%, transparent 80%),
                radial-gradient(circle at 90% 90%, rgba(249, 168, 38, 0.65) 0%, transparent 80%),
                radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.6) 0%, transparent 100%);
            height: 100vh; display: flex; justify-content: center; align-items: center;
        }

        /* --- LIGHT GLASSMORPHISM PANEL --- */
        .glass-panel {
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 20px; padding: 40px; width: 320px;
            box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.05);
            text-align: center;
        }

        .glass-panel h2 {
            margin-top: 0; font-family: 'Orbitron', sans-serif; font-size: 22px;
            letter-spacing: 1px; margin-bottom: 5px; text-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
            color: #1A1A3A;
        }

        .glass-panel p { margin-bottom: 25px; font-size: 13px; color: #555555; line-height: 1.5; }

        /* --- INPUT --- */
        .input-group { margin-bottom: 20px; text-align: left; position: relative; }
        .input-group label { display: block; margin-bottom: 8px; font-size: 13px; color: #333333; font-weight: 500; }

        .input-group input {
            width: 100%; padding: 12px; box-sizing: border-box;
            background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px; color: #333333; outline: none; transition: 0.3s;
        }
        .input-group input:focus { border-color: #F9A826; background: rgba(255, 255, 255, 0.9); box-shadow: 0 0 8px rgba(249, 168, 38, 0.2); }

        button {
            width: 100%; padding: 12px; background: linear-gradient(135deg, #F9A826, #E85D04);
            border: none; border-radius: 8px; color: white; font-size: 15px;
            font-weight: bold; cursor: pointer; transition: 0.3s; margin-top: 10px;
            box-shadow: 0 4px 15px rgba(249, 168, 38, 0.3);
        }
        button:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(249, 168, 38, 0.4); }

        .extra-links { margin-top: 20px; font-size: 13px; }
        .extra-links a { color: #666; text-decoration: none; transition: 0.3s; font-weight: 600; display: inline-flex; align-items: center; gap: 5px; }
        .extra-links a:hover { color: #F9A826; }
        
        .alert-success { background: rgba(40, 167, 69, 0.1); color: #28a745; padding: 12px; border-radius: 8px; font-size: 13px; margin-bottom: 15px; border: 1px solid rgba(40, 167, 69, 0.2); text-align: left;}
        .alert-danger { background: rgba(211, 47, 47, 0.1); color: #d32f2f; padding: 12px; border-radius: 8px; font-size: 13px; margin-bottom: 15px; border: 1px solid rgba(211, 47, 47, 0.2); text-align: left;}
    </style>
</head>
<body>

    <div class="glass-panel">
        <h2>PULIHKAN AKSES</h2>
        <p>Masukkan email operasional kamu, dan kami akan mengirimkan instruksi pemulihan.</p>

        @if(session('success'))
            <div class="alert-success">
                <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="input-group">
                <label for="email">Email Operasional</label>
                <input type="email" name="email" id="email" required placeholder="contoh@studystrip.com">
            </div>

            <button type="submit">KIRIM LINK PEMULIHAN</button>
        </form>

        <div class="extra-links">
            <a href="{{ route('login') }}"><i class="fa-solid fa-arrow-left"></i> Kembali ke Login</a>
        </div>
    </div>

</body>
</html>