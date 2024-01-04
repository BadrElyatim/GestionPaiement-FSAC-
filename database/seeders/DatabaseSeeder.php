<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'nom' => 'admin',
            'prenom' => 'admin',
            'telephone' => '0613431414',
            'password' => Hash::make('admin'),
            'role' => 'admin',
            'email' => 'admin@gmail.com',
        ]);
        \App\Models\User::create([
            'nom' => 'reg',
            'prenom' => 'reg',
            'telephone' => '05436546456',
            'password' => Hash::make('reg'),
            'role' => 'regisseur',
            'email' => 'reg@gmail.com',
        ]);
    }
}
