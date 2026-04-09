<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Komik - StudyStrip</title>
    
    <link rel="icon" type="image/jpeg" href="{{ asset('images/logo.jpeg') }}?v=3">
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    
    <style>
        body {
            margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fcfcfc;
            background-image: 
                radial-gradient(circle at 10% 90%, rgba(163, 116, 255, 0.65) 0%, transparent 80%),
                radial-gradient(circle at 90% 90%, rgba(249, 168, 38, 0.65) 0%, transparent 80%),
                radial-gradient(circle at 50% 0%, rgba(255, 255, 255, 0.6) 0%, transparent 100%);
            min-height: 100vh; color: #333;
        }

        /* --- NAVBAR KACA --- */
        .glass-navbar {
            position: fixed; top: 0; left: 0; width: 100%; background: rgba(255, 255, 255, 0.5);
            backdrop-filter: blur(15px); -webkit-backdrop-filter: blur(15px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.8); box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
            display: flex; justify-content: space-between; align-items: center;
            padding: 15px 40px; box-sizing: border-box; z-index: 100;
        }
        .nav-brand { display: flex; align-items: center; gap: 15px; }
        .nav-brand h2 { margin: 0; font-family: 'Orbitron', sans-serif; font-size: 24px; letter-spacing: 1px; }
        .text-dark { color: #1A1A3A; } .text-orange { color: #F9A826; }
        
        .btn-back {
            text-decoration: none; color: #444; font-weight: 600; font-size: 14px;
            display: flex; align-items: center; gap: 8px; transition: 0.3s;
        }
        .btn-back:hover { color: #F9A826; }

        /* --- KONTEN UTAMA --- */
        .container { max-width: 1000px; margin: 120px auto 50px auto; padding: 0 20px; }
        
        .header-flex { display: flex; justify-content: space-between; align-items: center; margin-bottom: 30px; }
        .header-flex h2 { margin: 0; color: #1A1A3A; font-size: 28px; }
        
        .btn-orange {
            background: linear-gradient(135deg, #F9A826, #E85D04); color: white; padding: 12px 20px; 
            border-radius: 8px; text-decoration: none; font-weight: bold; font-size: 14px;
            box-shadow: 0 4px 15px rgba(249, 168, 38, 0.3); transition: 0.3s; display: inline-flex; align-items: center; gap: 8px;
        }
        .btn-orange:hover { transform: translateY(-2px); box-shadow: 0 6px 20px rgba(249, 168, 38, 0.4); }

        /* --- TABEL KACA --- */
        .glass-table-container {
            background: rgba(255, 255, 255, 0.5); backdrop-filter: blur(20px);
            border: 1px solid rgba(255, 255, 255, 0.8); border-radius: 16px;
            padding: 20px; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05); overflow-x: auto;
        }

        table { width: 100%; border-collapse: collapse; }
        th { background: rgba(249, 168, 38, 0.1); color: #E85D04; padding: 15px; text-align: left; font-size: 14px; border-radius: 8px 8px 0 0; }
        td { padding: 15px; border-bottom: 1px solid rgba(0,0,0,0.05); font-size: 14px; color: #444; vertical-align: middle; }
        tr:last-child td { border-bottom: none; }
        tr:hover td { background: rgba(255,255,255,0.4); }

        .badge { background: #1A1A3A; color: white; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: bold; }
        
        .action-btns { display: flex; gap: 10px; }
        .btn-edit { background: rgba(40, 167, 69, 0.1); color: #28a745; padding: 8px 12px; border-radius: 6px; text-decoration: none; transition: 0.3s; }
        .btn-edit:hover { background: #28a745; color: white; }
        .btn-delete { background: rgba(220, 53, 69, 0.1); color: #dc3545; padding: 8px 12px; border-radius: 6px; text-decoration: none; border: none; cursor: pointer; transition: 0.3s; }
        .btn-delete:hover { background: #dc3545; color: white; }
    </style>
</head>
<body>

    <nav class="glass-navbar">
        <div class="nav-brand">
            <h2><span class="text-dark">STUDY</span><span class="text-orange">strip</span></h2>
        </div>
        <a href="{{ route('dashboard') }}" class="btn-back">
            <i class="fa-solid fa-arrow-left"></i> Kembali ke Dashboard
        </a>
    </nav>

    <div class="container">
        <div class="header-flex">
            <h2><i class="fa-solid fa-book-open" style="color: #F9A826;"></i> Manajemen Komik</h2>
            <a href="{{ route('comic.create') }}" class="btn-orange">
                <i class="fa-solid fa-plus"></i> Tambah Bab Baru
            </a>
        </div>

        <div class="glass-table-container">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Bab</th>
                        <th>Judul Materi</th>
                        <th>Akses Khusus</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>1</td>
                        <td><span class="badge">Bab 1</span></td>
                        <td>
                            <strong>Misteri Hukum Newton</strong><br>
                            <small style="color:#888;">Diupload: 3 April 2026</small>
                        </td>
                        <td>-</td>
                        <td class="action-btns">
                            <a href="#" class="btn-edit" title="Edit Komik"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button class="btn-delete" title="Hapus Komik"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                    
                    <tr>
                        <td>2</td>
                        <td><span class="badge">Bab 2</span></td>
                        <td>
                            <strong>Kekuatan Medan Magnet</strong><br>
                            <small style="color:#888;">Diupload: 1 April 2026</small>
                        </td>
                        <td><i class="fa-solid fa-lock" style="color:#888;" title="Terkunci Password"></i> Ada Sandi</td>
                        <td class="action-btns">
                            <a href="#" class="btn-edit" title="Edit Komik"><i class="fa-solid fa-pen-to-square"></i></a>
                            <button class="btn-delete" title="Hapus Komik"><i class="fa-solid fa-trash"></i></button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>