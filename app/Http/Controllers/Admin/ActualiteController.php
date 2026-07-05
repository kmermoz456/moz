<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\ActualiteRequest;
use App\Models\Actualite;
use Illuminate\Support\Facades\Storage;

class ActualiteController extends Controller
{
    public function index()
    {
        $actualites = Actualite::visiblesPar(auth()->user())->with('creePar')->latest()->paginate(15);

        return view('admin.actualites.index', compact('actualites'));
    }

    public function create()
    {
        return view('admin.actualites.create');
    }

    public function store(ActualiteRequest $request)
    {
        $data = $request->safe()->except('image');
        $data['publie'] = $request->boolean('publie');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('actualites', 'public');
        }

        Actualite::create($data);

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité publiée.');
    }

    public function edit(Actualite $actualite)
    {
        abort_unless($actualite->estModifiablePar(auth()->user()), 403);

        return view('admin.actualites.edit', compact('actualite'));
    }

    public function update(ActualiteRequest $request, Actualite $actualite)
    {
        abort_unless($actualite->estModifiablePar(auth()->user()), 403);

        $data = $request->safe()->except('image');
        $data['publie'] = $request->boolean('publie');

        if ($request->hasFile('image')) {
            if ($actualite->image) {
                Storage::disk('public')->delete($actualite->image);
            }
            $data['image'] = $request->file('image')->store('actualites', 'public');
        }

        $actualite->update($data);

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité mise à jour.');
    }

    public function destroy(Actualite $actualite)
    {
        abort_unless($actualite->estModifiablePar(auth()->user()), 403);

        if ($actualite->image) {
            Storage::disk('public')->delete($actualite->image);
        }
        $actualite->delete();

        return redirect()->route('admin.actualites.index')->with('success', 'Actualité supprimée.');
    }
}
