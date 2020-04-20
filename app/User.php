<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [
        'id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function userType()
    {
        return $this->belongsTo(UserType::class);
    }

    public function startupType()
    {
        return $this->belongsTo(StartupType::class);
    }

    public function startupProfile()
    {
        return $this->hasOne(StartupProfile::class);
    }

    public function startupCompany()
    {
        return $this->hasOne(Company::class);
    }

    public function startupServices()
    {
        return $this->hasOne(ProductService::class);
    }

    public function startupMarket()
    {
        return $this->hasOne(StartupMarket::class);
    }

    public function startupFinance()
    {
        return $this->hasOne(StartupFinance::class);
    }

    public function investorProfile()
    {
        return $this->hasOne(InvestorProfile::class);
    }

    public function investorInterest()
    {
        return $this->hasOne(InvestorInterest::class);
    }
}
