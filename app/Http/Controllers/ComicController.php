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

    public function index()
    {
        $comics = Comic::all()->map(function ($comic) {
            $pagesDir = public_path($comic->file_path . '/pages');
            $comic->page_count = File::exists($pagesDir) ? count(File::files($pagesDir)) : 0;
            return $comic;
        });

        return view('guru.komik', compact('comics'));
    }

    // --- 2. FUNGSI PENYIMPANAN YANG BARU (FILE + DATABASE) ---
    public function store(Request $request)
    {
        $request->validate([
            'chapter_number' => 'required|numeric',
            'title'          => 'required|string|max:255',
            'description'    => 'nullable|string',
            'visual_assets'  => 'required',
            'visual_assets.*'=> 'file|mimes:jpeg,png,jpg,gif,svg,webp|max:51200',
        ]);

        // Create comic record first to obtain an ID
        $comic = Comic::create([
            'chapter_number' => $request->chapter_number,
            'chapter_title'  => $request->title,
            'description'    => $request->description ?? $request->prompt_script ?? '',
            'file_path'      => '',
        ]);

        // Create directory for this comic's pages
        $comicDir = public_path('komik/' . $comic->id);
        $pagesDir = $comicDir . '/pages';
        if (!File::exists($pagesDir)) {
            File::makeDirectory($pagesDir, 0755, true);
        }

        // Move uploaded visual assets into pages directory
        if ($request->hasFile('visual_assets')) {
            $i = 0;
            foreach ($request->file('visual_assets') as $file) {
                $i++;
                $safeName = preg_replace('/[^A-Za-z0-9._-]/', '_', $file->getClientOriginalName());
                $targetName = sprintf('%02d_%s', $i, $safeName);
                $file->move($pagesDir, $targetName);
            }
        }

        // Save comic file_path as the comic folder path
        $comic->file_path = 'komik/' . $comic->id;
        $comic->save();

        return back()->with('success', 'Luar biasa! Bab ' . $request->chapter_number . ' - "' . $request->title . '" berhasil disimpan.');
    }

    // --- 3. FUNGSI UNTUK MENGHAPUS KOMIK DARI DATABASE & FOLDER ---
    public function destroy($id)
    {
        $comic = Comic::findOrFail($id);

        $file_path = public_path($comic->file_path);
        if (File::exists($file_path)) {
            File::deleteDirectory($file_path);
        }

        $comic->delete();

        return back()->with('success', 'Bab komik berhasil dihapus secara permanen!');
    }

    // --- 4. Fungsi untuk menampilkan halaman baca komik (Siswa) ---
    public function read($id)
    {
        $comic = \App\Models\Comic::findOrFail($id);

        $pages = [];
        $pagesDir = public_path('komik/' . $comic->id . '/pages');
        if (File::exists($pagesDir)) {
            $files = File::files($pagesDir);
            // Sort by filename
            usort($files, function($a, $b){ return strcmp($a->getFilename(), $b->getFilename()); });
            foreach ($files as $f) {
                $pages[] = url('komik/' . $comic->id . '/pages/' . $f->getFilename());
            }
        }

        return view('siswa.baca-komik', compact('comic','pages'));
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