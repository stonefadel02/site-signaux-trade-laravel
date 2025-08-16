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
use App\Http\Controllers\SouscriptionController;
use App\Models\Signal;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/support', function () {
    return view('support');
})->name('support');


Route::middleware(['auth', 'verified'])->group(function () {

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications');
    Route::post('/notifications/mark-all-read', [NotificationController::class, 'markAllRead'])->name('notifications.markAllRead');
    Route::post('/notifications/{id}/mark-read', [NotificationController::class, 'markRead'])->name('notifications.markRead');

    Route::resource('users', UserController::class)->except(['edit']);
    // Gestion des rôles utilisateurs
    Route::get('users/{user}/roles', [UserController::class, 'editRoles'])->name('users.roles.edit');
    Route::put('users/{user}/roles', [UserController::class, 'updateRoles'])->name('users.roles.update');
    Route::post('/admin/souscriptions/{souscription}/desactiver', [SouscriptionController::class, 'deactivate'])->name('admin.souscriptions.deactivate');
    Route::resource('plans', PlanController::class);
    Route::resource('signals', SignalController::class);
    Route::post('signals/bulk-result', [SignalController::class, 'bulkResultUpdate'])->name('signals.bulk-result');

});



// Inclusion des autres fichiers de routes
require __DIR__ . '/auth.php';
require __DIR__ . '/stone.php';
require __DIR__ . '/ezechiel.php';
require __DIR__ . '/provice.php';
require __DIR__ . '/sylvie.php';




