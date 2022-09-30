<?php

namespace App\Filament\Resources\ZoneAppointmentResource\Pages;

use App\Filament\Resources\ZoneAppointmentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\EditRecord;

class EditZoneAppointment extends EditRecord
{
    protected static string $resource = ZoneAppointmentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}
