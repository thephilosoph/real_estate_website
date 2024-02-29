<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert(
            [
                [
                    "name" => "admin",
                    "username" => "admin",
                    "email" => "admin@gmail.com",
                    "password" => Hash::make('111'),
                    "role" => "admin",
                    "status" => "active"
                ],
                [
                    "name" => "user",
                    "username" => "user",
                    "email" => "user@gmail.com",
                    "password" => Hash::make('111'),
                    "role" => "user",
                    "status" => "active"
                ],
                [
                    "name" => "agent",
                    "username" => "agent",
                    "email" => "agent@gmail.com",
                    "password" => Hash::make('111'),
                    "role" => "agent",
                    "status" => "active"
                ]
            ]
        );
    }
}
