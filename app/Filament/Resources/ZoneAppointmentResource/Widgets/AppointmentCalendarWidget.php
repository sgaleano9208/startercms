<?php

namespace App\Filament\Resources\ZoneAppointmentResource\Widgets;

use Closure;
use App\Models\Appointment;
use App\Models\ZoneAppointment;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TimePicker;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class AppointmentCalendarWidget extends FullCalendarWidget
{
    /**
     * Return events that should be rendered statically on calendar.
     */
    public function getViewData(): array
    {
        return[];
            /* return Appointment::all()->map(function ($appointmens) {
                return [
                    'id' => $appointmens->id,
                    'title' => $appointmens->client->name,
                    'date' => $appointmens->date,
                    'zone_appointment_id' => $appointmens->zone_appointment_id,
                    'client_id' => $appointmens->client_id,
                    'goals' => $appointmens->goals,
                    'note' => $appointmens->note,
                    'url' => url(route('filament.resources.appointments.edit', $appointmens->id)),
                ];
            })->toArray(); */
    }

    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        // return[];

        return Appointment::whereDate('date', '>=', $fetchInfo['start'])
            ->whereDate('date', '<=', $fetchInfo['end'])
            ->get()
            ->map(function ($appointments) {

                $date = $appointments->date->format('Y-m-d');
                $time = $appointments->time;

                $from = date('Y-m-d H:i:s', strtotime("$date $time"));

                return [
                    'id' => $appointments->id,
                    'title' => $appointments->client->name,
                    'start' => $from,
                    # Para moverlos todos juntos....
                    // 'groupId' => $appointments->zone_appointment_id,
                    'client_id' => $appointments->client_id,
                    'goals' => $appointments->goals,
                    'note' => $appointments->note,
                    'url' => url(route('filament.resources.appointments.edit', $appointments->id)),
                    'display' => 'block',
                    'backgroundColor' => $appointments->status === 'pending' ? '#387EF5' : '#EC6841',
                ];
            })
            ->toArray();
    }

    /**
     * Triggered when the user clicks an event.
     */
    public function onEventClick($event): void
    {
        //AQUI TENEMOS QUE PONER UNA VISTA PARA EL TEMA DE LOS PERMISOS... QUIEN NO CREA EL EVENTO... SOLO PUEDE VERLO, NO EDITARLO.
        parent::onEventClick($event);
    }

    /**
     * Triggered when dragging stops and the event has moved to a different day/time.
     */

    public Appointment $appointment;

    public function onEventDrop($newEvent, $oldEvent, $relatedEvents): void
    {
        $appointment = Appointment::find($oldEvent['id']);
        $this->appointment = $appointment;
        $this->appointment->update([
            'date' => $newEvent['start'],
        ]);
    }

    /**
     * Triggered when event's resize stops.
     */
    public function onEventResize($event, $oldEvent, $relatedEvents): void
    {
        // your code
    }

    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */

    public function createEvent(array $data): void
    {
        Appointment::create($data);
        $this->refreshEvents();
        // debug($data);
    }

    protected static function getCreateEventFormSchema(): array
    {
        return [
            Select::make('zone_appointment_id')
                // RECUERDA QUE AQUI TENEMOS QUE MOSTRAR SOLO LAS ZONEAPPOINTMENTS QUE ESTEN ACTIVAS Y NO TODAS!!!!
                ->options(ZoneAppointment::all()->pluck('salesPerson.name','id'))
                /* ->getOptionLabelFromRecordUsing(function ($state) {
                    $record = ZoneAppointment::find($state)->get();
                    return $record->salesPerson->name;
                }) */
                ->reactive()
                ->afterStateUpdated(function (Closure $set) {
                    $set('client_id', null);
                })
                ->required(),
            Select::make('client_id')
                ->options(function (Closure $get) {
                    $salesPerson = ZoneAppointment::find($get('zone_appointment_id'));
                    if (!$salesPerson) {
                        return [];
                    };
                    return $salesPerson->salesPerson->clients()->whereDoesntHave('appointments')->pluck('name', 'id');
                })
                ->required(),
            DatePicker::make('date')
                ->displayFormat('d/m/Y'),
            TimePicker::make('time')
                ->withoutSeconds(),
            Select::make('goals')
                ->options([
                    1 => 'Goal 1',
                    2 => 'Goal 2',
                    3 => 'Goal 3',
                    4 => 'Goal 4',
                    5 => 'Goal 5',
                ])
                ->multiple()
                ->searchable()
                ->required()
                ->columnSpanFull(),
            RichEditor::make('note')
                ->disableAllToolbarButtons()
                ->enableToolbarButtons([
                    'bold',
                    'bulletList',
                    'italic',
                    'link',
                    'orderedList',
                ])
                ->columnSpanFull(),
        ];
    }

    // // Resolve Event record into Model property
    // public function resolveEventRecord(array $data): Model
    // {
    //     // Using Appointment class as example
    //     return Appointment::find($data['id']);
    // }

    // protected static function getEditEventFormSchema(): array
    // {
    //     return [
    //         Select::make('zone_appointment_id')
    //             // RECUERDA QUE AQUI TENEMOS QUE MOSTRAR SOLO LAS ZONEAPPOINTMENTS QUE ESTEN ACTIVAS Y NO TODAS!!!!
    //             ->options(ZoneAppointment::all()->pluck('salesPerson.name','id'))
    //             /* ->getOptionLabelFromRecordUsing(function ($state) {
    //                 $record = ZoneAppointment::find($state)->get();
    //                 return $record->salesPerson->name;
    //             }) */
    //             ->reactive()
    //             ->afterStateUpdated(function (Closure $set) {
    //                 $set('client_id', null);
    //             })
    //             ->required(),
    //         Select::make('client_id')
    //             ->options(function (Closure $get) {
    //                 $salesPerson = ZoneAppointment::find($get('zone_appointment_id'));

    //                 if (!$salesPerson) {
    //                     return [];
    //                 };
    //                 return $salesPerson->salesPerson->clients->pluck('name', 'id');
    //             })
    //             ->required(),
    //         DatePicker::make('date')
    //             ->displayFormat('d/m/Y'),
    //         TimePicker::make('time')
    //             ->withoutSeconds(),
    //         Select::make('goals')
    //             ->options([
    //                 1 => 'Goal 1',
    //                 2 => 'Goal 2',
    //                 3 => 'Goal 3',
    //                 4 => 'Goal 4',
    //                 5 => 'Goal 5',
    //             ])
    //             ->multiple()
    //             ->searchable()
    //             ->required()
    //             ->columnSpanFull(),
    //         RichEditor::make('note')
    //             ->disableAllToolbarButtons()
    //             ->enableToolbarButtons([
    //                 'bold',
    //                 'bulletList',
    //                 'italic',
    //                 'link',
    //                 'orderedList',
    //             ])
    //             ->columnSpanFull(),
    //     ];
    // }


    // public function editEvent(array $data): void
    // {
    //     // Edit the event with the provided $data.

    //     /**
    //      * here you can access to 2 properties to perform update
    //      * 1. $this->event_id
    //      * 2. $this->event
    //      */

    //     $this->event->zone_appointment_id = $data['zone_appointment_id'];
    //     $this->event->client_id = $data['client_id'];
    //     $this->event->date = $data['date'];
    //     $this->event->time = $data['time'];
    //     $this->event->goals = $data['goals'];
    //     $this->event->note = $data['note'];
    //     $this->event->status = 'pending';
    //     $this->refreshEvents();


    //     # $this->event_id
    //     // the value is retrieved from event's id key
    //     Appointment::find($this->event->id);
    //     //        dd($this->event);

    //     # $this->event
    //     // model instance is resolved by user defined resolveEventRecord() funtion. See example below
    //     $this->event->update($data);
    // }
}
