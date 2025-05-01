<?php

namespace Database\Seeders;

use App\Models\Departemen;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Ambil beberapa user untuk dijadikan kepala departemen
        $users = User::all();

        // Pastikan ada cukup user untuk masing-masing departemen
        if ($users->count() < 3) {
            echo "Tidak cukup user untuk mengisi kepala departemen.\n";
            return;
        }

        // Membuat departemen dan mengassign kepala departemen yang berbeda
        Departemen::create([
            'id_kepala_departemen' => $users[0]->id, // Kepala untuk Teknologi Informasi
            'nama_departemen' => 'Teknologi Informasi',
        ]);

        Departemen::create([
            'id_kepala_departemen' => $users[1]->id, // Kepala untuk Keuangan
            'nama_departemen' => 'Keuangan',
        ]);

        Departemen::create([
            'id_kepala_departemen' => $users[2]->id, // Kepala untuk Sumber Daya Manusia
            'nama_departemen' => 'Sumber Daya Manusia',
        ]);
    }
}
