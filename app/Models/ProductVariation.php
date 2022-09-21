<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductVariation extends Model
{
    use HasFactory;
    use Searchable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'price',
        'units',
        'min_qty',
        'incomplete_price',
        'product_id',
        'color_id',
        'to_order',
        'size_id',
        'status',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'product_variations';

    protected $casts = [
        'to_order' => 'boolean',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }

    public function proposalItems()
    {
        return $this->hasMany(ProposalItem::class);
    }

    public function promotionItems()
    {
        return $this->hasMany(PromotionItem::class);
    }

    public function clientSalesDropDetails()
    {
        return $this->belongsToMany(ClientSalesDropDetail::class);
    }
}
