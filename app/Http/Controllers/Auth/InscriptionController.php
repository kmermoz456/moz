<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class InscriptionController extends Controller
{
    public function create()
    {
        return view('auth.inscription');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'      => 'required|string|max:100',
            'prenoms'   => 'required|string|max:150',
            'email'     => 'required|email|unique:users',
            'telephone' => 'required|string|max:20',
            'niveau'    => 'required|in:L1,L2',
            'password'  => 'required|min:8|confirmed',
        ]);

        $user = User::create([
            ...$validated,
            'password'  => Hash::make($validated['password']),
            'role'      => 'etudiant',
            'essai_fin' => now()->addMonth(), // 1 mois gratuit
        ]);

        Auth::login($user);

        return redirect()->route('etudiant.dashboard')
            ->with('success', 'Bienvenue chez ITF ! Votre mois de renforcement gratuit est activé.');
    }
}
