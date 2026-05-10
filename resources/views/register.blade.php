<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - StudyStrip</title>
    
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=4">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    
    <style>
        body { background-color: #f5f7f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 30px 0; }
        .card-auth { background: #ffffff; border: none; border-radius: 16px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04); width: 100%; max-width: 450px; overflow: hidden; }
        .brand-title { font-family: 'Orbitron', sans-serif; font-size: 28px; letter-spacing: 1px; color: #1A1A3A; margin-bottom: 0; }
        .text-orange { color: #F9A826; }
        .form-control { background-color: #f8f9fa; border: 1px solid #eaeaea; padding: 12px 15px; font-size: 14px; }
        .form-control:focus { background-color: #ffffff; border-color: #F9A826; box-shadow: none; }
        .input-group:focus-within { box-shadow: 0 0 0 0.2rem rgba(249, 168, 38, 0.15); border-radius: 8px; }
        .input-group-text { border: 1px solid #eaeaea; }
        .form-label { font-size: 13px; font-weight: 600; color: #555; margin-bottom: 6px; }
        .btn-primary-custom { background-color: #F9A826; border: none; color: white; font-weight: bold; padding: 12px; border-radius: 8px; transition: all 0.3s ease; }
        .btn-primary-custom:hover { background-color: #e09622; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(249, 168, 38, 0.3); }
        .toggle-password { cursor: pointer; background: #f8f9fa; transition: 0.3s; }
        .toggle-password:hover { color: #F9A826 !important; }
        .btn-loading { cursor: not-allowed; opacity: 0.8; }
        .spinner-border { width: 1.2rem; height: 1.2rem; display: none; }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center">
        <div class="card card-auth p-4 p-md-5">
            
            <div class="text-center mb-4">
                <h2 class="brand-title">STUDY<span class="text-orange">strip</span></h2>
                <p class="text-muted small mt-1">Daftarkan akun operasional baru</p>
            </div>

            @if($errors->any())
                <div class="alert alert-danger" style="font-size: 13px; border-radius: 8px;">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('register.post') }}" method="POST" id="registerForm">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-top-left-radius: 8px; border-bottom-left-radius: 8px;"><i class="fa-solid fa-user"></i></span>
                        <input type="text" name="name" class="form-control border-start-0" value="{{ old('name') }}" required style="border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email Operasional</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-top-left-radius: 8px; border-bottom-left-radius: 8px;"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control border-start-0" value="{{ old('email') }}" required style="border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                    </div>
                </div>

                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-top-left-radius: 8px; border-bottom-left-radius: 8px;"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password" class="form-control border-start-0 border-end-0" required>
                        <span class="input-group-text border-start-0 text-muted toggle-password" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                            <i class="fa-regular fa-eye"></i>
                        </span>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label">Konfirmasi Kata Sandi</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted" style="border-top-left-radius: 8px; border-bottom-left-radius: 8px;"><i class="fa-solid fa-lock"></i></span>
                        <input type="password" name="password_confirmation" class="form-control border-start-0 border-end-0" required>
                        <span class="input-group-text border-start-0 text-muted toggle-password" style="border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                            <i class="fa-regular fa-eye"></i>
                        </span>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary-custom w-100" id="btnSubmit">
                    <span class="btn-text"><i class="fa-solid fa-user-plus me-2"></i> DAFTAR SEKARANG</span>
                    <div class="spinner-border text-light" role="status" id="loadingSpinner"></div>
                </button>
            </form>

            <div class="text-center mt-4 pt-3 border-top">
                <p class="text-muted mb-0" style="font-size: 13px;">Sudah memiliki akun? 
                    <a href="{{ route('login') }}" class="text-decoration-none text-dark fw-bold">Masuk di sini</a>
                </p>
            </div>

        </div>
    </div>

    <script>
        // Efek Tombol Loading agar terlihat Pro
        document.getElementById('registerForm').addEventListener('submit', function() {
            var btn = document.getElementById('btnSubmit');
            var text = document.querySelector('.btn-text');
            var spinner = document.getElementById('loadingSpinner');
            
            btn.classList.add('btn-loading');
            text.style.display = 'none';
            spinner.style.display = 'inline-block';
        });

        window.addEventListener('pageshow', function() {
            document.getElementById('btnSubmit').classList.remove('btn-loading');
            document.querySelector('.btn-text').style.display = 'inline';
            document.getElementById('loadingSpinner').style.display = 'none';
        });

        // Script Tombol Mata (Eye Icon) Buatan Steven
        document.querySelectorAll('.toggle-password').forEach(iconContainer => {
            iconContainer.addEventListener('click', function () {
                const input = this.previousElementSibling;
                const icon = this.querySelector('i');
                
                if (input.type === 'password') {
                    input.type = 'text';
                    icon.classList.remove('fa-eye');
                    icon.classList.add('fa-eye-slash');
                } else {
                    input.type = 'password';
                    icon.classList.remove('fa-eye-slash');
                    icon.classList.add('fa-eye');
                }
            });
        });
    </script>
</body>
</html>