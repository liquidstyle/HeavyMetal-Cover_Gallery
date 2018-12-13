<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Base
{
    
    protected $fillable = [
        'id',
        'tag',
        'item_id'
    ];

    public function taggable()
    {
        return $this->morphTo();
    }

    public function items()
    {
        return $this->morphedByMany('App\Item', 'taggable');
    }

    public function chapters()
    {
        return $this->morphedByMany('App\Chapter', 'taggable');
    }

    public function persons()
    {
        return $this->morphedByMany('App\Person', 'taggable');
    }

}
