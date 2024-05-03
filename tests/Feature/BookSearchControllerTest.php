<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Book;
use App\Models\Publisher;
use App\Models\Author;

class BookSearchControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();

        // Create test data
        $this->publisher = Publisher::factory()->create(['name' => 'Test Publisher']);
        $this->author1 = Author::factory()->create(['name' => 'Test Author 1']);
        $this->author2 = Author::factory()->create(['name' => 'Test Author 2']);

        $this->book1 = Book::factory()->create([
            'title' => 'Test Book 1',
            'summary' => 'This is a test summary',
            'publisher_id' => $this->publisher->id,
        ]);
        $this->book1->authors()->attach([$this->author1->id, $this->author2->id]);

        $this->book2 = Book::factory()->create([
            'title' => 'Test Book 2',
            'summary' => 'Another test summary',
            'publisher_id' => $this->publisher->id,
        ]);
        $this->book2->authors()->attach([$this->author1->id]);
    }

    public function test_search_endpoint_returns_correct_results()
    {
        // Hit the search endpoint with a keyword
        $response = $this->get('/api/v1/search/book?q=test');

        // Assert response status is 200
        $response->assertStatus(200);

        // Assert response contains the correct data
        $response->assertJsonFragment([
            'title' => 'Test Book 1',
            'summary' => 'This is a test summary',
            'publisher' => 'Test Publisher',
            'authors' => ['Test Author 1', 'Test Author 2'],
        ]);

        $response->assertJsonFragment([
            'title' => 'Test Book 2',
            'summary' => 'Another test summary',
            'publisher' => 'Test Publisher',
            'authors' => ['Test Author 1'],
        ]);
    }

    public function test_search_endpoint_returns_incorrect_results()
    {
        // Hit the search endpoint with a keyword that shouldn't match any books
        $response = $this->get('/api/v1/search/book?q=nonexistent');

        // Assert response status is 200
        $response->assertStatus(200);

        // Assert response does not contain any book data
        $response->assertJsonMissing([
            'title' => 'Test Book 1',
            'summary' => 'This is a test summary',
            'publisher' => 'Test Publisher',
            'authors' => ['Test Author 1', 'Test Author 2'],
        ]);

        $response->assertJsonMissing([
            'title' => 'Test Book 2',
            'summary' => 'Another test summary',
            'publisher' => 'Test Publisher',
            'authors' => ['Test Author 1'],
        ]);
    }
}
