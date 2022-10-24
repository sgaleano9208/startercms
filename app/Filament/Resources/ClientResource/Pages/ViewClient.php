<?php

namespace App\Filament\Resources\ClientResource\Pages;

use Filament\Pages\Actions\Action;
use Filament\Resources\Pages\ViewRecord;
use App\Filament\Resources\ClientResource;
use Filament\Pages\Actions\EditAction;

class ViewClient extends ViewRecord
{

    protected static string $view = 'app.client.show';

    protected static string $resource = ClientResource::class;

    protected function getActions(): array
    {
        return [
            Action::make('back')
            ->link()
            ->color('gray')
            ->icon('heroicon-s-arrow-left')
            ->url(route('filament.resources.clients.index')),

            EditAction::make()
            ->icon('heroicon-s-pencil'),

        ];
    }

}