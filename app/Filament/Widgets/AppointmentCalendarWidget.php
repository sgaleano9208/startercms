<?php

namespace App\Filament\Widgets;

use App\Models\Appointment;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class AppointmentCalendarWidget extends FullCalendarWidget
{
    /**
     * Return events that should be rendered statically on calendar.
     */

    public function getViewData(): array
    {

        $appointments = Appointment::get();

        return
            $appointments->map(function($appointments){
            return[
                'id' => $appointments->id,
                'title' => $appointments->client->name,
                'start' => $appointments->date,
            ];
        })->toArray();
    }
    /**
     * FullCalendar will call this function whenever it needs new event data.
     * This is triggered when the user clicks prev/next or switches views on the calendar.
     */
    public function fetchEvents(array $fetchInfo): array
    {
        // You can use $fetchInfo to filter events by date.
        return [];
    }

    /**
     * Triggered when the user clicks an event.
     */
    public function onEventClick($event): void
    {
        parent::onEventClick($event);

        debug($this->event);
    }

    /**
     * Triggered when dragging stops and the event has moved to a different day/time.
     */
    public function onEventDrop($newEvent, $oldEvent, $relatedEvents): void
    {
        debug($newEvent);
        debug($oldEvent);
        debug($relatedEvents);
    }

    /**
     * Triggered when event's resize stops.
     */
    public function onEventResize($event, $oldEvent, $relatedEvents): void
    {
        // your code
    }

    protected static function getCreateEventFormSchema(): array
{
    return [
        TextInput::make('title')
            ->required(),
        DatePicker::make('start')
            ->required(),
        DatePicker::make('end')
            ->default(null),
    ];
}

    public function createEvent(array $data): void
    {
        // Create the event with the provided $data.
    }
    public function editEvent(array $data): void
    {
        // Edit the event with the provided $data.

        /**
         * here you can access to 2 properties to perform update
         * 1. $this->event_id
         * 2. $this->event
        */

        # $this->event_id
        // the value is retrieved from event's id key
        // eg: Appointment::find($this->event);

        # $this->event
        // model instance is resolved by user defined resolveEventRecord() funtion. See example below
        // eg: $this->event->update($data);

    }

    // Resolve Event record into Model property
    public function resolveEventRecord(array $data): Model
    {
        // Using Appointment class as example
        return Appointment::find($data['id']);
    }
}
