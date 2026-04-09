<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class ComicController extends Controller
{
    // --- 1. FUNGSI UNTUK MENAMPILKAN HALAMAN UPLOAD KOMIK ---
    public function create()
    {
        return view('guru.upload-komik');
    }

    // --- 2. FUNGSI PENYIMPANAN YANG BARU (FILE + DATABASE) ---
    public function store(Request $request)
    {
        $request->validate([
            'chapter_number' => 'required|numeric',
            'chapter_title'  => 'required|string|max:255',
            'description'    => 'nullable|string',
            'comic_file'     => 'required|file|mimes:jpeg,png,jpg,pdf|max:10240', 
        ]);

        if ($request->hasFile('comic_file')) {
            $file = $request->file('comic_file');
            $nama_file = time() . "_" . $file->getClientOriginalName();
            $file->move(public_path('komik'), $nama_file);
            
            Comic::create([
                'chapter_number' => $request->chapter_number,
                'chapter_title'  => $request->chapter_title,
                'description'    => $request->description,
                'file_path'      => $nama_file, 
            ]);
        }

        return back()->with('success', 'Luar biasa! Bab ' . $request->chapter_number . ' - "' . $request->chapter_title . '" berhasil disimpan ke database.');
    }

    // --- 3. FUNGSI UNTUK MENGHAPUS KOMIK DARI DATABASE & FOLDER ---
    public function destroy($id)
    {
        $comic = Comic::findOrFail($id);

        $file_path = public_path('komik/' . $comic->file_path);
        if (File::exists($file_path)) {
            File::delete($file_path);
        }

        $comic->delete();

        return back()->with('success', 'Bab komik berhasil dihapus secara permanen!');
    }

    // --- 4. Fungsi untuk menampilkan halaman baca komik (Siswa) ---
    public function read($id)
    {
        $comic = \App\Models\Comic::findOrFail($id);
        return view('siswa.baca-komik', compact('comic'));
    }

    // --- 5. Fungsi untuk mengklaim koin & EXP (DENGAN ANTI-SPAM) ---
    public function claimReward(Request $request, $id)
    {
        /** @var \App\Models\User $user */
        $user = \Illuminate\Support\Facades\Auth::user();

        // 1. Cek apakah siswa ini sudah pernah mengklaim komik ini sebelumnya
        $sudahPernahBaca = \Illuminate\Support\Facades\DB::table('comic_reads')
            ->where('user_id', $user->id)
            ->where('comic_id', $id)
            ->exists();

        // 2. Jika SUDAH PERNAH (Spam), tolak permintaannya!
        if ($sudahPernahBaca) {
            return response()->json([
                'success' => false,
                'message' => 'Eits! Kamu sudah pernah mengambil hadiah dari Bab ini sebelumnya. Baca bab lain untuk dapat koin lagi!',
            ]);
        }

        // 3. Jika BELUM PERNAH, catat di database agar next time tidak bisa di-spam
        \Illuminate\Support\Facades\DB::table('comic_reads')->insert([
            'user_id' => $user->id,
            'comic_id' => $id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 4. Tambahkan hadiah ke akun siswa
        $user->increment('exp', 50);
        $user->increment('coin', 20);

        return response()->json([
            'success' => true,
            'message' => 'Kerja Bagus! Kamu mendapatkan 50 EXP dan 20 Koin.',
        ]);
    }
}