<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccessCodeController;



Route::middleware('auth')->group(function () {
    Route::get('/support', function () {
        return view('support');
    })->name('support');
    
    Route::resource('access-codes', AccessCodeController::class);
});