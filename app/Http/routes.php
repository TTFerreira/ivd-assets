<?php
// Route::group(['prefix' => 'api/v1', 'middleware' => 'auth:api'], function() {
//   Route::get('test', function() {
//     return response()->json(['foo' => 'bar']);
//   });
//   Route::get('user', function() {
//     $users = App\User::all();
//     return $users->toJson();
//   });
// });

Route::group(['middleware' => ['web']], function () {
  Route::auth();

  Route::get('/', 'HomeController@index');
  Route::get('home', 'HomeController@index');
  Route::get('dashboard', 'HomeController@index');

  Route::group(['middleware' => ['auth', 'role:super-admin']], function () {
    // Users
    Route::resource('/admin/users', 'UsersController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => 'singular'
    ]);
    
    // Locations
    Route::resource('/locations', 'LocationsController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => 'singular'
    ]);

    // Asset Types
    Route::resource('/asset-types', 'AssetTypesController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => 'singular'
    ]);

    // Divisions
    Route::resource('/divisions', 'DivisionsController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => 'singular'
    ]);

    // Manufacturers
    Route::resource('/manufacturers', 'ManufacturersController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => 'singular'
    ]);

    // PCSpecs
    Route::resource('/pcspecs', 'PcspecsController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => 'singular'
    ]);

    // Suppliers
    Route::resource('/suppliers', 'SuppliersController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => 'singular'
    ]);

    // Models
    Route::resource('/models', 'AssetModelsController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => ['models' => 'asset_model']
    ]);

    // Invoices
    Route::resource('/invoices', 'InvoicesController', [
      'only' => ['index', 'edit', 'update', 'store', 'show'],
      'parameters' => 'singular'
    ]);

    // Budgets
    Route::resource('/budgets', 'BudgetsController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => 'singular'
    ]);

    Route::get('admin', 'PagesController@getTicketConfig');

    // Assets Statuses
    Route::resource('/admin/assets-statuses', 'StatusesController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => ['assets-statuses' => 'status']
    ]);

    // Ticket Statuses
    Route::resource('/admin/ticket-statuses', 'TicketsStatusesController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => ['ticket-statuses' => 'ticketsStatus']
    ]);

    // Ticket Priorities
    Route::resource('/admin/ticket-priorities', 'TicketsPrioritiesController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => ['ticket-priorities' => 'ticketsPriority']
    ]);

    // Ticket Types
    Route::resource('/admin/ticket-types', 'TicketsTypesController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => ['ticket-types' => 'ticketsType']
    ]);

    // Ticket Canned Fields
    Route::resource('/admin/ticket-canned-fields', 'TicketsCannedFieldsController', [
      'only' => ['index', 'edit', 'update', 'store'],
      'parameters' => ['ticket-canned-fields' => 'ticketsCannedField']
    ]);

    // Storeroom
    Route::resource('/admin/storeroom', 'StoreroomsController', [
      'only' => ['index', 'update'],
      'parameters' => 'singular'
    ]);
  });

  Route::group(['middleware' => ['auth', 'role:super-admin|admin']], function () {
    // Assets
    Route::resource('/assets', 'AssetsController', [
      'only' => ['index', 'edit', 'update', 'store', 'create'],
      'parameters' => 'singular'
    ]);

    // Assets Movements and History
    Route::get('assets/{asset}/history', 'MovementsController@show');
    Route::get('assets/{asset}/move', 'MovementsController@create');
    Route::post('assets/{asset}/store', 'MovementsController@store');
  });

  // Canned Ticket Entries
  Route::post('canned', 'TicketsCannedFieldsController@canned');

  // Tickets
  Route::resource('/tickets', 'TicketsController', [
    'only' => ['index', 'edit', 'update', 'store', 'create', 'show'],
    'parameters' => 'singular'
  ]);

  // Ticket Notes
  Route::post('tickets/{ticket}', 'TicketsEntriesController@store');
});
