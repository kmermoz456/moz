<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Prospect;

class ProspectController extends Controller
{
    public function index()
    {
        $prospects = Prospect::latest()->paginate(20);

        return view('admin.prospects.index', compact('prospects'));
    }

    public function destroy(Prospect $prospect)
    {
        $prospect->delete();

        return redirect()->route('admin.prospects.index')->with('success', 'Contact supprimé.');
    }
}
