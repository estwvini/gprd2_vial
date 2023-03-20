<?php
declare(strict_types=1);

namespace Database\Factories\Business\Catalogs;

use App\Models\Business\Catalogs\SpendingGuide;
use Illuminate\Database\Eloquent\Factories\Factory;

class SpendingGuideFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = SpendingGuide::class;

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
            'code' => $this->faker->randomNumber(2),
            'full_code' => $this->faker->randomNumber(2),
            'description' => $this->faker->sentence,
            'level' => 1
        ];
    }
}
