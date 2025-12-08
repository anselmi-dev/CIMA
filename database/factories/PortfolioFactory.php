<?php

namespace Database\Factories;

use App\Models\Professional;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Portfolio>
 */
class PortfolioFactory extends Factory
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
            'title' => $this->faker->jobTitle, // Genera un título ficticio relacionado con un trabajo
            'period' => $this->faker->year . ' - ' . $this->faker->year, // Genera un periodo ficticio
            'institute' => $this->faker->company, // Genera un nombre ficticio de institución
        ];
    }
}
