<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Item;
use App\Http\Resources\ItemResource;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page = (request('page') > 0 ? request('page') - 1 : 0);
        $perpage = (request('perpage') > 0 ? request('perpage') : 25);
        
        if(strlen(request('with')))
        {
            $with = explode(',',request('with'));
            // $items = Item::with($with)->forPage($page,$perpage)->get();
            $items = Item::with($with)->paginate($perpage);
        } else {
            $items = Item::paginate($perpage);
        }

        return new ItemResource($items);
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(strlen(request('with')))
        {
            $with = explode(',',request('with'));
            $item = Item::with($with)->find($id);
        } else {
            $item = Item::with('images')->find($id);
        }
        return new ItemResource($item);
    }

    /**
     * Like Counts
     */
    public function likes($id)
    {
        $item = Item::find($id);
        $item->likeCount;
        return new ItemResource($item);
    }

    /**
     * Current user has Liked
     */
    public function liked($id)
    {
        $item = Item::find($id);
        return [
            'data' => [
                'liked' => $item->liked()
            ]
        ];
    }

    /**
     * Like an Item
     */
    public function like($id)
    {
        $item = Item::find($id);
        $item->like();
        $item->likeCount;
        return new ItemResource($item);
    }
    
    /**
     * Unlike an Item
     */
    public function unlike($id)
    {
        $item = Item::find($id);
        $item->unlike();
        $item->likeCount;
        return new ItemResource($item);
    }

    /**
     * Favorite Counts
     */
    public function favorites($id)
    {
        $item = Item::find($id);
        $item->favoriteCount;
        return new ItemResource($item);
    }

    /**
     * Current user has Favorited
     */
    public function favorited($id)
    {
        $item = Item::find($id);
        return [
            'data' => [
                'favorited' => $item->favorited()
            ]
        ];
    }

    /**
     * Favorite an Item
     */
    public function favorite($id)
    {
        $item = Item::find($id);
        $item->favorite();
        $item->favoriteCount;
        return new ItemResource($item);
    }
    
    /**
     * Unfavorite an Item
     */
    public function unfavorite($id)
    {
        $item = Item::find($id);
        $item->unfavorite();
        $item->favoriteCount;
        return new ItemResource($item);
    }

    /**
     * Current user has Wishlisted
     */
    public function wishlisted($id)
    {
        $item = Item::find($id);
        return [
            'data' => [
                'wishlisted' => $item->wishlisted()
            ]
        ];
    }

    /**
     * Wishlist Counts
     */
    public function wishlists($id)
    {
        $item = Item::find($id);
        $item->wishlistCount;
        return new ItemResource($item);
    }

    /**
     * Wishlist an Item
     */
    public function wishlist($id)
    {
        $item = Item::find($id);
        $item->wishlist();
        $item->wishlistCount;
        return new ItemResource($item);
    }
    
    /**
     * Unwishlist an Item
     */
    public function unwishlist($id)
    {
        $item = Item::find($id);
        $item->unwishlist();
        $item->wishlistCount;
        return new ItemResource($item);
    }
}
