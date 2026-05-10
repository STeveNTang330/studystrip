<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

class SetUserOnline
{
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            // Mencatat waktu aktif user saat ini ditambah 5 menit ke depan
            $expiresAt = Carbon::now()->addMinutes(5);
            
            // Simpan status online ke dalam Cache memori (Sesuai dengan yang dicari oleh User.php)
            Cache::put('user-is-online-' . Auth::user()->id, true, $expiresAt);
        }

        return $next($request);
    }
}