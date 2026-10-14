<?php

namespace Database\Factories;

use App\Models\Avis;
use App\Models\Jeu;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Avis>
 */
class AvisFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'utilisateur_id' => User::factory(),
            'commentaire' => fake()->paragraph(3, true),
            'etoiles' => fake()->numberBetween(0, 5),
            'jeu_id' => Jeu::factory(),
        ];
    }
}
