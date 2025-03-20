<?php

namespace Database\Factories;

use App\Models\TempatBekerja;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\admin>
 */
class AdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id_user' => User::factory(), // Membuat user baru otomatis
            'id_tempat_bekerja' => TempatBekerja::factory(), // Membuat tempat_bekerja baru otomatis
            'nama' => $this->faker->name(),

        ];
    }
}
