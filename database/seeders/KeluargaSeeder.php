<?php

namespace Database\Seeders;

use App\Models\Keluarga;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KeluargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach (User::all() as $user) {
            // Simulasikan satu istri dan dua anak per user
            Keluarga::create([
                'id_user' => $user->id,
                'nama' => 'Ayu ',
                'hubungan' => 'istri',
                'tanggal_lahir' => now()->subYears(30)->subDays(rand(0, 365)),
                'pekerjaan' => 'Ibu Rumah Tangga',
            ]);

            for ($i = 1; $i <= 2; $i++) {
                Keluarga::create([
                    'id_user' => $user->id,
                    'nama' => 'Anak ke' . $i ,
                    'hubungan' => 'anak',
                    'tanggal_lahir' => now()->subYears(rand(5, 15))->subDays(rand(0, 365)),
                    'pekerjaan' => 'Pelajar',
                ]);
            }
        }
    }
}
