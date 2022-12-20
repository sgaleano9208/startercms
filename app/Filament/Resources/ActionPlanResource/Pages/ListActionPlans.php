<?php

namespace App\Filament\Resources\ActionPlanResource\Pages;

use App\Filament\Resources\ActionPlanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListActionPlans extends ListRecords
{
    protected static string $resource = ActionPlanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
