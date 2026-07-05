<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Commande;
use Illuminate\Http\Request;

class CommandeController extends Controller
{
    public function index(Request $request)
    {
        $commandes = Commande::with(['user', 'document'])
            ->when($request->filled('statut'), fn ($q) => $q->where('statut', $request->input('statut')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.commandes.index', compact('commandes'));
    }

    public function updateStatut(Request $request, Commande $commande)
    {
        $request->validate([
            'statut' => 'required|in:en_attente,confirmee,prete,livree,annulee',
        ]);

        $commande->update(['statut' => $request->input('statut')]);

        return back()->with('success', 'Statut de la commande mis à jour.');
    }

    public function destroy(Commande $commande)
    {
        $commande->delete();

        return redirect()->route('admin.commandes.index')->with('success', 'Commande supprimée.');
    }
}
