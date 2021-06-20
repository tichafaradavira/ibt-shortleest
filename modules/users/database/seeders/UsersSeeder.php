<?php

namespace Modules\Users\Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Hash;
use Modules\Users\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::factory()
            ->count(1)
            ->create([
                'email' => 'admin@ibtrealtor.com',
                'is_admin' => true,
                'otp' => 3333,
            ]);

        $realtor1 = User::factory()
            ->count(1)
            ->create([
                'email' => 'realtor1@gmail.com',
                'password' => Hash::make('test12345'),
                'otp' => 3333,
                'settings' => [
                    'currency' => "\$",
                    'language' => "en",
                    'street_address' => "26621 Christiansen Knolls",
                    'suburb' => "Borrowdale",
                    'city' => "randburg",
                    'country' => "South Africa",
                    'zip_code' => "28316",
                ]
            ]);



        $realtor2 = User::factory()
            ->count(1)
            ->create([
                'email' => 'realtor2@gmail.com',
                'password' => Hash::make('test12345'),
                'otp' => 3333,
                'settings' => [
                    'currency' => "\$",
                    'language' => "en",
                    'street_address' => "26621 Christiansen Knolls",
                    'suburb' => "Borrowdale",
                    'city' => "randburg",
                    'country' => "South Africa",
                    'zip_code' => "28316",
                ]

            ]);


    }
}
