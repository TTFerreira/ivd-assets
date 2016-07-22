<?php

namespace App\Http\Controllers;

use App\Location;
use Session;
use App\Http\Requests\Locations\StoreLocationRequest;
use App\Http\Requests\Locations\UpdateLocationRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class LocationsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'View Locations';
    $locations = Location::all();
    return view('locations.index', compact('locations', 'pageTitle'));
  }

  public function store(StoreLocationRequest $request)
  {
    Location::create($request->all());
    $location = Location::get()->last();

    Session::flash('status', 'success');
    Session::flash('title', $location->location_name);
    Session::flash('message', 'Successfully created');

    return redirect('locations');
  }

  public function edit(Location $location)
  {
    $pageTitle = 'Edit Location - ' . $location->location_name;
    return view('locations.edit', compact('location', 'pageTitle'));
  }

  public function update(UpdateLocationRequest $request, Location $location)
  {
    $location->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', $location->location_name);
    Session::flash('message', 'Successfully updated');

    return redirect('locations');
  }
}
