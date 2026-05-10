<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pulihkan Akses - StudyStrip</title>
    
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=4">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    
    <style>
        body { background-color: #f5f7f9; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; min-height: 100vh; display: flex; align-items: center; justify-content: center; }
        .card-auth { background: #ffffff; border: none; border-radius: 16px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04); width: 100%; max-width: 420px; overflow: hidden; }
        .brand-title { font-family: 'Orbitron', sans-serif; font-size: 28px; letter-spacing: 1px; color: #1A1A3A; margin-bottom: 0; }
        .text-orange { color: #F9A826; }
        .form-control { background-color: #f8f9fa; border: 1px solid #eaeaea; padding: 12px 15px; border-radius: 8px; font-size: 14px; }
        .form-control:focus { background-color: #ffffff; border-color: #F9A826; box-shadow: 0 0 0 0.2rem rgba(249, 168, 38, 0.15); }
        .form-label { font-size: 13px; font-weight: 600; color: #555; margin-bottom: 6px; }
        .btn-primary-custom { background-color: #F9A826; border: none; color: white; font-weight: bold; padding: 12px; border-radius: 8px; transition: all 0.3s ease; }
        .btn-primary-custom:hover { background-color: #e09622; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(249, 168, 38, 0.3); }
    </style>
</head>
<body>

    <div class="container d-flex justify-content-center">
        <div class="card card-auth p-4 p-md-5">
            
            <div class="text-center mb-4">
                <h2 class="brand-title">STUDY<span class="text-orange">strip</span></h2>
                <h5 class="mt-3 fw-bold text-dark">PULIHKAN AKSES</h5>
                <p class="text-muted small mt-1">Masukkan email operasional kamu, dan kami akan mengirimkan instruksi pemulihan.</p>
            </div>

            @if(session('success') || session('status'))
                <div class="alert alert-success d-flex align-items-center" style="font-size: 13px; border-radius: 8px;">
                    <i class="fa-solid fa-circle-check me-2 fs-5"></i> 
                    <div>{{ session('success') ?? session('status') }}</div>
                </div>
            @endif

            @if($errors->any())
                <div class="alert alert-danger" style="font-size: 13px; border-radius: 8px;">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('password.email') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label">Email Operasional</label>
                    <div class="input-group">
                        <span class="input-group-text bg-light border-end-0 text-muted"><i class="fa-solid fa-envelope"></i></span>
                        <input type="email" name="email" class="form-control border-start-0" placeholder="Masukkan email..." required autofocus>
                    </div>
                </div>

                <button type="submit" class="btn btn-primary-custom w-100 mb-3">
                    <i class="fa-solid fa-paper-plane me-2"></i> KIRIM LINK PEMULIHAN
                </button>
            </form>

            <div class="text-center mt-3 pt-3 border-top">
                <a href="{{ route('login') }}" class="text-decoration-none text-muted" style="font-size: 13px; font-weight: 600;">
                    <i class="fa-solid fa-arrow-left me-1"></i> Kembali ke Login
                </a>
            </div>

        </div>
    </div>

</body>
</html>