<?php

namespace App\Filament\Resources\ActionPlanResource\Pages;

use Filament\Resources\Pages\CreateRecord;
use App\Filament\Resources\ActionPlanResource;
use App\Models\Appointment;

class CreateActionPlan extends CreateRecord
{
    public $appointment_id;

    public function mount(): void
    {
        $this->appointment_id = session()->get('appointmentId');
        debug($this->appointment_id);
        //  session()->forget('appointmentId');
    }

    protected static string $resource = ActionPlanResource::class;
}
