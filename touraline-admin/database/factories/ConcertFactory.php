<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Concert;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Concert>
 */
final class ConcertFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'excerpt' => fake()->sentence(15),
            'description' => '<p>'.fake()->paragraph().'</p>',
            'image' => null,
        ];
    }
}
