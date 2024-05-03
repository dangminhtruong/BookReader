<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Publisher;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Book>
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
        $publisher = Publisher::select('id')->inRandomOrder()->first();

        return [
            'title' => fake()->realText(150),
            'summary' => fake()->realText(300),
            'publisher_id' => $publisher->id
        ];
    }
}
