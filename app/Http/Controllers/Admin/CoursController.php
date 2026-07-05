<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CoursRequest;
use App\Models\Cours;
use Illuminate\Support\Facades\Storage;

class CoursController extends Controller
{
    public function index()
    {
        $cours = Cours::visiblesPar(auth()->user())->with('creePar')->latest()->paginate(15);

        return view('admin.cours.index', compact('cours'));
    }

    public function create()
    {
        return view('admin.cours.create');
    }

    public function store(CoursRequest $request)
    {
        $data = $request->safe()->except('fichier_pdf');
        $data['gratuit'] = $request->boolean('gratuit');
        $data['fichier_pdf'] = $request->file('fichier_pdf')->store('cours', 'local');

        Cours::create($data);

        return redirect()->route('admin.cours.index')->with('success', 'Cours créé avec succès.');
    }

    public function edit(Cours $cour)
    {
        abort_unless($cour->estModifiablePar(auth()->user()), 403);

        return view('admin.cours.edit', ['cours' => $cour]);
    }

    public function update(CoursRequest $request, Cours $cour)
    {
        abort_unless($cour->estModifiablePar(auth()->user()), 403);

        $data = $request->safe()->except('fichier_pdf');
        $data['gratuit'] = $request->boolean('gratuit');

        if ($request->hasFile('fichier_pdf')) {
            if ($cour->fichier_pdf) {
                Storage::disk('local')->delete($cour->fichier_pdf);
            }
            $data['fichier_pdf'] = $request->file('fichier_pdf')->store('cours', 'local');
        }

        $cour->update($data);

        return redirect()->route('admin.cours.index')->with('success', 'Cours mis à jour.');
    }

    public function destroy(Cours $cour)
    {
        abort_unless($cour->estModifiablePar(auth()->user()), 403);

        if ($cour->fichier_pdf) {
            Storage::disk('local')->delete($cour->fichier_pdf);
        }
        $cour->delete();

        return redirect()->route('admin.cours.index')->with('success', 'Cours supprimé.');
    }
}
