<?php

use App\Http\Controllers\Auth\InscriptionController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\{PageController, CoursController, QuizController};

// Site public
Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/universite', [PageController::class, 'universite'])->name('universite');
Route::get('/pourquoi-itf', [PageController::class, 'pourquoiItf'])->name('pourquoi');

// Inscription
Route::get('/inscription', [InscriptionController::class, 'create'])->name('inscription');
Route::post('/inscription', [InscriptionController::class, 'store']);

// Connexion / déconnexion
Route::get('/connexion', [SessionController::class, 'create'])->name('connexion');
Route::post('/connexion', [SessionController::class, 'store']);
Route::post('/deconnexion', [SessionController::class, 'destroy'])->middleware('auth')->name('deconnexion');

// Espace étudiant
Route::middleware('auth')->group(function () {
    Route::get('/mon-espace', [CoursController::class, 'dashboard'])->name('etudiant.dashboard');
    Route::get('/cours/{cours}/telecharger', [CoursController::class, 'telecharger'])->name('cours.telecharger');

    Route::get('/quiz', [QuizController::class, 'index'])->name('etudiant.quiz.index');
    Route::get('/quiz/{quiz}', [QuizController::class, 'show'])->name('etudiant.quiz.show');
    Route::post('/quiz/{quiz}', [QuizController::class, 'submit'])->name('etudiant.quiz.submit');
});

// Espace admin
Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
});