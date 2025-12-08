<?php

namespace Database\Factories;

use App\Models\Professional;
use App\Models\Patient;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $startTime = $this->faker->dateTimeBetween('now', '+7 days');
        $endTime = (clone $startTime)->modify('+1 hour');

        $professional = Professional::query()->inRandomOrder()->first() ?? Professional::factory();

        return [
            'professional_id' => $professional->id,
            'patient_id' => Patient::query()->where('professional_id', $professional->id)->inRandomOrder()->value('id') ?? Patient::factory(),
            'medical_specialty_id' => $professional->medicalSpecialties()->first()->id,
            'is_presence' => $this->faker->boolean(),
            'start_at' => $startTime,
            'end_at' => $endTime,
            'status' => $this->faker->randomElement(['pending', 'completed', 'cancelled']),
            'created_at' => $startTime,
        ];
    }
}
