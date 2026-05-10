<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Membaca: Bab 1 - StudyStrip</title>
    
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=4">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body {
            background: linear-gradient(to bottom, rgba(40, 20, 70, 0.4), rgba(15, 5, 40, 0.6)), 
                        url('https://img.freepik.com/free-vector/gradient-galaxy-background_23-2148983655.jpg') center/cover no-repeat fixed;
            background-color: #2b1055;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
        }

        .top-nav {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            padding: 15px 40px;
            z-index: 1000;
            display: flex;
            justify-content: space-between;
            align-items: center;
            background: rgba(0, 0, 0, 0.25);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255,255,255,0.1);
        }

        .brand-title { font-family: 'Orbitron', sans-serif; font-size: 26px; color: #fff; margin: 0; font-weight: 900; letter-spacing: 1px; text-shadow: 0 2px 10px rgba(0,0,0,0.5);}
        .text-warning-custom { color: #F9A826; }

        #book-wrapper {
            position: relative;
            margin-top: 50px; 
        }

        .flip-book { display: none; }

        .page {
            background-color: #fcfcfc;
            color: #222;
            overflow: hidden;
            box-shadow: 0 0 20px rgba(0,0,0,0.4), inset 0 0 15px rgba(0,0,0,0.05); 
            background-image: linear-gradient(to right, rgba(0,0,0,0.08) 0%, rgba(255,255,255,0.7) 10%, rgba(255,255,255,0) 30%);
        }

        .page:nth-child(even) { background-image: linear-gradient(to left, rgba(0,0,0,0.08) 0%, rgba(255,255,255,0.7) 10%, rgba(255,255,255,0) 30%); }

        .page.-cover {
            background: #2c2b45; 
            color: #fff;
            background-image: linear-gradient(120deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.4) 20%, rgba(255,255,255,0) 50%);
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
            padding: 30px;
            border: 1px solid rgba(255,255,255,0.05);
        }

        .comic-img { width: 100%; height: 100%; object-fit: cover; pointer-events: none; }
        .swal2-popup { border-radius: 20px !important; }
    </style>
</head>
<body>

    <div class="top-nav">
        <h1 class="brand-title">STUDY<span class="text-warning-custom">strip</span></h1>
        <a href="{{ route('dashboard') }}" class="btn btn-outline-light rounded-pill fw-bold px-4 shadow-sm">
            <i class="fa-solid fa-arrow-left me-2"></i> Kembali
        </a>
    </div>

    <div id="book-wrapper">
        <div class="flip-book" id="book">
            
            <div class="page -cover">
                <h5 class="fw-bold text-warning mb-2" style="letter-spacing: 2px;">EPISODE 01</h5>
                <h3 class="fw-bold mb-4">Gaya & Gravitasi</h3>
                <img src="https://img.freepik.com/free-vector/flat-gravity-background_23-2149348981.jpg" alt="Cover Komik" style="width: 85%; border-radius: 10px; border: 3px solid rgba(255,255,255,0.2); box-shadow: 0 10px 20px rgba(0,0,0,0.5);">
                <div class="mt-5 text-light" style="opacity: 0.8; font-size: 14px;">
                    <i class="fa-solid fa-hand-pointer me-2"></i>Tarik sudut kertas untuk membaca
                </div>
            </div>

            <div class="page">
                <img src="https://img.freepik.com/free-vector/comic-book-page-template-design_1017-38661.jpg" class="comic-img" alt="Halaman 1">
            </div>

            <div class="page">
                <img src="https://img.freepik.com/free-vector/comic-empty-panels-set-with-speech-bubbles-sound-effects_225004-1065.jpg" class="comic-img" alt="Halaman 2">
            </div>

            <div class="page">
                <img src="https://img.freepik.com/free-vector/comic-book-page-template-with-empty-speech-bubbles_1017-38662.jpg" class="comic-img" alt="Halaman 3">
            </div>

            <div class="page -cover">
                <i class="fa-solid fa-circle-check text-success mb-3" style="font-size: 50px;"></i>
                <h3 class="fw-bold mb-3">Bab Selesai!</h3>
                <p class="mb-5 opacity-75" style="font-size: 14px;">Kamu telah menyelesaikan materi Hukum Newton 1. Lanjutkan ke Ruang Evaluasi untuk menguji nalar rekayasamu.</p>
                <button type="button" onclick="tampilkanPopUp()" class="btn btn-warning fw-bold rounded-pill px-4 py-3 shadow-lg" style="position: relative; z-index: 9999;">
                    <i class="fa-solid fa-coins me-2"></i> Klaim Poin SEKARANG
                </button>
            </div>
            
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/page-flip/dist/js/page-flip.browser.min.js"></script>
    
    <script src="https://cdn.jsdelivr.net/npm/canvas-confetti@1.6.0/dist/confetti.browser.min.js"></script>
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const bookEl = document.getElementById('book');
            bookEl.style.display = 'block';

            // --- SISTEM AUTO-GENAP: JEDA KOSMIK ---
            let pages = document.querySelectorAll('.page');
            
            if (pages.length % 2 !== 0) {
                let blankPage = document.createElement('div');
                blankPage.className = 'page';
                
                blankPage.style.cssText = `
                    background: linear-gradient(135deg, rgba(20, 10, 40, 0.98), rgba(40, 10, 60, 0.95)) !important;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    height: 100%;
                `;
                
                blankPage.innerHTML = '<div style="opacity: 0.08; font-weight: bold; font-family: Orbitron, sans-serif; font-size: 15px; color: #fff; letter-spacing: 4px;">- JEDA KOSMIK -</div>';
                
                let lastPage = pages[pages.length - 1];
                bookEl.insertBefore(blankPage, lastPage);
            }

            const pageFlip = new St.PageFlip(bookEl, {
                width: 400, height: 550, size: "fixed", minWidth: 400, maxWidth: 400, minHeight: 550, maxHeight: 550,
                maxShadowOpacity: 0.3, 
                showCover: true, 
                mobileScrollSupport: true, 
                useMouseEvents: true, 
                flippingTime: 1400,
                usePortrait: false 
            });
            
            pageFlip.loadFromHTML(document.querySelectorAll('.page'));

            // --- SENSOR LEDAKAN CONFETTI ---
            let isConfettiFired = false; // Mencegah meledak berkali-kali

            pageFlip.on('flip', (e) => {
                // Cek apakah user mencapai 2 halaman terakhir
                if (e.data >= pageFlip.getPageCount() - 2 && !isConfettiFired) {
                    isConfettiFired = true; // Tandai sudah meledak
                    
                    // Beri jeda 0.6 detik sampai animasi buku selesai terbuka
                    setTimeout(() => {
                        confetti({
                            particleCount: 250,
                            spread: 100,
                            origin: { y: 0.6 },
                            zIndex: 10000,
                            colors: ['#F9A826', '#ffffff', '#ff6b6b', '#4ecdc4'] // Warna ala luar angkasa/StudyStrip
                        });
                    }, 600);
                }
            });
            // --------------------------------
        });

        // --- FUNGSI POP-UP KLAIM POIN ---
        function tampilkanPopUp() {
            Swal.fire({
                title: '🎉 Misi Selesai!',
                text: 'Kerja bagus, Penjelajah! Kamu mendapatkan +80 EXP.',
                icon: 'success',
                confirmButtonText: 'Kembali ke Dashboard <i class="fa-solid fa-arrow-right ms-1"></i>',
                confirmButtonColor: '#F9A826',
                background: '#ffffff',
                backdrop: `rgba(15, 5, 40, 0.8)` 
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = '/klaim-hadiah';
                }
            });
        }
    </script>
</body>
</html>