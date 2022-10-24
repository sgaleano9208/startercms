<?php

namespace App\Filament\Resources\SalesPersonResource\Pages;

use App\Filament\Resources\SalesPersonResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSalesPerson extends EditRecord
{
    protected static string $resource = SalesPersonResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['id'] = $data['cod'];

        return $data;
    }
    
    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
