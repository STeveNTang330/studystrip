<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Nilai Siswa - StudyStrip Sheets</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; background-color: #f8f9fa; }
        
        /* Desain Topbar ala Google Sheets */
        .topbar { background: #ffffff; padding: 10px 15px; border-bottom: 1px solid #e0e0e0; display: flex; align-items: center; }
        .sheet-icon { color: #0F9D58; font-size: 35px; margin-right: 15px; }
        .sheet-info h1 { margin: 0; font-size: 18px; color: #202124; font-weight: normal; }
        .sheet-menu { font-size: 13px; color: #5f6368; margin-top: 4px; word-spacing: 10px; }
        
        /* Desain Tabel Grid ala Excel/Sheets */
        .table-container { padding: 15px; overflow-x: auto; height: calc(100vh - 80px); }
        table { border-collapse: collapse; background: #ffffff; width: 100%; max-width: 1000px; box-shadow: 0 1px 2px rgba(0,0,0,0.1); }
        th, td { border: 1px solid #e0e0e0; padding: 6px 12px; font-size: 13px; color: #000; }
        
        /* Warna Header (A, B, C) dan Baris (1, 2, 3) */
        th { background: #f8f9fa; color: #5f6368; font-weight: normal; text-align: center; }
        td:first-child, th:first-child { background: #f8f9fa; font-weight: normal; color: #5f6368; text-align: center; width: 30px; }
        
        /* Highlight baris saat dilewati mouse */
        tbody tr:hover { background-color: #f1f3f4; }
        
        /* Badge Online/Offline */
        .badge { padding: 4px 8px; border-radius: 12px; font-size: 11px; font-weight: bold; color: white; display: inline-block; }
        .bg-success { background-color: #0F9D58; }
        .bg-secondary { background-color: #70757a; }
    </style>
</head>
<body>

    <!-- Topbar Palsu -->
    <div class="topbar">
        <i class="fa-solid fa-file-excel sheet-icon"></i>
        <div class="sheet-info">
            <h1>Laporan_Peringkat_dan_Nilai_Siswa</h1>
            <div class="sheet-menu">File Edit View Insert Format Data Tools Help</div>
        </div>
    </div>

    <!-- Area Spreadsheet -->
    <div class="table-container">
        <table>
            <thead>
                <tr>
                    <th></th>
                    <th>A</th>
                    <th>B</th>
                    <th>C</th>
                    <th>D</th>
                    <th>E</th>
                </tr>
                <tr>
                    <th>1</th>
                    <th style="font-weight: bold; color: #000;">Nama Siswa</th>
                    <th style="font-weight: bold; color: #000;">Email Akun</th>
                    <th style="font-weight: bold; color: #000;">Total Pengalaman (EXP)</th>
                    <th style="font-weight: bold; color: #000;">Saldo Koin</th>
                    <th style="font-weight: bold; color: #000;">Status Aktivitas</th>
                </tr>
            </thead>
            <tbody>
                @forelse($siswa as $index => $s)
                <tr>
                    <td>{{ $index + 2 }}</td>
                    <td>{{ $s->name }}</td>
                    <td>{{ $s->email }}</td>
                    <td style="text-align: right;">{{ number_format($s->exp) }}</td>
                    <td style="text-align: right;">{{ number_format($s->coins) }}</td>
                    <td style="text-align: center;">
                        @if($s->isOnline())
                            <span class="badge bg-success">Online</span>
                        @else
                            <span class="badge bg-secondary">Offline</span>
                        @endif
                    </td>
                </tr>
                @empty
                <tr>
                    <td>2</td>
                    <td colspan="5" style="text-align: center; color: #999;">Belum ada data siswa.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>