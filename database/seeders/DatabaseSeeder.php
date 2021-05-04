<?php

namespace Database\Seeders;

use App\Models\Age;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Publisher::factory(10)->create();
        Category::factory(10)->create();
        Author::factory(90)->create();
        Age::factory(3)->create();
        Book::factory(150)->create();
    }
}
