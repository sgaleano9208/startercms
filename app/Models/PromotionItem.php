<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class PromotionItem extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'promotion_id',
        'product_variation_id',
        'name',
        'promo_price',
        'discount',
        'price',
        'current_sales',
        'past_sales',
        'is_selected',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'promotion_items';

    protected $casts = [
        'is_selected' => 'boolean',
    ];

    public function productVariation()
    {
        return $this->belongsTo(ProductVariation::class);
    }

    public function promotion()
    {
        return $this->belongsTo(Promotion::class);
    }
}
