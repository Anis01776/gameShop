<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\User;
use Tests\TestCase;

class CreationJeuTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    use RefreshDatabase;

    public function test_une_personne_connecte_peut_creer_un_jeu(): void
    {
        $user = User::factory()->create(['email_verified_at' => now(), 'role' => 'manager']);

        $response = $this->actingAs($user)->post(route('jeux.store'), [
            'nomJeu' => 'Jeu teste',
            'prix' => 99,
            'description' => 'description teste',
            'reduction' => false,
            'categorie' => 'Horreur',
            'published_at' => now(),
        ]);

        $response->assertRedirect();
        $this->assertDatabaseHas('jeux', [
            'nomJeu' => 'Jeu teste',
            'prix' => 99,
            'description' => 'description teste',
            'reduction' => false,
            'categorie' => 'Horreur',
        ]);
    }

    public function test_un_nom_de_jeu_vide_est_refuse(): void
    {
        $user = User::factory()->create(['email_verified_at' => now(), 'role' => 'manager']);

        $this->actingAs($user)->post(route('jeux.store'), [
            'prix' => 99,
            'description' => 'test fail',
            'reduction' => true,
            'categorie' => 'Horreur',
        ])->assertSessionHasErrors('nomJeu');

        $this->assertDatabaseCount('jeux', 0);
    }

    public function test_un_utilisateur_peut_pas_creer_de_jeu(): void
    {
        $user = User::factory()->create(['email_verified_at' => now(), 'role' => 'user']);

        $this->actingAs($user)->post(route('jeux.store'), [
            'nomJeu' => 'Jeu teste',
            'prix' => 99,
            'description' => 'description teste',
            'reduction' => false,
            'categorie' => 'Horreur',
            'published_at' => now(),
        ])->assertForbidden();

        $this->assertDatabaseCount('jeux', 0);
    }

    public function test_un_invite_peut_pas_creer_de_jeu(): void
    {
        $this->post(route('jeux.store'), [
            'nomJeu' => 'Jeu teste',
            'prix' => 99,
            'description' => 'description teste',
            'reduction' => false,
            'categorie' => 'Horreur',
            'published_at' => now(),
        ])->assertRedirect(route('login'));
        $this->assertDatabaseCount('jeux', 0);
    }
}
