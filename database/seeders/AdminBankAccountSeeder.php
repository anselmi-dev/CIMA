<?php

namespace Database\Seeders;

use App\Models\AdminBankAccount;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminBankAccountSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        AdminBankAccount::factory()->count(2)->create();
    }
}
