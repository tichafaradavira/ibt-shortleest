<?php

namespace Modules\Applications\Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Modules\Applications\Models\Application;
use Modules\Applications\Models\Vacancy;
use Modules\Properties\Models\Property;
use Modules\Users\Models\User;

class VacanciesSeeder extends Seeder
{
    /**
     * Run the database seeders.
     *
     * @return void
     */
    public function run()
    {
        $properties = Property::query()->get();

        foreach ($properties as $property) {
            $token =  Str::random(50);

            Vacancy::factory()
                ->create([
                    'user_id' => $property->realtor->id,
                    'property_id' => $property->id,
                    'token' => $token,
                    'link' =>  "/apply/".$property->realtor->id."/".$token,
                ]);

        }

        $vacancies = Vacancy::query()->get();

        foreach ($vacancies as $vacancy) {

            Application::factory()
                ->count(1)
                ->create([
                    'user_id' => $vacancy->realtor->id,
                    'property_id' => $vacancy->property->id,
                    'vacancy_id' => $vacancy->id,
                ]);

        }
    }
}
