@extends('layouts.master-guru')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fs-4 mb-1">Pengaturan Akun</h2>
        <p class="text-muted">Perbarui informasi profil dan kata sandi operasional Anda di sini.</p>
    </div>
</div>

<div class="row g-4">
    <div class="col-md-6">
        <div class="card p-4 h-100">
            <h5 class="mb-4"><i class="fa-solid fa-user-pen text-primary me-2"></i> Informasi Dasar</h5>
            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control" value="{{ Auth::user()->name }}" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Email Operasional</label>
                    <input type="email" name="email" class="form-control" value="{{ Auth::user()->email }}" required>
                </div>
                <button type="submit" class="btn btn-primary w-100"><i class="fa-solid fa-floppy-disk me-2"></i> Simpan Profil</button>
            </form>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-4 h-100">
            <h5 class="mb-4"><i class="fa-solid fa-shield-halved text-success me-2"></i> Keamanan Akun</h5>
            <form action="#" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">Kata Sandi Saat Ini</label>
                    <input type="password" name="current_password" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label text-muted small fw-bold">Kata Sandi Baru</label>
                    <input type="password" name="new_password" class="form-control" required>
                </div>
                <div class="mb-4">
                    <label class="form-label text-muted small fw-bold">Konfirmasi Sandi Baru</label>
                    <input type="password" name="new_password_confirmation" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-success w-100"><i class="fa-solid fa-key me-2"></i> Perbarui Kata Sandi</button>
            </form>
        </div>
    </div>
</div>
@endsection