<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DBImportSeeder extends Seeder
{
    public function run(): void
    {
        $sqlFiles = [
            'authors.sql',
            'books.sql',
            'bookshelves.sql',
            'formats.sql',
            'languages.sql',
            'subjects.sql',
            'book_author.sql',
            'book_language.sql',
            'book_subject.sql',
            'book_bookshelf.sql',
        ];

        foreach ($sqlFiles as $file) {
            $path = database_path("seeders/sql/{$file}");
            $this->command->info("Seeding: {$file}");

            DB::unprepared(File::get($path));
        }

        $this->command->info("DB data seeded successfully.");
    }
}
