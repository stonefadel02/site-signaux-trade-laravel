<?php

use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Route;
use App\Exports\SignalsTemplateExport;
use App\Http\Controllers\SignalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\SouscriptionController;

Route::middleware('auth')->group(function () {

    Route::post('/import-signals', [SignalController::class, 'import'])->name('import-signals');

    Route::get('/download-template', function () {
        return Excel::download(new SignalsTemplateExport, 'modele_signaux.xlsx');
    });

    Route::get('/signals-export', [SignalController::class, 'export'])->name('signals-export');

    Route::get('/create', [SouscriptionController::class, 'create'])->name('souscription.create');

    Route::post('/store', [SouscriptionController::class, 'store'])->name('souscription.store');

    Route::get('/dashboard-a', [DashboardController::class, 'index'])->name('dashboard.index');

});