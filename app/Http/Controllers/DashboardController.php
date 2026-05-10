<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Comic;

// Tambahan untuk Google Sheets API
use Google\Client;
use Google\Service\Sheets;
use Google\Service\Sheets\ValueRange;
use Google\Service\Sheets\ClearValuesRequest;

class DashboardController extends Controller
{
    // 1. Fungsi Utama Dashboard
    public function index()
    {
        $comics = Comic::all();

        if (Auth::user()->role == 'guru') {
            $siswa_online = User::where('role', 'siswa')->get();
            return view('guru.dashboard', compact('siswa_online', 'comics'));
        }
        
        // --- TAMBAHAN UNTUK SISWA ---
        // Ambil 5 siswa top global
        $top_siswa = User::where('role', 'siswa')->orderBy('exp', 'desc')->take(5)->get();
        // Ambil 1 pengumuman paling baru dari database
        $pengumuman_terbaru = \App\Models\Pengumuman::query()->latest()->first(); 
        
        return view('siswa.dashboard', compact('comics', 'top_siswa', 'pengumuman_terbaru'));
    }

    // 2. Fungsi Menu Guru Lainnya
    public function settings() { return view('guru.settings'); }
    public function siswaIndex() { return view('guru.data-siswa'); }
    public function nilai() { return view('guru.tabel-nilai'); }
    public function pengaturan() { return view('guru.pengaturan'); }

    // 3. Fungsi Game / Klaim Hadiah
    public function klaimHadiah()
    {
        return redirect('/dashboard')->with('success', 'Misi Selesai! Kamu berhasil mendapatkan +50 Koin dan +80 EXP! 🎉');
    }

    // ==========================================
    // 4. FUNGSI EKSPOR DATA KE GOOGLE SHEETS ASLI
    // ==========================================
    
    public function lihatLaporan()
    {
        // A. Ambil data siswa dari database
        $siswa = User::where('role', 'siswa')->orderBy('exp', 'desc')->get();
        
        // B. Siapkan format tabel untuk di-push ke Google Sheets
        $dataSheet = [];
        
        // Baris 1: Header Tabel
        $dataSheet[] = ['Peringkat', 'Nama Siswa', 'Email Akun', 'Total Pengalaman (EXP)', 'Saldo Koin', 'Status Aktivitas'];

        // Baris 2 dan seterusnya: Data Siswa
        foreach ($siswa as $index => $s) {
            $status = $s->isOnline() ? 'Online' : 'Offline';
            $dataSheet[] = [
                $index + 1,
                $s->name,
                $s->email,
                $s->exp,
                $s->coin, // Pastikan ini sesuai dengan nama kolom di databasemu (coin / coins)
                $status
            ];
        }

        // C. Hubungkan Laravel ke Google Cloud menggunakan file .json
        $client = new Client();
        $client->setApplicationName('StudyStrip Report');
        $client->setScopes([Sheets::SPREADSHEETS]);
        $client->setAuthConfig(storage_path('google-credentials.json'));
        $client->setAccessType('offline');

        $service = new Sheets($client);
        
        // D. Masukkan ID Spreadsheet Asli Milikmu
        $spreadsheetId = '1FjOHCfbaXZMDJmhuYhn1IEcI4fbDeo7RxOh64sblxgU';
        
        // E. Hapus data lama yang ada di sheet (agar bersih jika ada perubahan jumlah siswa)
        $clearRequest = new ClearValuesRequest();
        $service->spreadsheets_values->clear($spreadsheetId, 'A1:Z1000', $clearRequest);

        // F. Kirim data baru ke Google Sheets
        $body = new ValueRange();
$body->setValues($dataSheet);
        $params = ['valueInputOption' => 'USER_ENTERED'];
        $service->spreadsheets_values->update($spreadsheetId, 'A1', $body, $params);

        // G. Alihkan (Redirect) dosen/guru langsung ke Google Sheets yang sudah terisi otomatis!
        return redirect()->away('https://docs.google.com/spreadsheets/d/' . $spreadsheetId . '/edit');
    }

    // ==========================================
    // 5. FUNGSI MENU BARU (KATEGORI, KUIS, PENGUMUMAN)
    // ==========================================
    
    // A. Fungsi untuk menampilkan halaman & tabel kategori
    public function kategori() 
    { 
        // Ambil semua data kategori dari database, urutkan dari yang terbaru
        $kategori = \App\Models\Kategori::query()->orderBy('id', 'desc')->get();
        return view('guru.kategori', compact('kategori')); 
    }

    // B. Fungsi untuk menyimpan data kategori baru
    public function storeKategori(\Illuminate\Http\Request $request)
    {
        // Validasi, nama kategori tidak boleh kosong
        $request->validate(['nama_kategori' => 'required']);
        
        // Simpan ke database
        \App\Models\Kategori::query()->create([
            'nama_kategori' => $request->nama_kategori,
            'deskripsi' => $request->deskripsi,
        ]);

        return back()->with('success', 'Kategori Komik berhasil ditambahkan!');
    }

    // C. Menu lainnya yang masih kosong (akan kita buat nanti)
    public function kuis() { return view('guru.kuis'); }
    // Menampilkan halaman & data pengumuman
    public function pengumuman() 
    { 
        $pengumuman = \App\Models\Pengumuman::query()->orderBy('id', 'desc')->get();
        return view('guru.pengumuman', compact('pengumuman')); 
    }

    // Menyimpan pengumuman baru
    public function storePengumuman(\Illuminate\Http\Request $request)
    {
        $request->validate([
            'judul' => 'required',
            'isi_pesan' => 'required'
        ]);

        \App\Models\Pengumuman::query()->create([
            'judul' => $request->judul,
            'isi_pesan' => $request->isi_pesan,
        ]);

        return back()->with('success', 'Pengumuman berhasil dikirim ke seluruh siswa!');
    }
    // Menampilkan halaman khusus pengumuman untuk siswa
    public function pengumumanSiswa()
    {
        // Ambil data pengumuman
        $pengumuman = \App\Models\Pengumuman::latest()->get();
        // Ambil data top siswa untuk sidebar
        $top_siswa = \App\Models\User::where('role', 'siswa')->orderBy('exp', 'desc')->take(5)->get();
        
        return view('siswa.pengumuman', compact('pengumuman', 'top_siswa'));
    }
    // Menampilkan halaman Katalog Komik untuk siswa
    public function katalogSiswa()
    {
        $comics = \App\Models\Comic::latest()->get(); // Ambil komik terbaru
        $top_siswa = \App\Models\User::where('role', 'siswa')->orderBy('exp', 'desc')->take(5)->get();
        return view('siswa.katalog', compact('comics', 'top_siswa'));
    }

    // Menampilkan halaman Kuis Akhir Bab untuk siswa
    public function kuisSiswa()
    {
        $top_siswa = \App\Models\User::where('role', 'siswa')->orderBy('exp', 'desc')->take(5)->get();
        return view('siswa.kuis', compact('top_siswa'));
    }
}