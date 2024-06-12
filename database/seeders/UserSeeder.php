<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        if(!User::where('email', 'luis@api>com')->first()){
            User::create([
                'name' => 'Luis',
                'email' => 'luis@api.com',
                'password' => Hash::make('123456a', ['rounds' => 12]),
            ]);
        }

        if(!User::where('email', 'lari@api>com')->first()){
            User::create([
                'name' => 'lari',
                'email' => 'lari@api.com',
                'password' => Hash::make('654321a', ['rounds' => 12]),
            ]);
        }

        if(!User::where('email', 'bea@api>com')->first()){
            User::create([
                'name' => 'bea',
                'email' => 'bea@api.com',
                'password' => Hash::make('246810a', ['rounds' => 12]),
            ]);
        }
    }
}
