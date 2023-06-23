<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $role = $this->command->ask('What is the role of the user (admin or client) ?');

        User::create([
            "name" => "Youssef El Idrissi",
            "username" => "admin",
            "email" => "a@gmail.com",
            "role" => "admin",
            "password" => bcrypt("1234")
        ]);

        User::create([
            "name" => "Client",
            "username" => "client1",
            "email" => "c@gmail.com",
            "role" => "client",
            "password" => bcrypt("1234")
        ]);
    }
}
