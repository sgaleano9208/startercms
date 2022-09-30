<?php

namespace App\Filament\Resources\ZoneAppointmentResource\Pages;

use App\Filament\Resources\ZoneAppointmentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewZoneAppointment extends ViewRecord
{
    protected static string $view = 'app/appointmentItem/view';
    protected static string $resource = ZoneAppointmentResource::class;
}
