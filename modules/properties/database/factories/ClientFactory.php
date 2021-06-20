<?php
namespace Modules\Properties\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Modules\Properties\Models\Client;

class ClientFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Client::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'full_name' => $this->faker->name,
            'email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'description' => $this->faker->paragraph,
            'physical_address_street' => $this->faker->streetAddress,
            'physical_address_surburb' => $this->faker->word,
            'physical_address_city' => $this->faker->city,
            'physical_address_postcode' => $this->faker->postcode,
            'postal_equal_to_physical' => $this->faker->boolean,
            'postal_address_street' => $this->faker->streetAddress,
            'postal_address_surburb' => $this->faker->word,
            'postal_address_city' => $this->faker->city,
            'postal_address_postcode' => $this->faker->postcode,
        ];
    }
}

