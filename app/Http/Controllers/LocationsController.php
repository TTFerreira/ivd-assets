<?php

namespace App\Http\Controllers;

use App\Location;
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

  public function show(Location $location)
  {
    return view('locations.show', compact('location'));
  }

  public function store(StoreLocationRequest $request)
  {
    $location = new Location();
    $location->building = $request->building;
    $location->office = $request->office;
    $location->location_name = $request->location_name;

    $location->save();

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

    return redirect('locations');
  }
}
