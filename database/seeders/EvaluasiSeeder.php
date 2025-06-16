<?php

namespace Database\Seeders;

use App\Models\Evaluasi;
use App\Models\KategoriEvaluasi;
use App\Models\TahunAjaran;
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
        $users = User::all();
        $tahunAjarans = TahunAjaran::all();
        $kategoris = KategoriEvaluasi::all();

        foreach ($users as $user) {
            foreach ($tahunAjarans as $tahun) {
                foreach ($kategoris as $kategori) {
                    Evaluasi::create([
                        'id_user' => $user->id,
                        'id_tahun_ajaran' => $tahun->id,
                        'id_kategori' => $kategori->id,
                        'nilai' => rand(60, 100),
                        'catatan' => fake()->optional()->sentence()
                    ]);
                }
            }
        }
    }
}
