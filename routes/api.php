<?php

use App\Http\Controllers\Api\JeuController;
use App\Http\Controllers\Api\SessionTokenController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::apiResource('jeux', JeuController::class)
    ->parameters(['jeux' => 'jeu'])
    ->names('api.jeux')->only(['index', 'show']);

Route::middleware(['auth:sanctum', 'throttle:60.1'])->group(function () {
    Route::apiResource('jeux', JeuController::class)
        ->parameters(['jeux' => 'jeu'])
        ->names('api.jeux')->only(['store', 'update', 'destroy']);
});

Route::post('login', [SessionTokenController::class, 'store'])
    ->middleware('throttle:6,1');

Route::post('logout', [SessionTokenController::class, 'destroy'])
    ->middleware('auth:sanctum');
