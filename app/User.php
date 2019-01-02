<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable, HasApiTokens;

    public $incrementing = false;

    public $keyType = 'string';
    
    /**
     * Boot the Model.
     */
    public static function boot()
    {
        parent::boot();

        static::creating(function ($instance) {
            $instance->id = Str::upper(Str::uuid());
        });
    }
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function liked()
    {
        return Item::whereLikedBy($this->id) // find only items where user liked them
            ->with('likeCounter') // highly suggested to allow eager load
            ->get();
    }

    public function favorited()
    {
        return Item::whereFavoritedBy($this->id) // find only items where user favorited them
            ->with('favoriteCounter') // highly suggested to allow eager load
            ->get();
    }

    public function wishlisted()
    {
        return Item::whereWishlistedBy($this->id) // find only items where user wishlisted them
            ->with('wishlistCounter') // highly suggested to allow eager load
            ->get();
    }
}
