<?php

namespace Database\Factories;

use App\Models\Professional;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'professional_id' => Professional::query()->inRandomOrder()->value('id') ?? Professional::factory(),
            'name' => $this->faker->firstName,
            'lastname' => $this->faker->lastName,
            'rut' => $this->faker->numerify('########-#'),
            'birthday' => $this->faker->date(),
            'email' => $this->faker->unique()->safeEmail,
            'phone' => $this->faker->phoneNumber,
            'created_at' => $this->faker->dateTimeBetween('-7 days', 'now'),
        ];
    }
}
