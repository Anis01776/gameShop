<?php

namespace Database\Seeders;

use App\Models\Avis;
use App\Models\User;
use App\Models\Jeu;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Gestionnaire du blogue',
            'email' => 'gestionnaire@example.test',
        ]);

        Jeu::factory()
            ->count(12)
            ->has(Avis::factory()->count(2),'avis')
            ->create();

        Jeu::factory()->nonPublie()->create();
    }
}
