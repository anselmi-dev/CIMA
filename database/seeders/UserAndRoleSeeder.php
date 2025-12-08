<?php

namespace Database\Seeders;

use App\Models\Professional;
use App\Models\User;
use Database\Factories\ProfessionalFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserAndRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role_develop = Role::firstOrCreate(['name' => 'develop']);

        $role_admin = Role::firstOrCreate(['name' => 'admin']);

        $role_professional = Role::firstOrCreate(['name' => 'professional']);

        $user_develop = User::firstOrCreate([
            'email' => 'anselmi.dev@gmail.com',
        ], [
            'name' => 'Anselmi Dev',
            'password' => Hash::make('19901020'),
            'email_verified_at' => now(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'profile_photo_path' => null,
            'current_team_id' => null,
       ]);

        if (!$user_develop->hasRole($role_develop->name))
            $user_develop->assignRole($role_develop->name);


        $user_admin = User::firstOrCreate([
            'email' => 'macaperagallo@gmail.com',
        ], [
            'name' => 'Macarena Peragallo',
            'password' => Hash::make('admin1234'),
            'email_verified_at' => now(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        if (!$user_admin->hasRole($role_admin->name))
            $user_admin->assignRole($role_admin->name);

        $user_professional = User::firstOrCreate([
            'email' => 'professional@infinety.es',
        ], [
            'name' => 'Operador',
            'password' => Hash::make('19901020'),
            'email_verified_at' => now(),
            'two_factor_secret' => null,
            'two_factor_recovery_codes' => null,
            'profile_photo_path' => null,
            'current_team_id' => null,
        ]);

        if (!$user_professional->hasRole($role_professional->name))
            $user_professional->assignRole($role_professional->name);
    }
}
