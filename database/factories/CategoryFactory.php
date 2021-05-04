<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Category::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'parent_id' => null,
            'name' => $this->faker->unique()->randomElement(['Arts & Photography', 'Biographies & Memoirs','Business & Investing','Comics & Graphic Novels',
                                                    'Childrens Books','Cookbooks, Food & Wine','History','Literature & Fiction','Mystery & Suspense',
                                                    'Sci-Fi & Fantasy','Teens & Young Adult']),
        ];
    }
}
