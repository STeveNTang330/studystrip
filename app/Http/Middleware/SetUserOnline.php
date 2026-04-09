<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SetUserOnline
{
    public function handle(Request $request, Closure $next)
    {
        // Jika ada user yang sedang login, update waktu last_seen-nya ke detik ini juga!
        if (Auth::check()) {
            \Illuminate\Support\Facades\DB::table('users')
                ->where('id', Auth::user()->id)
                ->update(['last_seen' => now()]);
        }

        return $next($request);
    }
}