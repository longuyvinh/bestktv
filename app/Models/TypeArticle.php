<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TypeArticle extends Model
{
	protected $table = "type_article";

    protected $fillable = [
    	'id_type', 'id_article'
    ];

    public $timestamps = false;
}
