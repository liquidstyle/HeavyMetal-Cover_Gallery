<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Base extends Model
{
    public $incrementing = false;
    
    public $keyType = 'string';
    
    public static function boot()
    {
        parent::boot();

        static::creating(function ($instance) {
            $instance->id = Str::upper(Str::uuid());
        });
    }

    public function tag($tag)
    {
        return $this->tags()->attach($tag);
    }

    public function tags()
    {
        return $this->morphToMany('App\Tag', 'taggable');
    }
}
