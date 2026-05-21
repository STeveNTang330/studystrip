@extends('layouts.master-guru')

@section('pageTitle', 'Manajemen Komik')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-1">Manajemen Komik</h4>
            <p class="text-muted mb-0">Kelola bab komik yang sudah diunggah dan tambahkan konten baru dengan mudah.</p>
        </div>
        <a href="{{ route('comic.create') }}" class="btn btn-primary fw-bold px-4" style="background-color: #F9A826; border: none; border-radius: 8px;">
            <i class="fa-solid fa-plus me-2"></i> Unggah Komik Baru
        </a>
    </div>

    <div class="card p-4 border-0 shadow-sm" style="border-radius: 16px;">
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                    <tr>
                        <th class="text-center" style="width: 5%;">No</th>
                        <th style="width: 10%;">Bab</th>
                        <th>Judul Materi</th>
                        <th>Deskripsi Singkat</th>
                        <th class="text-center">Halaman</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($comics as $index => $comic)
                    <tr>
                        <td class="text-center text-muted">{{ $index + 1 }}</td>
                        <td><span class="badge bg-primary-subtle text-primary">Bab {{ $comic->chapter_number }}</span></td>
                        <td><strong>{{ $comic->chapter_title }}</strong></td>
                        <td class="text-muted">{{ Str::limit($comic->description, 80) }}</td>
                        <td class="text-center">
                            <span class="badge bg-success-subtle text-success">{{ $comic->page_count }} halaman</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('comic.read', $comic->id) }}" class="btn btn-sm btn-outline-primary me-1" target="_blank"><i class="fa-solid fa-eye"></i></a>
                            <form action="{{ route('comic.destroy', $comic->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center py-5 text-muted">Belum ada komik. Silakan unggah materi komik baru terlebih dahulu.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
