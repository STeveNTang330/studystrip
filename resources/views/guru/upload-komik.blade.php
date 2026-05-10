@extends('layouts.master-guru')

@section('content')
<div class="row mb-4 align-items-center">
    <div class="col-md-8">
        <h4>Studio Perakitan Komik</h4>
        <p class="text-muted mb-0">Rancang bab komik interaktif menggunakan skenario (prompt) dan aset visual pilihan.</p>
    </div>
    <div class="col-md-4 text-md-end mt-3 mt-md-0">
        <a href="{{ route('dashboard') }}" class="btn btn-light border shadow-sm"><i class="fa-solid fa-arrow-left me-2"></i> Kembali</a>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card p-4 p-md-5 border-0 shadow-sm" style="border-radius: 16px;">
            
            @if($errors->any())
                <div class="alert alert-danger rounded-3" style="font-size: 14px;">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('comic.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                
                <h5 class="fw-bold mb-4 border-bottom pb-2">1. Informasi Dasar Bab</h5>
                
                <div class="row g-3 mb-4">
                    <div class="col-md-3">
                        <label class="form-label fw-bold text-muted small">Nomor Bab</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light"><i class="fa-solid fa-hashtag"></i></span>
                            <input type="number" name="chapter_number" class="form-control" placeholder="Contoh: 1" required>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <label class="form-label fw-bold text-muted small">Judul Materi</label>
                        <input type="text" name="title" class="form-control" placeholder="Contoh: Menjelajah Hukum Newton" required>
                    </div>
                </div>

                <div class="mb-4">
                    <label class="form-label fw-bold text-muted small">Deskripsi / Sinopsis</label>
                    <textarea name="description" class="form-control" rows="3" placeholder="Tuliskan ringkasan cerita atau materi fisika yang akan dibahas..." required></textarea>
                </div>

                <h5 class="fw-bold mb-3 mt-5 border-bottom pb-2 text-primary"><i class="fa-solid fa-pen-nib me-2"></i> 2. Penyusunan Panel & Visual</h5>
                
                <div class="p-4 mb-4 rounded-3" style="background-color: #f8f9fa; border: 1px solid #eaeaea;">
                    <label class="form-label fw-bold" style="color: #1A1A3A;">
                        <i class="fa-regular fa-comment-dots me-2 text-primary"></i> Skenario / Prompt Dialog
                    </label>
                    <textarea name="prompt_script" class="form-control shadow-none" rows="4" placeholder="Contoh: Karakter utama berdiri di depan papan tulis yang menampilkan rumus F=m.a, lalu sebuah apel jatuh dari atas..." required></textarea>
                    <div class="form-text mt-2 text-muted" style="font-size: 12px;">
                        Tuliskan instruksi adegan dan teks percakapan (balon kata) yang akan ditampilkan di dalam panel komik ini.
                    </div>
                </div>

                <div class="p-4 mb-5 rounded-3" style="background-color: #f0f4f8; border: 1px dashed #adb5bd;">
                    <label class="form-label fw-bold text-dark">
                        <i class="fa-solid fa-shapes me-2 text-success"></i> Upload Aset Visual (Tema / Karakter)
                    </label>
                    <div class="input-group mb-2">
                        <input type="file" name="visual_assets[]" class="form-control" id="assetUpload" accept="image/*" multiple required>
                        <label class="input-group-text bg-white text-success fw-bold" for="assetUpload">Jelajahi File</label>
                    </div>
                    <div class="form-text" style="font-size: 12px;">
                        Unggah gambar latar belakang atau karakter (misalnya dari <b>Kenney.nl</b>). Anda dapat memilih lebih dari satu file sekaligus.
                    </div>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="reset" class="btn btn-light border fw-bold px-4">Bersihkan</button>
                    <button type="submit" class="btn btn-primary fw-bold px-4" style="background-color: #F9A826; border: none; color: white;">
                        <i class="fa-solid fa-cloud-arrow-up me-2"></i> Rakit & Simpan Komik
                    </button>
                </div>

            </form>
        </div>
    </div>
</div>
@endsection