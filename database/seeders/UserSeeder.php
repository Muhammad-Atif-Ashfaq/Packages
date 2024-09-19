<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Enums\UserTypesEnum;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'admin',
            'email'=> 'admin@admin.com',
            'password' => hash::make('password'),
            'role' =>  UserTypesEnum::ADMIN
        ]);

        $user = User::create([
            'name' => 'user',
            'email'=> 'user@user.com',
            'password' => hash::make('password'),
            'role' =>  UserTypesEnum::USER
        ]);
    }
}
