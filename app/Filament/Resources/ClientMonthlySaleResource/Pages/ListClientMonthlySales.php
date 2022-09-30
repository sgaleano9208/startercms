<?php

namespace App\Filament\Resources\ClientMonthlySaleResource\Pages;

use App\Filament\Resources\ClientMonthlySaleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListClientMonthlySales extends ListRecords
{
    protected static string $resource = ClientMonthlySaleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
