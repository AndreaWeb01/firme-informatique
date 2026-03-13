<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guard = (string) config('auth.defaults.guard', 'web');

        // Créer un utilisateur admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@firme-informatiquee.com'],
            [
                'name' => 'Admin',
                'prenom' => 'Firme',
                'telephone' => '+000000000',
                'password' => Hash::make('password'),
            ]
        );

        // Assigner le rôle admin
        $adminRole = Role::findByName('administrateur', $guard);
        $admin->assignRole($adminRole);
    }
}