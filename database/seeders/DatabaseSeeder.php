<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\User;
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
        // User::factory(10)->create();

        User::create([
            'name' => 'Test User',
            'email' => 'admin@gmail.com',
            'password' => '123',
            'role' => 'admin',
            'contact' => '09773942290'
        ]);

        Student::create([
            'name' => 'John Doe',
            'email' => 'student@gmail.com',
            'gender' => 'male',
            'contact' => '123456',
            'parent_contact' => '123456',
            'password' =>  Hash::make('123'),
        ]);
    }
}
