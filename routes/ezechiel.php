<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignalController;
use App\Http\Middleware\AccederAuxSignaux;
use App\Http\Controllers\SouscriptionController;
use App\Http\Controllers\MesAbonnementController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('mon-abonnement', [MesAbonnementController::class, 'index'])->name('mon-abonnement');
    Route::get('/signaux', [SignalController::class, 'publicIndex'])->name('signaux')->middleware(AccederAuxSignaux::class);
    Route::get('/souscrire', [SouscriptionController::class, 'souscrire'])->name('souscrire');
    // Route::get('/signaux/access-interdit', function () {
    //     return view('signals.accessInterdit');
    // })->name('access-interdit');

});