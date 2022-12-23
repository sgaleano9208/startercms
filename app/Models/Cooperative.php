<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cooperative extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'rapel', 'cod'];

    protected $searchableFields = ['*'];

    public function clientCooperativeHistories()
    {
        return $this->hasMany(ClientCooperativeHistory::class);
    }

    public function clients()
    {
        return $this->belongsToMany(Client::class);
    }
}
