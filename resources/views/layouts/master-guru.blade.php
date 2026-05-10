<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Guru - StudyStrip</title>

    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=4">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <style>
        body { background-color: #f5f7f9; color: #333; }

        /* Desain Sidebar */
        .sidebar-admin {
            width: 260px; height: 100vh; position: fixed; top: 0; left: 0;
            z-index: 1000; border-right: 1px solid #eaeaea; background: #ffffff;
            box-shadow: 2px 0 10px rgba(0,0,0,0.02);
        }

        /* Desain Area Konten */
        .main-content { margin-left: 260px; min-height: 100vh; display: flex; flex-direction: column;}

        /* Desain Topbar */
        .topbar-admin {
            background: #ffffff; border-bottom: 1px solid #eaeaea;
            padding: 15px 30px; box-shadow: 0 2px 10px rgba(0,0,0,0.02);
        }

        /* Desain Menu Link */
        .nav-admin {
            color: #555; font-weight: 600; 
            padding: 12px 15px;
            border-radius: 8px; margin: 0 15px 8px 15px;
            display: flex; align-items: center;
            text-decoration: none; transition: 0.3s;
            font-size: 0.95rem;
            white-space: nowrap;
            overflow: hidden; 
            text-overflow: ellipsis;
        }

        .nav-admin:hover, .nav-admin.active {
            background: rgba(249, 168, 38, 0.1); color: #F9A826;
        }

        /* Perbaikan Kartu & Tabel */
        .card { border: none !important; box-shadow: 0 5px 20px rgba(0,0,0,0.04) !important; border-radius: 12px !important; }
        .card-header { background: transparent !important; border-bottom: 1px solid #f0f0f0 !important; }
        .table th { background-color: #f8f9fa !important; font-weight: 600; color: #555; }
    </style>
</head>
<body>
    <div class="sidebar-admin">
        <div class="p-4 text-center border-bottom mb-4">
            <h3 class="m-0 fw-bold" style="color: #1A1A3A; font-family: 'Orbitron', sans-serif;">STUDY<span style="color: #F9A826;">strip</span></h3>
        </div>

        <div>
            <div class="text-muted small fw-bold px-3 mb-2 mt-3" style="font-size: 11px; letter-spacing: 1px;">MENU UTAMA</div>
            <a href="{{ route('dashboard') }}" class="nav-admin {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                Beranda
            </a>

            <div class="text-muted small fw-bold px-3 mb-2 mt-4" style="font-size: 11px; letter-spacing: 1px;">MANAJEMEN KONTEN</div>
            <a href="{{ url('/guru/kategori') }}" class="nav-admin {{ request()->is('guru/kategori*') ? 'active' : '' }}">
                Kategori & Genre
            </a>
            <a href="{{ route('comic.create') }}" class="nav-admin {{ request()->is('upload-komik*') || request()->is('guru/komik*') ? 'active' : '' }}">
                Manajemen Komik
            </a>
            <a href="{{ url('/guru/kuis') }}" class="nav-admin {{ request()->is('guru/kuis*') ? 'active' : '' }}">
                Manajemen Kuis & Misi
            </a>

            <div class="text-muted small fw-bold px-3 mb-2 mt-4" style="font-size: 11px; letter-spacing: 1px;">PEMANTAUAN & INTERAKSI</div>
            <a href="{{ route('guru.nilai') }}" class="nav-admin {{ request()->is('guru/nilai*') ? 'active' : '' }}">
                Tabel Nilai Siswa
            </a>
            <a href="{{ url('/guru/pengumuman') }}" class="nav-admin {{ request()->is('guru/pengumuman*') ? 'active' : '' }}">
                Pusat Pengumuman
            </a>
        </div>
    </div>
    
    <div class="main-content">
        <div class="topbar-admin d-flex justify-content-end align-items-center">
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle fw-bold shadow-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false" style="border-radius: 20px; padding: 8px 20px;">
                    <i class="fa-solid fa-user-circle fs-5 me-2 align-middle text-secondary"></i>
                    {{ Auth::user()->name ?? 'Guru' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="dropdownMenuButton" style="border-radius: 12px; min-width: 200px;">
                    <li>
                        <a class="dropdown-item py-2 fw-bold text-secondary" href="{{ route('guru.pengaturan') }}">
                            <i class="fa-solid fa-user-gear me-2"></i> Pengaturan Profil
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form action="{{ route('logout') }}" method="POST" class="m-0 p-0">
                            @csrf
                            <button type="submit" class="dropdown-item py-2 fw-bold text-danger">
                                <i class="fa-solid fa-right-from-bracket me-2"></i> Keluar
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>

        <div class="p-4 p-md-5">
            @yield('content')
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    @if(session()->has('success'))
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{!! session('success') !!}",
                showConfirmButton: true,
                confirmButtonColor: '#F9A826',
                background: '#ffffff',
                color: '#333'
            });
        });
    </script>
    @endif
    @if($errors->any())
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            Swal.fire({
                icon: 'error',
                title: 'Oops... Gagal!',
                html: '<ul style="text-align: left;">@foreach($errors->all() as $error) <li class="text-danger">{{ $error }}</li> @endforeach</ul>',
                confirmButtonColor: '#dc3545'
            });
        });
    </script>
    @endif
</body>
</html>