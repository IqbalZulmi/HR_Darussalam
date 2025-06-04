<?php

namespace App\Http\Controllers;

use App\Models\PengajuanCuti;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function showAdminDashboard(){
        $user = Auth::user();
        $selisih = Carbon::parse($user->profilePekerjaan->tanggal_masuk)->diff(Carbon::now());

        $pengajuanCuti = PengajuanCuti::latest()->get();

        // Ambil tahun dan bulan
        $tahunPengabdian = $selisih->y;
        $bulanPengabdian = $selisih->m;

        return view('admin.dashboard', [
            'dataProfile' => $user,
            'dataPengajuanCuti' => $pengajuanCuti,
            'tahunPengabdian' => $tahunPengabdian,
            'bulanPengabdian' => $bulanPengabdian,
        ]);
    }

    public function showPegawaiDashboard()
    {
        $user = Auth::user();
        $selisih = Carbon::parse($user->profilePekerjaan->tanggal_masuk)->diff(Carbon::now());

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
