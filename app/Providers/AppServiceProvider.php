<?php

namespace App\Providers;

use Filament\Facades\Filament;
use Filament\Navigation\NavigationItem;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Filament::serving(function () {
            Filament::registerNavigationItems([
                NavigationItem::make('Calendar')
                    ->url(route('filament.resources.zone-appointments.calendar'))
                    ->icon('heroicon-o-calendar')
                    ->activeIcon('heroicon-s-calendar')
                    ->group('Agenda')
                    ->sort(3),
            ]);
        });
    }
}
