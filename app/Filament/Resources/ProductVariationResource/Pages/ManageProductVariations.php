<?php

namespace App\Filament\Resources\ProductVariationResource\Pages;

use App\Filament\Resources\ProductVariationResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageProductVariations extends ManageRecords
{
    protected static string $resource = ProductVariationResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
