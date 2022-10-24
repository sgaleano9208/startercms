<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Client extends Model
{
    use HasFactory;
    use Searchable;
    use \Znck\Eloquent\Traits\BelongsToThrough;

    protected $fillable = [
        'name',
        'phone',
        'email',
        'vat',
        'no_nav',
        'discount',
        'observation',
        'type',
        'status',
        'country_id',
        'state_id',
        'typology_id',
        'sales_person_id',
    ];

    protected $searchableFields = ['*'];

    public function clientCooperativeHistories()
    {
        return $this->hasMany(ClientCooperativeHistory::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function typology()
    {
        return $this->belongsTo(Typology::class);
    }

    public function salesPerson()
    {
        return $this->belongsTo(SalesPerson::class);
    }

    public function commercial()
    {
        return $this->BelongsToThrough(User::class, SalesPerson::class,'','',[User::class => 'commercial_id'] );
    }

    public function contacts()
    {
        return $this->hasMany(Contact::class);
    }

    public function proposals()
    {
        return $this->hasMany(Proposal::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function clientMonthlySales()
    {
        return $this->hasMany(
            ClientMonthlySale::class,
            'client_no_nav',
            'no_nav'
        );
    }

    public function clientSalesDrops()
    {
        return $this->hasMany(ClientSalesDrop::class);
    }

    public function cooperatives()
    {
        return $this->belongsToMany(Cooperative::class);
    }
}
