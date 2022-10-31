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
                ->color('success')
                ->before(function (CreateAction $action, array $data) {
                    $start = $data['start_date'];
                    $end = $data['end_date'];
                    $existsActive = ZoneAppointment::where(function ($query) use ($start) {
                        $query->where('start_date', '<=', $start);
                        $query->where('end_date', '>=', $start);
                    })->orWhere(function ($query) use ($end) {
                        $query->where('start_date', '<=', $end);
                        $query->where('end_date', '>=', $end);
                    })->count();
                    if ($existsActive > 0) {
                        Notification::make()
                            ->warning()
                            ->title('Dates already selected')
                            ->body('The range of dates selected are already booked')
                            ->persistent()
                            ->send();
                        $action->cancel();
                    }
                }),

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
