<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    public $timestamps = false;

    public function states()
    {
        return $this->hasMany(State::class);
    }

    public function clients()
    {
        return $this->hasMany(Client::class);
    }
}
