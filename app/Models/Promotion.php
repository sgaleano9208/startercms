<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Promotion extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'client_id',
        'start_date',
        'end_date',
        'first_order_date',
        'observation',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date',
        'first_order_date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function promotionItems()
    {
        return $this->hasMany(PromotionItem::class);
    }
}
