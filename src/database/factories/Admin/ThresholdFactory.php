<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Threshold;
use Illuminate\Database\Eloquent\Factories\Factory;

class ThresholdFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Threshold::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'type' => $this->faker->randomElement(['ascending', 'descending', 'tolerance']),
            'color' => $this->faker->randomElement(['success', 'danger', 'warning']),
            'min' => $this->faker->randomDigit(),
            'max' => $this->faker->randomDigit(),
        ];
    }
}
