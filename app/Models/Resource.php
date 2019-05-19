<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Resource extends Model
{
    protected $fillable = [
    	'pid', 'type', 'path' 
    ];

    public function products()
    {
        return $this->hasOne('App\Models\Product');
    }
}
