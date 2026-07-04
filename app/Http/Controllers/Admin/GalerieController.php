<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\GalerieRequest;
use App\Models\Galerie;
use Illuminate\Support\Facades\Storage;

class GalerieController extends Controller
{
    public function index()
    {
        $photos = Galerie::latest()->paginate(15);

        return view('admin.galerie.index', compact('photos'));
    }

    public function create()
    {
        return view('admin.galerie.create');
    }

    public function store(GalerieRequest $request)
    {
        Galerie::create([
            'titre' => $request->input('titre'),
            'image' => $request->file('image')->store('galerie', 'public'),
        ]);

        return redirect()->route('admin.galerie.index')->with('success', 'Photo ajoutée à la galerie.');
    }

    public function destroy(Galerie $galerie)
    {
        Storage::disk('public')->delete($galerie->image);
        $galerie->delete();

        return redirect()->route('admin.galerie.index')->with('success', 'Photo supprimée.');
    }
}
