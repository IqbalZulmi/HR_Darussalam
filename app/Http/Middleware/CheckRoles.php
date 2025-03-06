<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRoles
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        if (!Auth::check() || Auth::user()->roles != $roles){
            return redirect()->back()->with([
                'notifikasi' => 'Anda tidak memiliki akses. Silakan login terlebih dahulu!',
                'type' => 'warning'
            ]);
        }

        return $next($request);
    }
}
