@extends('layouts.master-guru')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Kategori & Genre Komik</h4>
        
        <!-- Tombol Pemicu Modal -->
        <button class="btn btn-primary fw-bold px-4" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal" style="background-color: #F9A826; border: none; border-radius: 8px;">
            <i class="fa-solid fa-plus me-1"></i> Tambah Kategori
        </button>
    </div>

    <!-- Tabel Kategori -->
    <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="30%">Nama Kategori</th>
                        <th width="45%">Deskripsi</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $index => $k)
                    <tr>
                        <td class="text-muted fw-bold">{{ $index + 1 }}</td>
                        <td class="fw-bold text-dark">{{ $k->nama_kategori }}</td>
                        <td class="text-muted">{{ $k->deskripsi ?? '-' }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-primary me-1"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-4">Belum ada data kategori komik. Silakan tambah baru!</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Pop-up Tambah Kategori -->
<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow" style="border-radius: 15px;">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold" id="exampleModalLabel">Tambah Kategori Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ url('/guru/kategori') }}" method="POST">
          @csrf
          <div class="modal-body">
              <div class="mb-3">
                  <label class="form-label fw-bold text-secondary">Nama Kategori <span class="text-danger">*</span></label>
                  <input type="text" name="nama_kategori" class="form-control bg-light" placeholder="Contoh: Sains, Petualangan..." style="border-radius: 10px;" required>
              </div>
              <div class="mb-2">
                  <label class="form-label fw-bold text-secondary">Deskripsi Singkat (Opsional)</label>
                  <textarea name="deskripsi" class="form-control bg-light" rows="3" placeholder="Masukkan deskripsi kategori..." style="border-radius: 10px;"></textarea>
              </div>
          </div>
          <div class="modal-footer border-0 pt-0">
              <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
              <button type="submit" class="btn btn-primary fw-bold" style="background-color: #F9A826; border: none; border-radius: 8px;">Simpan Kategori</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection