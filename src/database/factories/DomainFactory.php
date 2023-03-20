<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Stancl\Tenancy\Database\Models\Domain;

class DomainFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Domain::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'domain' => $this->faker->unique()->domainName,
        ];
    }
}
