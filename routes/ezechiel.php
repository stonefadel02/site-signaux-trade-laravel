<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SignalController;
use App\Http\Middleware\AccederAuxSignaux;

Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/signaux', [SignalController::class, 'publicIndex'])->name('signaux')->middleware(AccederAuxSignaux::class);
    Route::get('/signaux/access-interdit', function () {
        return view('signals.accessInterdit');
    })->name('access-interdit');

});