<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

/**
 * @extends Factory<User>
 */
class UserFactory extends Factory
{
    /**
     * The current password being used by the factory.
     */
    protected static ?string $password;

    private const PRENOMS = [
        'Aya', 'Kouassi', 'Adjoua', 'Yao', 'Awa', 'Koffi', 'Mariam', 'Ismael',
        'Affoué', 'Brou', 'Fatou', 'Kacou', 'Nathalie', 'Abou', 'Christelle', 'Serge',
    ];

    private const NOMS = [
        'Kouadio', 'Traoré', 'Koné', 'Ouattara', 'Bamba', 'Diabaté', 'N\'Guessan',
        'Yao', 'Coulibaly', 'Diallo', 'Kra', 'Assi', 'Zadi', 'Gnamien',
    ];

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->randomElement(self::NOMS),
            'prenoms' => fake()->randomElement(self::PRENOMS),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'telephone' => sprintf('0%d%08d', fake()->randomElement([1, 5, 7]), fake()->numberBetween(0, 99999999)),
            'niveau' => fake()->randomElement(['L1', 'L2']),
            'role' => 'etudiant',
            'essai_fin' => now()->addDays(fake()->numberBetween(-20, 25)),
            'password' => static::$password ??= Hash::make('password'),
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     */
    public function unverified(): static
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }

    /**
     * Compte administrateur du back-office.
     */
    public function admin(): static
    {
        return $this->state(fn (array $attributes) => [
            'role' => 'admin',
            'essai_fin' => null,
        ]);
    }

    /**
     * Mois d'essai gratuit encore actif.
     */
    public function essaiActif(): static
    {
        return $this->state(fn (array $attributes) => [
            'essai_fin' => now()->addDays(fake()->numberBetween(1, 25)),
        ]);
    }

    /**
     * Mois d'essai gratuit terminé.
     */
    public function essaiExpire(): static
    {
        return $this->state(fn (array $attributes) => [
            'essai_fin' => now()->subDays(fake()->numberBetween(1, 60)),
        ]);
    }
}
