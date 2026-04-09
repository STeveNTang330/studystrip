<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Siswa - StudyStrip</title>
    
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=3">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    
    <style>
        body {
            margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcfcfc;
            background-image: 
                radial-gradient(circle at 10% 90%, rgba(40, 167, 69, 0.4) 0%, transparent 80%),
                radial-gradient(circle at 90% 90%, rgba(249, 168, 38, 0.5) 0%, transparent 80%),
                radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.6) 0%, transparent 100%);
            min-height: 100vh; color: #333;
        }

        .glass-navbar {
            position: fixed; top: 0; left: 0; width: 100%; background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.8); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            display: flex; justify-content: space-between; align-items: center; padding: 15px 40px; box-sizing: border-box; z-index: 100;
        }
        .nav-brand { display: flex; align-items: center; gap: 15px; }
        .nav-brand h2 { margin: 0; font-family: 'Orbitron', sans-serif; font-size: 24px; letter-spacing: 1px; }
        .text-dark { color: #1A1A3A; } .text-orange { color: #F9A826; }

        .nav-right { display: flex; align-items: center; gap: 20px; }

        /* --- TAMPILAN KOIN DI NAVBAR --- */
        .coin-badge {
            background: rgba(249, 168, 38, 0.2); border: 1px solid rgba(249, 168, 38, 0.5);
            color: #E85D04; font-weight: 800; padding: 8px 15px; border-radius: 20px;
            display: flex; align-items: center; gap: 8px; font-size: 15px; box-shadow: 0 4px 10px rgba(249, 168, 38, 0.2);
        }

        .profile-dropdown { position: relative; display: inline-block; }
        .profile-toggle {
            background: transparent; border: none; font-size: 14px; font-weight: 600; color: #444;
            cursor: pointer; display: flex; align-items: center; gap: 8px; font-family: inherit; padding: 8px 15px; border-radius: 8px; transition: 0.3s;
        }
        .profile-toggle:hover { background: rgba(0, 0, 0, 0.05); }

        .dropdown-menu {
            position: absolute; right: 0; top: 110%;
            background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.9);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1); border-radius: 12px; width: 180px; display: flex; flex-direction: column;
            opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s ease; z-index: 200; overflow: hidden;
        }
        .dropdown-menu.show { opacity: 1; visibility: visible; transform: translateY(0); }
        .dropdown-item {
            padding: 12px 16px; text-decoration: none; color: #444; font-size: 13px; font-weight: 600;
            display: flex; align-items: center; gap: 10px; background: transparent; border: none; width: 100%; text-align: left; cursor: pointer; transition: 0.2s;
        }
        .dropdown-item:hover { background: rgba(249, 168, 38, 0.1); color: #F9A826; }
        .dropdown-item.text-danger:hover { background: rgba(211, 47, 47, 0.1); color: #d32f2f; }
        .dropdown-divider { height: 1px; background: rgba(0, 0, 0, 0.08); margin: 4px 0; }

        .container { max-width: 1100px; margin: 0 auto; padding: 120px 20px 50px 20px; }

        /* --- STATUS LEVEL & EXP SISWA --- */
        .student-status-card {
            background: linear-gradient(135deg, rgba(26, 26, 58, 0.9), rgba(40, 40, 80, 0.9));
            border-radius: 20px; padding: 30px; display: flex; align-items: center; justify-content: space-between;
            color: white; margin-bottom: 30px; box-shadow: 0 15px 30px rgba(26, 26, 58, 0.2);
        }
        .student-info h2 { margin: 0 0 5px 0; font-size: 24px; }
        .student-info p { margin: 0; color: #b0abc3; font-size: 14px; }
        
        .exp-container { width: 300px; }
        .exp-text { display: flex; justify-content: space-between; font-size: 13px; font-weight: bold; margin-bottom: 8px; color: #F9A826; }
        .exp-bar-bg { width: 100%; height: 10px; background: rgba(255,255,255,0.2); border-radius: 10px; overflow: hidden; }
        
        /* CSS EXP BAR YANG SUDAH DINAMIS */
        .exp-bar-fill { height: 100%; background: linear-gradient(90deg, #F9A826, #E85D04); border-radius: 10px; transition: width 0.5s ease-in-out; }

        .page-title { font-size: 22px; font-weight: 800; color: #1A1A3A; margin-bottom: 20px; }

        .glass-card {
            background: rgba(255, 255, 255, 0.5); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 16px; padding: 25px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03); cursor: pointer; transition: 0.3s ease;
        }
        .glass-card.active-menu { border: 2px solid #28a745; background: rgba(255, 255, 255, 0.8); transform: translateY(-5px); box-shadow: 0 15px 35px rgba(40, 167, 69, 0.15); }
        .glass-card:hover { transform: translateY(-5px); }
        .glass-card h3 { margin: 0 0 10px 0; font-size: 16px; color: #1A1A3A; display: flex; align-items: center; gap: 10px; }
        
        .content-panel { display: none; animation: fadeIn 0.4s ease-in-out; }
        .content-panel.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        /* --- TOMBOL HINT GAME --- */
        .btn-hint {
            background: linear-gradient(135deg, #F9A826, #E85D04); color: white; border: none; padding: 12px 25px;
            border-radius: 12px; font-weight: bold; cursor: pointer; transition: 0.3s; font-family: inherit; font-size: 15px;
            display: flex; align-items: center; gap: 10px; box-shadow: 0 5px 15px rgba(249, 168, 38, 0.4);
            margin: 0 auto;
        }
        .btn-hint:hover { transform: scale(1.05); box-shadow: 0 8px 25px rgba(249, 168, 38, 0.6); }
        .btn-hint:disabled { background: #ccc; cursor: not-allowed; transform: none; box-shadow: none; color: #888; }
        /* --- MANTRA RESPONSIVE UNTUK HP & TABLET (DASHBOARD SISWA) --- */
        @media (max-width: 768px) {
            /* 1. Rapikan Navbar */
            .glass-navbar { padding: 15px 20px; }
            .nav-brand h2 { font-size: 18px; }
            .profile-toggle span { display: none; } /* Sembunyikan nama agar tidak sesak */
            
            /* 2. Rapikan Container Utama */
            .container { padding-top: 100px; }
            
            /* 3. Rapikan Card Status (Level & EXP) */
            .student-status-card {
                flex-direction: column; text-align: center; gap: 20px; padding: 20px;
            }
            .exp-container { width: 100%; }
            
            /* 4. Jadikan Menu 3 Kolom menjadi 1 Kolom Memanjang */
            div[style*="grid-template-columns: repeat(3, 1fr)"] {
                grid-template-columns: 1fr !important;
            }
            
            /* 5. Jadikan Daftar Komik 2 Kolom di Tablet */
            div[style*="grid-template-columns: repeat(auto-fill, minmax(220px, 1fr))"] {
                grid-template-columns: 1fr 1fr !important; 
            }
        }

        /* Khusus untuk Layar HP yang sangat kecil */
        @media (max-width: 480px) {
            .student-info h2 { font-size: 20px; }
            /* Jadikan Daftar Komik 1 Kolom di HP */
            div[style*="grid-template-columns: repeat(auto-fill, minmax(220px, 1fr))"] {
                grid-template-columns: 1fr !important; 
            }
        }
    </style>
</head>
<body>

    <nav class="glass-navbar">
        <div class="nav-brand"><h2><span class="text-dark">STUDY</span><span class="text-orange">strip</span></h2></div>
        
        <div class="nav-right">
            <div class="coin-badge" id="coinDisplay">
                <i class="fa-solid fa-coins"></i> <span id="coinAmount">{{ Auth::user()->coin ?? 0 }}</span>
            </div>

            <div class="profile-dropdown">
                <button class="profile-toggle" id="profileToggle">
                    Halo, <span class="text-orange">{{ Auth::user()->name ?? 'Siswa' }}</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px;"></i>
                </button>

                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="fa-solid fa-user-pen"></i> Edit Profil
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') ?? '#' }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fa-solid fa-right-from-bracket"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        
        <div class="student-status-card">
            <div class="student-info">
                <h2>Selamat Belajar, {{ Auth::user()->name ?? 'Siswa' }}! 👋</h2>
                <p>Selesaikan komik dan puzzle untuk naik level.</p>
            </div>
            
            <div class="exp-container">
                <div class="exp-text">
                    <span>Level 1 : Pemula</span>
                    <span>{{ Auth::user()->exp ?? 0 }} / 1000 EXP</span>
                </div>
                <div class="exp-bar-bg">
                    <div class="exp-bar-fill" style="width: {{ min(((Auth::user()->exp ?? 0) / 1000) * 100, 100) }}%;"></div>
                </div>
            </div>
        </div>

        <div style="display: grid; grid-template-columns: repeat(3, 1fr); gap: 20px; margin-bottom: 30px;">
            <div class="glass-card" id="btn-materi" onclick="switchPanel('materi')">
                <h3><i class="fa-solid fa-book-open" style="color: #F9A826;"></i> Ruang Baca</h3>
                <p style="font-size: 12px; color: #555;">Baca komik interaktif yang diunggah gurumu.</p>
            </div>
            <div class="glass-card" id="btn-game" onclick="switchPanel('game')">
                <h3><i class="fa-solid fa-puzzle-piece" style="color: #6f42c1;"></i> Puzzle AI</h3>
                <p style="font-size: 12px; color: #555;">Mainkan puzzle dari potongan komik.</p>
            </div>
            <div class="glass-card" id="btn-kuis" onclick="switchPanel('kuis')">
                <h3><i class="fa-solid fa-ranking-star" style="color: #28a745;"></i> Evaluasi Kuis</h3>
                <p style="font-size: 12px; color: #555;">Uji pemahamanmu dan raih nilai terbaik.</p>
            </div>
        </div>

        <hr style="border: none; height: 1px; background: rgba(0,0,0,0.1); margin-bottom: 30px;">

        <div id="panel-materi" class="content-panel">
            <h2 class="page-title"><i class="fa-solid fa-book-open" style="color:#F9A826;"></i> Daftar Komik Tersedia</h2>
            
            @if(!isset($comics) || $comics->isEmpty())
                <div class="glass-card" style="cursor:default; text-align:center; padding:40px;">
                    <i class="fa-solid fa-book-journal-whills" style="font-size:40px; color:#ddd; margin-bottom:15px;"></i>
                    <p style="color:#888; margin:0;">Belum ada komik yang diunggah oleh guru saat ini.</p>
                </div>
            @else
                <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(220px, 1fr)); gap: 20px;">
                    @foreach($comics as $comic)
                        <div class="glass-card" style="display: flex; flex-direction: column; text-align: center; padding: 20px;">
                            
                            <div style="width: 100%; height: 120px; background: rgba(249, 168, 38, 0.1); border-radius: 12px; margin-bottom: 15px; display: flex; justify-content: center; align-items: center;">
                                <i class="fa-solid fa-book-open-reader" style="font-size: 50px; color: #E85D04;"></i>
                            </div>
                            
                            <h4 style="margin: 0 0 5px 0; color: #1A1A3A; font-size: 16px;">Bab {{ $comic->chapter_number }}</h4>
                            <p style="margin: 0 0 20px 0; font-size: 13px; color: #666; font-weight: bold; flex-grow: 1;">{{ $comic->chapter_title }}</p>
                            
                            <a href="{{ route('comic.read', $comic->id) ?? '#' }}" style="background: linear-gradient(135deg, #28a745, #20c997); color: white; padding: 10px; border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 13px; transition: 0.3s; display: block;">
                                <i class="fa-solid fa-play"></i> Mulai Membaca
                            </a>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>

        <div id="panel-game" class="content-panel">
            <h2 class="page-title"><i class="fa-solid fa-puzzle-piece" style="color:#6f42c1;"></i> Ruang Puzzle AI</h2>
            
            <div class="glass-card" style="cursor:default; text-align:center; padding:50px 40px; background: rgba(255, 255, 255, 0.6); position:relative;">
                
                <span style="position: absolute; top: 20px; right: 20px; background: rgba(111, 66, 193, 0.1); color: #6f42c1; font-size: 12px; font-weight: bold; padding: 6px 15px; border-radius: 20px;">
                    <i class="fa-solid fa-robot"></i> AI Active
                </span>

                <i class="fa-solid fa-cubes-stacked" style="font-size:60px; color:#b0abc3; margin-bottom:20px;"></i>
                <h3 style="justify-content: center; font-size: 22px;">Simulasi Papan Puzzle</h3>
                <p style="color:#666; margin:0 auto 30px auto; max-width: 500px; font-size: 14px; line-height: 1.6;">
                    Tempat gambar puzzle dirender oleh AI nantinya. Jika kamu merasa kesulitan menyusunnya, kamu bisa membeli petunjuk menggunakan koin belajarmu.
                </p>

                <button type="button" class="btn-hint" id="btnBuyHint" onclick="beliHint()">
                    <i class="fa-solid fa-lightbulb"></i> Gunakan Hint (20 Koin)
                </button>
            </div>
        </div>

        <div id="panel-kuis" class="content-panel">
            <h2 class="page-title"><i class="fa-solid fa-ranking-star" style="color:#28a745;"></i> Evaluasi Kuis</h2>
            <div class="glass-card" style="cursor:default; text-align:center; padding:40px;">
                <i class="fa-solid fa-clipboard-question" style="font-size:40px; color:#ddd; margin-bottom:15px;"></i>
                <p style="color:#888; margin:0;">Selesaikan komik terlebih dahulu untuk membuka kuis.</p>
            </div>
        </div>

    </div>

    <script>
        // --- LOGIKA PERPINDAHAN TAB ---
        function switchPanel(panelName) {
            document.querySelectorAll('.content-panel').forEach(panel => panel.classList.remove('active'));
            document.querySelectorAll('.glass-card').forEach(btn => btn.classList.remove('active-menu'));
            
            document.getElementById('panel-' + panelName).classList.add('active');
            document.getElementById('btn-' + panelName).classList.add('active-menu');
            localStorage.setItem('activeSiswaTab', panelName);
        }

        document.addEventListener("DOMContentLoaded", function() {
            let savedTab = localStorage.getItem('activeSiswaTab') || 'materi';
            switchPanel(savedTab);
        });

        // --- LOGIKA DROPDOWN PROFIL ---
        const profileToggle = document.getElementById('profileToggle');
        const dropdownMenu = document.getElementById('dropdownMenu');
        if(profileToggle && dropdownMenu) {
            profileToggle.addEventListener('click', function(e) {
                e.stopPropagation();
                dropdownMenu.classList.toggle('show');
            });
            window.addEventListener('click', function(e) {
                if (!profileToggle.contains(e.target) && !dropdownMenu.contains(e.target)) {
                    dropdownMenu.classList.remove('show');
                }
            });
        }

        // --- LOGIKA AJAX UNTUK MEMBELI HINT (TERHUBUNG KE GameController) ---
        function beliHint() {
            // Ambil CSRF Token untuk keamanan Laravel
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            let btnHint = document.getElementById('btnBuyHint');

            // Nonaktifkan tombol sementara agar tidak diklik dua kali
            btnHint.disabled = true;
            btnHint.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

            fetch('{{ route("game.buyHint") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // Update tampilan koin di navbar
                    document.getElementById('coinAmount').innerText = data.sisa_koin;
                    
                    Swal.fire({
                        icon: 'success',
                        title: 'Petunjuk Ditemukan!',
                        text: data.message + ' (Kepingan ' + data.hint.piece_id + ' diletakkan di ' + data.hint.position + ')',
                        confirmButtonColor: '#F9A826'
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Koin Tidak Cukup!',
                        text: data.message,
                        confirmButtonColor: '#d33'
                    });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Error', 'Terjadi kesalahan pada sistem.', 'error');
            })
            .finally(() => {
                // Kembalikan tombol seperti semula
                btnHint.disabled = false;
                btnHint.innerHTML = '<i class="fa-solid fa-lightbulb"></i> Gunakan Hint (20 Koin)';
            });
        }
    </script>
</body>
</html>