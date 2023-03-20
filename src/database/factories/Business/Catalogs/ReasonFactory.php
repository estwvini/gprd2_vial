<?php
declare(strict_types=1);

namespace Database\Factories\Business\Catalogs;

use App\Models\Business\Catalogs\Reason;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReasonFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reason::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'id' => $this->faker->unique()->randomDigit(),
            'name' => $this->faker->title,
            'type' => Reason::TYPE_CANCEL
        ];
    }
}
