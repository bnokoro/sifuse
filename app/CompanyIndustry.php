<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CompanyIndustry extends Model
{
    protected $guarded = ['id'];

    public function industry()
    {
        return $this->belongsTo(Industry::class);
    }
}
