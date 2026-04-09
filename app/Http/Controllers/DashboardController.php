<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Comic;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        // Ambil data user yang sedang login
        $user = Auth::user();

        // --- 1. LOGIKA UNTUK GURU ---
        if ($user->role === 'guru' || $user->role === 'admin') {
            
            // AMBIL DATA SISWA
            $data_siswa = User::where('role', 'siswa')
                            ->orderBy('exp', 'desc')
                            ->get();

            // AMBIL DATA KOMIK (Tambahan baru agar tabel manajemen komik muncul!)
            $comics = Comic::orderBy('chapter_number', 'asc')->get();

            // Lempar KEDUA variabel tersebut ke halaman guru
            return view('guru.dashboard', compact('data_siswa', 'comics'));
        }

        // --- 2. LOGIKA UNTUK SISWA ---
        if ($user->role === 'siswa') {
            
            // Ambil daftar komik untuk murid
            $comics = Comic::orderBy('chapter_number', 'asc')->get();
            
            return view('siswa.dashboard', compact('comics'));
        }

        // Jika tidak punya role, paksa keluar
        Auth::logout();
        return redirect('/');
    }
}