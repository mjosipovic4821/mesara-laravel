<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard');

Route::get('/raspored', function () {
    return view('raspored.index');
})->name('raspored.index');

Route::resource('dobavljacs', App\Http\Controllers\DobavljacController::class);

Route::resource('materijals', App\Http\Controllers\MaterijalController::class);

Route::resource('proizvods', App\Http\Controllers\ProizvodController::class);

Route::resource('kupacs', App\Http\Controllers\KupacController::class);

Route::resource('nabavkas', App\Http\Controllers\NabavkaController::class);

Route::resource('fakturas', App\Http\Controllers\FakturaController::class);

use App\Http\Controllers\PublicProizvodController;

Route::get('/proizvodi', [PublicProizvodController::class, 'index'])
    ->name('public.proizvodi.index');

Route::get('/proizvodi/{proizvod}', [PublicProizvodController::class, 'show'])
    ->name('public.proizvodi.show');

use App\Http\Controllers\PublicNarudzbinaController;

Route::get('/narudzbina', [PublicNarudzbinaController::class, 'create'])
    ->name('public.narudzbina.create');

Route::post('/narudzbina', [PublicNarudzbinaController::class, 'store'])
    ->name('public.narudzbina.store');

Route::get('/narudzbina/{faktura}', [PublicNarudzbinaController::class, 'show'])
    ->name('public.narudzbina.show');
