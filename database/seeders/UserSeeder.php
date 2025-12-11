<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(
            [
                "name" => 'Admin',
                "email" => "admin@email.com",
                "password" => Hash::make("password"),
                "role_id" => Role::where("name", "Admin")->first()->id,
            ]
        );

        User::create(
            [
                "name" => 'Librarian',
                "email" => "librarian@email.com",
                "password" => Hash::make("password"),
                "role_id" => Role::where("name", "Librarian")->first()->id,
            ]
        );

        User::create(
            [
                "name" => 'Student',
                "email" => "student@email.com",
                "password" => Hash::make("password"),
                "role_id" => Role::where("name", "User")->first()->id,
            ]
        );

        User::factory(10)->create();
    }
}
