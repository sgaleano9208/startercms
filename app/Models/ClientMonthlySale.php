<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientMonthlySale extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['client_id', 'cooperative_id', 'date', 'sales'];

    protected $searchableFields = ['*'];

    protected $table = 'client_monthly_sales';

    protected $casts = [
        'date' => 'date',
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
