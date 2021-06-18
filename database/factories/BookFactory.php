<?php

namespace Database\Factories;

use App\Models\Age;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class BookFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Book::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => Author::all('id')->random(),
            'publisher_id' => Publisher::all('id')->random(),
            'category_id' => Category::all('id')->random(),
            'age_id' => Age::all('id')->random(),
            'shelf_id' => null,
            'title' => $this->faker->city(),
            'description' => $this->faker->paragraph(2),
            'tags' => $this->faker->randomElement(['children', 'english', 'history', 'sport']),
            'pages' => $this->faker->numberBetween(20,600),
            'stock' => $this->faker->numberBetween(1,4),
            'Language' => $this->faker->randomElement(['English', 'French', 'Turkish', 'Germany','Persian']),
            'weight' => $this->faker->numberBetween(1,6),
            'Dimensions' => $this->faker->randomElement(['5*8', '10*10', '3*4', '3*6']),
            'reward' => $this->faker->randomElement(['Best seller', 'Best book in 2018 ', 'Best book for children']),
            'release_date' => $this->faker->dateTime(),
        ];
    }
}
