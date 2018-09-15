<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Base
{
    
    protected $fillable = [
        'id',
        'name'
    ];

    public function chapters()
    {
        $this->hasManyThrough('App\ChapterAuthor','App\Chapter');
    }
}
