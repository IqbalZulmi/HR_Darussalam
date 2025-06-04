<?php

namespace App\Http\Controllers;

use App\Models\absensi;
use App\Models\JamKerja;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class AbsensiController extends Controller
{
    public function showRekapTodayPage(){
        return view('admin.kelola-absensi-today',[

        ]);
    }

    public function showRekapPribadiPage(){
        return view('pegawai.rekap-absensi-pribadi',[

        ]);
    }

    public function checkInProcess(Request $request){
        $validatedData = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ],[
            'latitude.required' => 'latitude harus diisi',
            'longitude.required' => 'longitude harus diisi',
        ]);

        if(!$validatedData){
            return redirect()->back()->with([
                'notifikasi' => 'latitude atau longitude harus diisi',
                'type' => 'warning'
            ]);
        }


        $user = Auth::user();
        $today = Carbon::now()->toDateString();

        // Cek apakah sudah check-in hari ini
        $sudahCheckIn = Absensi::where('id_user', $user->id)
            ->whereDate('tanggal', $today)
            ->whereNotNull('check_in')
            ->exists();

        if ($sudahCheckIn) {
            return redirect()->back()->with([
                'notifikasi' => 'Anda sudah melakukan check-in hari ini.',
                'type' => 'warning'
            ]);
        }


        if (!$user->profilePekerjaan || !$user->profilePekerjaan->tempatKerja) {
            return redirect()->back()->with([
                'notifikasi' => 'Lokasi kantor tidak tersedia. Silakan hubungi HR.',
                'type' => 'error'
            ]);
        }

        // lokasi kantor
        $officeLat = $user->profilePekerjaan->tempatKerja->latitude;
        $officeLon = $user->profilePekerjaan->tempatKerja->longitude;

        //lokasi user
        $userLat = $request->latitude;
        $userLon = $request->longitude;

        // Hitung jarak menggunakan Haversine Formula
        $distance = $this->calculateDistance($officeLat, $officeLon, $userLat, $userLon);

        //jarak dalam meter
        $jarak = round($distance);

        //lebih dari 500 meter
        if ($distance > 500) {
            return redirect()->back()->with([
                'notifikasi' => 'Anda berada di luar radius '. $jarak .' meter dari kantor.',
                'type' => 'error'
            ]);
        }

        // Tentukan hari sekarang
        $hariSekarang = strtolower(Carbon::now()->locale('id')->dayName); // contoh: "senin"
        $jabatanId = $user->profilePekerjaan->id_jabatan ?? null;

        $jamKerja = JamKerja::where('id_jabatan', $jabatanId)
            ->where('hari', $hariSekarang)
            ->first();

        if (!$jamKerja || $jamKerja->is_libur) {
            return redirect()->back()->with([
                'notifikasi' => 'Hari ini adalah hari libur atau jam kerja belum diatur.',
                'type' => 'warning'
            ]);
        }

        $jamMasuk = Carbon::createFromFormat('H:i:s', $jamKerja->jam_masuk);
        $waktuSekarang = Carbon::now();

        // Hitung selisih waktu dalam menit
        $selisihMenit = $jamMasuk->diffInMinutes($waktuSekarang, false);

        // Tentukan status
        $status = $selisihMenit > 15 ? 'terlambat' : 'hadir';

        // Simpan absensi (check-in)
        $save = Absensi::create([
            'id_user' => $user->id,
            'tanggal' => $today,
            'check_in' => $waktuSekarang,
            'latitude_in' => $userLat,
            'longitude_in' => $userLon,
            'status' => $status,
        ]);

        if($save){
            return redirect()->back()->with([
                'notifikasi' => 'Check-in berhasil!',
                'type' => 'success'
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi' => 'Check-in gagal!',
                'type' => 'error'
            ]);
        }
    }

    private function calculateDistance($lat1, $lon1, $lat2, $lon2)
    {
         $earthRadius = 6371000; // Radius bumi dalam meter

        $dLat = deg2rad($lat2 - $lat1);
        $dLon = deg2rad($lon2 - $lon1);

        $lat1 = deg2rad($lat1);
        $lat2 = deg2rad($lat2);

        $a = sin($dLat / 2) * sin($dLat / 2) +
            sin($dLon / 2) * sin($dLon / 2) * cos($lat1) * cos($lat2);

        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));
        $distance = $earthRadius * $c;

        return $distance; // hasil dalam meter
    }


    public function checkOutProcess(Request $request)
    {
        $validatedData = $request->validate([
            'latitude' => 'required',
            'longitude' => 'required',
        ], [
            'latitude.required' => 'Latitude wajib diisi.',
            'longitude.required' => 'Longitude wajib diisi.',
        ]);

        if(!$validatedData){
            return redirect()->back()->with([
                'notifikasi' => 'latitude atau longitude harus diisi',
                'type' => 'warning'
            ]);
        }

        $user = Auth::user();
        $today = Carbon::now()->toDateString();

        // Cek apakah sudah check-in hari ini
        $absen = Absensi::where('id_user', $user->id)
            ->whereDate('tanggal', $today)
            ->whereNotNull('check_in')
            ->first();

        if (!$absen) {
            return redirect()->back()->with([
                'notifikasi' => 'Anda belum melakukan check-in hari ini.',
                'type' => 'warning'
            ]);
        }

        // Cek apakah sudah check-out
        if ($absen->check_out !== null) {
            return redirect()->back()->with([
                'notifikasi' => 'Anda sudah melakukan check-out hari ini.',
                'type' => 'info'
            ]);
        }

        // Simpan check-out
        $update = $absen->update([
            'check_out' => Carbon::now(),
            'latitude_out' => $request->latitude,
            'longitude_out' => $request->longitude,
        ]);

        if($update){
            return redirect()->back()->with([
                'notifikasi' => 'Check-out berhasil!',
                'type' => 'success'
            ]);
        }else{
            return redirect()->back()->with([
                'notifikasi' => 'Check-out gagal!',
                'type' => 'error'
            ]);

        }
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(absensi $absensi)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(absensi $absensi)
    {
        return view('admin.rekap-absen-pegawai',[

        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, absensi $absensi)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(absensi $absensi)
    {
        //
    }
}
