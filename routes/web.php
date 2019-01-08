<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');

// Route::get('/', 'ItemsController@index');
// Auth::routes();

// // Public 
// Route::get('/dashboard', 'ActivitiesController@index')->name('dashboard');
// Route::get('/profile', 'ProfileController@index');

// Route::get('/items', 'ItemsController@index');
// Route::get('/items/{id}', 'ItemsController@show');

// Route::get('/persons', 'PersonsController@index');
// Route::get('/persons/{id}', 'PersonsController@show');

// Route::get('/activity', 'ActivitiesController@index');




// // Manager Routes
// Route::get('/manager/items/create', 'Manager\ItemsController@create');
// Route::resource('/manager/items', 'Manager\ItemsController');
// Route::resource('/manager/persons', 'Manager\PersonsController');
// Route::resource('/manager/users', 'Manager\UsersController');
// Route::resource('/manager', 'Manager\DashboardController');