<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Database\Factories\UserFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Hidden;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

#[Fillable(['name', 'email', 'password'])]
#[Hidden(['password', 'remember_token'])]
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    protected $fillable = [
    'name', 'prenoms', 'email', 'telephone', 'niveau', 'role', 'essai_fin', 'password',
];

public function paiements() { return $this->hasMany(Paiement::class); }
public function quizAttempts() { return $this->hasMany(QuizAttempt::class); }
public function commandes() { return $this->hasMany(Commande::class); }

public function isAdmin(): bool { return $this->role === 'admin'; }
public function essaiActif(): bool
{
    return $this->essai_fin && now()->lte($this->essai_fin);
}
}
