<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    { {
            User::updateOrCreate([
                'id' => 1,
                'role_id' => '1',
                'name' => 'nahom',
                'email' => 'nahom@gmail.com',
                'password' => Hash::make('password'),
            ]);
            User::updateOrCreate([
                'id' => 2,
                'role_id' => '1',
                'name' => 'nvmaanen',
                'email' => 'nvmaanen@live.nl',
                'password' => Hash::make('password'),
            ]);

            User::updateOrCreate([
                'id' => 3,
                'role_id' => 2,
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
            User::updateOrCreate([
                'id' => 4,
                'role_id' => 2,
                'name' => Str::random(10),
                'email' => Str::random(10) . '@gmail.com',
                'password' => Hash::make('password'),
            ]);
        }
    }
}
