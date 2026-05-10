@extends('layouts.master-guru')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold m-0" style="color: #1A1A3A;">Pusat Pengumuman</h4>
        
        <button class="btn btn-primary fw-bold px-4" data-bs-toggle="modal" data-bs-target="#tambahPengumumanModal" style="background-color: #F9A826; border: none; border-radius: 8px;">
            <i class="fa-solid fa-paper-plane me-1"></i> Kirim Pengumuman
        </button>
    </div>

    <div class="card p-4 border-0 shadow-sm" style="border-radius: 15px;">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Judul Pengumuman</th>
                        <th width="40%">Isi Pesan</th>
                        <th width="15%">Tanggal Kirim</th>
                        <th width="15%">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pengumuman as $index => $p)
                    <tr>
                        <td class="text-muted fw-bold">{{ $index + 1 }}</td>
                        <td class="fw-bold text-dark">{{ $p->judul }}</td>
                        <td class="text-muted">{{ Str::limit($p->isi_pesan, 60) }}</td>
                        <td class="text-muted">{{ $p->created_at->format('d M Y, H:i') }}</td>
                        <td>
                            <button class="btn btn-sm btn-outline-danger"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">Belum ada pengumuman yang dikirim.</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<div class="modal fade" id="tambahPengumumanModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content border-0 shadow" style="border-radius: 15px;">
      <div class="modal-header border-0 pb-0">
        <h5 class="modal-title fw-bold">Kirim Pengumuman Baru</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      
      <form action="{{ url('/guru/pengumuman') }}" method="POST">
          @csrf
          <div class="modal-body">
              <div class="mb-3">
                  <label class="form-label fw-bold text-secondary">Judul Pengumuman <span class="text-danger">*</span></label>
                  <input type="text" name="judul" class="form-control bg-light" placeholder="Contoh: Info Update Komik Baru!" style="border-radius: 10px;" required>
              </div>
              <div class="mb-2">
                  <label class="form-label fw-bold text-secondary">Isi Pesan Pengumuman <span class="text-danger">*</span></label>
                  <textarea name="isi_pesan" class="form-control bg-light" rows="4" placeholder="Ketik pesan yang akan dibaca oleh semua siswa..." style="border-radius: 10px;" required></textarea>
              </div>
          </div>
          <div class="modal-footer border-0 pt-0">
              <button type="button" class="btn btn-light fw-bold" data-bs-dismiss="modal" style="border-radius: 8px;">Batal</button>
              <button type="submit" class="btn btn-primary fw-bold" style="background-color: #F9A826; border: none; border-radius: 8px;"><i class="fa-solid fa-paper-plane me-1"></i> Kirim Sekarang</button>
          </div>
      </form>
    </div>
  </div>
</div>
@endsection