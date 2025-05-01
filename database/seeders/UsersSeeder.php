<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data user dan role yang ingin di-assign
        $users = [
            [
                'email' => 'superadmin@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'superadmin',
            ],
            [
                'email' => 'kepalahrd@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'kepala hrd',
            ],
            [
                'email' => 'tendik@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'Tenaga Pendidik',
            ],
            [
                'email' => 'kepalayayasan@gmail.com',
                'password' => bcrypt('password'),
                'role' => 'Kepala Yayasan',
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate([
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            // Assign role
            $role = Role::firstOrCreate(['name' => $data['role']]);
            $user->assignRole($role);
        }
    }
}
