<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Appointment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'zone_appointment_id',
        'client_id',
        'date',
        'time',
        'goals',
        'note',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
        'goals' => 'array'
    ];

    public function zoneAppointment()
    {
        return $this->belongsTo(ZoneAppointment::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function actionPlans()
    {
        return $this->morphMany(ActionPlan::class, 'action_planable');
    }
}
