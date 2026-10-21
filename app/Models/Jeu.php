<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Jeu extends Model
{
    use HasFactory;
    protected $table = 'jeux';

    protected $fillable = ['nomJeu', 'prix', 'description', 'reduction', 'prixRabais', 'categorie', 'image_path', 'published_at'];

    protected function casts(): array
    {
        return ['published_at' => 'datetime'];
    }

    public function avis(): HasMany
    {
        return $this->hasMany(Avis::class, 'jeu_id');
    }
}
