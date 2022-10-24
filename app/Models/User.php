<?php

namespace App\Models;

use App\Models\Scopes\Searchable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasFactory;
    use Searchable;

    protected $fillable = ['name', 'email', 'password'];

    protected $searchableFields = ['*'];

    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_secret',
        'two_factor_recovery_codes',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'two_factor_confirmed_at' => 'datetime',
    ];

    public function salesPeople()
    {
        return $this->hasMany(SalesPerson::class, 'commercial_id');
    }

    public function salesPeople2()
    {
        return $this->hasMany(SalesPerson::class, 'sales_manager_id');
    }

    public function clientSalesDropDetails()
    {
        return $this->hasMany(ClientSalesDropDetail::class);
    }

    public function clients()
    {
        return $this->hasManyThrough(Client::class, SalesPerson::class);
    }

    public function isSuperAdmin()
    {
        return in_array($this->email, config('auth.super_admins'));
    }
}
