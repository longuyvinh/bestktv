<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
    	'category', 'name', 'slug', 'price_usd', 'price_vnd', 'description', 'image'
    ];

    public function resources()
    {
        return $this->hasOne('App\Models\Resource', 'pid');
    }

    public function singers()
    {
        return $this->belongsToMany('App\Models\Singer');
    }

    public function types()
    {
        return $this->belongsToMany('App\Models\Type');
    }

    public function albums()
    {
        return $this->belongsToMany('App\Models\Album', 'product_album');
    }
}
