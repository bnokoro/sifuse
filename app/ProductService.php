<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductService extends Model
{
    protected $guarded = ['id'];

    public function teams()
    {
        return $this->hasMany(ProductServiceTeam::class);
    }
}
