<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Modules\Applications\Database\Seeders\VacanciesSeeder;
use Modules\Properties\Database\Seeders\PropertiesSeeder;
use Modules\Users\Database\Seeders\UsersSeeder;

class DemoSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        $this->call(UsersSeeder::class);
        $this->call(PropertiesSeeder::class);
        $this->call(VacanciesSeeder::class);
    }
}
