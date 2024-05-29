<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlyMemberMiddleware
{
    // check apakah ada session dengan key user
    // kalau dia member baru boleh akses, ada kembalikan ke controller..  exists(key): bool // cek apakah ada session
    // kalau dia bukan member tidak boleh akses
    public function handle(Request $request, Closure $next)
    {
        if ($request->session()->exists("user")) {
            return $next($request); // jika member boleh akses
        } else {
            return redirect("/"); // jika bukan member tidak bisa akses
        }
    }
}
