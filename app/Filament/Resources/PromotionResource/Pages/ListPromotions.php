<?php

namespace App\Filament\Resources\PromotionResource\Pages;

use App\Filament\Resources\PromotionResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPromotions extends ListRecords
{
    protected static string $resource = PromotionResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
