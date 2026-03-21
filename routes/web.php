<?php

use App\Http\Controllers\CommandeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::resource('commandes', CommandeController::class);


Route::get('/commandes/stats', [CommandeController::class, 'stats'])
    ->name('commandes.stats');
