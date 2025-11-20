<?php

it('returns a 200 OK for the books endpoint', function () {
    $response = $this->getJson('/api/books');

    $response->assertStatus(200);
});

it('returns correct JSON structure for books API', function () {
    $response = $this->getJson('/api/books');

    $response->assertStatus(200)
        ->assertJsonStructure([
            'count',
            'next',
            'previous',
            'results' => [
                '*' => [
                    'id',
                    'title',
                    'authors',      // array
                    'languages',    // array
                    'subjects',     // array
                    'bookshelves',  // array
                    'formats' => [
                        '*' => [
                            'mime_type',
                            'url',
                        ],
                    ],
                ],
            ],
        ]);
});
