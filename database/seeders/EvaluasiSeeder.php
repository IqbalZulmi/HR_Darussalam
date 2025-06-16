<?php

namespace Database\Seeders;

use App\Models\Evaluasi;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EvaluasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // // Ambil beberapa user yang ada
        // $users = User::all();

        // // Pastikan ada data user
        // if ($users->isEmpty()) {
        //     echo "Data user kosong.\n";
        //     return;
        // }

        // // Buat data evaluasi untuk setiap user
        // foreach ($users as $user) {
        //     Evaluasi::create([
        //         'id_user' => $user->id,
        //         'nilai' => rand(70, 100), // Nilai acak antara 70 dan 100
        //         'komentar' => 'Evaluasi untuk pengguna ', // Komentar disesuaikan dengan nama user
        //     ]);
        // }
    }
}
