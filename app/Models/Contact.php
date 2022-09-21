<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'area',
        'client_id',
        'is_main',
    ];

    protected $searchableFields = ['*'];

    protected $casts = [
        'is_main' => 'boolean',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
