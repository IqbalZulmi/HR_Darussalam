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
                'name' => 'Kepala HRD',
                'email' => 'kepala.hrd@example.com',
                'password' => bcrypt('password'),
                'role' => 'Kepala HRD',
            ],
            [
                'name' => 'Tenaga Pendidik',
                'email' => 'tenaga.pendidik@example.com',
                'password' => bcrypt('password'),
                'role' => 'Tenaga Pendidik',
            ],
            [
                'name' => 'Kepala Yayasan',
                'email' => 'kepala.yayasan@example.com',
                'password' => bcrypt('password'),
                'role' => 'Kepala Yayasan',
            ],
        ];

        foreach ($users as $data) {
            $user = User::firstOrCreate([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            // Assign role
            $role = Role::firstOrCreate(['name' => $data['role']]);
            $user->assignRole($role);
        }
    }
}
