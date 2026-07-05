<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DocumentPhysiqueRequest;
use App\Models\DocumentPhysique;
use Illuminate\Support\Facades\Storage;

class DocumentPhysiqueController extends Controller
{
    public function index()
    {
        $documents = DocumentPhysique::visiblesPar(auth()->user())->with('creePar')->withCount('commandes')->latest()->paginate(15);

        return view('admin.documents.index', compact('documents'));
    }

    public function create()
    {
        return view('admin.documents.create');
    }

    public function store(DocumentPhysiqueRequest $request)
    {
        $data = $request->safe()->except('image');
        $data['disponible'] = $request->boolean('disponible');

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('documents', 'public');
        }

        DocumentPhysique::create($data);

        return redirect()->route('admin.documents.index')->with('success', 'Document ajouté au catalogue.');
    }

    public function edit(DocumentPhysique $document)
    {
        abort_unless($document->estModifiablePar(auth()->user()), 403);

        return view('admin.documents.edit', compact('document'));
    }

    public function update(DocumentPhysiqueRequest $request, DocumentPhysique $document)
    {
        abort_unless($document->estModifiablePar(auth()->user()), 403);

        $data = $request->safe()->except('image');
        $data['disponible'] = $request->boolean('disponible');

        if ($request->hasFile('image')) {
            if ($document->image) {
                Storage::disk('public')->delete($document->image);
            }
            $data['image'] = $request->file('image')->store('documents', 'public');
        }

        $document->update($data);

        return redirect()->route('admin.documents.index')->with('success', 'Document mis à jour.');
    }

    public function destroy(DocumentPhysique $document)
    {
        abort_unless($document->estModifiablePar(auth()->user()), 403);

        if ($document->image) {
            Storage::disk('public')->delete($document->image);
        }
        $document->delete();

        return redirect()->route('admin.documents.index')->with('success', 'Document supprimé du catalogue.');
    }
}
