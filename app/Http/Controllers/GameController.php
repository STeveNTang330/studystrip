<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function buyHint(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();
        $hintCost = 20; // Tetapkan harga 1 petunjuk

        // 1. Validasi Saldo Koin
        if ($user->coin < $hintCost) {
            return response()->json([
                'success' => false,
                'message' => 'Koin kamu tidak cukup! Baca komik lagi untuk mengumpulkan koin.'
            ], 400); // Response 400 Bad Request
        }

        // 2. Kurangi Koin Siswa
        $user->decrement('coin', $hintCost);

        // 3. Logika Menarik Data Petunjuk (Simulasi)
        $hintData = [
            'piece_id' => rand(1, 10), // Anggap ini ID kepingan puzzle yang benar
            'position' => 'kiri-atas'
        ];

        // 4. Kembalikan Respons Sukses
        return response()->json([
            'success' => true,
            'message' => 'Petunjuk berhasil dibuka!',
            'sisa_koin' => $user->coin,
            'hint' => $hintData
        ], 200);
    }
}