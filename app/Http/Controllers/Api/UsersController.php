<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\User;
use App\Http\Resources\UserResource;

class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::paginate(25);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        if(strlen(request('with')))
        {
            $withArray = explode(',',request('with'));
            foreach($withArray as $idx => $with)
            {
                if(method_exists($user,$with))
                {
                    $user->$with = $user->$with();
                }
            }
        }
        return new UserResource($user);
    }

    public function myliked(Request $request)
    {
        return $this->liked($request->user()->id);
    }

    public function myfavorited(Request $request)
    {
        return $this->favorited($request->user()->id);
    }

    public function mywishlisted(Request $request)
    {
        return $this->wishlisted($request->user()->id);
    }

    public function liked($user_id)
    {
        $user       = User::find($user_id);
        $liked      = $user->liked();

        // resort with object ID as key
        $return = [];
        foreach($liked as $idx => $like)
        {
            // $model = strtolower(str_replace('App\\','',get_class($like)));
            $return[$like->id] = $like;
        }
        return $return;
    }

    public function favorited($user_id)
    {
        $user = User::find($user_id);
        $favorited = $user->favorited();

        // resort with object ID as key
        $return = [];
        foreach($favorited as $idx => $favorite)
        {
            // $model = strtolower(str_replace('App\\','',get_class($favorite)));
            $return[$favorite->id] = $favorite;
        }
        return $return;
    }

    public function wishlisted($user_id)
    {
        $user = User::find($user_id);
        $wishlisted = $user->wishlisted();
        
        // resort with object ID as key
        $return = [];
        foreach($wishlisted as $idx => $wishlist)
        {
            // $model = strtolower(str_replace('App\\','',get_class($wishlist)));
            $return[$wishlist->id] = $wishlist;
        }
        return $return;
    }
}
