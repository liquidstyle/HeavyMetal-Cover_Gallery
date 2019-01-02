<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::resource('/static', 'Api\StaticController');

Route::resource('/ingest', 'Api\IngestController');

// Passport
Route::group([
    'prefix' => 'auth'
], function () {
    Route::post('login', 'Api\AuthController@login');
    Route::post('signup', 'Api\AuthController@signup');
  
    Route::group([
      'middleware' => 'auth:api'
    ], function() {
        Route::get('logout', 'Api\AuthController@logout');
        
    });
});

// Private Endpoints
Route::group([
    'middleware' => 'auth:api'
  ], function() {
    Route::get('me', 'Api\AuthController@user'); // Get Active User

    Route::get('me/liked', 'Api\UsersController@myliked'); // Get My Likes
    Route::get('me/favorited', 'Api\UsersController@myfavorited'); // Get My Favorites
    Route::get('me/wishlisted', 'Api\UsersController@mywishlisted'); // Get My Wishlist Objects

    Route::get('users', 'Api\UsersController@index'); // Get All Users

    Route::get('users/{id}', 'Api\UsersController@show'); // Get Specific User
    
    Route::get('users/{id}/liked', 'Api\UsersController@myliked'); // Get Specific Users Liked Objects
    Route::get('users/{id}/favorited', 'Api\UsersController@myfavorited'); // Get Specific Users Favorited Objects
    Route::get('users/{id}/wishlisted', 'Api\UsersController@mywishlisted'); // Get Specific Users Wishlisted Objects

    // Likes
    Route::get('/items/{id}/like','Api\ItemsController@liked');
    Route::post('/items/{id}/like','Api\ItemsController@like');
    Route::delete('/items/{id}/like','Api\ItemsController@unlike');

    // Favorites
    Route::get('/items/{id}/favorite','Api\ItemsController@favorited');
    Route::post('/items/{id}/favorite','Api\ItemsController@favorite');
    Route::delete('/items/{id}/favorite','Api\ItemsController@unfavorite');

    // Wishlists
    Route::get('/items/{id}/wishlist','Api\ItemsController@wishlisted');
    Route::post('/items/{id}/wishlist','Api\ItemsController@wishlist');
    Route::delete('/items/{id}/wishlist','Api\ItemsController@unwishlist');

  });


// Public Endpoints
Route::group(
    [
        'middleware' => 'api'
    ], function () {
        Route::resource('/items', 'Api\ItemsController');
        Route::get('/items/{id}/likes','Api\ItemsController@likes');
        Route::get('/items/{id}/favorites','Api\ItemsController@favorites');
        Route::get('/items/{id}/wishlists','Api\ItemsController@wishlists');
        
        Route::resource('/persons', 'Api\PersonsController');
    }
);
