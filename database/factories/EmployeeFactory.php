<?php

namespace Database\Factories;

use App\Models\Departemen;
use App\Models\Position;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nama_lengkap' => $this->faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'nomor_telepon' => $this->faker->numerify('08######'),
            'tanggal_lahir' => $this->faker->date('Y-m-d', '-20 years'),
            'alamat' => $this->faker->address(),
            'tanggal_masuk' => $this->faker->dateTimeBetween('-5 years', 'now'),
            'status' => $this->faker->randomElement(['aktif', 'nonaktif']),
            'departemen_id' => Departemen::inRandomOrder()->first()?->id ?? 1,
            'jabatan_id' => Position::inRandomOrder()->first()?->id ?? 1,
        ];
    }
}




