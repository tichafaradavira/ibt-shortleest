<?php

namespace Modules\Properties\Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Properties\Models\Client;
use Modules\Properties\Models\Property;
use Modules\Users\Models\User;

class PropertiesSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $users = User::query()->where('is_admin', false)->get();

        foreach ($users as $user) {
            Client::factory()
                ->count(5)
                ->create([
                    'user_id' => $user->id
                ]);
        }

        $clients = Client::query()->get();

        foreach ($clients as $client) {
            Property::factory()
                ->count(5)
                ->create([
                    'user_id' => $client->realtor->id,
                    'client_id' => $client->id
                ]);
        }
    }
}
