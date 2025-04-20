<?php

namespace Database\Factories;

use App\Models\Golongan;
use App\Models\Jabatan;
use App\Models\TempatBekerja;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pegawai>
 */
class PegawaiFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' =>$this->faker->randomElement(['1', '2','3']), // Membuat user baru secara otomatis
            'id_tempat_bekerja' => TempatBekerja::factory(), // Membuat tempat_bekerja baru
            'id_jabatan' => Jabatan::factory(), // Membuat jabatan baru
            'id_golongan' => Golongan::factory(), // Membuat golongan baru
            'nama' => $this->faker->name(),
            'alamat' => $this->faker->address(),
            'no_telepon' => $this->faker->phoneNumber(),
            'tanggal_lahir' => $this->faker->date(),
            'gender' => $this->faker->randomElement(['pria', 'wanita']),
            'foto' => null, // Bisa diisi dengan path foto yang valid jika diperlukan
            'tanggal_masuk' => $this->faker->date(),
        ];
    }
}
