<?php

namespace Unit\Api\V1;

use App\Models\Age;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\User;
use App\Models\Reservation;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookReservationsTest extends TestCase
{
    use RefreshDatabase;

    /**@test */
    public function test_book_checkout()
    {
        // Book factory needs to author,publisher,category and age 
        Author::factory()->create();
        Publisher::factory()->create();
        Category::factory()->create();
        Age::factory()->create();

        $book = Book::factory()->create();
        $user = User::factory()->create();
     
        $book->Checkout($user);

        $this->assertCount(1,Reservation::all());
        $this->assertEquals($user->id,Reservation::first()->user_id);
        $this->assertEquals($book->id,Reservation::first()->book_id);
        $this->assertEquals(now(),Reservation::first()->checked_out_at);
    }

    public function test_book_checkin()
    {
        // Book factory needs to author,publisher,category and age 
        Author::factory()->create();
        Publisher::factory()->create();
        Category::factory()->create();
        Age::factory()->create();

        $book = Book::factory()->create();
        $user = User::factory()->create();
        
        $book->Checkout($user);
        $book->Checkin($user);

        $this->assertCount(1,Reservation::all());
        $this->assertEquals($user->id,Reservation::first()->user_id);
        $this->assertEquals($book->id,Reservation::first()->book_id);
        $this->assertEquals(now(),Reservation::first()->checked_in_at);
    }

    public function test_if_not_checked_out_exeption_is_thrown()
    {
        $this->expectException(\Exception::class);
       // Book factory needs to author,publisher,category and age 
       Author::factory()->create();
       Publisher::factory()->create();
       Category::factory()->create();
       Age::factory()->create();

       $book = Book::factory()->create();
       $user = User::factory()->create();
       
       $book->Checkin($user);
    }
}
