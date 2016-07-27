<?php

namespace App\Http\Controllers;

use App\Movement;
use App\Asset;
use App\Location;
use App\Status;
use App\Http\Requests\Movements\StoreMovementRequest;
use Illuminate\Http\Request;
use Auth;

use App\Http\Requests;

class MovementsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function show(Asset $asset)
  {
    $pageTitle = 'Movement History - ' . $asset->asset_tag;
    $movements = Movement::all();
    $locations = Location::all();
    $statuses = Status::all();
    return view('movements.history', compact('asset', 'movements', 'locations', 'statuses', 'pageTitle'));
  }

  public function create(Asset $asset)
  {
    $pageTitle = 'Move Asset - ' . $asset->asset_tag;
    $assets = Asset::all();
    $locations = Location::all();
    $statuses = Status::all();
    return view('movements.move', compact('asset', 'assets', 'locations', 'statuses', 'pageTitle'));
  }

  public function store(StoreMovementRequest $request, Asset $asset)
  {
    $user = Auth::user()->id;

    $movement = new Movement();
    $movement->asset_id = $asset->id;
    $movement->location_id = $request->location_id;
    $movement->status_id = $request->status_id;
    $movement->user_id = $user;

    $movement->save();

    $asset->movement_id = $movement->id;
    $asset->update();

    return redirect()->route('assets.index');
  }
}
