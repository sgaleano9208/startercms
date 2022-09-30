<?php

namespace App\Filament\Resources\ClientMonthlySaleResource\Pages;

use App\Filament\Resources\ClientMonthlySaleResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditClientMonthlySale extends EditRecord
{
    protected static string $resource = ClientMonthlySaleResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
