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
  Route::get('locations/{location}/edit', 'LocationsController@edit');
  Route::patch('locations/{location}/update', 'LocationsController@update');
  Route::post('locations', 'LocationsController@store');

  Route::get('asset-types', 'AssetTypesController@index');
  Route::get('asset-types/create', 'AssetTypesController@create');
  Route::get('asset-types/{asset_type}/edit', 'AssetTypesController@edit');
  Route::patch('asset-types/{asset_type}/update', 'AssetTypesController@update');
  Route::post('asset-types', 'AssetTypesController@store');

  Route::get('divisions', 'DivisionsController@index');
  Route::get('divisions/create', 'DivisionsController@create');
  Route::get('divisions/{division}/edit', 'DivisionsController@edit');
  Route::patch('divisions/{division}/update', 'DivisionsController@update');
  Route::post('divisions', 'DivisionsController@store');

  Route::get('manufacturers', 'ManufacturersController@index');
  Route::get('manufacturers/create', 'ManufacturersController@create');
  Route::get('manufacturers/{manufacturer}/edit', 'ManufacturersController@edit');
  Route::patch('manufacturers/{manufacturer}/update', 'ManufacturersController@update');
  Route::post('manufacturers', 'ManufacturersController@store');

  Route::get('pcspecs', 'PcspecsController@index');
  Route::get('pcspecs/create', 'PcspecsController@create');
  Route::get('pcspecs/{pcspec}/edit', 'PcspecsController@edit');
  Route::patch('pcspecs/{pcspec}/update', 'PcspecsController@update');
  Route::post('pcspecs', 'PcspecsController@store');

  Route::get('cards', 'CardsController@index');
  Route::get('cards/{card}', 'CardsController@show');

  Route::post('cards/{card}/notes', 'NotesController@store');

  Route::get('notes/{note}/edit', 'NotesController@edit');
  Route::patch('notes/{note}', 'NotesController@update');
});
