<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Book>
 */
class BookFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'download_count' => fake()->numberBetween(0, 10000),
            'gutenberg_id' => fake()->unique()->numberBetween(1, 600),
            'title' => fake()->sentence(3, true),
            'media_type' => fake()->randomElement(['Text', 'StillImage', 'Dataset', 'MovingImage']),
        ];
    }

    public function withRelations(): static
    {
        return $this->afterCreating(function ($book) {
            $book->authors()->create(AuthorFactory::new()->make()->toArray());
            $book->languages()->create(LanguageFactory::new()->make()->toArray());
            $book->subjects()->create(SubjectFactory::new()->make()->toArray());
            $book->bookshelves()->create(BookshelfFactory::new()->make()->toArray());
            $book->formats()->create(FormatFactory::new()->make()->toArray());
        });
    }
}
