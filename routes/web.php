<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JeuController;
use App\Http\Controllers\RechercheJeuxController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;


Route::get('/', function () {
    return view('welcome');
});

Route::post('/lang', function (Request $request) {
    $data = $request->validate(['locale' => ['required', Rule::in(['fr', 'en'])],]);

    $request->session()->put('locale', $data['locale']);
    return back();
})->name('locale.update');

Route::resource('jeux', JeuController::class)->parameters(['jeux' => 'jeu']);

Route::get('/recherche/jeux', RechercheJeuxController::class)->name('recherche.jeux');
