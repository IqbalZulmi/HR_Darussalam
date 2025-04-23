<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showAdminDashboard(){
        return view('admin.dashboard');
    }

    public function showPegawaiDashboard()
    {
        $user = Auth::user()->pegawai;
        $selisih = Carbon::parse($user->tanggal_masuk)->diff(Carbon::now());

        // Ambil tahun dan bulan
        $tahunPengabdian = $selisih->y;
        $bulanPengabdian = $selisih->m;

        return view('pegawai.dashboard', [
            'dataProfile' => $user,
            'tahunPengabdian' => $tahunPengabdian,
            'bulanPengabdian' => $bulanPengabdian,
        ]);
    }

}
