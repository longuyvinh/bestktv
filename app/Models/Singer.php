<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Singer extends Model
{
    protected $fillable = [
        'name', 'slug', 'gender','description','image','background'
    ];

    public function albums()
    {
        return $this->belongsToMany('App\Models\Album');
    }
}
