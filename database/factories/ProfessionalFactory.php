<?php

namespace Database\Factories;

use App\Models\MedicalSpecialty;
use App\Models\Portfolio;
use App\Models\Professional;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Professional>
 */
class ProfessionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'rut' => $this->faker->unique()->numerify('########-#'),
            'phone' => $this->faker->phoneNumber,
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Professional $professional)
        {
            $specialties = MedicalSpecialty::inRandomOrder()->take(rand(1, 3))->pluck('id');

            $professional->medicalSpecialties()->attach($specialties);

            Portfolio::factory()
                ->count(rand(1, 5))
                ->create(['professional_id' => $professional->id]);
        });
    }
}
