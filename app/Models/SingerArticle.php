<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SingerArticle extends Model
{
	protected $table = 'singer_article';

	protected $fillable = [
    	'id_singer', 'id_article'
    ];

    public $timestamps = false;
	
}
