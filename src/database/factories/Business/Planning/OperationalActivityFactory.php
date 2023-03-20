<?php

namespace Database\Factories\Business\Planning;

use App\Models\Business\Planning\OperationalActivity;
use Illuminate\Database\Eloquent\Factories\Factory;

class OperationalActivityFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = OperationalActivity::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'current_expenditure_element_id' => null,
            'code' => $this->faker->randomDigit(),
            'name' => $this->faker->title,
            'responsible_unit_id' => null,
            'executing_unit_id' => null
        ];
    }
}
