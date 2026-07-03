<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
    /**
     * Espace étudiant : mes cours
     */
    public function dashboard()
    {
        $user = auth()->user();

        // Logique d'accès :
        // - cours gratuits : toujours accessibles
        // - tous les cours : si mois d'essai actif OU paiement du mois validé
        $accesComplet = $user->essaiActif() || $this->aPayeCeMois($user);

        $cours = Cours::where('niveau', $user->niveau)
            ->when(!$accesComplet, fn ($q) => $q->where('gratuit', true))
            ->orderBy('matiere')
            ->get()
            ->groupBy('matiere');

        return view('etudiant.dashboard', compact('cours', 'accesComplet'));
    }

    /**
     * Téléchargement d'un PDF (+ compteur pour les stats admin)
     */
    public function telecharger(Cours $cours)
    {
        $user = auth()->user();

        // Vérification des droits d'accès
        $accesComplet = $user->essaiActif() || $this->aPayeCeMois($user);

        if (!$cours->gratuit && !$accesComplet) {
            return redirect()->route('etudiant.dashboard')
                ->with('error', 'Votre mois d\'essai est terminé. Effectuez un paiement pour accéder à ce cours.');
        }

        if (!$cours->fichier_pdf || !Storage::disk('local')->exists($cours->fichier_pdf)) {
            abort(404, 'Fichier introuvable.');
        }

        // Incrémenter le compteur de téléchargements (visible dans le dashboard admin)
        $cours->increment('telechargements');

        return Storage::disk('local')->download(
            $cours->fichier_pdf,
            $cours->titre . '.pdf'
        );
    }

    /**
     * L'étudiant a-t-il un paiement validé pour le mois en cours ?
     */
    private function aPayeCeMois($user): bool
    {
        return $user->paiements()
            ->where('statut', 'valide')
            ->whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->exists();
    }
}