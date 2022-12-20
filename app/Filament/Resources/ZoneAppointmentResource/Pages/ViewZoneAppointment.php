<?php

namespace App\Filament\Resources\ZoneAppointmentResource\Pages;

use Auth;
use DateTime;
use App\Models\Appointment;
use App\Models\ZoneAppointment;
use Filament\Resources\Pages\ViewRecord;
use Response;
use Spatie\IcalendarGenerator\Components\Event;
use Spatie\IcalendarGenerator\Components\Calendar;
use App\Filament\Resources\ZoneAppointmentResource;

class ViewZoneAppointment extends ViewRecord
{
    protected static string $view = 'app.appointmentItem.view';
    protected static string $resource = ZoneAppointmentResource::class;

    public function addToCalendar()
    {
        $salesManager = Auth::user();
        // $from = DateTime::createFromFormat('Y-m-d H:i:s', $this->record->start_date);
        // $to = DateTime::createFromFormat('Y-m-d H:i:s', $this->record->end_date);

        

        /* $event = Event::create()
        ->name('Appointments with '. $this->record->salesPerson->name)
        ->description('Listado de visitas con fecha y hora')
        ->uniqueIdentifier($this->record->id)
        ->startsAt($from)
        ->endsAt($to)
        ->organizer($salesManager->email, $salesManager->name)
        ->attendee($this->record->salesPerson->email, $this->record->salesPerson->name); */

        $events = [];

        $appointments = Appointment::all();

        foreach ($appointments as $appointment){
            $date = $appointment->date->format('Y-m-d');
            $time = $appointment->time;

            $from = date('Y-m-d H:i:s', strtotime("$date $time"));
            $to = date('Y-m-d H:i:s', strtotime("$from + 30 minutes"));
            $from = DateTime::createFromFormat('Y-m-d H:i:s', $from);
            $to = DateTime::createFromFormat('Y-m-d H:i:s', $to);

            $event = Event::create()
                ->name('Appointment with '.$appointment->client->name)
                ->description(strip_tags($appointment->note))
                ->uniqueIdentifier($appointment->id)
                // ->createdAt(new DateTime('6 march 2019'))
                ->startsAt($from)
                ->endsAt($to)
                ->organizer($salesManager->email, $salesManager->name)
                ->attendee($this->record->salesPerson->email, $this->record->salesPerson->name);
            $events[] = $event;
        }

        $calendar = Calendar::create('Appointments calendar')
        ->refreshInterval(5)
        ->event($events);

        // dd($calendar);

        
        $tempFile = tempnam(sys_get_temp_dir(), 'ics');
        file_put_contents($tempFile, $calendar->get());

        return Response::download($tempFile, 'appointment.ics', [
            'Content-Type' => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="my-awesome-calendar.ics"',
         ]);
    }



    protected function getActions(): array
    {
        return [
            \Filament\Pages\Actions\Action::make('back')
            ->link()
            ->color('gray')
            ->icon('heroicon-s-arrow-left')
            ->url(route('filament.resources.zone-appointments.index')),
            \Filament\Pages\Actions\Action::make('addToCalendar')
            ->action('addToCalendar')
            ->color('primary')
            ->icon('heroicon-o-calendar')

        ];
    }
}
