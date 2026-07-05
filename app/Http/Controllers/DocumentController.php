<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommanderDocumentRequest;
use App\Models\Commande;
use App\Models\DocumentPhysique;

class DocumentController extends Controller
{
    /**
     * Catalogue des documents physiques disponibles à la commande
     */
    public function index()
    {
        $documents = DocumentPhysique::where('disponible', true)
            ->where(function ($query) {
                $query->where('niveau', auth()->user()->niveau)->orWhere('niveau', 'Tous');
            })
            ->orderBy('categorie')
            ->get()
            ->groupBy('categorie');

        return view('etudiant.documents.index', compact('documents'));
    }

    /**
     * Passer une commande pour un document
     */
    public function commander(CommanderDocumentRequest $request, DocumentPhysique $document)
    {
        abort_unless($document->disponible, 404);

        Commande::create([
            'user_id'       => auth()->id(),
            'document_id'   => $document->id,
            'quantite'      => $request->integer('quantite'),
            'prix_unitaire' => $document->prix,
            'notes'         => $request->input('notes'),
        ]);

        return redirect()->route('etudiant.commandes.index')
            ->with('success', "Votre commande pour « {$document->titre} » a bien été enregistrée. Nous vous contacterons sur WhatsApp pour la suite.");
    }

    /**
     * Historique des commandes de l'étudiant connecté
     */
    public function mesCommandes()
    {
        $commandes = auth()->user()->commandes()->with('document')->latest()->paginate(10);

        return view('etudiant.documents.commandes', compact('commandes'));
    }
}
