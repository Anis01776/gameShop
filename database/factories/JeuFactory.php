<?php

namespace Database\Factories;

use App\Models\Jeu;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Jeux>
 */
class JeuFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nomJeu' => fake()->sentence(6),
            'prix' => fake()->numberBetween(0, 100),
            'description' => fake()->text(200), 
            'reduction' => fake()->boolean(),
            'prixRabais' => fake()->numberBetween(0, 100),
            'categorie' => fake()->randomElement(['Horreur', 'Action', 'Aventure', 'RPG']),
            'published_at' => now(),
        ];
    }
    public function nonPublie(): static
    {
        return $this->state(fn() => ['published_at' => null]);
    }
}
