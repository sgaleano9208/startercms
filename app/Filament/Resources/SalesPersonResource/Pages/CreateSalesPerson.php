<?php

namespace App\Filament\Resources\SalesPersonResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\SalesPersonResource;

class CreateSalesPerson extends CreateRecord
{
    protected static string $resource = SalesPersonResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        $data['id'] = $data['cod'];

        return $data;
    }
}


