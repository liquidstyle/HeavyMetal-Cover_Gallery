<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Base
{
    
    protected $fillable = [
        'id',
        'name',
        'pagenum',
        'item_id'
    ];

    public function persons()
    {
        return $this->belongsToMany('App\Person','chapters_persons');
    }

    public function item()
    {
        return $this->belongsTo('App\Item');
    }
}
