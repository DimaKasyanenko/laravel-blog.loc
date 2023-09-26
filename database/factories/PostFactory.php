<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

use function Laravel\Prompts\text;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::query()->inRandomOrder()->value('id'),
            'title' => ucfirst(fake()->words(2, true)),
            'slug' => fake()->slug(),
            'description' => fake()->paragraph(2),
            'thumbnail' => fake()->image(storage_path('app/public/posts'),
                '1200', '900', '', false),
        ];
    }
}
