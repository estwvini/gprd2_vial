<?php

namespace Database\Factories\System;

use App\Models\System\Setting;
use Illuminate\Database\Eloquent\Factories\Factory;


class SettingFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Setting::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'idd' => $this->faker->unique()->randomDigit(),
            'key' => $this->faker->slug,
            'value' => null,
            'description' => $this->faker->sentences(2)
        ];
    }
}
