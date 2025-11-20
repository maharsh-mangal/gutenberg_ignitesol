<?php

use App\Models\Author;
use App\Models\Book;
use App\Models\Language;
use Illuminate\Support\Arr;

use function Pest\Laravel\getJson;

it('filters books by title', function () {
    $bookTitle = Book::inRandomOrder()->first()->title;
    $filterTerm = strtolower(explode(' ', $bookTitle)[0]);
    getJson("/api/books?title={$filterTerm}")
        ->assertStatus(200)
        ->assertJsonFragment(['title' => $bookTitle]);
});

it('filters books by author name', function () {
    $author = Author::inRandomOrder()->first()->name;
    $filterTerm = strtolower(explode(' ', $author)[0]);
    getJson("/api/books?author={$filterTerm}") // Lewis Carroll
        ->assertStatus(200)
        ->assertJsonStructure(['results' => [['authors']]])
        ->assertJsonFragment(['name' => $author]);
});

it('filters books by language code', function () {
    $languageCode = Language::inRandomOrder()->first()->code;
    getJson("/api/books?language={$languageCode}")
        ->assertStatus(200)
        ->assertJsonStructure(['results' => [['languages']]]);
});

it('filters books by format mime-type', function () {
    $response = $this->getJson('/api/books?mime=text');
    getJson('/api/books?mime=text')
        ->assertStatus(200)
        ->assertJsonStructure(['results' => [['formats']]]);
});

it('filters books by topic (subject OR bookshelf)', function () {
    $book = Book::inRandomOrder()->first();
    $subject = $book->subjects->random()->first()->name;
    $bookshelf = $book->bookshelves->random()->name;

    $searchTerm = Arr::random([
        strtolower(explode(' ', $subject)[0]),
        strtolower(explode(' ', $bookshelf)[0]),
    ]);

    getJson("/api/books?topic={$searchTerm}")
        ->assertStatus(200)
        ->assertJsonStructure(['results' => [['subjects', 'bookshelves']]]);
});

it('applies multiple filters together', function () {
    $book = Book::inRandomOrder()->first();
    $bookTitle = strtolower(explode(' ', $book->title)[0]);
    $authorName = strtolower(explode(' ', $book->authors->first()->name)[0]);
    $languageCode = $book->languages->first()->code;
    $response = getJson("/api/books?title={$bookTitle}&author={$authorName}&language={$languageCode}");

    $response->assertStatus(200)
        ->assertJsonStructure(['results'])
        ->assertJsonFragment(['title' => $book->title]);
});
