<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Person extends Base
{
    protected $table = 'persons';
    
    protected $fillable = [
        'id',
        'name'
    ];

    public function chapters()
    {
        return $this->belongsToMany('App\Chapter','chapters_persons');
    }

    public function items()
    {
        return $this->belongsToMany('App\Item','chapters_persons');
    }
}
