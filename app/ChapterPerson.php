<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChapterPerson extends Base
{
    
    protected $table = 'chapters_persons';

    protected $fillable = [
        'id',
        'chapter_id',
        'person_id',
        'item_id',
        'role',
    ];
}
