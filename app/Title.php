<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Title extends Base
{
    protected $fillable = [
        'id',
        'name',
        'month',
        'year',
        'yearmonth',
        'cover_variant',
        'special_issue',
        'front_cover_path',
        'front_cover_name',
        'front_cover_author',
        'back_cover_path',
        'back_cover_name',
        'back_cover_author',
        'description',
        'signed_by',
        'active',
        'status'
    ];

    public function chapters()
    {
        return $this->hasMany('App\Chapter');
    }

    public function tags()
    {
        return $this->hasMany('App\Tag');
    }
}
