<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChapterAuthor extends Base
{
    
    protected $table = 'chapters_authors';

    protected $fillable = [
        'id',
        'chapter_id',
        'author_id',
        'title_id',
    ];
}
