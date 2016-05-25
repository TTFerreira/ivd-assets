<?php

namespace App\Http\Controllers;

use App\Location;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\Storerooms\UpdateStoreroomRequest;
use App\Http\Requests;

class StoreroomsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Default Storeroom';
    $locations = Location::all();
    $storeroom = Location::where('storeroom', 1)->first();
    return view('admin.storeroom.index', compact('pageTitle', 'locations', 'storeroom'));
  }

  public function update(UpdateStoreroomRequest $request)
  {
    $oldStoreroom = Location::where('storeroom', 1)->first();
    if(isset($oldStoreroom))
    {
      $oldStoreroom->storeroom = 0;
      $oldStoreroom->update();
    }

    $location = Location::where('id', $request->store)->first();
    $location->storeroom = 1;
    $location->update();

    Session::flash('status', 'success');
    Session::flash('title', 'New Default Storeroom Saved');
    Session::flash('message', $location->location_name);

    return redirect('/admin/storeroom');
  }
}
