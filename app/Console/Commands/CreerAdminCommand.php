<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Attributes\Description;
use Illuminate\Console\Attributes\Signature;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

use function Laravel\Prompts\password;
use function Laravel\Prompts\text;

#[Signature('admin:creer
    {--name= : Nom}
    {--prenoms= : Prénoms}
    {--email= : Email}
    {--telephone= : Téléphone WhatsApp}
    {--password= : Mot de passe (au moins 8 caractères)}
')]
#[Description('Créer un compte administrateur (à utiliser en production, ne dépend pas des données de démo)')]
class CreerAdminCommand extends Command
{
    /**
     * Execute the console command.
     */
    public function handle()
    {
        $name = $this->option('name') ?: text('Nom', required: true);
        $prenoms = $this->option('prenoms') ?: text('Prénoms', required: true);

        $email = $this->option('email');
        if ($email) {
            $erreur = $this->validerEmail($email);
            if ($erreur) {
                $this->error($erreur);

                return self::FAILURE;
            }
        } else {
            $email = text('Email', required: true, validate: fn ($value) => $this->validerEmail($value));
        }

        $telephone = $this->option('telephone') ?: text('Téléphone (WhatsApp)', required: true);

        $password = $this->option('password');
        if ($password) {
            if (strlen($password) < 8) {
                $this->error('Le mot de passe doit contenir au moins 8 caractères.');

                return self::FAILURE;
            }
        } else {
            $password = password('Mot de passe', required: true, validate: fn ($value) => strlen($value) < 8
                ? 'Le mot de passe doit contenir au moins 8 caractères.'
                : null);
        }

        $admin = User::create([
            'name' => $name,
            'prenoms' => $prenoms,
            'email' => $email,
            'telephone' => $telephone,
            'niveau' => 'L1',
            'role' => 'admin',
            'password' => Hash::make($password),
        ]);

        $this->info("Compte administrateur créé pour {$admin->email}.");

        return self::SUCCESS;
    }

    private function validerEmail(string $email): ?string
    {
        return Validator::make(
            ['email' => $email],
            ['email' => 'required|email|unique:users,email']
        )->errors()->first('email');
    }
}
