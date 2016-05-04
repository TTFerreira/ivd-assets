<?php

namespace App\Http\Controllers;

use App\AssetType;
use Illuminate\Http\Request;
use App\Http\Requests\AssetTypes\StoreAssetTypeRequest;
use App\Http\Requests\AssetTypes\UpdateAssetTypeRequest;

use App\Http\Requests;

class AssetTypesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'View Asset Types';
    $asset_types = AssetType::all();
    return view('asset-types.index', compact('asset_types', 'pageTitle'));
  }

  public function show(AssetType $asset_type)
  {
    return view('asset-types.show', compact('asset_type'));
  }

  public function create()
  {
    $pageTitle = 'Create New Asset Type';
    return view('asset-types.create', compact('pageTitle'));
  }

  public function store(StoreAssetTypeRequest $request)
  {
    $asset_type = new AssetType();
    $asset_type->type_name = $request->type_name;
    $asset_type->abbreviation = $request->abbreviation;

    $asset_type->save();

    return redirect('asset-types');
  }

  public function edit(AssetType $asset_type)
  {
    $pageTitle = 'Edit Asset Type - ' . $asset_type->type_name;
    return view('asset-types.edit', compact('asset_type', 'pageTitle'));
  }

  public function update(UpdateAssetTypeRequest $request, AssetType $asset_type)
  {
    $asset_type->update($request->all());

    return redirect('asset-types');
  }
}
