<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class SalesPerson extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = [
        'name',
        'photo',
        'email',
        'phone',
        'cod',
        'commercial_id',
        'sales_manager_id',
    ];

    protected $searchableFields = ['*'];

    protected $table = 'sales_people';

    public $timestamps = false;

    public function clients()
    {
        return $this->hasMany(Client::class);
    }

    public function commercial()
    {
        return $this->belongsTo(User::class, 'commercial_id');
    }

    public function salesManager()
    {
        return $this->belongsTo(User::class, 'sales_manager_id');
    }
}
