<?php

namespace App\Filament\Resources\ZoneAppointmentResource\Pages;

use App\Filament\Resources\ZoneAppointmentResource;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZoneAppointments extends ListRecords
{
    protected static string $resource = ZoneAppointmentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [

            ZoneAppointmentResource\Widgets\AppointmentsOverview::class,
        ];
    }
}
