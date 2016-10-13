<?php

namespace App\Http\Controllers;

use App\Division;
use App\Asset;
use App\AssetType;
use App\Http\Requests\Assets\StoreAssetRequest;
use App\Repositories\Assets\AssetRepositoryInterface;

class SparesController extends Controller
{
  public function __construct(AssetRepositoryInterface $asset)
  {
      $this->middleware('auth');
      $this->asset = $asset;
  }

  public function index()
  {
    $pageTitle = 'Spares';
    $divisions = Division::all();
    $assetTypes = AssetType::where('spare', 1)->get();
    $assets = Asset::all();

    //return $this->asset->sparesCount(11, 2);

    return view('spares.index', compact('divisions', 'assetTypes', 'assets', 'pageTitle'));
  }
}
