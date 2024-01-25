<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Pyae Phyo Khant',
            'email' => 'pyaephyokhant2020dc@gmail.com',
            'phone' => '09760892129',
            'address' => 'Kume',
            'role' => 'admin',
            'password' => Hash::make('ppk12345')
        ]);
    }
}
