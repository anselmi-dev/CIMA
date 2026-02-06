<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $this->call([
            BankSeeder::class,
            MedicalSpecialtySeeder::class,
            ProfessionalSeeder::class,
            AdminBankAccountSeeder::class,
            AppointmentSeeder::class,
            PatientSeeder::class,
            UserAndRoleSeeder::class,
            SettingSeeder::class,
            FaqSeeder::class,
            PageSeeder::class,
            TestimonialSeeder::class,
        ]);
    }
}


