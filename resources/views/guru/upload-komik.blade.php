<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Komik - StudyStrip</title>
    
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
            min-height: 100vh; color: #333; display: flex; flex-direction: column;
        }

        .glass-navbar {
            position: fixed; top: 0; left: 0; width: 100%; background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.8); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 40px; box-sizing: border-box; z-index: 100;
        }
        .nav-brand { display: flex; align-items: center; gap: 15px; }
        .nav-brand h2 { margin: 0; font-family: 'Orbitron', sans-serif; font-size: 24px; letter-spacing: 1px; }
        .text-dark { color: #1A1A3A; } .text-orange { color: #F9A826; }
        
        .btn-back {
            text-decoration: none; color: #444; font-weight: 600; font-size: 14px;
            display: flex; align-items: center; gap: 8px; transition: 0.3s;
        }
        .btn-back:hover { color: #F9A826; }

        .container { max-width: 700px; margin: 120px auto 50px auto; padding: 0 20px; width: 100%; }

        .editor-panel {
            background: rgba(255, 255, 255, 0.5); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 20px;
            padding: 40px; box-shadow: 0 10px 40px rgba(0, 0, 0, 0.05);
        }

        .editor-panel h3 { margin: 0 0 5px 0; font-size: 22px; color: #1A1A3A; display: flex; align-items: center; gap: 10px;}
        .editor-panel p { margin: 0 0 30px 0; font-size: 14px; color: #666; }

        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; font-size: 13px; font-weight: 600; color: #444; }
        .form-group input, .form-group textarea, .form-group select {
        width: 100%; padding: 12px; box-sizing: border-box; background: rgba(255, 255, 255, 0.7); 
        border: 1px solid rgba(0, 0, 0, 0.1); border-radius: 8px; color: #333; outline: none; transition: 0.3s; font-family: inherit;
        resize: vertical; /* <--- INI KUNCI SAKTINYA */
        }
        .form-group input:focus, .form-group textarea:focus { border-color: #F9A826; background: #fff; box-shadow: 0 0 8px rgba(249, 168, 38, 0.2); }

        .upload-area {
            border: 2px dashed rgba(249, 168, 38, 0.5); border-radius: 12px; padding: 40px 20px;
            text-align: center; background: rgba(255, 255, 255, 0.3); cursor: pointer; transition: 0.3s;
        }
        .upload-area:hover { background: rgba(249, 168, 38, 0.05); border-color: #F9A826; }
        .upload-area i { font-size: 40px; color: #F9A826; margin-bottom: 15px; }
        .upload-area p { margin: 0; font-size: 14px; color: #555; }
        .upload-area span { color: #E85D04; font-weight: bold; }

        .btn-orange {
            width: 100%; background: linear-gradient(135deg, #F9A826, #E85D04); border: none;
            padding: 14px; border-radius: 8px; color: white; font-size: 16px; font-weight: bold; cursor: pointer;
            transition: 0.3s; box-shadow: 0 4px 15px rgba(249, 168, 38, 0.3); margin-top: 20px;
        }
        .btn-orange:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(249, 168, 38, 0.4); }

       .loading-overlay {
            position: fixed; top: 0; left: 0; width: 100%; height: 100%; 
            background: rgba(255, 255, 255, 0.4); /* Kaca transparan terang */
            backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px); /* Efek blur glassmorphism */
            display: flex; justify-content: center; align-items: center; z-index: 99999; 
            opacity: 0; visibility: hidden; transition: 0.4s ease;
        }
        .loading-overlay.active { opacity: 1; visibility: visible; }
        .stars-ring { width: 120px; height: 120px; position: relative; display: flex; justify-content: center; align-items: center; color: #F9A826; animation: rotateManyStars 3s linear infinite; margin-bottom: 25px; }
        .stars-ring i { font-size: 22px; position: absolute; text-shadow: 0 0 15px rgba(249, 168, 38, 0.7); }
        .star-1 { transform: rotate(0deg) translate(50px); } .star-2 { transform: rotate(72deg) translate(50px); } .star-3 { transform: rotate(144deg) translate(50px); } .star-4 { transform: rotate(216deg) translate(50px); } .star-5 { transform: rotate(288deg) translate(50px); }
        .loading-text { 
            color: #1A1A3A; font-family: 'Orbitron', sans-serif; font-size: 15px; 
            letter-spacing: 3px; animation: pulseTextMany 1.5s infinite; margin:0; text-align:center; font-weight: 800;
        }
    </style>
</head>
<body>

    <div id="loadingOverlay" class="loading-overlay active">
        <div style="display: flex; flex-direction: column; align-items: center;">
            <div class="stars-ring">
                <i class="fa fa-star star-1"></i><i class="fa fa-star star-2"></i>
                <i class="fa fa-star star-3"></i><i class="fa fa-star star-4"></i><i class="fa fa-star star-5"></i>
            </div>
            <p class="loading-text">MEMPROSES...</p>
        </div>
    </div>

    <nav class="glass-navbar">
        <div class="nav-brand">
            <h2><span class="text-dark">STUDY</span><span class="text-orange">strip</span></h2>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Batal & Kembali
        </a>
    </nav>

    <div class="container">
        <div class="editor-panel">
            <h3><i class="fa-solid fa-cloud-arrow-up" style="color: #F9A826;"></i> Upload Bab Baru</h3>
            <p>Tambahkan halaman komik baru ke dalam sistem pembelajaran.</p>

            @if(session('success'))
                <div style="background: rgba(40, 167, 69, 0.2); color: #155724; padding: 12px; border-radius: 8px; margin-bottom: 20px; font-size: 13px; border: 1px solid rgba(40, 167, 69, 0.3); text-align: center;">
                    <i class="fa-solid fa-circle-check"></i> {{ session('success') }}
                </div>
            @endif

           @if($errors->any())
            <div style="background: rgba(220, 53, 69, 0.2); color: #721c24; padding: 10px; border-radius: 8px; margin-bottom: 15px; font-size: 14px; border: 1px solid rgba(220, 53, 69, 0.3);">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('comic.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            
            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display: block; font-size: 14px; font-weight: 600; color: #444; margin-bottom: 5px;">Nomor Bab</label>
                <input type="number" name="chapter_number" placeholder="Contoh: 1" required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.1); background: rgba(255,255,255,0.7);">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display: block; font-size: 14px; font-weight: 600; color: #444; margin-bottom: 5px;">Judul Materi Baru</label>
                <input type="text" name="chapter_title" placeholder="Masukkan judul materi komik..." required style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.1); background: rgba(255,255,255,0.7);">
            </div>

            <div class="form-group" style="margin-bottom: 15px;">
                <label style="display: block; font-size: 14px; font-weight: 600; color: #444; margin-bottom: 5px;">Deskripsi Singkat (Opsional)</label>
                <textarea name="description" placeholder="Ceritakan sedikit tentang bab ini..." rows="3" style="width: 100%; padding: 12px; border-radius: 8px; border: 1px solid rgba(0,0,0,0.1); background: rgba(255,255,255,0.7);"></textarea>
            </div>

            <div class="form-group" style="margin-bottom: 25px;">
                <label style="display: block; font-size: 14px; font-weight: 600; color: #444; margin-bottom: 5px;">File Komik (Gambar / PDF)</label>
                <input type="file" name="comic_file" accept=".jpg,.jpeg,.png,.pdf" required style="width: 100%; padding: 10px; border-radius: 8px; border: 1px dashed #F9A826; background: rgba(249,168,38,0.1);">
            </div>

            <button type="submit" class="btn-orange" style="width: 100%; background: linear-gradient(135deg, #F9A826, #E85D04); border: none; padding: 15px; border-radius: 8px; color: white; font-weight: bold; cursor: pointer;">
                UNGGAH KOMIK SEKARANG
            </button>
        </form>
        </div>
    </div>

    <script>
        const loader = document.getElementById('loadingOverlay');
        window.addEventListener('load', () => loader.classList.remove('active'));

        document.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function(e) {
                if (this.href && !this.href.includes('#') && this.target !== '_blank') {
                    loader.classList.add('active');
                }
            });
        });

        // Script untuk menunjukkan form sedang diproses
        document.querySelector('form').addEventListener('submit', function() {
            loader.classList.add('active');
        });

        // Script untuk mengganti teks saat file dipilih
        document.getElementById('fileUpload').addEventListener('change', function(e) {
            var fileName = e.target.files[0].name;
            var infoText = this.previousElementSibling.querySelector('p span');
            infoText.innerHTML = "File terpilih: " + fileName;
            infoText.style.color = "#28a745"; // Warna hijau kalau file sudah dipilih
        });
    </script>
</body>
</html>