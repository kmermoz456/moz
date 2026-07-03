<?php

use App\Http\Controllers\Auth\InscriptionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\{PageController, CoursController};

// Site public
Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/universite', [PageController::class, 'universite'])->name('universite');
Route::get('/pourquoi-itf', [PageController::class, 'pourquoiItf'])->name('pourquoi');

// Inscription
Route::get('/inscription', [InscriptionController::class, 'create'])->name('inscription');
Route::post('/inscription', [InscriptionController::class, 'store']);

// Espace étudiant
Route::middleware('auth')->group(function () {
    Route::get('/mon-espace', [CoursController::class, 'dashboard'])->name('etudiant.dashboard');
    Route::get('/cours/{cours}/telecharger', [CoursController::class, 'telecharger'])->name('cours.telecharger');
});

// Espace admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});