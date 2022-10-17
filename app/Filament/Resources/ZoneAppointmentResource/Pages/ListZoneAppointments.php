<?php

namespace App\Filament\Resources\ZoneAppointmentResource\Pages;

use App\Filament\Resources\ZoneAppointmentResource;
use App\Models\ZoneAppointment;
use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;

class ListZoneAppointments extends ListRecords
{
    protected static string $resource = ZoneAppointmentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make(),
            Actions\Action::make('calendar')
            ->label('View calendar')
            ->icon('heroicon-o-calendar')
            ->url(fn () => ZoneAppointmentResource::getUrl('calendar'))
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [

            ZoneAppointmentResource\Widgets\AppointmentsOverview::class,
        ];
    }
}
