<?php

namespace App\Http\Controllers;

use App\Division;
use App\Asset;
use App\AssetType;

class SparesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Spares';
    $divisions = Division::all();
    $assetTypes = AssetType::where('spare', 1)->get();
    $assets = Asset::all();

    return view('spares.index', compact('divisions', 'assetTypes', 'assets', 'pageTitle'));
  }
}
