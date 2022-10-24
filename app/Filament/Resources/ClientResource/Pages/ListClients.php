<?php

namespace App\Filament\Resources\ClientResource\Pages;

use Closure;
use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\ClientResource;

class ListClients extends ListRecords
{
    protected static string $resource = ClientResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getTableRecordUrlUsing(): ?Closure
    {
        return fn (Model $record): string => route('filament.resources.clients.view', ['record' => $record]);
    }

    protected function getHeaderWidgets(): array
    {
        return [
            // ClientResource\Widgets\ClientOverview::class,
        ];
    }
}
