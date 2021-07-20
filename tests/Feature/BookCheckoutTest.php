<?php

namespace Tests\Feature;

use App\Models\Age;
use App\Models\Author;
use App\Models\Book;
use App\Models\Category;
use App\Models\Publisher;
use App\Models\Reservation;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BookCheckoutTest extends TestCase
{
    use RefreshDatabase;
    public function test_book_can_be_checkout_by_a_signed_in_user()
    {
        Author::factory()->create();
        Publisher::factory()->create();
        Category::factory()->create();
        Age::factory()->create();

        $book = Book::factory()->create();
        $user = User::factory()->create();
        $this->actingAs($user)->post('/api/v1/checkout/'. $book->id);

        $this->assertCount(1,Reservation::all());
        $this->assertEquals($user->id,Reservation::first()->user_id);
        $this->assertEquals($book->id,Reservation::first()->book_id);
        $this->assertEquals(now(),Reservation::first()->checked_out_at);
    }

    public function test_only_signed_in_user_can_checkout_book()
    {
        $this->withoutExceptionHandling();
        Author::factory()->create();
        Publisher::factory()->create();
        Category::factory()->create();
        Age::factory()->create();

        $book = Book::factory()->create();
        $user = User::factory()->create();
        $this->post('/api/v1/checkout/'. $book->id)->assertRedirect('/api/v1/login');

        $this->assertCount(0,Reservation::all());
    }
}
