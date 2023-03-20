<?php

namespace Database\Factories\Admin;

use App\Models\Admin\Department;
use Illuminate\Database\Eloquent\Factories\Factory;

class DepartmentFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Department::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomNumber(),
            'name' => $this->faker->company,
            'description' => $this->faker->sentence(5),
            'phone_number' => $this->faker->phoneNumber,
            'code' => $this->faker->randomNumber(3),
            'parent_id' => null,
        ];
    }
}
