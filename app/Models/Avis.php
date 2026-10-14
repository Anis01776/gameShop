<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Avis extends Model
{
    use HasFactory;

    protected $fillable = ['utilisateur_id', 'commentaire', 'etoiles', 'jeu_id'];

    public function jeu(): BelongsTo
    {
        return $this->belongsTo(Jeu::class);
    }
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
