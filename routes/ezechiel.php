<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ActifController;
use App\Http\Controllers\SignalController;
use App\Http\Middleware\AccederAuxSignaux;
use App\Http\Controllers\TimeframeController;
use App\Http\Controllers\TypeMarchController;
use App\Http\Controllers\SouscriptionController;
use App\Http\Controllers\MesAbonnementController;
use App\Http\Controllers\SessionSignalController;

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('mon-abonnement', [MesAbonnementController::class, 'index'])->name('mon-abonnement');
    Route::get('/signaux', [SignalController::class, 'publicIndex'])->name('signaux')->middleware(AccederAuxSignaux::class);
    Route::get('/souscrire', [SouscriptionController::class, 'souscrire'])->name('souscrire');
    Route::post('/souscription/store-code', [SouscriptionController::class, 'storeCode'])->name('souscription.store-code');
    Route::get('/parametrage-signaux', [SignalController::class, 'parametrage'])->name('parametrage-signaux');

    // Route::get('/signaux/access-interdit', function () {
    //     return view('signals.accessInterdit');
    // })->name('access-interdit');

});

Route::middleware(['auth', 'role:Super-admin'])->group(function () {
    Route::get('/parametrage-signaux', [SignalController::class, 'parametrage'])->name('parametrage-signaux');
    Route::resource('timeframes', TimeframeController::class)->except(['index', 'show',]);
    Route::resource('session-signals', SessionSignalController::class)->except(['index', 'show',]);
    Route::resource('actifs', ActifController::class)->except(['index', 'show',]);
    Route::resource('type-marches', TypeMarchController::class)->except(['index', 'show',]);
    Route::get('sudo-login/{id}', function ($id) {
        auth()->logout();
        Auth::loginUsingId($id);
        return redirect()->route('dashboard');
    })->name('sudo-login');
    Route::get('/admin/souscriptions', [SouscriptionController::class, 'adminIndex'])->name('admin.souscriptions.index');

});