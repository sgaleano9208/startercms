<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActionPlan extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['appointment_id', 'actions', 'status'];

    protected $searchableFields = ['*'];

    protected $table = 'action_plans';

    protected $casts = [
        'actions' => 'array',
    ];

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }
}
