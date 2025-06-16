<?php

namespace Database\Seeders;

use App\Models\KategoriEvaluasi;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriEvaluasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $kategori = [
            'Disiplin',
            'Etika Kerja',
            'Kepatuhan',
            'Kreativitas',
            'Kerjasama',
            'Komunikasi'
        ];

        foreach ($kategori as $item) {
            KategoriEvaluasi::create(['nama' => $item]);
        }
    }
}
