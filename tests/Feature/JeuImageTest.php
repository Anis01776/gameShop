<?php

namespace Tests\Feature;

use App\Models\Jeu;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class JeuImageTest extends TestCase
{
    /**
     * A basic feature test example.
     */

    use RefreshDatabase;

    public function test_un_jeu_peut_recevoir_une_image(): void
    {
        Storage::fake('public');
        $user = User::factory()->create(['email_verified_at' => now(), 'role' => 'manager']);

        $this->actingAs($user)->post(route('jeux.store'), [
            'nomJeu' => 'Jeu teste',
            'prix' => 99,
            'description' => 'description teste',
            'reduction' => false,
            'categorie' => 'Horreur',
            'published_at' => now(),
            'image_path' => UploadedFile::fake()->image('test.png'),
        ])->assertRedirect();

        $jeu = Jeu::firstOrFail();
        $this->assertDatabaseHas('jeux', ['id' => $jeu->id]);
        Storage::disk('public')->assertExists($jeu->image_path);
    }
}
