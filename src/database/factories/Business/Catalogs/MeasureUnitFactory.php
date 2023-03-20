<?php

namespace Database\Factories\Business\Catalogs;

use App\Models\Business\Catalogs\MeasureUnit;
use Illuminate\Database\Eloquent\Factories\Factory;

class MeasureUnitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = MeasureUnit::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomDigit(),
            'name' => $this->faker->title,
            'abbreviation' => $this->faker->randomLetter
        ];
    }
}
