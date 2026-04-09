<?php

use App\Http\Controllers\GameController;
use Illuminate\Support\Facades\File;
use App\Models\Comic;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ComicController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes - StudyStrip
|--------------------------------------------------------------------------
*/

// 1. Jalur Tamu (Bisa diakses tanpa login)
Route::get('/', function () {
    // Cek apakah user sudah login atau punya tiket "Ingat Saya"
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('dashboard'); // Langsung lempar ke dashboard!
    }
    return view('login');
})->name('login');

Route::get('/register', function () {
    // Cek juga di halaman register, biar user yang udah login ga bisa daftar lagi
    if (\Illuminate\Support\Facades\Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('register');
})->name('register');

// 2. Jalur Proses Auth & Lupa Password
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/lupa-sandi', [AuthController::class, 'forgotPassword'])->name('password.request');
Route::post('/lupa-sandi', [AuthController::class, 'sendResetLink'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetForm'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// 3. Jalur Khusus User yang SUDAH LOGIN
Route::middleware(['auth', \App\Http\Middleware\SetUserOnline::class])->group(function () {
    
    // --- PERBAIKAN: Halaman Dashboard Utama menggunakan DashboardController ---
    // Route ini sekarang memanggil DashboardController tempat kita meletakkan 
    // logika pencarian data siswa dan data komik secara dinamis.
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // --- FITUR GURU ---
    Route::get('/upload-komik', [ComicController::class, 'create'])->name('comic.create');
    Route::post('/upload-komik', [ComicController::class, 'store'])->name('comic.store');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('guru.settings');
    Route::get('/data-siswa', [DashboardController::class, 'siswaIndex'])->name('guru.siswa');
    Route::get('/guru/komik', [ComicController::class, 'index'])->name('guru.komik.index');
    Route::delete('/guru/komik/{id}', [ComicController::class, 'destroy'])->name('comic.destroy');

    // --- FITUR SISWA ---
    Route::get('/baca-komik/{id}', [ComicController::class, 'read'])->name('comic.read');
    Route::post('/baca-komik/{id}/claim', [ComicController::class, 'claimReward'])->name('comic.claim');
    
    // --- FITUR PROFIL (GURU & SISWA) ---
    // 1. Menampilkan Halaman Edit Profil
    Route::get('/edit-profil', function () { 
        return view('edit-profil');
    })->name('profile.edit');

    // 2. Memproses Update Profil (DENGAN PESAN SUKSES DINAMIS)
    Route::post('/edit-profil/update', function (Request $request) { 
        
        /** @var \App\Models\User $user */ 
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:5120', // Maksimal foto 5MB
        ]);

        $user->name = $request->name;
        $user->email = $request->email;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        // --- 1. BUAT VARIABEL PESAN DEFAULT ---
        $pesan_sukses = 'Profil berhasil diperbarui!';

        // --- LOGIKA UPLOAD FOTO PROFIL BARU ---
        if ($request->hasFile('profile_picture')) {
            // Hapus foto lama dari folder (jika ada) biar memori laptop tidak penuh
            if ($user->profile_picture && File::exists(public_path('profil/' . $user->profile_picture))) {
                File::delete(public_path('profil/' . $user->profile_picture));
            }

            // Simpan foto baru ke folder public/profil
            $file = $request->file('profile_picture');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('profil'), $nama_file);

            // Catat nama filenya di database
            $user->profile_picture = $nama_file;

            // --- 2. UBAH PESAN JIKA ADA FOTO YANG DIUNGGAH ---
            $pesan_sukses = 'Profil dan foto berhasil diperbarui!';
        }

        $user->save(); 

        // --- 3. KIRIM PESAN DINAMIS KE TAMPILAN ---
        return back()->with('success', $pesan_sukses);
    })->name('profile.update');

    // --- RUTE TES UI (SEMENTARA) ---
    Route::get('/tes-siswa', function () {
        return view('siswa.dashboard');
    });

    Route::get('/tes-manajemen', function () {
        // Memanggil file index di dalam folder guru/komik
        return view('guru.komik.index');
    });
    
    // Route untuk membeli petunjuk (hanya bisa diakses jika siswa sudah login)
    Route::post('/game/buy-hint', [GameController::class, 'buyHint'])->name('game.buyHint');

});