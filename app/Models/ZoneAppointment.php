<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ZoneAppointment extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'sales_person_id',
        'start_date',
        'end_date',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'zone_appointments';

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function salesPerson()
    {
        return $this->belongsTo(SalesPerson::class);
    }

    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    
}
