<?php

namespace Database\Seeders;

use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\Pegawai;
use App\Models\TempatBekerja;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            PermissionSeeder::class,
            UsersSeeder::class,
        ]);

        Pegawai::factory(3)->create();
        // TempatBekerja::factory(2)->create();
        // Golongan::factory(2)->create();
        // Jabatan::factory(2)->create();
    }
}
