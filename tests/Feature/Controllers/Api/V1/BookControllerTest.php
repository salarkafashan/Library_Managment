<?php

namespace Tests\Feature\Controllers\Api\V1;

use App\Models\Book;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


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

        $response = $this->post('/api/v1/books', $this->data());
        $response = $this->get('/');
        $response->assertOk();
        $this->assertCount(1, Book::all());
    }

    /** @test */
    public function test_a_book_can_be_updated()
    {
        $this->post('/api/v1/books', $this->data());
        
        $book = Book::first();
        $response = $this->patch('/api/v1/books/'.$book->id, array_merge($this->data(),
            [
                'title'=> 'new test',
                'description'   => 'new test description test description test description test description test description test description test description',
                'Language'      => 'new English',         
                'reward'        => 'new test'
            ])
        );
        $response->assertSessionHasNoErrors();
        $this->assertEquals('new test', Book::first()->title);
        $this->assertEquals('new English', Book::first()->Language);
        
    }

    /** @test */
    public function test_book_can_be_deleted()
    {
        $this->post('/api/v1/books', $this->data());
        
        $book = Book::first();
        $this->delete('/api/v1/books/'.$book->id);   
        $this->assertCount(0, Book::all());
    }

    /** @test */
    public function test_should_fail_validation_when_adding_a_book_without_categoryId()
    {
        $response = $this->post('/api/v1/books', array_merge($this->data(),['category_id'   => '']));
        $response->assertSessionHasErrors(['category_id' => 'The category id field is required.']);
    }

    /** @test */
    public function test_should_fail_validation_when_adding_a_book_without_title()
    {
        // $user = User::factory()->create();
        // $this->withoutExceptionHandling();
        //$response = $this->actingAs($user)
        //     ->json('POST', '/api/v1/books', [
        $response = $this->post('/api/v1/books', array_merge($this->data(),['title'   => '']));
        $response->assertSessionHasErrors(['title' => 'The title field is required.']);
    }
    
    private function data()
    {
        return[
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
        ];
    }
}
