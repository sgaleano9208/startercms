<?php

namespace App\Filament\Resources\ZoneAppointmentResource\Pages;

use App\Filament\Resources\ZoneAppointmentResource;
use Filament\Resources\Pages\Page;

class AppointmentCalendar extends Page
{
    protected static string $resource = ZoneAppointmentResource::class;

    protected static string $view = 'filament.resources.zone-appointment-resource.pages.appointment-calendar';
}
