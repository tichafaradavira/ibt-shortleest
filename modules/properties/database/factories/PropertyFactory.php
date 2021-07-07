<?php
namespace Modules\Properties\Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use Modules\Properties\Models\Property;

class PropertyFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Property::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'uuid' => Str::uuid()->toString(),
            'type' => $this->faker->numberBetween(1,3),
            'rental_price' => $this->faker->numberBetween(1000,5000),
            'area' =>  $this->faker->numberBetween(10,100),
            'description' =>  $this->faker->paragraph,
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

