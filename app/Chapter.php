<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Chapter extends Base
{
    
    protected $fillable = [
        'id',
        'name',
        'pagenum',
        'title_id'
    ];

    public function authors()
    {
        $this->hasManyThrough('App\ChapterAuthor','App\Author');
    }
}
