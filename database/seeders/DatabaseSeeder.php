<?php

namespace Database\Seeders;

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
            JabatanSeeder::class,
            DepartementSeeder::class,
            TempatKerjaSeeder::class,
            ProfileSeeder::class,
            KeluargaSeeder::class,
            OrangTuaSeeder::class,
            SosialMediaSeeder::class,
            UserSosialMediaSeeder::class,
            AbsensiSeeder::class,
            PengajuanCutiSeeder::class,
            EvaluasiSeeder::class,
            JamKerjaSeeder::class,
        ]);


    }
}
