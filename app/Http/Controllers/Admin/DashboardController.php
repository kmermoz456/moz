<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\{User, Paiement, QuizAttempt, Cours};

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'etudiants_total'   => User::where('role', 'etudiant')->count(),
            'nouveaux_semaine'  => User::where('role', 'etudiant')
                                       ->where('created_at', '>=', now()->subDays(7))->count(),
            'paiements_jour'    => Paiement::whereDate('created_at', today())->count(),
            'paiements_mois'    => Paiement::whereMonth('created_at', now()->month)
                                       ->whereYear('created_at', now()->year)->count(),
            'recettes_mois'     => Paiement::where('statut', 'valide')
                                       ->whereMonth('created_at', now()->month)->sum('montant'),
            'quiz_realises'     => QuizAttempt::count(),
            'taux_reussite'     => round(
                QuizAttempt::where('total', '>', 0)->get(['score', 'total'])
                    ->avg(fn ($a) => $a->score / $a->total * 100) ?? 0
            ),
            'telechargements'   => Cours::sum('telechargements'),
        ];

        $derniers_inscrits = User::where('role', 'etudiant')->latest()->take(10)->get();

        return view('admin.dashboard', compact('stats', 'derniers_inscrits'));
    }
}
