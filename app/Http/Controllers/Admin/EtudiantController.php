<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ProlongerEssaiRequest;
use App\Models\User;
use Illuminate\Http\Request;

class EtudiantController extends Controller
{
    public function index(Request $request)
    {
        $etudiants = User::where('role', 'etudiant')
            ->when($request->filled('recherche'), function ($q) use ($request) {
                $terme = $request->input('recherche');
                $q->where(function ($q) use ($terme) {
                    $q->where('name', 'like', "%{$terme}%")
                        ->orWhere('prenoms', 'like', "%{$terme}%")
                        ->orWhere('email', 'like', "%{$terme}%");
                });
            })
            ->when($request->filled('niveau'), fn ($q) => $q->where('niveau', $request->input('niveau')))
            ->latest()
            ->paginate(15)
            ->withQueryString();

        return view('admin.etudiants.index', compact('etudiants'));
    }

    public function show(User $etudiant)
    {
        $etudiant->load(['paiements' => fn ($q) => $q->latest(), 'quizAttempts' => fn ($q) => $q->with('quiz')->latest()]);

        return view('admin.etudiants.show', compact('etudiant'));
    }

    public function prolongerEssai(ProlongerEssaiRequest $request, User $etudiant)
    {
        $base = $etudiant->essaiActif() ? $etudiant->essai_fin : now();
        $etudiant->update(['essai_fin' => \Illuminate\Support\Carbon::parse($base)->addDays($request->integer('jours'))]);

        return back()->with('success', "Essai prolongé de {$request->integer('jours')} jour(s) pour {$etudiant->name}.");
    }

    public function destroy(User $etudiant)
    {
        $etudiant->delete();

        return redirect()->route('admin.etudiants.index')->with('success', 'Étudiant supprimé.');
    }
}
