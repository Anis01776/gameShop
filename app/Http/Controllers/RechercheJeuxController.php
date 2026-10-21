<?php

namespace App\Http\Controllers;

use App\Models\Jeu;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class RechercheJeuxController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(Request $request): JsonResponse
    {
        $data = $request->validate(['q' => ['required', 'string', 'min:2', 'max:50'],]);

        $jeux = Jeu::query()
            ->whereNotNull('published_at')
            ->where('nomJeu', 'like', '%' . $data['q'] . '%')
            ->orderBy('nomJeu')
            ->limit(8)
            ->get(['id', 'nomJeu']);

        return response()->json([
            'data' => $jeux->map(fn(Jeu $jeu) => [
                'id' => $jeu->id,
                'label' => $jeu->nomJeu,
                'url' => route('jeux.show', $jeu),
            ]),
        ]);
    }
}
