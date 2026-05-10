@extends('layouts.master-guru')

@section('content')
<div class="row mb-4">
    <div class="col-12">
        <h2 class="fs-4 mb-1">Tabel Nilai & Progres Siswa</h2>
        <p class="text-muted">Pantau perolehan EXP, Koin, dan Level dari seluruh siswa yang membaca komik.</p>
    </div>
</div>

<div class="row">
    <div class="col-12">
        <div class="card p-0">
            <div class="card-header bg-white p-3 d-flex justify-content-between align-items-center">
    <h6 class="m-0 fw-bold"><i class="fa-solid fa-medal text-warning me-2"></i> Peringkat Siswa</h6>

    <!-- INI TOMBOL BARUNYA -->
    <a href="{{ route('guru.laporan') }}" target="_blank" class="btn btn-success btn-sm fw-bold shadow-sm">
        <i class="fa-solid fa-table-cells me-1"></i> Lihat Laporan
    </a>

</div>
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th class="ps-4">No</th>
                            <th>Nama Siswa</th>
                            <th>Email</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Total EXP</th>
                            <th class="text-center">Koin Aktif</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="ps-4">1</td>
                            <td>
                                <div class="d-flex align-items-center">
                                    <div class="bg-primary-subtle text-primary rounded-circle d-flex justify-content-center align-items-center fw-bold me-3" style="width: 35px; height: 35px;">S</div>
                                    <span class="fw-bold">Steven</span>
                                </div>
                            </td>
                            <td class="text-muted">steven@uvers.ac.id</td>
                            <td class="text-center"><span class="badge bg-success">Level 5</span></td>
                            <td class="text-center fw-bold text-primary">1,250 EXP</td>
                            <td class="text-center fw-bold text-warning"><i class="fa-solid fa-coins me-1"></i> 300</td>
                        </tr>
                        
                        </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection