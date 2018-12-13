<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class Item extends Base
{
    public $incrementing = false;

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
        'front_cover_person',
        'back_cover_path',
        'back_cover_name',
        'back_cover_person',
        'description',
        'signed_by',
        'active',
        'status'
    ];

    public function chapters()
    {
        return $this->hasMany('App\Chapter');
    }

    public function persons()
    {
        return $this->belongsToMany('App\Person','chapters_persons');
    }
}
