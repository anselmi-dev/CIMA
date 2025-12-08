<?php

namespace Database\Seeders;

use App\Models\MedicalSpecialty;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicalSpecialtySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // MedicalSpecialty::factory()->count(10)->create();
        collect([
            'Cardiología',
            'Dermatología',
        ])->map(function ($name) {
            MedicalSpecialty::firstOrCreate(['name' => $name]);
        });
    }
}
