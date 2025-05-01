<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $modules = [
            //administrator
            'manajemen_role',
            'manajemen_hak_akses',
            'manajemen_hak_akses_user',

            //general
            'manajemen_profil',

            //hrd
            'manajemen_user',
            'manajemen_rekap_absensi',
            'manajemen_evaluasi',
            'verifikasi_cuti',

            //pegawai
            'rekap_absensi_pribadi',
            'pengajuan_cuti',
            'rekap_evaluasi_pribadi',
        ];

        $actions = ['create', 'read', 'update', 'delete'];

        foreach ($modules as $module) {
            foreach ($actions as $action) {
                Permission::firstOrCreate(['name' => "$module.$action"]);
            }
        }

        // Assign permissions to superadmin role
        $superAdminRole = Role::findByName('superadmin'); // Pastikan role 'superadmin' sudah ada

        // Ambil semua permission yang telah dibuat dan assign ke superadmin
        $permissions = Permission::all();
        $superAdminRole->givePermissionTo($permissions);
    }
}
