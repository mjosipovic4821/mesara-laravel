<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DobavljacController;
use App\Http\Controllers\FakturaController;
use App\Http\Controllers\KupacController;
use App\Http\Controllers\MaterijalController;
use App\Http\Controllers\NabavkaController;
use App\Http\Controllers\NabavkaWizardController;
use App\Http\Controllers\ProizvodController;
use App\Http\Controllers\PublicNarudzbinaController;
use App\Http\Controllers\PublicProizvodController;
use App\Http\Controllers\RasporedController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public (guest) routes
|--------------------------------------------------------------------------
*/

// Dashboard (kod tebe je public; ako želiš da bude samo za ulogovane,
// prebaci ovu rutu u auth grupu)
Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

// Login / logout
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.attempt');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Public katalog proizvoda
Route::get('/proizvodi', [PublicProizvodController::class, 'index'])
    ->name('public.proizvodi.index');

Route::get('/proizvodi/{proizvod}', [PublicProizvodController::class, 'show'])
    ->name('public.proizvodi.show');

// Public narudzbina
Route::get('/narudzbina', [PublicNarudzbinaController::class, 'create'])
    ->name('public.narudzbina.create');

Route::post('/narudzbina', [PublicNarudzbinaController::class, 'store'])
    ->name('public.narudzbina.store');

Route::get('/narudzbina/{faktura}', [PublicNarudzbinaController::class, 'show'])
    ->name('public.narudzbina.show');

/*
|--------------------------------------------------------------------------
| Authenticated (admin/internal) routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    // CRUD resursi
    Route::resource('dobavljacs', DobavljacController::class);
    Route::resource('materijals', MaterijalController::class);
    Route::resource('proizvods', ProizvodController::class);
    Route::resource('kupacs', KupacController::class);
    Route::resource('nabavkas', NabavkaController::class);
    Route::resource('fakturas', FakturaController::class);

    // Nabavka wizard (novo)
    Route::get('/nabavka/novo', [NabavkaWizardController::class, 'create'])
        ->name('nabavka.wizard.create');

    Route::post('/nabavka/novo', [NabavkaWizardController::class, 'store'])
        ->name('nabavka.wizard.store');

    // Raspored i zadaci
    Route::get('/raspored', [RasporedController::class, 'index'])
        ->name('raspored.index');

    Route::post('/raspored', [RasporedController::class, 'store'])
        ->name('raspored.store');
});
