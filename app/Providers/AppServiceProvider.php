<?php

namespace App\Providers;

use App\Models\Parametre;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::composer('components.app-layout', function ($view) {
            $view->with([
                'whatsappLien'      => Parametre::get('whatsapp_lien', 'https://chat.whatsapp.com/'),
                'placesDisponibles' => Parametre::get('places_disponibles', 15),
            ]);
        });
    }
}
