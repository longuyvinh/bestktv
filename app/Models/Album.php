<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
	protected $fillable = [
    	'name', 'slug', 'description', 'images'
    ];

    public function singers()
    {
        return $this->belongsToMany('App\Models\Singer');
    }

    public function products()
    {
        return $this->belongsToMany('App\Models\Product');
    }
}
