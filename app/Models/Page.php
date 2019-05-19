<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    const STATUS_ACTIVE = 'ACTIVE';
    const STATUS_INACTIVE = 'INACTIVE';

    public static $statuses = [self::STATUS_ACTIVE, self::STATUS_INACTIVE];

    protected $fillable = array('author_id', 'title', 'slug','body');
}
