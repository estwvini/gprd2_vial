<?php

namespace Database\Factories\System;

use App\Models\System\Role;
use Illuminate\Database\Eloquent\Factories\Factory;


class RoleFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Role::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'slug' => $this->faker->slug,
            'description' => $this->faker->sentence(5),
            'editable' => true
        ];
    }
}
