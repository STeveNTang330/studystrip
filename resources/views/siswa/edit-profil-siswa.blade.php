<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengaturan Profil - StudyStrip</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=4">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #b8d8b4 0%, #e8d3a7 50%, #e3b382 100%); font-family: 'Nunito', sans-serif; min-height: 100vh; margin: 0; padding-top: 100px; padding-bottom: 50px; overflow-x: hidden; }
        
        .webtoon-nav { background-color: rgba(255, 255, 255, 0.6); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.4); position: fixed; width: 100%; top: 0; z-index: 1050; box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
        .brand-title { font-family: 'Orbitron', sans-serif; font-size: 24px; color: #2c2b45; margin: 0; font-weight: 900;}
        .text-orange { color: #F9A826; }

        .glass-form-card { background-color: rgba(255, 255, 255, 0.55); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px); border-radius: 24px; padding: 40px; border: 1px solid rgba(255, 255, 255, 0.9); box-shadow: 0 15px 35px rgba(0,0,0,0.05); }

        .form-control { background-color: rgba(255, 255, 255, 0.7); border: 1px solid rgba(0,0,0,0.08); border-radius: 12px; padding: 12px 15px; font-weight: 600; }
        .form-control:focus { background-color: #fff; box-shadow: 0 0 0 3px rgba(249, 168, 38, 0.3); border-color: #F9A826; }
        
        .profile-preview { width: 110px; height: 110px; border-radius: 50%; object-fit: cover; border: 4px solid #fff; box-shadow: 0 8px 20px rgba(0,0,0,0.1); margin-bottom: 15px; display: inline-block; }

        .btn-save { background: linear-gradient(90deg, #F9A826, #e67e22); color: white; border: none; padding: 12px 30px; border-radius: 12px; font-weight: 800; width: 100%; transition: 0.3s; box-shadow: 0 4px 15px rgba(230, 126, 34, 0.3); }
        .btn-save:hover { transform: translateY(-3px); box-shadow: 0 8px 25px rgba(230, 126, 34, 0.4); color: white;}
        
        /* CSS Khusus Ikon Mata agar kursor berubah saat diarahkan */
        .cursor-pointer { cursor: pointer; transition: 0.2s; }
        .cursor-pointer:hover { background-color: #f4f6f9 !important; }
    </style>
</head>
<body>

    <nav class="webtoon-nav">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="brand-title">STUDY<span class="text-orange">strip</span></h1>
            <a href="{{ route('dashboard') }}" class="btn btn-sm btn-dark fw-bold rounded-pill px-4">
                <i class="fa-solid fa-arrow-left me-2"></i> Kembali
            </a>
        </div>
    </nav>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="glass-form-card">
                    <h3 class="fw-bold mb-4 text-center" style="color: #2c2b45;">Pengaturan Profil</h3>
                    
                    @if(session('success'))
                        <div class="alert alert-success rounded-3 fw-bold small"><i class="fa-solid fa-check-circle me-2"></i>{{ session('success') }}</div>
                    @endif

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <div class="text-center border-bottom pb-4 mb-4">
                            <img id="imagePreview" src="{{ Auth::user()->profile_picture ? asset('profil/' . Auth::user()->profile_picture) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}" alt="Foto Profil" class="profile-preview bg-white">
                            <br>
                            <label for="profile_picture" class="btn btn-sm btn-light fw-bold border rounded-pill px-3 shadow-sm mt-2" style="cursor: pointer;">
                                <i class="fa-solid fa-camera me-1"></i> Pilih Foto Baru
                            </label>
                            <input type="file" name="profile_picture" id="profile_picture" class="d-none" accept="image/*">
                        </div>

                        <div class="row g-3">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-secondary small">Nama Penjelajah</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-user text-muted"></i></span>
                                    <input type="text" name="name" class="form-control border-start-0 ps-0" value="{{ Auth::user()->name ?? '' }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold text-secondary small">Email Akses</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-envelope text-muted"></i></span>
                                    <input type="email" name="email" class="form-control border-start-0 ps-0" value="{{ Auth::user()->email ?? '' }}" required>
                                </div>
                            </div>

                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary small">Sandi Baru <span class="fw-normal">(Opsional)</span></label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                                    <input type="password" name="password" id="password" class="form-control border-start-0 border-end-0 ps-0" placeholder="Min. 8 karakter">
                                    <span class="input-group-text bg-white border-start-0 cursor-pointer" onclick="togglePassword('password', 'eye-icon-1')">
                                        <i class="fa-solid fa-eye-slash text-muted" id="eye-icon-1"></i>
                                    </span>
                                </div>
                            </div>
                            
                            <div class="col-md-6 mb-4">
                                <label class="form-label fw-bold text-secondary small">Konfirmasi Sandi</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-white border-end-0"><i class="fa-solid fa-lock text-muted"></i></span>
                                    <input type="password" name="password_confirmation" id="password_confirmation" class="form-control border-start-0 border-end-0 ps-0" placeholder="Ketik ulang sandi">
                                    <span class="input-group-text bg-white border-start-0 cursor-pointer" onclick="togglePassword('password_confirmation', 'eye-icon-2')">
                                        <i class="fa-solid fa-eye-slash text-muted" id="eye-icon-2"></i>
                                    </span>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-save mt-2">
                            <i class="fa-solid fa-floppy-disk me-2"></i> Simpan Pembaruan Data
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // SCRIPT LIVE PREVIEW FOTO
        document.getElementById('profile_picture').addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    document.getElementById('imagePreview').src = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        });

        // SCRIPT SHOW/HIDE PASSWORD (FUNGSI KLIK IKON MATA)
        function togglePassword(inputId, iconId) {
            const input = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
        }
    </script>
</body>
</html>