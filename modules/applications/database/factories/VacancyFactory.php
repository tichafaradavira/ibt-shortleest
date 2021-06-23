<?php
namespace Modules\Applications\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Applications\Models\Vacancy;
use Modules\Properties\Models\Property;

class VacancyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vacancy::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'status' => $this->faker->boolean ,
            'available_from' => $this->faker->dateTimeThisDecade,
            'reference' => Str::random(7),
        ];
    }
}

