<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ClientSalesDropDetail extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'client_sales_drop_id',
        'drop_reason_id',
        'competitor_id',
        'user_id',
        'family_id',
        'status',
        'comments',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'client_sales_drop_details';

    protected $casts = [
        'comments' => 'array',
    ];

    public function clientSalesDrop()
    {
        return $this->belongsTo(ClientSalesDrop::class);
    }

    public function dropReason()
    {
        return $this->belongsTo(DropReason::class);
    }

    public function competitor()
    {
        return $this->belongsTo(Competitor::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function productVariations()
    {
        return $this->belongsToMany(ProductVariation::class);
    }
}
