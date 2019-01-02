<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Base
{
    protected $fillable = [
        'id',
        'path',
        'key',
        'name'
    ];

    public function imageable()
    {
        return $this->morphTo();
    }
}
