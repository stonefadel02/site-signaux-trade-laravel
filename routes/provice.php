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
    Route::middleware('auth')->group(function () {
Route::post('/paiement/initier', [PaiementController::class, 'initierPaiement'])->name('paiement.initier');
Route::get('/paiement/callback', [PaiementController::class, 'handleCallback'])->name('paiement.callback');

});

});
Route::post('/paiement/webhook', [PaiementController::class, 'handleWebhook'])->name('paiement.webhook');