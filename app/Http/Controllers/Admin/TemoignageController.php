<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\TemoignageRequest;
use App\Models\Temoignage;

class TemoignageController extends Controller
{
    public function index()
    {
        $temoignages = Temoignage::visiblesPar(auth()->user())->with('creePar')->latest()->paginate(15);

        return view('admin.temoignages.index', compact('temoignages'));
    }

    public function create()
    {
        return view('admin.temoignages.create');
    }

    public function store(TemoignageRequest $request)
    {
        $data = $request->safe()->except('photo');
        $data['publie'] = $request->boolean('publie');

        if ($request->hasFile('photo')) {
            $data['photo'] = $request->file('photo')->store('temoignages', 'public');
        }

        Temoignage::create($data);

        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage ajouté.');
    }

    public function edit(Temoignage $temoignage)
    {
        abort_unless($temoignage->estModifiablePar(auth()->user()), 403);

        return view('admin.temoignages.edit', compact('temoignage'));
    }

    public function update(TemoignageRequest $request, Temoignage $temoignage)
    {
        abort_unless($temoignage->estModifiablePar(auth()->user()), 403);

        $data = $request->safe()->except('photo');
        $data['publie'] = $request->boolean('publie');

        if ($request->hasFile('photo')) {
            if ($temoignage->photo) {
                \Illuminate\Support\Facades\Storage::disk('public')->delete($temoignage->photo);
            }
            $data['photo'] = $request->file('photo')->store('temoignages', 'public');
        }

        $temoignage->update($data);

        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage mis à jour.');
    }

    public function destroy(Temoignage $temoignage)
    {
        abort_unless($temoignage->estModifiablePar(auth()->user()), 403);

        if ($temoignage->photo) {
            \Illuminate\Support\Facades\Storage::disk('public')->delete($temoignage->photo);
        }
        $temoignage->delete();

        return redirect()->route('admin.temoignages.index')->with('success', 'Témoignage supprimé.');
    }
}
