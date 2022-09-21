<?php

namespace App\Filament\Resources\ContactResource\Pages;

use App\Filament\Resources\ContactResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageContacts extends ManageRecords
{
    protected static string $resource = ContactResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
