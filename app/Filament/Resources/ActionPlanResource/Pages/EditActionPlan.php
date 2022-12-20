<?php

namespace App\Filament\Resources\ActionPlanResource\Pages;

use App\Filament\Resources\ActionPlanResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditActionPlan extends EditRecord
{
    protected static string $resource = ActionPlanResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
