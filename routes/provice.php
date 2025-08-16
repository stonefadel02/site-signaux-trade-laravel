<?php

use App\Http\Controllers\SouscriptionController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VotreController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\MesAbonnementController;

Route::middleware('auth')->group(function () {


    Route::get('/abonnement', [MesAbonnementController::class, 'abonnement'])->name('abonnement');
    Route::get('/paiements/download/{id}/{format?}', [PaiementController::class, 'download'])
        ->name('payments.download');
    Route::get('/dashboard', [SouscriptionController::class, 'dashboard'])->name('dashboard');

});