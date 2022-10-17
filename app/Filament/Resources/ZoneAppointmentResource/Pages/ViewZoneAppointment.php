<?php

namespace App\Filament\Resources\ZoneAppointmentResource\Pages;

use App\Filament\Resources\ZoneAppointmentResource;
use App\Models\ZoneAppointment;
use Filament\Resources\Pages\ViewRecord;

class ViewZoneAppointment extends ViewRecord
{
    protected static string $view = 'app.appointmentItem.view';
    protected static string $resource = ZoneAppointmentResource::class;

    protected function getActions(): array
    {
        return [
            \Filament\Pages\Actions\Action::make('back')
            ->link()
            ->color('gray')
            ->icon('heroicon-s-arrow-left')
            ->url(route('filament.resources.zone-appointments.index'))
        ];
    }
}
