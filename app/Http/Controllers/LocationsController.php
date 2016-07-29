<?php

namespace App\Http\Controllers;

use App\Location;
use App\Http\Requests\Locations\StoreLocationRequest;
use App\Http\Requests\Locations\UpdateLocationRequest;
use Illuminate\Http\Request;
use App\Repositories\Locations\LocationRepositoryInterface;

use App\Http\Requests;

class LocationsController extends Controller
{
  public function __construct(LocationRepositoryInterface $location)
  {
      $this->middleware('auth');
      $this->location = $location;
  }

  public function index()
  {
    $pageTitle = 'View Locations';
    $locations = $this->location->getAll();
    return view('locations.index', compact('locations', 'pageTitle'));
  }

  public function store(StoreLocationRequest $request)
  {
    $this->location->store($request);

    $this->location->flashSuccessCreate($this->location->getLatest()->location_name);

    if (env('SLACK_ENABLED')) {
      $this->location->slackCreate();
    }

    return redirect()->route('locations.index');
  }

  public function edit(Location $location)
  {
    $pageTitle = 'Edit Location - ' . $location->location_name;
    return view('locations.edit', compact('location', 'pageTitle'));
  }

  public function update(UpdateLocationRequest $request, Location $location)
  {
    $this->location->update($request, $location);

    $this->location->flashSuccessUpdate($this->location->find($location->id)->location_name);

    if (env('SLACK_ENABLED')) {
      $this->location->slackUpdate($location->id);
    }

    return redirect()->route('locations.index');
  }
}
