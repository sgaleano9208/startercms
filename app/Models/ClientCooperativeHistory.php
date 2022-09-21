<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientCooperativeHistory extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'client_id',
        'cooperative_id',
        'start_date',
        'end_date',
        'observation',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'client_cooperative_histories';

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class);
    }
}
