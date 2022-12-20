<?php

namespace App\Filament\Resources\AppointmentResource\Pages;

use Filament\Pages\Actions;
use Illuminate\Database\Eloquent\Model;
use Filament\Resources\Pages\EditRecord;
use App\Filament\Resources\AppointmentResource;
use Illuminate\Support\Carbon;
use Response;
use DateTime;
use Spatie\IcalendarGenerator\Components\Calendar;
use Spatie\IcalendarGenerator\Components\Event;

class EditAppointment extends EditRecord
{
    protected static string $resource = AppointmentResource::class;

    public function addToCalendar()
    {
        $date = $this->record->date->format('Y-m-d');
        $time = $this->record->time;

        $from = date('Y-m-d H:i:s', strtotime("$date $time"));
        $to = date('Y-m-d H:i:s', strtotime("$from + 30 minutes"));
        $from = DateTime::createFromFormat('Y-m-d H:i:s', $from);
        $to = DateTime::createFromFormat('Y-m-d H:i:s', $to);

        $event = Event::create()
                ->name('Appointment with '.$this->record->client->name)
                ->description(strip_tags($this->record->note))
                ->uniqueIdentifier($this->record->id)
                // ->createdAt(new DateTime('6 march 2019'))
                ->startsAt($from)
                ->endsAt($to);

        $calendar = Calendar::create('Appointments calendar')
        ->refreshInterval(5)
        ->event($event);

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
            // Actions\ViewAction::make(),
            Actions\Action::make('addToCalendar')
            ->action('addToCalendar'),

            Actions\DeleteAction::make(),
        ];
    }
}
