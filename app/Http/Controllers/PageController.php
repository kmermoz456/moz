<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Galerie;
use App\Models\Parametre;
use App\Models\Temoignage;
use App\Models\User;
use App\Models\Cours;

class PageController extends Controller
{
    /**
     * Page d'accueil
     */
    public function accueil()
    {
        // Chiffres clés : nombre d'étudiants calculé en temps réel, le reste modifiable par l'admin
        $chiffres = [
            'etudiants_formes' => User::where('role', 'etudiant')->count(),
            'taux_reussite'    => Parametre::get('taux_reussite', 92),
            'enseignants'      => Parametre::get('nombre_enseignants', 15),
            'annees'           => Parametre::get('annees_experience', now()->year - 2021),
        ];

        // Témoignages publiés (les 6 plus récents)
        $temoignages = Temoignage::where('publie', true)
            ->latest()
            ->take(6)
            ->get();

        // Actualités publiées (les 3 plus récentes)
        $actualites = Actualite::where('publie', true)
            ->latest()
            ->take(3)
            ->get();

        // Galerie photos (les 8 plus récentes)
        $galerie = Galerie::latest()->take(8)->get();

        return view('accueil', compact('chiffres', 'temoignages', 'actualites', 'galerie'));
    }

    /**
     * Découvrir l'Université Nangui Abrogoua
     */
    public function universite()
    {
        // Données statiques structurées — faciles à afficher en boucle dans la vue
        $filieres = [
            [
                'nom' => 'Biologie',
                'description' => 'Étude des organismes vivants, de la cellule aux écosystèmes.',
            ],
            [
                'nom' => 'Géosciences',
                'description' => 'Sciences de la Terre : géologie, environnement, ressources naturelles.',
            ],
            [
                'nom' => 'Biochimie',
                'description' => 'Étude des processus chimiques au sein des organismes vivants.',
            ],
            // Ajoutez les autres filières de l'UFR SN ici
        ];

        $lieux = [
            ['nom' => 'Amphithéâtres', 'icone' => '🏛️', 'description' => 'Localisation des amphis A, B, C et des salles de TD.'],
            ['nom' => 'Bibliothèque', 'icone' => '📚', 'description' => 'Horaires, conditions d\'accès et ressources disponibles.'],
            ['nom' => 'Restaurants universitaires', 'icone' => '🍽️', 'description' => 'Les restos U du campus et leurs tarifs.'],
            ['nom' => 'Résidences universitaires', 'icone' => '🏠', 'description' => 'Cités universitaires et démarches pour obtenir une chambre.'],
            ['nom' => 'Services administratifs', 'icone' => '🗂️', 'description' => 'Scolarité, CROU, inscriptions pédagogiques.'],
        ];

        $faq = [
            [
                'question' => 'Comment se déroule la première semaine à l\'université ?',
                'reponse'  => 'Après votre orientation, vous devez finaliser votre inscription administrative puis pédagogique. ITF vous accompagne dans toutes ces démarches.',
            ],
            [
                'question' => 'Qu\'est-ce que le système LMD ?',
                'reponse'  => 'Licence (3 ans) – Master (2 ans) – Doctorat (3 ans). Chaque année est divisée en semestres validés par des crédits (UE).',
            ],
            [
                'question' => 'Où trouver les emplois du temps ?',
                'reponse'  => 'Ils sont affichés à l\'UFR et relayés sur la plateforme ITF dès leur publication.',
            ],
            // Ajoutez d'autres questions fréquentes
        ];

        return view('universite', compact('filieres', 'lieux', 'faq'));
    }

    /**
     * Pourquoi choisir ITF ?
     */
    public function pourquoiItf()
    {
        $avantages = [
            ['titre' => 'Enseignants expérimentés', 'icone' => '👨‍🏫', 'description' => 'Une équipe pédagogique qui maîtrise parfaitement les programmes de l\'UFR SN.'],
            ['titre' => 'Suivi personnalisé', 'icone' => '🎯', 'description' => 'Chaque étudiant est suivi individuellement dans sa progression.'],
            ['titre' => 'Petits groupes', 'icone' => '👥', 'description' => 'Des effectifs réduits pour favoriser les échanges et la compréhension.'],
            ['titre' => 'Exercices corrigés', 'icone' => '✍️', 'description' => 'Des séries d\'exercices avec corrections détaillées.'],
            ['titre' => 'Examens blancs', 'icone' => '📝', 'description' => 'Entraînez-vous dans les conditions réelles des examens.'],
            ['titre' => 'Quiz interactifs', 'icone' => '⚡', 'description' => 'Testez vos connaissances en ligne et suivez vos scores.'],
            ['titre' => 'Supports PDF', 'icone' => '📄', 'description' => 'Tous les cours et fiches téléchargeables à tout moment.'],
            ['titre' => 'Cours en ligne', 'icone' => '💻', 'description' => 'Accédez à vos cours où que vous soyez, 24h/24.'],
            ['titre' => 'Assistance permanente', 'icone' => '💬', 'description' => 'Une équipe disponible sur WhatsApp pour répondre à vos questions.'],
            ['titre' => 'Préparation intensive', 'icone' => '🔥', 'description' => 'Sessions de révision renforcées avant chaque période d\'examens.'],
            ['titre' => 'Taux élevé de réussite', 'icone' => '🏆', 'description' => 'Nos anciens étudiants valident leurs semestres avec succès.'],
        ];

        return view('pourquoi-itf', compact('avantages'));
    }
}