<?php

namespace App\Filament\Resources\ClientSalesDropResource\Pages;

use App\Filament\Resources\ClientSalesDropResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageClientSalesDrops extends ManageRecords
{
    protected static string $resource = ClientSalesDropResource::class;

    protected function getActions(): array
    {
        return [

        ];
    }
}
