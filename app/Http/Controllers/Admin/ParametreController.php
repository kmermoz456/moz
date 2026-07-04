<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ParametresRequest;
use App\Models\Parametre;

class ParametreController extends Controller
{
    public function index()
    {
        $parametres = [
            'taux_reussite'      => Parametre::get('taux_reussite', 92),
            'taux_satisfaction'  => Parametre::get('taux_satisfaction', 95),
            'nombre_enseignants' => Parametre::get('nombre_enseignants', 15),
            'annees_experience'  => Parametre::get('annees_experience', now()->year - 2021),
            'whatsapp_lien'      => Parametre::get('whatsapp_lien', 'https://chat.whatsapp.com/'),
        ];

        return view('admin.parametres.index', compact('parametres'));
    }

    public function update(ParametresRequest $request)
    {
        foreach ($request->validated() as $cle => $valeur) {
            Parametre::updateOrCreate(['cle' => $cle], ['valeur' => $valeur]);
        }

        return back()->with('success', 'Paramètres mis à jour.');
    }
}
