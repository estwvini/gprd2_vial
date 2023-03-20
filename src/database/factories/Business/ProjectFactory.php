<?php

namespace Database\Factories\Business;

use App\Models\Business\Project;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Project::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->title,
            'cup' => $this->faker->randomDigit(),
            'full_cup' => $this->faker->randomDigit(),
            'description' => $this->faker->sentence(5),
            'responsible_unit_id' => null,
            'executing_unit_id' => null,
        ];
    }
}
