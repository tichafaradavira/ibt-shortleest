<?php

namespace Modules\Applications\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Arr;
use Modules\Applications\Models\Application;
use Modules\Applications\Models\Vacancy;
use Modules\Properties\Models\Property;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'first_name' => $this->faker->firstName,
            'middle_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'nationality' => $this->faker->country,
            'citizenship' => $this->faker->country,
            'national_id' => $this->faker->bankAccountNumber,
            'gender' => Arr::random(['male', 'female']),
            'dob' => Carbon::now()->addYears(-20),

            'mobile_number' => $this->faker->phoneNumber,
            'home_number' => $this->faker->phoneNumber,
            'work_number' => $this->faker->phoneNumber,
            'email' => $this->faker->email,
            'fax' => $this->faker->phoneNumber,


            'physical_address_street' => $this->faker->streetAddress,
            'physical_address_surburb' => $this->faker->word,
            'physical_address_city' => $this->faker->city,
            'physical_address_postcode' => $this->faker->postcode,
            'postal_equal_to_physical' => $this->faker->boolean,
            'postal_address_street' => $this->faker->streetAddress,
            'postal_address_surburb' => $this->faker->word,
            'postal_address_city' => $this->faker->city,
            'postal_address_postcode' => $this->faker->postcode,


            'employment_status' => $this->faker->word,
            'employer_name' => $this->faker->company,
            'employer_phone' => $this->faker->phoneNumber,
            'employer_email' => $this->faker->companyEmail,
            'employer_address' => $this->faker->address,
            'gross_salary' => $this->faker->numberBetween(2000, 5000),

            'dependants' => $this->faker->numberBetween(1, 4),
            'reason_for_moving' => $this->faker->paragraph,
            'is_smoker' => $this->faker->boolean,
            'has_pets' => $this->faker->boolean,

            'next_of_kin_name' =>$this->faker->name,
            'next_of_kin_email' =>$this->faker->email,
            'next_of_kin_phone' =>$this->faker->phoneNumber,
            'next_of_kin_address' =>$this->faker->address,
            'references' => [
                [
                    'name' => $this->faker->name,
                    'email' => $this->faker->email,
                    'phone' => $this->faker->phoneNumber,
                    'address' => $this->faker->address,
                ],
                [
                    'name' => $this->faker->name,
                    'email' => $this->faker->email,
                    'phone' => $this->faker->phoneNumber,
                    'address' => $this->faker->address,
                ],
            ],
            'expenses' => [
                [
                    "expense" => $this->faker->word,
                    "cost" => (float)$this->faker->numberBetween(100, 1000)
                ],     [
                    "expense" => $this->faker->word,
                    "cost" => (float)$this->faker->numberBetween(100, 1000)
                ],     [
                    "expense" => $this->faker->word,
                    "cost" => (float)$this->faker->numberBetween(100, 1000)
                ],     [
                    "expense" => $this->faker->word,
                    "cost" => (float)$this->faker->numberBetween(100, 1000)
                ],

            ],
        ];
    }

    public function getArray()
    {

    }
}

