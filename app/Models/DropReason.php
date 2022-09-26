<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class DropReason extends Model
{
    use HasFactory;
    use Searchable;

    protected $fillable = ['name'];

    protected $searchableFields = ['*'];

    protected $table = 'drop_reasons';

    public $timestamps = false;

    public function clientSalesDropDetails()
    {
        return $this->hasMany(ClientSalesDropDetail::class);
    }
}
