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
        body { background-color: #eef2f7; color: #1f2946; }

        /* Desain Sidebar */
        .sidebar-admin {
            width: 280px; height: 100vh; position: fixed; top: 0; left: 0;
            z-index: 1000; border-right: 1px solid rgba(145, 158, 171, 0.16);
            background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
            box-shadow: 2px 0 20px rgba(56, 65, 89, 0.08);
        }

        .sidebar-admin .brand {
            padding: 28px 24px; text-align: left;
        }

        .sidebar-admin .brand h3 {
            margin: 0; font-family: 'Orbitron', sans-serif; font-size: 24px; letter-spacing: 1px;
            color: #171c35;
        }

        .sidebar-admin .brand small {
            display: block; margin-top: 6px; color: #7b8191; font-size: 13px;
        }

        .sidebar-admin .menu-section {
            margin-top: 18px;
        }

        .sidebar-admin .menu-label {
            color: #7b8191; font-size: 11px; letter-spacing: 1px; padding: 0 24px; margin-top: 18px;
        }

        .sidebar-admin .nav-admin {
            color: #4b5563; font-weight: 700;
            padding: 14px 22px; margin: 0 12px 6px 12px;
            border-radius: 14px; display: flex; align-items: center;
            text-decoration: none; transition: all 0.25s ease;
            font-size: 0.95rem; background: #ffffff;
            box-shadow: 0 6px 18px rgba(102, 113, 134, 0.06);
        }

        .sidebar-admin .nav-admin:hover {
            transform: translateX(2px);
            background: rgba(249, 168, 38, 0.1);
            color: #d97706;
        }

        .sidebar-admin .nav-admin.active {
            background: #fff3e0; color: #b45309;
            box-shadow: inset 4px 0 0 #F9A826, 0 10px 24px rgba(249, 168, 38, 0.12);
        }

        .main-content { margin-left: 280px; min-height: 100vh; display: flex; flex-direction: column; }

        .topbar-admin {
            background: rgba(255, 255, 255, 0.95); border-bottom: 1px solid rgba(145,158,171,0.16);
            padding: 16px 32px; position: sticky; top: 0; z-index: 900;
            backdrop-filter: blur(12px);
            display: flex; justify-content: space-between; align-items: center;
        }

        .topbar-admin .page-title {
            font-size: 1rem; font-weight: 700; color: #1f2946;
        }

        .topbar-admin .dropdown-toggle {
            border-radius: 28px; padding: 8px 22px; box-shadow: 0 8px 20px rgba(15,23,42,0.08);
        }

        .card { border: none !important; box-shadow: 0 12px 30px rgba(15, 23, 42, 0.06) !important; border-radius: 18px !important; }
        .card-header { background: transparent !important; border-bottom: 1px solid #eef2f7 !important; }
        .table th { background-color: #f8fafc !important; font-weight: 700 !important; color: #3f4b63; }
        .table td, .table th { vertical-align: middle; }

        .breadcrumb-admin {
            padding: 0; margin: 0; list-style: none; display: flex; gap: 10px;
            color: #64748b; font-size: 0.9rem;
        }

        .breadcrumb-admin li a {
            color: #64748b; text-decoration: none;
        }

        .breadcrumb-admin li::after {
            content: '/'; margin: 0 8px; color: #cbd5e1;
        }

        .breadcrumb-admin li:last-child::after { content: ''; }
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
            <a href="{{ route('guru.komik.index') }}" class="nav-admin {{ request()->is('guru/komik*') ? 'active' : '' }}">
                Manajemen Komik
            </a>
            <a href="{{ route('comic.create') }}" class="nav-admin {{ request()->is('upload-komik*') ? 'active' : '' }}">
                Unggah Komik
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
            <a href="{{ route('guru.chat') }}" class="nav-admin {{ request()->routeIs('guru.chat') ? 'active' : '' }}">
                Pusat Pesan (Chat)
            </a>
        </div>
    </div>
    
    <div class="main-content">
        <div class="topbar-admin">
            <div>
                <div class="page-title">@yield('pageTitle', 'Dashboard Guru')</div>
                <ul class="breadcrumb-admin mt-2">
                    <li><a href="{{ route('dashboard') }}">Beranda</a></li>
                    <li>@yield('pageTitle', 'Dashboard')</li>
                </ul>
            </div>
            <div class="dropdown">
                <button class="btn btn-light dropdown-toggle fw-bold shadow-sm" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user-circle fs-5 me-2 align-middle text-secondary"></i>
                    {{ Auth::user()->name ?? 'Guru' }}
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow border-0 mt-2" aria-labelledby="dropdownMenuButton" style="border-radius: 12px; min-width: 220px;">
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