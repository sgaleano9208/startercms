<?php

namespace App\Filament\Resources\ZoneAppointmentResource\Pages;

use App\Filament\Resources\ZoneAppointmentResource;
use App\Models\Appointment;
use Filament\Resources\Pages\Page;
use Spatie\CalendarLinks\Link;

class AppointmentCalendar extends Page
{
    protected static string $resource = ZoneAppointmentResource::class;

    protected static string $view = 'filament.resources.zone-appointment-resource.pages.appointment-calendar';

    public function download()
    {
        /* $appointments = Appointment::all();

        $calendar = new Calendar('Appointments');

        foreach ($appointments as $appointment) {
            $event = new Event();
            $event->setSummary($appointment->zoneAppointment->salesPerson->name);
            $event->setStart($appointment->date);
            $calendar->addEvent($event);
        }
    
        // Generate the .ics file content
        $ics = $calendar->render();
    
        // Set the proper headers and output the .ics file
        header('Content-Type: text/calendar; charset=utf-8');
        header('Content-Disposition: attachment; filename=appointments.ics');
        echo $ics; */
    }

    protected function getActions(): array
    {
        return [
            \Filament\Pages\Actions\Action::make('back')
            ->link()
            ->color('gray')
            ->icon('heroicon-s-arrow-left')
            ->url(route('filament.resources.zone-appointments.index')),

            \Filament\Pages\Actions\Action::make('downloadIcs')
            ->color('primary')
            ->icon('heroicon-s-download')
            ->action('download')
        ];
    }

    protected function getHeaderWidgets(): array
    {
        return [
            ZoneAppointmentResource\Widgets\AppointmentCalendarWidget::class,
        ];
    }
}
