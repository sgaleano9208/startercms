<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProposalItem extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'proposal_id',
        'product_variation_id',
        'name',
        'price',
        'discount',
        'discount2',
        'quantity',
        'net_price',
        'total',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'proposal_items';

    public function proposal()
    {
        return $this->belongsTo(Proposal::class);
    }

    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class);
    }
}
