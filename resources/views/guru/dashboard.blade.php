@extends('layouts.master-guru')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="mb-6">
            <h1 class="fs-3">Halo, {{ Auth::user()->name }}</h1>
            <p>Selamat datang di Pusat Kendali StudyStrip. Kelola materi komik dan pantau siswa di sini.</p>
        </div>
    </div>
</div>

<div class="row g-6">
    <div class="col-xl-8 col-12">
        <div class="card card-lg">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Daftar Materi Komik</h5>
                </div>
            <div class="table-responsive">
                <table class="table text-nowrap mb-0 table-centered table-hover">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Bab</th>
                            <th>Judul Materi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody> @forelse($comics ?? [] as $index => $comic)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td><span class="badge bg-primary-subtle text-primary">Bab {{ $comic->chapter_number }}</span></td>
                            <td><strong>{{ $comic->chapter_title }}</strong></td>
                            <td>
                                <form action="{{ route('comic.destroy', $comic->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-white btn-sm text-danger border shadow-sm">Hapus</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-4 text-muted">Belum ada komik yang diunggah.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <div class="col-xl-4 col-12 mt-4 mt-xl-0">
        <div class="card card-lg h-100">
            <div class="card-body">
                <h5 class="mb-4">Siswa Online</h5>
<div class="d-flex flex-column gap-4">
    @forelse($siswa_online ?? [] as $s)
    <div class="d-flex justify-content-between align-items-center border-bottom pb-2">
        <div class="d-flex align-items-center gap-2">
            <span class="fw-bold">{{ $s->name }}</span>
        </div>
        @if($s->isOnline())
            <span class="badge bg-success rounded-pill px-3">Online</span>
        @else
            <span class="badge bg-secondary rounded-pill px-3">Offline</span>
        @endif
    </div>
    @empty
        <p class="text-muted">Belum ada siswa.</p>
    @endforelse
</div>
            </div>
        </div>
    </div>
</div>
@endsection