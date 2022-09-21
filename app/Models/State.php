<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class State extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'country_id'];

    protected $searchableFields = ['*'];

    public $timestamps = false;

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
