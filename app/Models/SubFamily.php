<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SubFamily extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'family_id'];

    protected $searchableFields = ['*'];

    protected $table = 'sub_families';

    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function family()
    {
        return $this->belongsTo(Family::class);
    }
}
