<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessCodeController;
use App\Http\Controllers\DashboardController;



Route::middleware('auth')->group(function () {
    Route::get('/support', function () {
        return view('support');
    })->name('support');
    Route::get('/admin/signal-stats', [DashboardController::class, 'signalStats'])->name('admin.signal-stats');

    Route::resource('access-codes', AccessCodeController::class);
});