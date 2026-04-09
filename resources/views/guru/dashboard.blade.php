<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - StudyStrip</title>
    
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=3">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    
    <style>
        body {
            margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcfcfc;
            background-image: 
                radial-gradient(circle at 10% 90%, rgba(163, 116, 255, 0.65) 0%, transparent 80%),
                radial-gradient(circle at 90% 90%, rgba(249, 168, 38, 0.65) 0%, transparent 80%),
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

        .profile-dropdown { position: relative; display: inline-block; }
        .profile-toggle {
            background: transparent; border: none; font-size: 14px; font-weight: 600; color: #444;
            cursor: pointer; display: flex; align-items: center; gap: 8px; font-family: inherit;
            padding: 8px 15px; border-radius: 8px; transition: 0.3s;
        }
        .profile-toggle:hover { background: rgba(0, 0, 0, 0.05); }

        .dropdown-menu {
            position: absolute; right: 0; top: 110%;
            background: rgba(255, 255, 255, 0.85); backdrop-filter: blur(20px); -webkit-backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.9); box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-radius: 12px; width: 180px; display: flex; flex-direction: column;
            opacity: 0; visibility: hidden; transform: translateY(-10px); transition: all 0.3s ease; z-index: 200; overflow: hidden;
        }
        
        .dropdown-menu.show { opacity: 1; visibility: visible; transform: translateY(0); }

        .dropdown-item {
            padding: 12px 16px; text-decoration: none; color: #444; font-size: 13px; font-weight: 600;
            display: flex; align-items: center; gap: 10px; background: transparent; border: none;
            width: 100%; text-align: left; cursor: pointer; font-family: inherit; transition: background 0.2s;
        }
        .dropdown-item i { width: 16px; text-align: center; }
        .dropdown-item:hover { background: rgba(249, 168, 38, 0.1); color: #F9A826; }
        
        .dropdown-item.text-danger:hover { background: rgba(211, 47, 47, 0.1); color: #d32f2f; }
        .dropdown-divider { height: 1px; background: rgba(0, 0, 0, 0.08); margin: 4px 0; }

        .container { max-width: 1200px; margin: 0 auto; padding: 120px 20px 50px 20px; }
        .page-title { font-size: 28px; font-weight: 800; color: #1A1A3A; margin-bottom: 30px; }

        .glass-card {
            background: rgba(255, 255, 255, 0.5); backdrop-filter: blur(20px); border: 1px solid rgba(255, 255, 255, 0.8);
            border-radius: 16px; padding: 25px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.03); cursor: pointer; transition: 0.3s ease;
        }
        .glass-card.active-menu { border: 2px solid #F9A826; background: rgba(255, 255, 255, 0.8); transform: translateY(-5px); box-shadow: 0 15px 35px rgba(249, 168, 38, 0.15); }
        .glass-card:hover { transform: translateY(-5px); }
        .glass-card h3 { margin: 0 0 10px 0; font-size: 16px; color: #1A1A3A; display: flex; align-items: center; gap: 10px; }
        
        .content-panel { display: none; animation: fadeIn 0.4s ease-in-out; }
        .content-panel.active { display: block; }
        @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

        table { width: 100%; border-collapse: collapse; background: rgba(255, 255, 255, 0.5); border-radius: 12px; overflow: hidden; backdrop-filter: blur(10px); }
        th { background: rgba(249, 168, 38, 0.1); color: #E85D04; padding: 15px; text-align: left; }
        td { padding: 15px; border-bottom: 1px solid rgba(0,0,0,0.05); }
    </style>
</head>
<body>

    <nav class="glass-navbar">
        <div class="nav-brand"><h2><span class="text-dark">STUDY</span><span class="text-orange">strip</span></h2></div>
        
        <div class="nav-links">
            <div class="profile-dropdown">
                <button class="profile-toggle" id="profileToggle">
                    Halo, <span class="text-orange">{{ Auth::user()->name ?? 'Guru' }}</span>
                    <i class="fa-solid fa-chevron-down" style="font-size: 12px; margin-top: 2px;"></i>
                </button>

                <div class="dropdown-menu" id="dropdownMenu">
                    <a href="{{ route('profile.edit') }}" class="dropdown-item">
                        <i class="fa-solid fa-user-pen"></i> Edit Profil
                    </a>
                    <div class="dropdown-divider"></div>
                    <form action="{{ route('logout') ?? '#' }}" method="POST" style="margin:0;">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="fa-solid fa-right-from-bracket" style="color: #d32f2f;"></i> Keluar
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <div class="container">
        <h1 class="page-title">Dashboard Guru</h1>

        <div style="display: grid; grid-template-columns: repeat(5, 1fr); gap: 15px; margin-bottom: 30px;">
            <div class="glass-card" id="btn-welcome" onclick="switchPanel('welcome')">
                <h3><i class="fa-solid fa-house" style="color: #6c757d;"></i> Beranda</h3>
                <p style="font-size: 12px; color: #555;">Ringkasan aktivitas dan status ruang kelas Anda.</p>
            </div>
            <div class="glass-card" id="btn-komik" onclick="switchPanel('komik')">
                <h3><i class="fa-solid fa-book-open" style="color: #F9A826;"></i> Daftar Komik</h3>
                <p style="font-size: 12px; color: #555;">Kelola komik pembelajaran. Tambah, edit, atau hapus bab.</p>
            </div>
            <div class="glass-card" id="btn-siswa" onclick="switchPanel('siswa')">
                <h3><i class="fa-solid fa-users" style="color: #28a745;"></i> Data Siswa</h3>
                <p style="font-size: 12px; color: #555;">Pantau status <span style="color:#28a745;font-weight:bold;">Online</span> dan kelola murid.</p>
            </div>
            <div class="glass-card" id="btn-game" onclick="switchPanel('game')">
                <h3><i class="fa-solid fa-gamepad" style="color: #6f42c1;"></i> Studio Game</h3>
                <p style="font-size: 12px; color: #555;">Ruang pembuatan Puzzle AI interaktif.</p>
            </div>
            <div class="glass-card" id="btn-nilai" onclick="switchPanel('nilai')">
                <h3><i class="fa-solid fa-chart-line" style="color: #17a2b8;"></i> Laporan Nilai</h3>
                <p style="font-size: 12px; color: #555;">Pantau perkembangan dan perolehan nilai siswa.</p>
            </div>
        </div>

        <hr style="border: none; height: 1px; background: rgba(0,0,0,0.1); margin-bottom: 30px;">

        <div id="panel-welcome" class="content-panel">
            <h2 style="margin-top:0; color:#1A1A3A;"><i class="fa-solid fa-bell" style="color:#F9A826;"></i> Aktivitas Terkini</h2>
            <div class="glass-card" style="cursor:default; text-align:center; padding:40px;">
                <i class="fa-regular fa-bell-slash" style="font-size:40px; color:#ddd; margin-bottom:15px;"></i>
                <p style="color:#888; margin:0;">Belum ada aktivitas terbaru di kelas Anda.</p>
            </div>
        </div>

        <div id="panel-komik" class="content-panel">
            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px;">
                <h2 style="margin:0; color:#1A1A3A;"><i class="fa-solid fa-book-open" style="color:#F9A826;"></i> Manajemen Komik</h2>
                <a href="{{ route('comic.create') ?? '#' }}" style="background: linear-gradient(135deg, #F9A826, #E85D04); color: white; padding: 10px 20px; border-radius: 8px; text-decoration: none; font-weight: bold;"><i class="fa-solid fa-plus"></i> Unggah Bab Baru</a>
            </div>

            @if(!isset($comics) || (isset($comics) && $comics->isEmpty()))
                <div class="glass-card" style="cursor:default; text-align:center; padding:40px;">
                    <i class="fa-solid fa-folder-open" style="font-size:40px; color:#ddd; margin-bottom:15px;"></i>
                    <p style="color:#888; margin:0;">Belum ada bab komik yang diunggah. Silakan klik tombol "Unggah Bab Baru" di atas.</p>
                </div>
            @else
                <table>
                    <tr><th>No</th><th>Bab</th><th>Judul Materi</th><th>Aksi</th></tr>
                    @foreach($comics as $index => $comic)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td><span style="background:#1A1A3A; color:white; padding:4px 10px; border-radius:20px; font-size:12px;">Bab {{ $comic->chapter_number }}</span></td>
                        <td><b>{{ $comic->chapter_title }}</b></td>
                        <td>
                            <form action="{{ route('comic.destroy', $comic->id) }}" method="POST" class="form-hapus-komik" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" style="background:rgba(220,53,69,0.1); color:#dc3545; border:none; padding:8px 12px; border-radius:6px; cursor:pointer; transition:0.3s;" onmouseover="this.style.background='#dc3545'; this.style.color='white';" onmouseout="this.style.background='rgba(220,53,69,0.1)'; this.style.color='#dc3545';">
                                    <i class="fa-solid fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </table>
            @endif
        </div>

        <div id="panel-siswa" class="content-panel">
            <h2 style="margin-top:0; color:#1A1A3A;"><i class="fa-solid fa-users" style="color:#28a745;"></i> Pantauan Data Siswa</h2>

            @if(!isset($data_siswa) || (isset($data_siswa) && $data_siswa->isEmpty()))
                <div class="glass-card" style="cursor:default; text-align:center; padding:40px;">
                    <i class="fa-solid fa-user-slash" style="font-size:40px; color:#ddd; margin-bottom:15px;"></i>
                    <p style="color:#888; margin:0;">Belum ada siswa yang terdaftar di kelas Anda.</p>
                </div>
            
            @else
                <div style="background: rgba(255, 255, 255, 0.6); backdrop-filter: blur(10px); border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 16px; padding: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); overflow-x: auto;">
                    
                    <table style="width: 100%; border-collapse: collapse; text-align: left; font-size: 14px;">
                        <thead>
                            <tr style="background: rgba(40, 167, 69, 0.1); border-bottom: 2px solid rgba(40, 167, 69, 0.3);">
                                <th style="padding: 15px; color: #1A1A3A;">No</th>
                                <th style="padding: 15px; color: #1A1A3A; text-align: center;">Profil</th>
                                <th style="padding: 15px; color: #1A1A3A;">Nama Lengkap</th>
                                <th style="padding: 15px; color: #1A1A3A; text-align: center;">Status</th>
                                <th style="padding: 15px; color: #1A1A3A;">Total EXP</th>
                                <th style="padding: 15px; color: #1A1A3A;">Koin</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_siswa as $index => $s)
                            <tr style="border-bottom: 1px solid rgba(0,0,0,0.05); transition: 0.3s;" onmouseover="this.style.background='rgba(255,255,255,0.8)'" onmouseout="this.style.background='transparent'">
                                
                                <td style="padding: 15px; color: #555;">{{ $index + 1 }}</td>
                                
                               <td style="padding: 15px; text-align: center;">
                                    @if($s->profile_picture)
                                        <img src="{{ asset('profil/' . $s->profile_picture) }}" alt="Profil {{ $s->name }}" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                    @else
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($s->name) }}&background=random&color=fff&bold=true" alt="Avatar" style="width: 45px; height: 45px; border-radius: 50%; object-fit: cover; border: 2px solid #fff; box-shadow: 0 4px 10px rgba(0,0,0,0.1);">
                                    @endif
                                </td>
                                
                                <td style="padding: 15px; color: #333;">
                                    <span style="font-weight: bold; font-size: 15px;">{{ $s->name }}</span><br>
                                    <span style="font-size: 12px; color: #666;">{{ $s->email }}</span>
                                </td>
                                
                                <td style="padding: 15px; text-align: center;">
                                    @if($s->isOnline())
                                        <span style="background: rgba(40, 167, 69, 0.1); color: #28a745; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; border: 1px solid rgba(40, 167, 69, 0.3); display: inline-block; width: 75px;">
                                            <i class="fa-solid fa-circle" style="font-size: 8px; margin-right: 4px; animation: pulse 2s infinite;"></i> ONLINE
                                        </span>
                                    @else
                                        <span style="background: rgba(220, 53, 69, 0.1); color: #dc3545; padding: 6px 12px; border-radius: 20px; font-size: 11px; font-weight: 800; border: 1px solid rgba(220, 53, 69, 0.3); display: inline-block; width: 75px;">
                                            <i class="fa-solid fa-circle" style="font-size: 8px; margin-right: 4px;"></i> OFFLINE
                                        </span>
                                    @endif
                                </td>
                                
                                <td style="padding: 15px; color: #F9A826; font-weight: bold;">
                                    <i class="fa-solid fa-star"></i> {{ $s->exp }} EXP
                                </td>
                                
                                <td style="padding: 15px; color: #E85D04; font-weight: bold;">
                                    <i class="fa-solid fa-coins"></i> {{ $s->coin }}
                                </td>
                                
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>

        <div id="panel-game" class="content-panel">
            <h2 style="margin-top:0; color:#1A1A3A;"><i class="fa-solid fa-wand-magic-sparkles" style="color:#6f42c1;"></i> AI Puzzle Studio</h2>
            
            <div class="glass-card" style="position: relative; cursor:default; text-align:center; padding:50px 40px; background: rgba(255, 255, 255, 0.4);">
                
                <span style="position: absolute; top: 25px; right: 25px; background: #1A1A3A; color: #F9A826; font-size: 11px; font-weight: 800; padding: 6px 14px; border-radius: 20px; letter-spacing: 1px;">
                    READY FOR AI
                </span>

                <i class="fa-solid fa-puzzle-piece" style="font-size:60px; color:#b0abc3; margin-bottom:20px;"></i>
                
                <h3 style="margin-bottom: 12px; color: #1A1A3A; justify-content: center; font-size: 20px;">Puzzle Generator v1.0</h3>
                <p style="color:#666; margin:0 auto 30px auto; max-width: 550px; font-size: 14px; line-height: 1.6;">
                    Template ini siap dihubungkan ke API AI. Guru nantinya cukup memilih gambar komik, dan AI akan otomatis memotongnya menjadi kepingan puzzle interaktif untuk dimainkan siswa.
                </p>

                <button style="background: #6c757d; color: white; border: none; padding: 12px 25px; border-radius: 8px; font-weight: bold; cursor: pointer; transition: 0.3s; font-family: inherit; font-size: 14px;" 
                        onmouseover="this.style.background='#5a6268'" 
                        onmouseout="this.style.background='#6c757d'">
                    Konfigurasi API AI
                </button>

            </div>
        </div>

        <div id="panel-nilai" class="content-panel">
            <h2 style="margin-top:0; color:#1A1A3A;"><i class="fa-solid fa-chart-line" style="color:#17a2b8;"></i> Laporan Nilai Kelas</h2>
            <div class="glass-card" style="cursor:default; text-align:center; padding:40px;">
                <i class="fa-solid fa-ranking-star" style="font-size:40px; color:#ddd; margin-bottom:15px;"></i>
                <p style="color:#888; margin:0;">Belum ada data nilai kuis yang masuk. Siswa harus menyelesaikan bacaan terlebih dahulu.</p>
            </div>
        </div>

    </div>

    <script>
        function switchPanel(panelName) {
            document.querySelectorAll('.content-panel').forEach(panel => panel.classList.remove('active'));
            document.querySelectorAll('.glass-card').forEach(btn => btn.classList.remove('active-menu'));
            
            document.getElementById('panel-' + panelName).classList.add('active');
            document.getElementById('btn-' + panelName).classList.add('active-menu');

            localStorage.setItem('activeDashboardTab', panelName);
        }

        document.addEventListener("DOMContentLoaded", function() {
            let savedTab = localStorage.getItem('activeDashboardTab') || 'welcome';
            switchPanel(savedTab);
        });

        document.querySelectorAll('.form-hapus-komik').forEach(form => {
            form.addEventListener('submit', function(e) {
                e.preventDefault(); 
                
                Swal.fire({
                    title: 'Hapus Bab Ini?',
                    text: "Data dan file komik ini akan musnah permanen dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#888',
                    confirmButtonText: '<i class="fa-solid fa-trash"></i> Ya, Musnahkan!',
                    cancelButtonText: 'Batal',
                    background: '#ffffff',
                    backdrop: 'rgba(0,0,0,0.4)'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); 
                    }
                })
            });
        });

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
    </script>

    @if(session('success'))
        <script>
            document.addEventListener("DOMContentLoaded", function() {
                Swal.fire({
                    icon: 'success',
                    title: 'Berhasil!',
                    text: "{!! session('success') !!}",
                    confirmButtonColor: '#F9A826',
                    background: '#ffffff' 
                });
            });
        </script>
    @endif

</body>
</html>