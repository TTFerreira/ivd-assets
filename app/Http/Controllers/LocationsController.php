<?php

namespace App\Http\Controllers;

use App\Location;
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
    //$location->load('notes.user');
    return view('locations.show', compact('location'));
  }

  public function create()
  {
    $pageTitle = 'Create Location';
    return view('locations.create', compact('pageTitle'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'building' => 'required',
      'office' => 'required',
      'location_name' => 'required|unique:locations,location_name'
    ]);

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

  public function update(Request $request, Location $location)
  {
    $this->validate($request, [
      'building' => 'required',
      'office' => 'required',
      'location_name' => 'required|unique:locations,location_name,'.$location->id
    ]);

    $location->update($request->all());

    return redirect('locations');
  }
}
