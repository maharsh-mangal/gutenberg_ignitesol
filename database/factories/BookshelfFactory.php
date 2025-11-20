<?php

namespace Database\Factories;

use App\Models\Bookshelf;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Bookshelf>
 */
class BookshelfFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->sentence(2),
        ];
    }
}
