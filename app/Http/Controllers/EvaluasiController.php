<?php

namespace App\Http\Controllers;

use App\Models\evaluasi;
use App\Models\KategoriEvaluasi;
use App\Models\TahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EvaluasiController extends Controller
{
    public function showEvaluasiPage(){
        return view('admin.evaluasi-pegawai',[

        ]);
    }

    public function storeEvaluasi(Request $request){
        $validatedData = $request->validate([
            'id_user' => 'required|exists:users,id',
            'id_tahun_ajaran' => 'required|exists:tahun_ajarans,id',
            'nilai' => 'required|array',
            'nilai.*' => 'required|numeric|min:1|max:5',
            'catatan' => 'nullable|string|max:1000',
        ], [
            // id_user
            'id_user.required' => 'Nama pendidik wajib dipilih.',
            'id_user.exists' => 'Pendidik tidak valid.',

            // id_tahun_ajaran
            'id_tahun_ajaran.required' => 'Tahun ajaran wajib dipilih.',
            'id_tahun_ajaran.exists' => 'Tahun ajaran tidak valid.',

            // nilai
            'nilai.required' => 'Penilaian tidak boleh kosong.',
            'nilai.array' => 'Format nilai tidak valid.',
            'nilai.*.required' => 'Semua indikator penilaian harus diisi.',
            'nilai.*.numeric' => 'Nilai harus berupa angka.',
            'nilai.*.min' => 'Nilai minimal adalah 1.',
            'nilai.*.max' => 'Nilai maksimal adalah 5.',

            // catatan
            'catatan.string' => 'Catatan harus berupa teks.',
            'catatan.max' => 'Catatan maksimal 1000 karakter.',
        ]);

        try {
            DB::beginTransaction();

            foreach ($validatedData['nilai'] as $idKategori => $nilai) {
                Evaluasi::create([
                    'id_user' => $validatedData['id_user'],
                    'id_penilai' => Auth::user()->id,
                    'id_kategori' => $idKategori,
                    'id_tahun_ajaran' => $validatedData['id_tahun_ajaran'],
                    'nilai' => $nilai,
                    'catatan' => $validatedData['catatan'], // bisa sama untuk semua atau disesuaikan
                ]);
            }

            DB::commit();

            return redirect()->back()->with([
                'notifikasi' => 'Evaluasi berhasil disimpan.',
                'type' => 'success'
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return redirect()->back()->with([
                'notifikasi' => 'Terjadi kesalahan saat menyimpan evaluasi.',
                'type' => 'error'
            ]);
        }
    }
}
