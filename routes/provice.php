<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VotreController; 
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\MesabonnementController;

Route::get('/abonnement', [MesabonnementController::class, 'abonnement'])->name('abonnement');
Route::get('/paiements/download/{id}/{format?}', [PaiementController::class, 'download'])
    ->name('payments.download');