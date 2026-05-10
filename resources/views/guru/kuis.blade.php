@extends('layouts.master-guru')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4>Manajemen Kuis & Misi</h4>
        
        <button class="btn btn-primary fw-bold px-4" data-bs-toggle="modal" data-bs-target="#tambahKuisModal" style="background-color: #F9A826; border: none; border-radius: 8px;">
            <i class="fa-solid fa-plus me-1"></i> Buat Kuis / Misi
        </button>
    </div>

    <!-- Tabel Kuis & Misi -->
    <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Judul Misi / Kuis</th>
                        <th width="15%">Tipe</th>
                        <th width="20%">Target Komik</th>
                        <th width="15%">Reward</th>
                        <th width="20%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Nanti data dari database akan di-looping di sini -->
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">Belum ada data kuis atau misi. Silakan buat baru!</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Modal Pop-up Tambah Kuis -->
<div class="modal fade" id="tambahKuisModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg">
    <div class="modal-content border-0 shadow" style="border-radius: 15px;">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold">Buat Kuis / Misi Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="#" method="POST">
          @csrf
          <div class="modal-body">
              <div class="row">
                  <div class="col-md-8 mb-3">
                      <label class="form-label fw-bold text-secondary">Judul Kuis / Misi <span class="text-danger">*</span></label>
                      <input type="text" name="judul" class="form-control bg-light" placeholder="Contoh: Jawab 3 Pertanyaan Sejarah" style="border-radius: 10px;" required>
                  </div>
                  <div class="col-md-4 mb-3">
                      <label class="form-label fw-bold text-secondary">Tipe <span class="text-danger">*</span></label>
                      <select name="tipe" class="form-select bg-light" style="border-radius: 10px;" required>
                          <option value="Kuis">Kuis Pilihan Ganda</option>
                          <option value="Misi">Misi Membaca</option>
                      </select>
                  </div>
              </div>
              <div class="row">
                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-bold text-secondary">Reward Koin</label>
                      <input type="number" name="reward_koin" class="form-control bg-light" placeholder="Contoh: 50" style="border-radius: 10px;">
                  </div>
                  <div class="col-md-6 mb-3">
                      <label class="form-label fw-bold text-secondary">Reward EXP</label>
                      <input type="number" name="reward_exp" class="form-control bg-light" placeholder="Contoh: 100" style="border-radius: 10px;">
                  </div>
              </div>
          </div>
          <div class="modal-footer border-0 pt-0">
              <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
              <button type="submit" class="btn btn-primary fw-bold" style="background-color: #F9A826; border: none; border-radius: 8px;">Simpan Data</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection