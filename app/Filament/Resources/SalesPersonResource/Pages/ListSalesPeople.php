<?php

namespace App\Filament\Resources\SalesPersonResource\Pages;

use App\Filament\Resources\SalesPersonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListSalesPeople extends ListRecords
{
    protected static string $resource = SalesPersonResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
