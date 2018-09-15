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
        return $this->hasMany('App\ChapterAuthor');
        return $this->hasManyThrough('App\Chapter','App\ChapterAuthor','author_id','id','chapter_id');
    }
}
