<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientMonthlySale extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['client_no_nav', 'date', 'cooperative_cod'];

    protected $searchableFields = ['*'];

    protected $table = 'client_monthly_sales';

    protected $casts = [
        'date' => 'date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_no_nav', 'no_nav');
    }

    public function cooperative()
    {
        return $this->belongsTo(Cooperative::class, 'cooperative_cod', 'cod');
    }
}
