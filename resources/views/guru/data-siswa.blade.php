<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Siswa - StudyStrip</title>
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&display=swap" rel="stylesheet">
    <style>
        body { margin: 0; font-family: 'Segoe UI', sans-serif; background: #0F3460; color: white; padding: 40px; }
        .brand { font-family: 'Orbitron'; font-size: 24px; margin-bottom: 30px; }
        .text-orange { color: #F9A826; }
        .glass-card { background: rgba(255, 255, 255, 0.05); backdrop-filter: blur(15px); border: 1px solid rgba(255, 255, 255, 0.1); border-radius: 20px; padding: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th { text-align: left; padding: 15px; color: #F9A826; border-bottom: 2px solid rgba(249, 168, 38, 0.3); }
        td { padding: 15px; border-bottom: 1px solid rgba(255,255,255,0.1); }
        .badge-level { background: #F9A826; color: #1A1A3A; padding: 3px 10px; border-radius: 5px; font-weight: bold; font-size: 12px; }
    </style>
</head>
<body>

    <div class="brand">DATA <span class="text-orange">SISWA</span></div>
    <a href="/dashboard" style="color: #ccc; text-decoration: none;">← Kembali ke Dashboard</a>

    <div class="glass-card" style="margin-top: 30px;">
        <table>
            <thead>
                <tr>
                    <th>Nama Siswa</th>
                    <th>Email</th>
                    <th>Koin</th>
                    <th>Total EXP</th>
                    <th>Level</th>
                </tr>
            </thead>
            <tbody>
                @forelse($allSiswa as $s)
                <tr>
                    <td><b>{{ $s->name }}</b></td>
                    <td>{{ $s->email }}</td>
                    <td>💰 {{ $s->coin }}</td>
                    <td>⭐ {{ $s->exp }}</td>
                    <td><span class="badge-level">LVL {{ floor($s->exp / 100) + 1 }}</span></td>
                </tr>
                @empty
                <tr>
                    <td colspan="5" style="text-align: center; padding: 40px; color: #888;">Belum ada siswa yang mendaftar.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</body>
</html>