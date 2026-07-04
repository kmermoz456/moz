<?php

use App\Http\Controllers\Auth\InscriptionController;
use App\Http\Controllers\Auth\SessionController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EtudiantController as AdminEtudiantController;
use App\Http\Controllers\Admin\CoursController as AdminCoursController;
use App\Http\Controllers\Admin\PaiementController as AdminPaiementController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Admin\TemoignageController as AdminTemoignageController;
use App\Http\Controllers\Admin\ActualiteController as AdminActualiteController;
use App\Http\Controllers\Admin\GalerieController as AdminGalerieController;
use App\Http\Controllers\Admin\ParametreController as AdminParametreController;
use App\Http\Controllers\Admin\ProspectController as AdminProspectController;
use App\Http\Controllers\{PageController, CoursController, QuizController, ProspectController};

// Site public
Route::get('/', [PageController::class, 'accueil'])->name('accueil');
Route::get('/universite', [PageController::class, 'universite'])->name('universite');
Route::get('/pourquoi-itf', [PageController::class, 'pourquoiItf'])->name('pourquoi');
Route::get('/whatsapp', [PageController::class, 'whatsapp'])->name('whatsapp');
Route::get('/statistiques', [PageController::class, 'statistiques'])->name('statistiques');
Route::get('/temoignages', [PageController::class, 'temoignages'])->name('temoignages');
Route::get('/a-propos', [PageController::class, 'aPropos'])->name('apropos');

// Formulaire rapide (pop-up, bandeau, footer)
Route::post('/contact-rapide', [ProspectController::class, 'store'])->name('prospects.store');

// Inscription
Route::get('/inscription', [InscriptionController::class, 'create'])->name('inscription');
Route::post('/inscription', [InscriptionController::class, 'store']);
Route::get('/inscription/confirmation', [InscriptionController::class, 'confirmation'])
    ->middleware('auth')->name('inscription.confirmation');

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
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('etudiants', [AdminEtudiantController::class, 'index'])->name('etudiants.index');
    Route::get('etudiants/{etudiant}', [AdminEtudiantController::class, 'show'])->name('etudiants.show');
    Route::post('etudiants/{etudiant}/prolonger-essai', [AdminEtudiantController::class, 'prolongerEssai'])->name('etudiants.prolonger-essai');
    Route::delete('etudiants/{etudiant}', [AdminEtudiantController::class, 'destroy'])->name('etudiants.destroy');

    Route::resource('cours', AdminCoursController::class)->except(['show']);

    Route::get('paiements', [AdminPaiementController::class, 'index'])->name('paiements.index');
    Route::get('paiements/creer', [AdminPaiementController::class, 'create'])->name('paiements.create');
    Route::post('paiements', [AdminPaiementController::class, 'store'])->name('paiements.store');
    Route::patch('paiements/{paiement}/statut', [AdminPaiementController::class, 'updateStatut'])->name('paiements.statut');
    Route::delete('paiements/{paiement}', [AdminPaiementController::class, 'destroy'])->name('paiements.destroy');

    Route::resource('quiz', AdminQuizController::class)->except(['show']);
    Route::resource('temoignages', AdminTemoignageController::class)->except(['show']);
    Route::resource('actualites', AdminActualiteController::class)->except(['show']);

    Route::get('galerie', [AdminGalerieController::class, 'index'])->name('galerie.index');
    Route::get('galerie/ajouter', [AdminGalerieController::class, 'create'])->name('galerie.create');
    Route::post('galerie', [AdminGalerieController::class, 'store'])->name('galerie.store');
    Route::delete('galerie/{galerie}', [AdminGalerieController::class, 'destroy'])->name('galerie.destroy');

    Route::get('parametres', [AdminParametreController::class, 'index'])->name('parametres.index');
    Route::put('parametres', [AdminParametreController::class, 'update'])->name('parametres.update');

    Route::get('prospects', [AdminProspectController::class, 'index'])->name('prospects.index');
    Route::delete('prospects/{prospect}', [AdminProspectController::class, 'destroy'])->name('prospects.destroy');
});