<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Unit;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LaratrustSeeder::class);
        
        Unit::create([
            'unitName' => 'Botol'
        ]);

        Unit::create([
            'unitName' => 'Bungkus'
        ]);

        Unit::create([
            'unitName' => 'Dus'
        ]);

        Unit::create([
            'unitName' => 'Karung'
        ]);

        Unit::create([
            'unitName' => 'Kaleng'
        ]);

        Unit::create([
            'unitName' => 'Kg'
        ]);

        Unit::create([
            'unitName' => 'Pcs'
        ]);

        Unit::create([
            'unitName' => 'Lembar'
        ]);

        Unit::create([
            'unitName' => 'Liter'
        ]);

        Unit::create([
            'unitName' => 'Pasang'
        ]);

        User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
        ])->attachRole('admin');

        User::create([
            'name' => 'user',
            'email' => 'user@gmail.com',
            'password' => Hash::make('user123'),
        ])->attachRole('user');
    }
}
