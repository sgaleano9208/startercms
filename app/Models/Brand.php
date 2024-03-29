<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Brand extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'image'];

    protected $searchableFields = ['*'];

    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
