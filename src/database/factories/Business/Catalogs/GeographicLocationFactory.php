<?php

namespace Database\Factories\Business\Catalogs;

use App\Models\Business\Catalogs\GeographicLocation;
use Illuminate\Database\Eloquent\Factories\Factory;

class GeographicLocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = GeographicLocation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomDigit(),
            'parent_id' => null,
            'code' => $this->faker->numerify('##'),
            'description' => $this->faker->sentence,
            'type' => $this->faker->randomElement([GeographicLocation::TYPE_CANTON, GeographicLocation::TYPE_PARISH])
        ];
    }
}
