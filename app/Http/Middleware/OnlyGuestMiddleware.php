<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class OnlyGuestMiddleware
{
    public function handle(Request $request, Closure $next)
    {

        // check apakah ada session dengan key user
        // jika ada kembalikan ke route "/"..  exists(key): bool // cek apakah ada session
        // jika tidak ada kembalikan ke controller
        if ($request->session()->exists("user")) {
            return redirect("/"); // jika sudah login
        } else {
            return $next($request); // jika belum login
        }

    }
}
