<?php

namespace Database\Factories\Business\Catalogs;

use App\Models\Business\Catalogs\BudgetClassifier;
use Illuminate\Database\Eloquent\Factories\Factory;

class BudgetClassifierFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = BudgetClassifier::class;

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
            'full_code' => $this->faker->numerify('##'),
            'title' => $this->faker->title,
            'description' => $this->faker->sentence,
            'level' => 0
        ];
    }
}
