<?php

namespace Database\Seeders;

use App\Models\Professional;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProfessionalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if (Professional::count() === 0) {
            Professional::factory()->count(10)->create();
        }
    }
}
