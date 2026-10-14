<?php

namespace App\Http\Controllers;

use App\Http\Requests\EnregistrerJeuRequest;
use App\Models\Jeu;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;

class JeuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $jeux = Jeu::query()
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(10);
        return view('jeux.index', compact('jeux'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('jeux.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnregistrerJeuRequest $request): RedirectResponse
    {
        $jeu = Jeu::create([...$request->validated(), 'published_at' => now(),]);
        return redirect()->route('jeux.show', $jeu)
            ->with('status', 'Jeu créé.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Jeu $jeu): View
    {
        abort_if($jeu->published_at === null, 404);

        return view('jeux.show', [
            'jeu' => $jeu->load('avis.user'),
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Jeu $jeu): View
    {
        return view('jeux.edit', compact('jeu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EnregistrerJeuRequest $request, Jeu $jeu): RedirectResponse
    {
        $jeu->update($request->validated());

        return redirect()->route('jeux.show', $jeu)
            ->with('status', 'Jeu modifié.');
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Jeu $jeu): RedirectResponse
    {
        $jeu->delete();

        return redirect()->route('jeux.index')
            ->with('status', 'Jeu supprimé.');
    }
}
