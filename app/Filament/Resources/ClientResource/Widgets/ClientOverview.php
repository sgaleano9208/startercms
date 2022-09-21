<?php

namespace App\Filament\Resources\ClientResource\Widgets;

use App\Models\Client;
use Illuminate\Support\Carbon;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class ClientOverview extends BaseWidget
{
    protected function getCards(): array
    {

        return [
            Card::make('Total clients', Client::all()->count())
                ->description('32k increase')
                ->descriptionIcon('heroicon-s-trending-up')
                ->color('success'),
            Card::make('Leads', Client::all()->where('type', 'lead')->count())
                ->description('7% increase')
                ->descriptionIcon('heroicon-s-trending-down')
                ->color('danger'),
            Card::make('New clients', Client::whereMonth('created_at', '=', Carbon::now()->month)->count())
                ->description('New clients last month')
                ->descriptionIcon('heroicon-s-trending-up')
                ->chart([7, 2, 10, 3, 15, 4, 17])
                ->color('success'),
        ];
    }
}
