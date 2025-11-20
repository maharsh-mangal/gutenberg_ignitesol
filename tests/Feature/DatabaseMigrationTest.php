<?php

use Illuminate\Support\Facades\Schema;

it('tables exist', function () {
    $tables = [
        'books', 'authors', 'languages', 'subjects', 'bookshelves',
        'formats', 'book_author', 'book_language', 'book_subject', 'book_bookshelf'
    ];

    foreach ($tables as $table) {
        expect(Schema::hasTable($table))->toBeTrue();
    }
});

it('books table has correct columns', function () {
    expect(Schema::hasColumns('books', [
        'id', 'gutenberg_id', 'download_count', 'media_type', 'title',
        'created_at', 'updated_at'
    ]))->toBeTrue();
});

it('authors table has correct columns', function () {
    expect(Schema::hasColumns('authors', [
        'id', 'birth_year', 'death_year', 'name',
        'created_at', 'updated_at'
    ]))->toBeTrue();
});
