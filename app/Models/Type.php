<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
	// protected $dates = [
 //        'created_at',
 //        'updated_at'
 //    ];

    protected $fillable = ['name', 'slug', 'description'];

    // public function setCreatedAtAttribute($value)
    // {
    //     return Carbon::parse($value)->format('d/m/Y');
    // }
    /*
    public function products()
    {
        return $this->belongsToMany('App\Models\Product', 'type_article');
    }*/
}
