<?php

namespace App\Filament\Resources\ClientResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\ClientResource;

class EditClient extends EditRecord
{
    protected static string $resource = ClientResource::class;

    public $visible = '';
    public $disable = '';
    public $cooperatives = [];

    protected function getActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

}
