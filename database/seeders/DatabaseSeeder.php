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
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

    User::create([
            'name' => 'Jessy Jane',
            'email' => 'jessy@gmail.com',
            'phone' => '0997766543',
            'address' => 'Los Angeles',
            'gender' => 'Female',
            'role' => 'admin',
            'password' => Hash::make('admin1234')
        ]);
    }
}
