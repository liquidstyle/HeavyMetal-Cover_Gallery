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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::get('/', 'TitlesController@index');
Auth::routes();

// Public 
Route::get('/dashboard', 'ActivitiesController@index')->name('dashboard');
Route::get('/profile', 'ProfileController@index');
Route::get('/titles', 'TitlesController@index');
Route::get('/authors', 'AuthorsController@index');
Route::get('/activity', 'ActivitiesController@index');

// Manager Routes
Route::get('/manager/titles/create', 'Manager\TitlesController@create');
Route::resource('/manager/titles', 'Manager\TitlesController');
Route::resource('/manager/authors', 'Manager\AuthorsController');
Route::resource('/manager/users', 'Manager\UsersController');
Route::resource('/manager/ingest', 'Manager\IngestController');
Route::resource('/manager', 'Manager\DashboardController');