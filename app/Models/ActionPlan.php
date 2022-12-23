<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ActionPlan extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'client_id',
        'title',
        'date',
        'note',
        'offer',
        'action_planable_id',
        'action_planable_type',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'action_plans';

    protected $casts = [
        'date' => 'date',
        'offer' => 'array',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function action_planable()
    {
        return $this->morphTo();
    }
}
