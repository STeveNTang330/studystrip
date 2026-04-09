<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Baca Komik - StudyStrip</title>
    
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=3">

    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <style>
        /* Perbaikan Latar Belakang (Sesuai Konsep) */
        body {
            margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcfcfc;
            background-image: 
                radial-gradient(circle at 10% 90%, rgba(163, 116, 255, 0.4) 0%, transparent 80%),
                radial-gradient(circle at 90% 90%, rgba(249, 168, 38, 0.4) 0%, transparent 80%),
                radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.6) 0%, transparent 100%);
            min-height: 100vh; color: #333;
        }

        /* --- NAVBAR GLASSMORPHISM --- */
        .glass-navbar {
            position: fixed; top: 0; left: 0; width: 100%; background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.8); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            display: flex; justify-content: space-between; align-items: center; padding: 15px 40px; box-sizing: border-box; z-index: 100;
        }
        .nav-title { font-size: 18px; font-weight: bold; margin: 0; color: #1A1A3A; }
        .text-orange { color: #F9A826; }
        
        .btn-back {
            text-decoration: none; color: #444; font-weight: 600; font-size: 14px;
            display: flex; align-items: center; gap: 8px; transition: 0.3s;
        }
        .btn-back:hover { color: #F9A826; }

        /* --- WADAH UTAMA --- */
        .comic-container {
            max-width: 800px; margin: 100px auto 50px auto; 
            background: rgba(255, 255, 255, 0.8); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.9); border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0,0,0,0.08);
            overflow: hidden; text-align: center;
            display: flex; flex-direction: column;
        }

        /* Perbaikan Template Placeholder AI Komik */
        .ai-placeholder {
            width: 100%; min-height: 600px; 
            background: repeating-linear-gradient(
                45deg,
                rgba(249, 168, 38, 0.03),
                rgba(249, 168, 38, 0.03) 10px,
                rgba(255, 255, 255, 0.5) 10px,
                rgba(255, 255, 255, 0.5) 20px
            );
            display: flex; flex-direction: column; justify-content: center; align-items: center;
            border-bottom: 2px dashed rgba(0,0,0,0.1); padding: 40px; box-sizing: border-box;
        }

        .ai-badge {
            background: rgba(111, 66, 193, 0.1); color: #6f42c1; font-size: 14px; font-weight: bold;
            padding: 8px 20px; border-radius: 20px; margin-bottom: 20px;
            display: inline-flex; align-items: center; gap: 8px; border: 1px solid rgba(111, 66, 193, 0.3);
        }

        /* --- TOMBOL KLAIM HADIAH --- */
        .reward-section { padding: 40px 20px; background: rgba(255, 255, 255, 0.5); }
        .btn-claim {
            background: linear-gradient(135deg, #28a745, #20c997); color: white;
            border: none; padding: 15px 35px; border-radius: 50px; font-size: 16px; font-weight: bold;
            cursor: pointer; box-shadow: 0 8px 20px rgba(40, 167, 69, 0.3); transition: 0.3s;
            display: inline-flex; align-items: center; gap: 10px; font-family: inherit;
        }
        .btn-claim:hover { transform: translateY(-3px); box-shadow: 0 12px 25px rgba(40, 167, 69, 0.5); }
        .btn-claim:disabled { background: #ccc; cursor: not-allowed; transform: none; box-shadow: none; }
        /* --- MANTRA RESPONSIVE UNTUK HP & TABLET (BACA KOMIK) --- */
        @media (max-width: 768px) {
            /* 1. Sesuaikan Navbar dan Judul */
            .glass-navbar { padding: 15px 20px; }
            .nav-title { font-size: 14px; text-align: center; line-height: 1.4; }
            .btn-back span { display: none; } /* Sembunyikan tulisan 'kembali', sisakan ikon panah */
            
            /* 2. Sesuaikan Lebar Kertas Komik */
            .comic-container { margin: 80px 15px 30px 15px; border-radius: 12px; }
            .ai-placeholder { padding: 20px; min-height: 400px; }
            .ai-placeholder i { font-size: 50px; }
            
            /* 3. Tombol Klaim Hadiah jadi Lebar Penuh (Full Width) */
            .btn-claim { width: 100%; justify-content: center; }
            .reward-section h3 { font-size: 18px; }
        }
    </style>
</head>
<body>

    <nav class="glass-navbar">
        <a href="{{ route('dashboard') }}" class="btn-back"><i class="fa-solid fa-arrow-left"></i> Kembali</a>
        <h2 class="nav-title">Bab {{ $comic->chapter_number }} : <span class="text-orange">{{ $comic->chapter_title }}</span></h2>
        <div style="width: 80px;"></div> </nav>

    <div class="comic-container">
        
        <div class="ai-placeholder" id="comic-render-area">
            <div class="ai-badge"><i class="fa-solid fa-wand-magic-sparkles"></i> AI Comic Renderer</div>
            <i class="fa-regular fa-image" style="font-size: 80px; color: #ddd; margin-bottom: 20px;"></i>
            <h3 style="color: #1A1A3A; margin: 0 0 10px 0;">Menunggu API AI...</h3>
            <p style="color: #666; font-size: 14px; max-width: 400px; margin: 0; line-height: 1.6;">
                Area ini sudah disiapkan. Nanti saat kamu berlangganan, hasil <i>generate</i> komik dari AI akan otomatis disuntikkan dan memanjang ke bawah di dalam kotak ini.
            </p>
        </div>
        
        <div class="reward-section">
            <h3 style="color: #1A1A3A; margin-top: 0; font-size: 22px;">Sudah selesai membaca?</h3>
            <p style="color: #666; font-size: 14px; margin-bottom: 25px;">Klaim hadiah belajarmu untuk membeli petunjuk di ruang Puzzle AI!</p>
            
            <button class="btn-claim" id="btnClaim" onclick="klaimHadiah()">
                <i class="fa-solid fa-gift"></i> Selesai Membaca & Klaim Hadiah!
            </button>
        </div>

    </div>

    <script>
        function klaimHadiah() {
            let btn = document.getElementById('btnClaim');
            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            // Ubah tombol jadi loading
            btn.disabled = true;
            btn.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Memproses...';

            fetch('{{ route("comic.claim", $comic->id) }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                }
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    // JIKA SUKSES DAPAT KOIN
                    Swal.fire({
                        title: 'Horeee!',
                        text: data.message,
                        icon: 'success', 
                        confirmButtonText: 'Lanjut Main Puzzle!',
                        confirmButtonColor: '#F9A826',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('dashboard') }}";
                        }
                    });
                } else {
                    // JIKA DITOLAK (KARENA SPAM)
                    Swal.fire({
                        title: 'Eits!',
                        text: data.message,
                        icon: 'warning', 
                        confirmButtonText: 'Kembali ke Dashboard',
                        confirmButtonColor: '#d33',
                        allowOutsideClick: false
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = "{{ route('dashboard') }}";
                        }
                    });
                    
                    // Kembalikan tombol ke bentuk semula agar tidak nyangkut
                    btn.disabled = false;
                    btn.innerHTML = '<i class="fa-solid fa-gift"></i> Selesai Membaca & Klaim Hadiah!';
                }
            })
            .catch(error => {
                console.error('Error:', error);
                Swal.fire('Oops!', 'Terjadi kesalahan sistem. Cek terminalmu.', 'error');
                
                // Kembalikan tombol ke bentuk semula jika error
                btn.disabled = false;
                btn.innerHTML = '<i class="fa-solid fa-gift"></i> Selesai Membaca & Klaim Hadiah!';
            });
        }
    </script>
</body>
</html>