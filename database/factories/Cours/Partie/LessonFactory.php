<?php

namespace Database\Factories\Cours\Partie;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class LessonFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence,
            'chapitre_id' => rand(1,7),
            'user_id' => 1,
            'statut_id' => rand(1,3),
            'lesson_numero' => rand(1,3),
            'published_at' => now(),
        ];
    }
}
