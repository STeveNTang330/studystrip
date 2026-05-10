<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - StudyStrip</title>
    
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=4">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; overflow-x: hidden; }
        
        /* PANEL KIRI: Visual & Branding */
        .auth-cover {
            background: linear-gradient(135deg, #1A1A3A 0%, #2b2b5e 100%);
            position: relative;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            color: white;
            overflow: hidden;
        }
        
        .auth-cover::before {
            content: ''; position: absolute; top: -10%; left: -10%;
            width: 400px; height: 400px; border-radius: 50%;
            background: rgba(249, 168, 38, 0.1); filter: blur(40px); z-index: 1;
        }
        .auth-cover::after {
            content: ''; position: absolute; bottom: -10%; right: -10%;
            width: 300px; height: 300px; border-radius: 50%;
            background: rgba(163, 116, 255, 0.15); filter: blur(40px); z-index: 1;
        }

        .cover-content { position: relative; z-index: 2; padding: 4rem 5rem; height: 100%; display: flex; flex-direction: column; justify-content: center; }
        .cover-title { font-family: 'Orbitron', sans-serif; font-size: 3rem; font-weight: 700; margin-bottom: 1rem; line-height: 1.2; }
        .cover-subtitle { font-size: 1.1rem; color: #a8a8c2; line-height: 1.6; max-width: 90%; }
        
        /* Kustomisasi Slider (Carousel) */
        .carousel-indicators { margin-bottom: 2rem; justify-content: flex-start; margin-left: 5rem; }
        .carousel-indicators [data-bs-target] { width: 10px; height: 10px; border-radius: 50%; background-color: rgba(255,255,255,0.4); border: none; margin: 0 5px; transition: 0.3s; }
        .carousel-indicators .active { background-color: #F9A826; width: 25px; border-radius: 8px; }
        .carousel-control-prev, .carousel-control-next { width: 5%; opacity: 0; transition: 0.3s; z-index: 10;}
        .auth-cover:hover .carousel-control-prev, .auth-cover:hover .carousel-control-next { opacity: 0.7; }
        .carousel-control-prev:hover, .carousel-control-next:hover { opacity: 1; }

        /* PANEL KANAN: Form Area */
        .auth-form-area { background-color: #f5f7f9; min-height: 100vh; display: flex; align-items: center; justify-content: center; padding: 2rem; }
        .card-login { background: #ffffff; border: none; border-radius: 16px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.04); width: 100%; max-width: 420px; }
        .brand-title { font-family: 'Orbitron', sans-serif; font-size: 28px; letter-spacing: 1px; color: #1A1A3A; margin-bottom: 0; }
        .text-orange { color: #F9A826; }
        
        /* Kustomisasi Input Form */
        .form-control { background-color: #f8f9fa; border: 1px solid #eaeaea; padding: 12px 15px; border-radius: 8px; font-size: 14px; }
        .form-control:focus { background-color: #ffffff; border-color: #F9A826; box-shadow: none; }
        .input-group:focus-within { box-shadow: 0 0 0 0.2rem rgba(249, 168, 38, 0.15); border-radius: 8px; }
        .input-group-text { border: 1px solid #eaeaea; }
        .form-label { font-size: 13px; font-weight: 600; color: #555; margin-bottom: 6px; }
        
        .btn-primary-custom { background-color: #F9A826; border: none; color: white; font-weight: bold; padding: 12px; border-radius: 8px; transition: all 0.3s ease; }
        .btn-primary-custom:hover { background-color: #e09622; transform: translateY(-2px); box-shadow: 0 5px 15px rgba(249, 168, 38, 0.3); }
        .btn-loading { cursor: not-allowed; opacity: 0.8; }
        .spinner-border { width: 1.2rem; height: 1.2rem; display: none; }
    </style>
</head>
<body>

    <div class="container-fluid p-0">
        <div class="row g-0">
            
            <div class="col-lg-6 d-none d-lg-block auth-cover position-relative">
                
                <div id="loginSlider" class="carousel slide h-100" data-bs-ride="carousel" data-bs-interval="4000">
                    
                    <div class="carousel-indicators">
                        <button type="button" data-bs-target="#loginSlider" data-bs-slide-to="0" class="active" aria-current="true"></button>
                        <button type="button" data-bs-target="#loginSlider" data-bs-slide-to="1"></button>
                        <button type="button" data-bs-target="#loginSlider" data-bs-slide-to="2"></button>
                    </div>

                    <div class="carousel-inner h-100">
                        
                        <div class="carousel-item active h-100">
                            <div class="cover-content">
                                <h1 class="cover-title">STUDY<span class="text-orange">strip</span></h1>
                                <h2 class="mb-4 fw-bold" style="font-size: 2rem;">Revolusi Belajar Fisika<br>Lewat Petualangan.</h2>
                                <p class="cover-subtitle">Meninggalkan metode hafalan rumus yang membosankan. StudyStrip memadukan komik digital dengan pendekatan <i>engineering mindset</i> untuk memecahkan masalah fisika secara interaktif.</p>
                                
                                <div class="mt-5 d-flex flex-column gap-3">
                                    <div class="d-flex align-items-center text-light opacity-75">
                                        <i class="fa-solid fa-circle-check text-orange me-3 fs-5"></i>
                                        <span style="font-size: 0.95rem;">Visualisasi Konsep Abstrak Hukum Newton</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item h-100">
                            <div class="cover-content">
                                <h1 class="cover-title" style="color: rgba(255,255,255,0.2);">STUDY<span class="text-orange" style="opacity: 0.2;">strip</span></h1>
                                <h2 class="mb-4 fw-bold" style="font-size: 2rem; color: #F9A826;">Motivasi Maksimal<br>dengan Gamifikasi.</h2>
                                <p class="cover-subtitle">Tingkatkan antusiasme siswa dalam menyelesaikan misi membaca komik dan tantangan <i>puzzle</i>. Dapatkan Koin Energi dan EXP untuk terus menaikkan level pencapaian.</p>
                                
                                <div class="mt-5 d-flex flex-column gap-3">
                                    <div class="d-flex align-items-center text-light opacity-75">
                                        <i class="fa-solid fa-gamepad text-orange me-3 fs-5"></i>
                                        <span style="font-size: 0.95rem;">Sistem Poin, Level, dan Evaluasi Kuis</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="carousel-item h-100">
                            <div class="cover-content">
                                <h1 class="cover-title" style="color: rgba(255,255,255,0.2);">STUDY<span class="text-orange" style="opacity: 0.2;">strip</span></h1>
                                <h2 class="mb-4 fw-bold" style="font-size: 2rem; color: #A374FF;">Pemantauan Nilai<br>Real-Time.</h2>
                                <p class="cover-subtitle">Pusat kendali penuh bagi guru. Pantau akumulasi skor, pencapaian level siswa, kelola bank soal, dan materi komik dengan mudah melalui dasbor yang komprehensif.</p>
                                
                                <div class="mt-5 d-flex flex-column gap-3">
                                    <div class="d-flex align-items-center text-light opacity-75">
                                        <i class="fa-solid fa-chart-line text-orange me-3 fs-5"></i>
                                        <span style="font-size: 0.95rem;">Manajemen Data Siswa Terpusat</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                    <button class="carousel-control-prev" type="button" data-bs-target="#loginSlider" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#loginSlider" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>

                </div>
            </div>

            <div class="col-lg-6 auth-form-area">
                <div class="card card-login p-4 p-md-5">
                    
                    <div class="text-center mb-4 d-lg-none">
                        <h2 class="brand-title">STUDY<span class="text-orange">strip</span></h2>
                    </div>

                    <div class="mb-4">
                        <h4 class="fw-bold" style="color: #1A1A3A;">Selamat Datang</h4>
                        <p class="text-muted small">Silakan masuk ke akun Anda untuk melanjutkan.</p>
                    </div>

                    @if($errors->any())
                        <div class="alert alert-danger" style="font-size: 13px; border-radius: 8px;">
                            <ul class="mb-0 ps-3">
                                @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('login.post') }}" method="POST" id="loginForm">
                        @csrf
                        
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted" style="border-top-left-radius: 8px; border-bottom-left-radius: 8px;"><i class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email" class="form-control border-start-0" required style="border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                            </div>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Kata Sandi</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0 text-muted" style="border-top-left-radius: 8px; border-bottom-left-radius: 8px;"><i class="fa-solid fa-lock"></i></span>
                                <input type="password" name="password" class="form-control border-start-0" required style="border-top-right-radius: 8px; border-bottom-right-radius: 8px;">
                            </div>
                        </div>

                        <div class="d-flex justify-content-between align-items-center mb-4">
                            <div class="form-check">
                                <input class="form-check-input shadow-none" type="checkbox" name="remember" id="remember">
                                <label class="form-check-label text-muted" style="font-size: 13px;" for="remember">Ingat saya</label>
                            </div>
                            <a href="{{ route('password.request') }}" class="text-decoration-none text-orange" style="font-size: 13px; font-weight: 600;">Lupa Sandi?</a>
                        </div>

                        <button type="submit" class="btn btn-primary-custom w-100" id="btnSubmit">
                            <span class="btn-text">Login</span>
                            <div class="spinner-border text-light" role="status" id="loadingSpinner"></div>
                        </button>
                    </form>

                    <div class="text-center mt-4 pt-4 border-top">
                        <p class="text-muted mb-0" style="font-size: 13px;">Belum memiliki akun? 
                            <a href="{{ route('register') }}" class="text-decoration-none text-dark fw-bold">Daftar di sini</a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>

   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Skrip Animasi Tombol Login
        document.getElementById('loginForm').addEventListener('submit', function() {
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

        // Skrip Paksaan Auto-Slide Carousel
        document.addEventListener("DOMContentLoaded", function() {
            var loginCarousel = document.getElementById('loginSlider');
            if (loginCarousel) {
                new bootstrap.Carousel(loginCarousel, {
                    interval: 3500, // Waktu slide 3.5 detik
                    ride: 'carousel', // Jalan otomatis saat halaman dimuat
                    pause: false // Matikan fitur pause saat mouse menyorot layar
                });
            }
        });
    </script>
</body>
</html>