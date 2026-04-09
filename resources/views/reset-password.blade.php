<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kata Sandi Baru - StudyStrip</title>

    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=3">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <style>
        body {
            margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcfcfc;
            background-image: 
                radial-gradient(circle at 10% 90%, rgba(163, 116, 255, 0.65) 0%, transparent 80%),
                radial-gradient(circle at 90% 90%, rgba(249, 168, 38, 0.65) 0%, transparent 80%),
                radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.6) 0%, transparent 100%);
            height: 100vh; display: flex; justify-content: center; align-items: center;
        }

        .glass-panel {
            background: rgba(255, 255, 255, 0.4); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 20px; padding: 40px; width: 320px;
            box-shadow: 0 10px 40px 0 rgba(0, 0, 0, 0.05); text-align: center;
        }

        .glass-panel h2 {
            margin-top: 0; font-family: 'Orbitron', sans-serif; font-size: 22px;
            letter-spacing: 1px; margin-bottom: 5px; text-shadow: 0 2px 5px rgba(0, 0, 0, 0.05); color: #1A1A3A;
        }

        .glass-panel p { margin-bottom: 25px; font-size: 13px; color: #555555; line-height: 1.5; }

        .input-group { margin-bottom: 20px; text-align: left; position: relative; }
        .input-group label { display: block; margin-bottom: 8px; font-size: 13px; color: #333333; font-weight: 500; }
        
        .input-group input {
            width: 100%; padding: 12px; box-sizing: border-box; background: rgba(255, 255, 255, 0.6);
            border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 8px; color: #333333; outline: none; transition: 0.3s;
        }
        
        .input-group input:focus { border-color: #F9A826; background: rgba(255, 255, 255, 0.9); box-shadow: 0 0 8px rgba(249, 168, 38, 0.2); }

        button {
            width: 100%; padding: 12px; background: linear-gradient(135deg, #F9A826, #E85D04);
            border: none; border-radius: 8px; color: white; font-size: 15px; font-weight: bold; cursor: pointer; transition: 0.3s; margin-top: 10px;
            box-shadow: 0 4px 15px rgba(249, 168, 38, 0.3);
        }
        
        button:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(249, 168, 38, 0.4); }

        .alert-danger { background: rgba(211, 47, 47, 0.1); color: #d32f2f; padding: 12px; border-radius: 8px; font-size: 13px; margin-bottom: 15px; border: 1px solid rgba(211, 47, 47, 0.2); text-align: left;}
        
        .toggle-password { position: absolute; right: 12px; top: 38px; cursor: pointer; color: #777777; transition: 0.3s; z-index: 2;}
        .toggle-password:hover { color: #F9A826; }
    </style>
</head>
<body>

    <div class="glass-panel">
        <h2>KATA SANDI BARU</h2>
        <p>Buat kata sandi baru untuk akunmu.</p>

        @if($errors->any())
            <div class="alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('password.update') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group">
                <label for="email">Email Operasional</label>
                <input type="email" name="email" id="email" required placeholder="Email kamu">
            </div>

            <div class="input-group">
                <label for="password">Sandi Baru</label>
                <input type="password" name="password" id="password" required placeholder="Minimal 8 karakter" style="padding-right: 40px;">
                <i class="fa fa-eye toggle-password"></i>
            </div>

            <div class="input-group">
                <label for="password_confirmation">Konfirmasi Sandi Baru</label>
                <input type="password" name="password_confirmation" id="password_confirmation" required placeholder="Ulangi sandi baru" style="padding-right: 40px;">
                <i class="fa fa-eye toggle-password"></i>
            </div>

            <button type="submit">SIMPAN KATA SANDI</button>
        </form>
    </div>

    <script>
        document.querySelectorAll('.toggle-password').forEach(icon => {
            icon.addEventListener('click', function () {
                const input = this.previousElementSibling;
                if (input.type === 'password') {
                    input.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>