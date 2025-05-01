<?php

namespace Database\Seeders;

use App\Models\Absensi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;

class AbsensiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil semua user yang ada
        $users = User::all();

        // Pastikan ada data user
        if ($users->isEmpty()) {
            echo "Data user kosong.\n";
            return;
        }

        // Buat data absensi untuk setiap user
        foreach ($users as $user) {
            // Menggunakan Carbon untuk mendapatkan tanggal dan waktu
            $tanggal = Carbon::now()->toDateString(); // Tanggal hari ini
            $jamMasuk = Carbon::now()->setTime(8, 0)->toTimeString(); // Jam masuk (misalnya jam 8:00)
            $jamKeluar = Carbon::now()->setTime(17, 0)->toTimeString(); // Jam keluar (misalnya jam 17:00)

            Absensi::create([
                'id_user' => $user->id,
                'tanggal' => $tanggal,
                'jam_masuk' => $jamMasuk,
                'jam_keluar' => $jamKeluar,
                'status' => 'hadir', // Status bisa diubah sesuai kebutuhan
                'keterangan' => 'Tidak ada keterangan', // Keterangan bisa diubah atau dibiarkan kosong
            ]);
        }
    }
}
