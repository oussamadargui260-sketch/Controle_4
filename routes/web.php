<?php

use App\Http\Controllers\CommandeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/commandes/stats', [CommandeController::class, 'stats'])
    ->name('commandes.stats');

Route::resource('commandes', CommandeController::class);




Route::post('/commandes/{commande}/produits', [CommandeController::class, 'addProduit'])
    ->name('commandes.addProduit');
