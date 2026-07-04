<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PaiementRequest;
use App\Models\Paiement;
use App\Models\User;
use Illuminate\Http\Request;

class PaiementController extends Controller
{
    public function index()
    {
        $paiements = Paiement::with('user')->latest()->paginate(15);

        return view('admin.paiements.index', compact('paiements'));
    }

    public function create()
    {
        $etudiants = User::where('role', 'etudiant')->orderBy('name')->get();

        return view('admin.paiements.create', compact('etudiants'));
    }

    public function store(PaiementRequest $request)
    {
        Paiement::create($request->validated());

        return redirect()->route('admin.paiements.index')->with('success', 'Paiement enregistré.');
    }

    public function updateStatut(Request $request, Paiement $paiement)
    {
        $request->validate(['statut' => 'required|in:en_attente,valide']);

        $paiement->update(['statut' => $request->input('statut')]);

        return back()->with('success', 'Statut du paiement mis à jour.');
    }

    public function destroy(Paiement $paiement)
    {
        $paiement->delete();

        return redirect()->route('admin.paiements.index')->with('success', 'Paiement supprimé.');
    }
}
