<?php

namespace Database\Seeders;

use App\Models\Bank;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BankSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        collect([
            'Banco de Chile',
            'Banco Internacional',
            'Scotiabank Chile',
            'Banco de Crédito e Inversiones',
            'Banco BICE',
            'HSBC Bank (Chile)',
            'Banco Santander Chile',
            'Itaú Corpbanca',
            'Banco Security',
            'Banco Falabella',
            'Banco Ripley',
            'Banco Consorcio',
            'Banco BTG Pactual Chile',
            'BancoEstado'
        ])->map(function ($name) {
            Bank::factory()->create(['name' => $name]);
        });
    }
}
