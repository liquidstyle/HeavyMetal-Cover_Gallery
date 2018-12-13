<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Taggable extends Base
{
    protected $fillable = [
        'tag_id',
        'tagable_id',
        'tagable_type'
    ];
}
