<?php

namespace App\Filament\Resources\ZoneAppointmentResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Support\Carbon;
use App\Models\ZoneAppointment;
use Illuminate\Database\Eloquent\Model;
use Filament\Notifications\Notification;
use Filament\Pages\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Notifications\Actions\Action;
use App\Filament\Resources\ZoneAppointmentResource;

class ListZoneAppointments extends ListRecords
{
    protected static string $resource = ZoneAppointmentResource::class;

    protected function getActions(): array
    {
        return [
            Actions\CreateAction::make()
                ->label('Block dates')
                ->icon('heroicon-s-plus')
                ->color('success'),

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
