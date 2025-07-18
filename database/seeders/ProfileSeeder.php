<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\Profile;
use App\Models\ProfilePekerjaan;
use App\Models\ProfilePribadi;
use App\Models\TempatKerja;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $departemens = Departemen::all();
        $jabatans = Jabatan::all();
        $tempatKerja = TempatKerja::all();

        // Pastikan ada data di departemen dan jabatan
        if ($departemens->isEmpty() || $jabatans->isEmpty() || $tempatKerja->isEmpty()) {
            $this->command->warn('Seeder dibatalkan: Departemen atau Jabatan atau tempat kerja kosong.');
            return;
        }

        foreach (User::all() as $user) {
            ProfilePribadi::create([
                'id_user' => $user->id,
                'nomor_induk_kependudukan' => mt_rand(1000000000000000, 9999999999999999),
                'nama_lengkap' => $user->email,
                'tempat_lahir' => 'Batam',
                'tanggal_lahir' => now()->subYears(rand(22, 40))->subDays(rand(1, 365)),
                'jenis_kelamin' => ['pria', 'wanita'][rand(0, 1)],
                'golongan_darah' => ['a', 'b', 'ab', 'o'][rand(0, 3)],
                'status_pernikahan' => ['belum nikah', 'sudah nikah'][rand(0, 1)],
                'npwp' => mt_rand(100000000000000, 999999999999999),
                'kecamatan' => 'Batu Aji',
                'alamat_lengkap' => 'Jl. Pendidikan No. ' . rand(1, 100),
                'no_hp' => '08' . rand(1111111111, 9999999999),
                'foto' => null,
            ]);

            ProfilePekerjaan::create([
                'id_user' => $user->id,
                'id_departemen' => $departemens->random()->id,
                'id_tempat_kerja' => $tempatKerja->random()->id,
                'id_jabatan' => $jabatans->random()->id,
                'nomor_induk_karyawan' => strtoupper(Str::random(6)),
                'tanggal_masuk' => now()->subYears(rand(22, 40))->subDays(rand(1, 365)),
                'status' => collect(['aktif', 'nonaktif', 'kontrak', 'tetap', 'magang', 'honorer', 'pensiun', 'cuti', 'skorsing'])->random(),
            ]);
        }
    }
}
