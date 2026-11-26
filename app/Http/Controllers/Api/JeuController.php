<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\EnregistrerJeuApiRequest;
use App\Http\Resources\JeuResource;
use App\Models\Jeu;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Throwable;

class JeuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $jeux = Jeu::query()
            ->whereNotNull('published_at')
            ->latest('published_at')
            ->paginate(15);

        return JeuResource::collection($jeux);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EnregistrerJeuApiRequest $request)
    {
        $data = $request->safe()->except('image');
        $path = $request->file('image')?->store('jeux', 'public');

        try {
            $jeu = Jeu::create([
                ...$data,
                'image_path' => $path,
                'published_at' => now()
            ]);
        } catch (Throwable $exception) {
            if ($path) {
                Storage::disk('public')->delete($path);
            }
            throw $exception;
        }

        return (new JeuResource($jeu))->response()->setStatusCode(201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Jeu $jeu): JeuResource
    {
        abort_if(!$jeu->published_at, 404);

        return new JeuResource($jeu);
    }

    /**
     * Update the specified resource in storage.
     */
        public function update(EnregistrerJeuApiRequest $request, Jeu $jeu): JeuResource
        {
            Gate::authorize('update', $jeu);
            $data = $request->safe()->except('image');
            $newPath = $request->file('image')?->store('jeux', 'public');
            $oldPath = $jeu->image_path;

            try {
                $jeu->update([...$data, ...($newPath ? ['image_path' => $newPath] : [])]);
            } catch (Throwable $exception) {
                if ($newPath) {
                    Storage::disk('public')->delete($newPath);
                }
                throw $exception;
            }

            if ($newPath && $oldPath) {
                Storage::disk('public')->delete($oldPath);
            }

            return new JeuResource($jeu);
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Jeu $jeu): Response
    {
        Gate::authorize('delete', $jeu);

        $imagePath = $jeu->image_path;
        $jeu->delete();

        if ($imagePath) {
            Storage::disk('public')->delete($imagePath);
        }

        return response()->noContent();
    }
}
