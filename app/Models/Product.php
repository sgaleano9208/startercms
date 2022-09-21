<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'ref',
        'photo',
        'description',
        'certificate',
        'technical_sheet',
        'family_id',
        'sub_family_id',
        'type',
        'brand_id',
    ];

    protected $searchableFields = ['*'];

    public function productVariations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }

    public function subFamily()
    {
        return $this->belongsTo(SubFamily::class);
    }

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }
}
