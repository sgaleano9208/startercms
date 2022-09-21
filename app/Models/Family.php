<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Family extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    public $timestamps = false;

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function subFamilies()
    {
        return $this->hasMany(SubFamily::class);
    }

    public function clientSalesDropDetails()
    {
        return $this->hasMany(ClientSalesDropDetail::class);
    }
}
