<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail; 
use Illuminate\Support\Facades\DB;   
use Illuminate\Support\Str;         

class AuthController extends Controller
{
    // Fungsi untuk mendaftar akun baru
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'siswa', 
            'exp' => 0,
            'coin' => 0,
        ]);

        Auth::login($user);
        return redirect('/dashboard');
    }

    // Fungsi untuk Masuk Sistem (DENGAN FITUR INGAT SAYA)
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // 1. Tangkap status kotak centang dari tampilan login
        $remember = $request->has('remember');

        // 2. Selipkan variabel $remember ke dalam mesin otentikasi Laravel
        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();
            return redirect()->intended('dashboard');
        }

        return back()->withErrors([
            'email' => 'Email atau kata sandi salah.',
        ]);
    }

    // Fungsi untuk Keluar Sistem (Dengan Pemutus Status Online)
    public function logout(Request $request)
    {
        // 1. Tangkap ID user yang sedang mau logout
        if (\Illuminate\Support\Facades\Auth::check()) {
            
            // 2. Gunakan query langsung agar VS Code tidak bingung, dan update instan!
            \App\Models\User::where('id', \Illuminate\Support\Facades\Auth::id())
                ->update(['last_seen' => null]);
        }

        // 3. Proses logout standar Laravel
        \Illuminate\Support\Facades\Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }

   public function forgotPassword()
{
    // Karena filenya ada di luar (sejajar login), kodingannya cukup begini:
    return view('forgot-password'); 
}

// 2. Fungsi untuk memproses pengiriman link ke email
public function sendResetLink(Request $request)
{
    // Validasi: Email harus ada di tabel users
    $request->validate([
        'email' => 'required|email|exists:users,email'
    ], [
        'email.exists' => 'Email ini tidak terdaftar di sistem StudyStrip!'
    ]);

    // Buat token unik untuk keamanan reset
    $token = \Illuminate\Support\Str::random(64);

    // Simpan token ke tabel khusus (bawaan Laravel)
    \Illuminate\Support\Facades\DB::table('password_reset_tokens')->updateOrInsert(
        ['email' => $request->email],
        ['token' => $token, 'created_at' => now()]
    );

    // Kirim Email (Pastikan .env sudah disetting!)
    \Illuminate\Support\Facades\Mail::send('emails.forgot-password', ['token' => $token], function($message) use($request){
        $message->to($request->email);
        $message->subject('Reset Kata Sandi StudyStrip');
    });

    return back()->with('success', 'Siap! Cek inbox email kamu untuk link pemulihan.');
}

    // 3. Menampilkan halaman form untuk ketik password baru
    public function showResetForm($token)
    {
        return view('reset-password', ['token' => $token]);
    }

    // 4. Memproses perubahan password ke database
    public function resetPassword(Request $request)
    {
        // Validasi input
        $request->validate([
            'email' => 'required|email|exists:users,email',
            'password' => 'required|min:8|confirmed', // confirmed berarti harus cocok dengan password_confirmation
            'token' => 'required'
        ]);

        // Cari token dan email di database
        $resetRecord = \Illuminate\Support\Facades\DB::table('password_reset_tokens')
            ->where('email', $request->email)
            ->where('token', $request->token)
            ->first();

        // Kalau tidak cocok/tidak ada
        if (!$resetRecord) {
            return back()->withErrors(['email' => 'Token tidak valid atau email salah.']);
        }

        // Kalau cocok, Ganti password user di tabel users
        \App\Models\User::where('email', $request->email)->update([
            'password' => \Illuminate\Support\Facades\Hash::make($request->password)
        ]);

        // Hapus token yang sudah terpakai biar aman
        \Illuminate\Support\Facades\DB::table('password_reset_tokens')->where('email', $request->email)->delete();

        // Kembalikan ke halaman login dengan pesan sukses
        return redirect('/')->with('success', 'Kata sandi berhasil direset! Silakan masuk dengan sandi baru.');
    }
}