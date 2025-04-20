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
        if (!Auth::check()) {
            return redirect()->route('login')->with([
                'notifikasi' => 'Silakan login terlebih dahulu!',
                'type' => 'warning',
            ]);
        }

        $user = Auth::user();

        // Pecah role jika lebih dari satu (admin|pegawai)
        $roleArray = explode('|', $roles);

        if (!$user->hasAnyRole($roleArray)) {
            return redirect()->back()->with([
                'notifikasi' => 'Anda tidak memiliki akses ke halaman ini!',
                'type' => 'warning',
            ]);
        }

        return $next($request);
    }
}
