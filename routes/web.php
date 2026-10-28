<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JeuController;
use App\Http\Controllers\RechercheJeuxController;
use App\Http\Controllers\InscriptionController;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompteController;
use App\Http\Middleware\EnsureManager;
use Illuminate\Foundation\Auth\EmailVerificationRequest;


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

Route::get('/inscription', [InscriptionController::class, 'create'])
    ->middleware('guest')->name('register');
Route::post('/inscription', [InscriptionController::class, 'store'])
    ->middleware('guest')->name('register.store');

Route::get('/connexion', [AuthController::class, 'create'])
    ->middleware('guest')->name('login');
Route::post('/connexion', [AuthController::class, 'login'])
    ->middleware(['guest', 'throttle:6,1'])->name('login.store');
Route::post('/deconnexion', [AuthController::class, 'logout'])
    ->middleware('auth')->name('logout');

Route::get('/', [JeuController::class, 'index'])->name('home');
Route::get('/compte', [CompteController::class, 'show'])
    ->middleware('auth')->name('account.show');

Route::middleware(['auth', EnsureManager::class])->group(function () {
    Route::get('/administration', fn() => 'Administration')
        ->name('admin.index');
});

Route::resource('jeux', JeuController::class)
    ->middlewareFor(['create', 'store', 'edit', 'update', 'destroy'], 'auth')
    ->middlewareFor('store', ['auth', 'verified']);

Route::get('/email/verify', fn() => view('auth.verify-email'))
    ->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();
    return redirect()->route('jeux.index');
})->middleware(['auth', 'signed'])->name('verification.verify');

Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();
    return back()->with('status', 'Lien de vérification envoyé.');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');
