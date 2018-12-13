<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Base
{
    
    protected $fillable = [
        'id',
        'name'
    ];

    public function chapters()
    {
        return $this->belongsToMany('App\Chapter','chapters_persons');
    }
}
