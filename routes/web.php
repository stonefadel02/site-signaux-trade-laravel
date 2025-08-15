<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlanController;


use App\Http\Controllers\UserController;
use App\Http\Controllers\SignalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PaiementController;
use App\Http\Controllers\AccessCodeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SessionSignalController;

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markRead'])->name('notifications.markRead');
    Route::resource('users', UserController::class)->except(['edit']);

    Route::resource('session-signals', SessionSignalController::class);
    Route::resource('plans', PlanController::class);
    Route::resource('signals', SignalController::class);
    Route::resource('paiements', PaiementController::class);
    Route::resource('access-codes', AccessCodeController::class);
    Route::get('/support', function () {
        return view('support');
    })->name('support');
    Route::get('/signaux', [SignalController::class, 'publicIndex'])->name('signaux');
});


Route::get('/', function () {
    return view('welcome');
});

// Route publique pour les signaux (accessible aux abonnés)

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


require __DIR__ . '/auth.php';
require __DIR__ . '/stone.php';
require __DIR__ . '/provice.php';
require __DIR__ . '/sylvie.php';
Route::get('/register', function () {
    return view('auth.register');
})->name('register');



