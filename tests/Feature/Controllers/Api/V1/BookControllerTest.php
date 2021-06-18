<?php

namespace Tests\Feature\Controllers\Api\V1;

use App\Models\Age;
use App\Models\Book;
use App\Models\User;
use App\Models\Author;
use App\Models\Category;
use App\Models\Publisher;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use Illuminate\Foundation\Testing\TestResponse;
use Illuminate\Testing\TestResponse as TestingTestResponse;

class BookControllerTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function test_a_book_can_be_added_to_the_library()
    {
        // create new user
        $user = User::factory()->create();

        // act as user
        $this->actingAs($user);

        $this->withoutExceptionHandling();
        $response = $this->post('/api/v1/books', [
            'author_id'     => 1,
            'publisher_id'  => 1,
            'category_id'   => 1,
            'age_id'        => 1,
            'shelf_id'      => 1,
            'title'         => 'test',
            'description'   => 'test description test description test description test description test description test description test description',
            'tags'          => '',
            'pages'         => '123',
            'stock'         => 12,
            'Language'      => 'English',
            'weight'        => 1,
            'Dimensions'    => '5*8',
            'reward'        => 'test',
            'release_date'  => '1977-10-26 15:29:10',
        ]);
        $response = $this->get('/');
        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function test_a_book_can_be_updated()
    {
        $this->post('/api/v1/books', [
            'author_id'     => 1,
            'publisher_id'  => 1,
            'category_id'   => 1,
            'age_id'        => 1,
            'shelf_id'      => 1,
            'title'         => 'test',
            'description'   => 'test description test description test description test description test description test description test description',
            'tags'          => '',
            'pages'         => '123',
            'stock'         => 12,
            'Language'      => 'English',
            'weight'        => 1,
            'Dimensions'    => '5*8',
            'reward'        => 'test',
            'release_date'  => '1977-10-26 15:29:10',
        ]);
        
        $book = Book::first();
        $response = $this->patch('/api/v1/books/'.$book->id, [
            'author_id'     => 1,
            'publisher_id'  => 1,
            'category_id'   => 1,
            'age_id'        => 1,
            'shelf_id'      => 1,
            'title'         => 'new test',
            'description'   => 'new test description test description test description test description test description test description test description',
            'tags'          => '',
            'pages'         => '123',
            'stock'         => 12,
            'Language'      => 'new English',
            'weight'        => 1,
            'Dimensions'    => '5*8',
            'reward'        => 'new test',
            'release_date'  => '1977-10-26 15:29:10',
        ]);
        $response->assertSessionHasNoErrors();
        $this->assertEquals('new test', Book::first()->title);
        $this->assertEquals('new English', Book::first()->Language);
        
    }

    /** @test */
    public function test_book_can_be_deleted()
    {
        $this->post('/api/v1/books', [
            'author_id'     => 1,
            'publisher_id'  => 1,
            'category_id'   => 1,
            'age_id'        => 1,
            'shelf_id'      => 1,
            'title'         => 'test',
            'description'   => 'test description test description test description test description test description test description test description',
            'tags'          => '',
            'pages'         => '123',
            'stock'         => 12,
            'Language'      => 'English',
            'weight'        => 1,
            'Dimensions'    => '5*8',
            'reward'        => 'test',
            'release_date'  => '1977-10-26 15:29:10',
        ]);
        
        $book = Book::first();
        $this->delete('/api/v1/books/'.$book->id);   
        $this->assertCount(0, Book::all());
    }

    /** @test */
    public function test_categoryId_required()
    {
        $response = $this->post('/api/v1/books', [
            'author_id'     => 1,
            'publisher_id'  => 1,
            'category_id'   => '',
            'age_id'        => 1,
            'shelf_id'      => 1,
            'title'         => 'test',
            'description'   => 'test description test description test description test description test description test description test description',
            'tags'          => '',
            'pages'         => '123',
            'stock'         => 12,
            'Language'      => 'English',
            'weight'        => 1,
            'Dimensions'    => '5*8',
            'reward'        => 'test',
            'release_date'  => '1977-10-26 15:29:10',
        ]);
        $response->assertSessionHasErrors(['category_id' => 'The category id field is required.']);
    }

    /** @test */
    public function test_should_fail_validation_when_adding_a_book_without_title()
    {
        // $user = User::factory()->create();
        // $this->withoutExceptionHandling();
        //$response = $this->actingAs($user)
        //     ->json('POST', '/api/v1/books', [
        $response = $this->post('/api/v1/books',[
            'author_id'     => 1,
            'publisher_id'  => 1,
            'category_id'   => 1,
            'age_id'        => 1,
            'shelf_id'      => 1,
            'title'         => '',
            'description'   => 'test description test description test description test description test description test description test description',
            'tags'          => '',
            'pages'         => '123',
            'stock'         => 12,
            'Language'      => 'English',
            'weight'        => 1,
            'Dimensions'    => '5*8',
            'reward'        => 'test',
            'release_date'  => '1977-10-26 15:29:10',
        ]);
        $response->assertSessionHasErrors(['title' => 'The title field is required.']);
    }
   
}
