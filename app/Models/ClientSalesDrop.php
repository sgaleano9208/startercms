<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientSalesDrop extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['client_id', '_reported'];

    protected $searchableFields = ['*'];

    protected $table = 'client_sales_drops';

    protected $casts = [
        '_reported' => 'boolean',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function clientSalesDropDetails()
    {
        return $this->hasMany(ClientSalesDropDetail::class);
    }
}
