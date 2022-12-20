<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use App\Filament\Resources\AppointmentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewAppointment extends ViewRecord
{
    protected static string $resource = AppointmentResource::class;

    protected static string $view = 'app.appointmentItem.view';

    protected function getActions(): array
    {
        return [
            Actions\EditAction::make(),
        ];
    }
}