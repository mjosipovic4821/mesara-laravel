<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('dobavljacs', App\Http\Controllers\DobavljacController::class);

Route::resource('materijals', App\Http\Controllers\MaterijalController::class);

Route::resource('proizvods', App\Http\Controllers\ProizvodController::class);

Route::resource('kupacs', App\Http\Controllers\KupacController::class);

Route::resource('nabavkas', App\Http\Controllers\NabavkaController::class);

Route::resource('fakturas', App\Http\Controllers\FakturaController::class);
