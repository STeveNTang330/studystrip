<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar - StudyStrip</title>
    
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
            z-index: 10;
        }

        .glass-panel h2 {
            margin-top: 0; font-family: 'Orbitron', sans-serif; font-size: 32px;
            letter-spacing: 2px; margin-bottom: 5px; text-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
        }
        
        .text-dark { color: #1A1A3A; } 
        .text-orange { color: #F9A826; }
        .glass-panel p { margin-bottom: 30px; font-size: 14px; color: #555555; }

        /* --- INPUT & TOMBOL MATA --- */
        .input-group { margin-bottom: 20px; text-align: left; position: relative; }
        .input-group label { display: block; margin-bottom: 8px; font-size: 13px; color: #333333; font-weight: 500; }
        
        .input-group input {
            width: 100%; padding: 12px; box-sizing: border-box;
            background: rgba(255, 255, 255, 0.6); 
            border: 1px solid rgba(0, 0, 0, 0.1);
            border-radius: 8px; color: #333333; outline: none; transition: 0.3s;
            padding-right: 40px;
        }
        .input-group input:focus { border-color: #F9A826; background: rgba(255, 255, 255, 0.9); box-shadow: 0 0 8px rgba(249, 168, 38, 0.2); }

        .toggle-password {
            position: absolute; right: 12px; top: 38px; cursor: pointer; color: #777777; 
            transition: color 0.3s ease; z-index: 2;
        }
        .toggle-password:hover { color: #F9A826; }

        button {
            width: 100%; padding: 12px; background: linear-gradient(135deg, #F9A826, #E85D04);
            border: none; border-radius: 8px; color: white; font-size: 16px;
            font-weight: bold; cursor: pointer; transition: 0.3s; margin-top: 10px;
            box-shadow: 0 4px 15px rgba(249, 168, 38, 0.3);
        }
        button:hover { opacity: 0.9; transform: translateY(-2px); box-shadow: 0 6px 20px rgba(249, 168, 38, 0.4); }

        .extra-links { margin-top: 25px; font-size: 13px; }
        .extra-links a { color: #666666; text-decoration: none; transition: 0.3s; }
        .extra-links a span { color: #E85D04; font-weight: bold; }
        .extra-links a:hover { color: #1A1A3A; }

        /* --- CSS LOADING BINTANG GLASSMORPHISM --- */
        .loading-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(255, 255, 255, 0.4); 
            backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); 
            display: flex; justify-content: center; align-items: center; z-index: 99999; 
            opacity: 0; visibility: hidden; transition: 0.4s ease;
        }

        .loading-overlay.active { opacity: 1; visibility: visible; }

        .loader-content {
            display: flex; flex-direction: column; align-items: center; justify-content: center;
        }

        .stars-ring {
            width: 120px; height: 120px;
            position: relative; display: flex;
            justify-content: center; align-items: center;
            color: #F9A826; 
            animation: rotateManyStars 3s linear infinite; 
            margin-bottom: 25px;
        }

        .stars-ring i {
            font-size: 22px; position: absolute;
            text-shadow: 0 0 15px rgba(249, 168, 38, 0.7);
        }

        .star-1 { transform: rotate(0deg) translate(50px); }
        .star-2 { transform: rotate(72deg) translate(50px); }
        .star-3 { transform: rotate(144deg) translate(50px); }
        .star-4 { transform: rotate(216deg) translate(50px); }
        .star-5 { transform: rotate(288deg) translate(50px); }

        .loading-text { 
            color: #1A1A3A; font-family: 'Orbitron', sans-serif; font-size: 15px; 
            letter-spacing: 3px; animation: pulseTextMany 1.5s infinite; margin:0; text-align:center; font-weight: 800;
        }

        @keyframes rotateManyStars {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        @keyframes pulseTextMany {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.4; }
        }
    </style>
</head>
<body>

    <div id="loadingOverlay" class="loading-overlay active">
        <div class="loader-content">
            <div class="stars-ring">
                <i class="fa fa-star star-1"></i>
                <i class="fa fa-star star-2"></i>
                <i class="fa fa-star star-3"></i>
                <i class="fa fa-star star-4"></i>
                <i class="fa fa-star star-5"></i>
            </div>
            <p class="loading-text">MEMPROSES...</p>
        </div>
    </div>

    <div class="glass-panel">
        <h2><span class="text-dark">STUDY</span><span class="text-orange">strip</span></h2>
        <p>Pendaftaran Anggota Baru</p>
        
        <form action="{{ route('register.post') }}" method="POST" id="registerForm">
            @csrf

            @if ($errors->any())
                <div style="color: #d32f2f; font-size: 13px; margin-bottom: 15px; text-align: left; background: rgba(211, 47, 47, 0.1); padding: 10px; border-radius: 8px; border: 1px solid rgba(211, 47, 47, 0.2);">
                    <ul style="margin: 0; padding-left: 20px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="input-group">
                <label for="name">Nama Lengkap</label>
                <input type="text" name="name" id="name" required>
            </div>

            <div class="input-group">
                <label for="email">Email Operasional</label>
                <input type="email" name="email" id="email" required>
            </div>
            
            <div class="input-group">
                <label for="password">Kata Sandi</label>
                <input type="password" name="password" id="password" required>
                <i class="fa fa-eye toggle-password"></i>
            </div>
            
            <button type="submit">DAFTARKAN AKUN</button>

            <div class="extra-links">
                <a href="{{ route('login') }}">Sudah punya markas? <span>Masuk di sini</span></a>
            </div>
        </form>
    </div>

    <script>
        // --- 1. SCRIPT MATA PASSWORD ---
        const togglePasswordIcons = document.querySelectorAll('.toggle-password');
        togglePasswordIcons.forEach(icon => {
            icon.addEventListener('click', function () {
                const passwordInput = this.previousElementSibling;
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    this.classList.remove('fa-eye');
                    this.classList.add('fa-eye-slash');
                } else {
                    passwordInput.type = 'password';
                    this.classList.remove('fa-eye-slash');
                    this.classList.add('fa-eye');
                }
            });
        });

        // --- 2. SCRIPT LOADING BINTANG ---
        const loader = document.getElementById('loadingOverlay');

        window.addEventListener('load', function() {
            loader.classList.remove('active');
        });

        const registerForm = document.getElementById('registerForm');
        if (registerForm) {
            registerForm.addEventListener('submit', function() {
                loader.classList.add('active');
            });
        }

        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.href && !this.href.includes('#') && this.target !== '_blank') {
                    loader.classList.add('active');
                }
            });
        });

        window.addEventListener('pageshow', function(event) {
            if (event.persisted) {
                loader.classList.remove('active');
            }
        });
    </script>
</body>
</html>