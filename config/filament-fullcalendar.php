<?php

/**
 * Consider this file the root configuration object for FullCalendar.
 * Any configuration added here, will be added to the calendar.
 * @see https://fullcalendar.io/docs#toc
 */

return [
    'timeZone' => config('app.timezone'),

    'locale' => config('app.locale'),

    'headerToolbar' => [
        'left' => '',
        'center' => 'title',
        'right' => 'prev,next today',
        // 'right' => 'dayGridMonth,dayGridWeek,dayGridDay',
    ],

    'navLinks' => false,

    'editable' => true,

    'selectable' => false,

    'dayMaxEvents' => true,

    'weekends' => false,
];
