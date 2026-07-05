<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdministrateurRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdministrateurController extends Controller
{
    public function index()
    {
        $administrateurs = User::where('role', 'admin')->latest()->get();

        return view('admin.administrateurs.index', compact('administrateurs'));
    }

    public function create()
    {
        return view('admin.administrateurs.create');
    }

    public function store(AdministrateurRequest $request)
    {
        User::create([
            ...$request->safe()->except(['password', 'est_super_admin']),
            'password' => Hash::make($request->validated('password')),
            'niveau'   => 'L1',
            'role'     => 'admin',
            // Seul un super admin peut créer un autre super admin.
            'est_super_admin' => auth()->user()->estSuperAdmin() && $request->boolean('est_super_admin'),
        ]);

        return redirect()->route('admin.administrateurs.index')->with('success', 'Administrateur créé avec succès.');
    }

    public function destroy(User $administrateur)
    {
        abort_unless($administrateur->role === 'admin', 404);

        if ($administrateur->id === auth()->id()) {
            return back()->with('error', 'Vous ne pouvez pas supprimer votre propre compte.');
        }

        if (User::where('role', 'admin')->count() <= 1) {
            return back()->with('error', 'Impossible de supprimer le dernier administrateur.');
        }

        $administrateur->delete();

        return redirect()->route('admin.administrateurs.index')->with('success', 'Administrateur supprimé.');
    }
}
