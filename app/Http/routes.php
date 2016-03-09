<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
  Route::auth();

  Route::get('/', 'HomeController@index');
  Route::get('home', 'HomeController@index');
  Route::get('dashboard', 'HomeController@index');

  Route::get('locations', 'LocationsController@index');
  Route::get('locations/create', 'LocationsController@create');
  Route::get('locations/{location}', 'LocationsController@show');
  Route::get('locations/{location}/edit', 'LocationsController@edit');
  Route::patch('locations/{location}/update', 'LocationsController@update');
  Route::post('locations', 'LocationsController@store');


  Route::get('cards', 'CardsController@index');
  Route::get('cards/{card}', 'CardsController@show');

  Route::post('cards/{card}/notes', 'NotesController@store');

  Route::get('notes/{note}/edit', 'NotesController@edit');
  Route::patch('notes/{note}', 'NotesController@update');
});
