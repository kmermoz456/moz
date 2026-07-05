<?php

namespace App\Http\Controllers;

class SeoController extends Controller
{
    /**
     * Pages publiques à référencer, avec leur priorité et fréquence de mise à jour.
     */
    private const PAGES = [
        ['route' => 'accueil',       'priority' => '1.0', 'changefreq' => 'weekly'],
        ['route' => 'universite',    'priority' => '0.8', 'changefreq' => 'monthly'],
        ['route' => 'pourquoi',      'priority' => '0.8', 'changefreq' => 'monthly'],
        ['route' => 'temoignages',   'priority' => '0.7', 'changefreq' => 'weekly'],
        ['route' => 'statistiques',  'priority' => '0.7', 'changefreq' => 'monthly'],
        ['route' => 'whatsapp',      'priority' => '0.7', 'changefreq' => 'monthly'],
        ['route' => 'apropos',      'priority' => '0.6', 'changefreq' => 'monthly'],
        ['route' => 'inscription',   'priority' => '0.9', 'changefreq' => 'monthly'],
        ['route' => 'connexion',     'priority' => '0.3', 'changefreq' => 'yearly'],
    ];

    /**
     * Plan du site pour les moteurs de recherche.
     */
    public function sitemap()
    {
        $urls = collect(self::PAGES)->map(fn ($page) => [
            'loc' => route($page['route']),
            'priority' => $page['priority'],
            'changefreq' => $page['changefreq'],
        ]);

        return response()
            ->view('sitemap', compact('urls'))
            ->header('Content-Type', 'text/xml');
    }

    /**
     * robots.txt — bloque les espaces privés et référence le sitemap.
     */
    public function robots()
    {
        $lignes = [
            'User-agent: *',
            'Disallow: /admin',
            'Disallow: /mon-espace',
            'Disallow: /mes-commandes',
            'Disallow: /documents',
            'Disallow: /quiz',
            'Disallow: /inscription/confirmation',
            '',
            'Sitemap: '.route('sitemap'),
        ];

        return response(implode("\n", $lignes), 200)->header('Content-Type', 'text/plain');
    }
}
