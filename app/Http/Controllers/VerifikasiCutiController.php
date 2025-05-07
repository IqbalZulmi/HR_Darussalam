<?php

namespace App\Http\Controllers;

use App\Models\PengajuanCuti;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VerifikasiCutiController extends Controller
{
    public function showVerifikasiKepsekPage(){
        $departemenId = Auth::user()->profilePekerjaan->id_departemen;

        $verifikasiSedangDiproses = PengajuanCuti::whereHas('user.profilePekerjaan', function ($query) use ($departemenId) {
            $query->where('id_departemen', $departemenId);
        })->where('status_pengajuan','ditinjau kepala sekolah')->with(['user.profilePekerjaan'])->latest()->get();

        $verifikasiSelesai = PengajuanCuti::whereHas('user.profilePekerjaan', function ($query) use ($departemenId) {
            $query->where('id_departemen', $departemenId);
        })->whereIn('status_pengajuan',[
            'disetujui kepala sekolah menunggu tinjauan dirpen',
            'disetujui kepala sekolah',
            'ditolak kepala sekolah',
            ])->with(['user.profilePekerjaan'])->orderBy('updated_at', 'desc')->get();

        return view('admin.verifikasi-cuti-kepsek',[
            'dataSedangDiproses' => $verifikasiSedangDiproses,
            'dataSelesai' => $verifikasiSelesai,
        ]);
    }

    public function verifikasiCutiKepsek(Request $request,$id_pengajuan){
        $validatedData = $request->validate([
            'status_pengajuan' => 'required',
            'komentar' => 'nullable|string|max:1000',
        ], [
            'status_pengajuan.required' => 'Status pengajuan wajib diisi.',
            'komentar.string' => 'Komentar harus berupa teks.',
            'komentar.max' => 'Komentar maksimal 1000 karakter.',
        ]);

        // Ambil data pengajuan
        $pengajuan = PengajuanCuti::findOrFail($id_pengajuan);

        // Tentukan status pengajuan berdasarkan kondisi
        if ($request->status_pengajuan === 'disetujui kepala sekolah' && $pengajuan->tipe_cuti === 'cuti tahunan') {
            $statusPengajuan = 'disetujui kepala sekolah menunggu tinjauan dirpen';
        } else {
            $statusPengajuan = $request->status_pengajuan;
        }

        // Simpan perubahan
        $save = $pengajuan->update([
            'status_pengajuan' => $statusPengajuan,
            'komentar' => $request->komentar,
        ]);

        if($save){
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil memverifikasi cuti',
                'type' => 'success',
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi' => 'Gagal memverifikasi cuti',
                'type' => 'error',
            ]);
        }
    }

    public function showVerifikasiDirpenPage(){

        $verifikasiSedangDiproses = PengajuanCuti::whereIn('status_pengajuan',[
            'disetujui kepala sekolah menunggu tinjauan dirpen',
            'disetujui hrd menunggu tinjauan dirpen',
            'disetujui kepala hrd menunggu tinjauan dirpen',
            'ditinjau dirpen',
            ])->latest()->get();

        $verifikasiSelesai = PengajuanCuti::whereIn('status_pengajuan',[
            'disetujui dirpen',
            'ditolak dirpen',
            ])->orderBy('updated_at', 'desc')->get();

        return view('admin.verifikasi-cuti-dirpen',[
            'dataSedangDiproses' => $verifikasiSedangDiproses,
            'dataSelesai' => $verifikasiSelesai,
        ]);
    }

    public function verifikasiCutiDirpen(Request $request,$id_pengajuan){
        $validatedData = $request->validate([
            'status_pengajuan' => 'required',
            'komentar' => 'nullable|string|max:1000',
        ], [
            'status_pengajuan.required' => 'Status pengajuan wajib diisi.',
            'komentar.string' => 'Komentar harus berupa teks.',
            'komentar.max' => 'Komentar maksimal 1000 karakter.',
        ]);

        // Ambil data pengajuan
        $pengajuan = PengajuanCuti::findOrFail($id_pengajuan);

        // Simpan perubahan
        $save = $pengajuan->update([
            'status_pengajuan' => $request->status_pengajuan,
            'komentar' => $request->komentar,
        ]);

        if($save){
            return redirect()->back()->with([
                'notifikasi' => 'Berhasil memverifikasi cuti',
                'type' => 'success',
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi' => 'Gagal memverifikasi cuti',
                'type' => 'error',
            ]);
        }
    }
}
