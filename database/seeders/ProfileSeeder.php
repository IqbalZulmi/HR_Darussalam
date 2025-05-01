<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\Jabatan;
use App\Models\Profile;
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

        // Pastikan ada data di departemen dan jabatan
        if ($departemens->isEmpty() || $jabatans->isEmpty()) {
            $this->command->warn('Seeder dibatalkan: Departemen atau Jabatan kosong.');
            return;
        }

        foreach (User::all() as $user) {
            Profile::create([
                'id_user' => $user->id,
                'id_departemen' => $departemens->random()->id,
                'id_jabatan' => $jabatans->random()->id,
                'nomor_induk_kependudukan' => mt_rand(1000000000000000, 9999999999999999),
                'nomor_induk_karyawan' => strtoupper(Str::random(6)),
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
        }
    }
}
