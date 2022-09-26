<?php

namespace App\Models;


use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Proposal extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'number',
        'client_id',
        'date',
        'end_date',
        'type_of_payment_id',
        'status',
        'observation',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'date' => 'date',
        'end_date' => 'date',
    ];

    public function typeOfPayment()
    {
        return $this->belongsTo(TypeOfPayment::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function proposalItems()
    {
        return $this->hasMany(ProposalItem::class);
    }
}
