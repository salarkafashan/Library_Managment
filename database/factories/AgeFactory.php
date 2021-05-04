<?php

namespace Database\Factories;

use App\Models\Age;
use Illuminate\Database\Eloquent\Factories\Factory;

class AgeFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Age::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->unique()->randomElement(['Children', 'Youth', 'over 18']),
            'range' => $this->faker->unique()->randomElement(['6-9', '10-18', '+18']),
        ];
    }
}
