<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Base
{
    
    protected $fillable = [
        'id',
        'tag',
        'title_id'
    ];

    public function title()
    {
        return $this->belongsTo('App\Title');
    }
}
