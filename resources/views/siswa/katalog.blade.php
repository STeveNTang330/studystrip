<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Katalog Komik - StudyStrip</title>
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Nunito:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { background: linear-gradient(135deg, #b8d8b4 0%, #e8d3a7 50%, #e3b382 100%); font-family: 'Nunito', sans-serif; padding-top: 85px; padding-bottom: 50px; min-height: 100vh;}
        .webtoon-nav { background-color: rgba(255, 255, 255, 0.6); backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); padding: 15px 0; border-bottom: 1px solid rgba(255,255,255,0.5); position: fixed; width: 100%; top: 0; z-index: 1050; box-shadow: 0 4px 20px rgba(0,0,0,0.03); }
        .brand-title { font-family: 'Orbitron', sans-serif; font-size: 24px; color: #2c2b45; margin: 0; font-weight: 900;}
        .text-orange { color: #F9A826; }
        .glass-card { background: rgba(255, 255, 255, 0.45); backdrop-filter: blur(12px); -webkit-backdrop-filter: blur(12px); border-radius: 20px; border: 1px solid rgba(255, 255, 255, 0.7); box-shadow: 0 8px 32px rgba(0,0,0,0.04); overflow: hidden; transition: 0.3s; }
        .coin-badge { background-color: rgba(255, 255, 255, 0.8); color: #d35400; padding: 6px 16px; border-radius: 20px; font-weight: bold; border: 1px solid white; box-shadow: 0 2px 10px rgba(0,0,0,0.05); }
        .progress-custom { height: 8px; background-color: rgba(0,0,0,0.1); border-radius: 4px; }
        .progress-bar-custom { background-color: #F9A826; border-radius: 4px; }
        .comic-thumbnail { width: 100%; aspect-ratio: 3/4; object-fit: cover; border-radius: 12px; margin-bottom: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); transition: 0.3s; }
        .comic-item:hover .comic-thumbnail { transform: translateY(-5px); box-shadow: 0 8px 20px rgba(0,0,0,0.15); }
        .comic-title { font-weight: 800; color: #2c2b45; font-size: 16px; margin-bottom: 4px; line-height: 1.2; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
        .rank-item { display: flex; align-items: center; padding: 12px; border-bottom: 1px solid rgba(0,0,0,0.05); }
        .rank-item:last-child { border-bottom: none; }
        .rank-number { font-weight: 900; font-size: 18px; width: 30px; text-align: center;}
        .rank-1 { color: #F9A826; font-size: 22px; } .rank-2 { color: #9E9E9E; } .rank-3 { color: #CD7F32; }
    </style>
</head>
<body>

    <nav class="webtoon-nav">
        <div class="container d-flex justify-content-between align-items-center">
            
            <div class="d-flex align-items-center gap-4">
                <h1 class="brand-title m-0">STUDY<span class="text-orange">strip</span></h1>
                
                <div class="d-none d-lg-flex align-items-center gap-4 ms-4 mt-1">
                    <a class="text-decoration-none fw-bold text-secondary transition" href="{{ url('/dashboard') }}" style="font-size: 15px; padding-bottom: 4px;">
                        Beranda
                    </a>
                    <a class="text-decoration-none fw-bold text-secondary transition" href="#" style="font-size: 15px; padding-bottom: 4px;">
                        <i class="fa-solid fa-puzzle-piece me-1"></i> Puzzle Interaktif
                    </a>
                    <a class="text-decoration-none fw-bold text-secondary transition" href="{{ url('/siswa/kuis') }}" style="font-size: 15px; padding-bottom: 4px;">
                        <i class="fa-solid fa-list-check me-1"></i> Kuis Akhir Bab
                    </a>
                    
                    <a class="text-decoration-none fw-bold text-dark" href="{{ url('/siswa/katalog') }}" style="font-size: 15px; border-bottom: 2px solid #F9A826; padding-bottom: 4px;">
                        Katalog Komik
                    </a>
                    
                    <a class="text-decoration-none fw-bold text-secondary transition" href="{{ url('/siswa/pengumuman') }}" style="font-size: 15px; padding-bottom: 4px;">
                        <i class="fa-solid fa-bullhorn me-1"></i> Pengumuman
                    </a>
                </div>
            </div>

            <div class="d-flex align-items-center gap-3">
                <div class="coin-badge"><i class="fa-solid fa-bolt text-warning me-1"></i> {{ Auth::user()->coins ?? 120 }} Koin</div>
                <div class="dropdown">
                    <button class="btn btn-sm btn-dark rounded-pill fw-bold px-3 dropdown-toggle" type="button" data-bs-toggle="dropdown">
                        <i class="fa-solid fa-user me-1"></i> {{ explode(' ', Auth::user()->name ?? 'Siswa')[0] }}
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end border-0 shadow-lg rounded-4 mt-2">
                        <li><a class="dropdown-item fw-bold py-2" href="{{ route('profile.edit') }}"><i class="fa-solid fa-gear me-2"></i>Pengaturan</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <form action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item fw-bold text-danger py-2"><i class="fa-solid fa-right-from-bracket me-2"></i>Keluar</button>
                            </form>
                        </li>
                    </ul>
                </div>
            </div>

        </div>
    </nav>

    <div class="container mt-3">
        <div class="row g-4">
            
            <div class="col-lg-8">
                <div class="d-flex align-items-center mb-4 pt-2">
                    <div class="bg-primary bg-opacity-25 p-3 rounded-circle me-3">
                        <i class="fa-solid fa-book-open fs-3 text-primary"></i>
                    </div>
                    <div>
                        <h4 class="fw-bold m-0 text-dark">Katalog Komik</h4>
                        <span class="text-muted small">Jelajahi berbagai materi seru yang tersedia!</span>
                    </div>
                </div>

                <div class="glass-card p-4">
                    <div class="row g-4">
                        <div class="col-6 col-md-4 comic-item">
                            <a href="{{ url('/tes-buku') }}" class="text-decoration-none">
                                <div class="position-relative">
                                    <img src="https://img.freepik.com/free-vector/flat-gravity-background_23-2149348981.jpg" class="comic-thumbnail" alt="Cover">
                                    <span class="badge bg-danger position-absolute top-0 start-0 m-2">Baru</span>
                                </div>
                                <div class="comic-title">Bab 1: Gaya & Gravitasi</div>
                                <div class="text-muted small fw-bold"><i class="fa-solid fa-star text-warning"></i> 9.8 • Fisika</div>
                            </a>
                        </div>
                        
                        <div class="col-6 col-md-4 comic-item" style="opacity: 0.6;">
                            <div class="position-relative">
                                <img src="https://img.freepik.com/free-vector/flat-science-concept_23-2148530751.jpg" class="comic-thumbnail" alt="Cover">
                                <span class="badge bg-dark position-absolute top-50 start-50 translate-middle"><i class="fa-solid fa-lock"></i></span>
                            </div>
                            <div class="comic-title">Bab 2: Aksi Reaksi</div>
                            <div class="text-danger small fw-bold"><i class="fa-solid fa-circle-exclamation"></i> Selesaikan Bab 1</div>
                        </div>

                        </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="glass-card p-4 mb-4 text-center mt-2">
                    <img src="{{ Auth::user()->profile_picture ? asset('profil/'.Auth::user()->profile_picture) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}" 
                         class="rounded-circle mb-3 bg-white" style="width: 80px; height: 80px; object-fit: cover; border: 3px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                    <h5 class="fw-bold text-dark mb-1">{{ Auth::user()->name ?? 'Penjelajah' }}</h5>
                    <div class="badge bg-dark rounded-pill px-3 py-2 mb-3">Level {{ Auth::user()->level ?? 1 }} : Pemula</div>
                    <div class="text-start">
                        <div class="d-flex justify-content-between fw-bold small text-muted mb-1">
                            <span>EXP Terkumpul</span>
                            <span class="text-orange">{{ Auth::user()->exp ?? 60 }} / 100</span>
                        </div>
                        <div class="progress-custom">
                            <div class="progress-bar-custom h-100" style="width: {{ ((Auth::user()->exp ?? 60) / 100) * 100 }}%;"></div>
                        </div>
                    </div>
                </div>

                <div class="glass-card p-3">
                    <h6 class="fw-bold text-center mt-2 mb-3" style="color: #2c2b45;">
                        <i class="fa-solid fa-trophy text-warning me-2"></i> Top Penjelajah
                    </h6>
                    @foreach($top_siswa as $index => $siswa)
                        <div class="rank-item {{ $siswa->id == Auth::id() ? 'bg-warning bg-opacity-10 rounded-3' : '' }}">
                            <div class="rank-number rank-{{ $index + 1 }}">{{ $index + 1 }}</div>
                            <img src="{{ $siswa->profile_picture ? asset('profil/'.$siswa->profile_picture) : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}" 
                                 class="rounded-circle mx-2" style="width: 40px; height: 40px; object-fit: cover;">
                            <div class="flex-grow-1">
                                <div class="fw-bold text-dark lh-sm">{{ $siswa->name }} @if($siswa->id == Auth::id()) <span class="badge bg-primary ms-1" style="font-size: 9px;">KAMU</span> @endif</div>
                                <div class="text-muted" style="font-size: 11px;">Level {{ $siswa->level ?? 1 }}</div>
                            </div>
                            <div class="fw-bold text-success small">{{ $siswa->exp ?? 0 }} EXP</div>
                        </div>
                    @endforeach
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>