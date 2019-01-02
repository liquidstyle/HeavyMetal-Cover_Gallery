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

    public function covers($type="front")
    {
        $key = $type.'cover';
        return $this->images()->where('key',$key)->get();
    }

    public function front_cover()
    {
        $covers = $this->images()->where('key','frontcover')->get();
        foreach($covers as $cover)
        {
            return $cover->path;
        }
    }

    public function mylike()
    {
        $this->morphMany('App\Like','likeable')->where('user_id',auth()->user()->id);
    }
}
