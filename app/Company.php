<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $guarded = ['id'];

    public function industries()
    {
        return $this->hasMany(CompanyIndustry::class);
    }
}
