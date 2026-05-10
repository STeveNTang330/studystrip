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

// 1. Jalur Tamu (GUEST)
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login');
})->name('login');

Route::get('/register', function () {
    if (Auth::check()) {
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

// 3. Jalur Khusus User (LOGIN REQUIRED)
Route::middleware(['auth', \App\Http\Middleware\SetUserOnline::class])->group(function () {
    
    // Dashboard Utama
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // FITUR GURU / ADMIN
    Route::get('/upload-komik', [ComicController::class, 'create'])->name('comic.create');
    Route::post('/upload-komik', [ComicController::class, 'store'])->name('comic.store');
    Route::get('/settings', [DashboardController::class, 'settings'])->name('guru.settings');
    Route::get('/data-siswa', [DashboardController::class, 'siswaIndex'])->name('guru.siswa');
    Route::get('/guru/komik', [ComicController::class, 'index'])->name('guru.komik.index');
    Route::delete('/guru/komik/{id}', [ComicController::class, 'destroy'])->name('comic.destroy');
    Route::get('/guru/nilai', [DashboardController::class, 'nilai'])->name('guru.nilai');
    Route::get('/guru/pengaturan', [DashboardController::class, 'pengaturan'])->name('guru.pengaturan');
    
    Route::get('/guru/kategori', [App\Http\Controllers\DashboardController::class, 'kategori']);
    Route::get('/guru/kuis', [App\Http\Controllers\DashboardController::class, 'kuis']);
    Route::get('/guru/pengumuman', [App\Http\Controllers\DashboardController::class, 'pengumuman']);
    Route::post('/guru/pengumuman', [App\Http\Controllers\DashboardController::class, 'storePengumuman']);
    // ----------------------------------------------------
    
    // ======== RUTE CETAK LAPORAN ========
    Route::get('/guru/cetak-laporan', [DashboardController::class, 'cetakLaporan'])->name('guru.cetak');
    Route::get('/guru/lihat-laporan', [\App\Http\Controllers\DashboardController::class, 'lihatLaporan'])->name('guru.laporan');

    // FITUR SISWA (BACA KOMIK)
    Route::get('/siswa/pengumuman', [App\Http\Controllers\DashboardController::class, 'pengumumanSiswa']);
    Route::get('/siswa/katalog', [App\Http\Controllers\DashboardController::class, 'katalogSiswa']);
    Route::get('/siswa/kuis', [App\Http\Controllers\DashboardController::class, 'kuisSiswa']);
    Route::get('/baca-komik/{id}', [ComicController::class, 'read'])->name('comic.read');
    Route::post('/baca-komik/{id}/claim', [ComicController::class, 'claimReward'])->name('comic.claim');
    
    // RUANG BACA
    Route::get('/tes-buku', function () {
        return view('siswa.baca-komik');
    });
    
    // FITUR PROFIL
    Route::get('/edit-profil', function () {
        return view('siswa.edit-profil-siswa'); 
    })->name('profile.edit');

    Route::post('/edit-profil/update', function (Request $request) { 
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,'.$user->id,
            'password' => 'nullable|min:8|confirmed',
            'profile_picture' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        if ($request->filled('password')) { $user->password = Hash::make($request->password); }

        if ($request->hasFile('profile_picture')) {
            if ($user->profile_picture && File::exists(public_path('profil/' . $user->profile_picture))) {
                File::delete(public_path('profil/' . $user->profile_picture));
            }
            $file = $request->file('profile_picture');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('profil'), $nama_file);
            $user->profile_picture = $nama_file;
        }
        $user->save(); 
        return back()->with('success', 'Profil berhasil diperbarui!');
    })->name('profile.update');

    // FITUR GAME
    Route::post('/game/buy-hint', [GameController::class, 'buyHint'])->name('game.buyHint');
    Route::post('/klaim-hadiah', [DashboardController::class, 'klaimHadiah'])->name('klaim.hadiah');

});