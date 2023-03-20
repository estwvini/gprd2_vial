<?php

namespace Database\Factories\System;

use App\Models\System\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'username' => $this->faker->userName,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'password' => bcrypt('adminpass'),
            'remember_token' => md5(uniqid('', true)),
            'changed_password' => 1,
            'identification_type' => 'other',
            'enabled' => 1
        ];
    }
}
