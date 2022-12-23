<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use Filament\Pages\Actions;
use Filament\Resources\Pages\ListRecords;
use App\Filament\Resources\AppointmentResource;
use App\Filament\Resources\ZoneAppointmentResource;

class ListAppointments extends ListRecords
{
    protected static string $resource = AppointmentResource::class;

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

    
}
