<?php

namespace App\Filament\Resources\CooperativeResource\Pages;

use App\Filament\Resources\CooperativeResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageCooperatives extends ManageRecords
{
    protected static string $resource = CooperativeResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
