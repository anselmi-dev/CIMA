<?php

namespace Database\Factories;

use App\Models\Bank;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\AdminBankAccount>
 */
class AdminBankAccountFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'bank_id' => Bank::query()->inRandomOrder()->value('id') ?? Bank::factory(),
            'bank_details' => [
                'full_name' => $this->faker->name,
                'email' => $this->faker->email,
                'account_number' => $this->faker->bankAccountNumber,
                'rut' => $this->faker->numerify('########-#'),
            ],
            'status' => $this->faker->boolean,
            'notes' => $this->faker->paragraph,
        ];
    }
}
