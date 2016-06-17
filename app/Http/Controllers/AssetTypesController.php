<?php

namespace App\Http\Controllers;

use App\AssetType;
use Session;
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

  public function store(StoreAssetTypeRequest $request)
  {
    $asset_type = new AssetType();
    $asset_type->type_name = $request->type_name;
    $asset_type->abbreviation = $request->abbreviation;

    $asset_type->save();

    Session::flash('status', 'success');
    Session::flash('title', $asset_type->type_name);
    Session::flash('message', 'Successfully created');

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

    Session::flash('status', 'success');
    Session::flash('title', $asset_type->type_name);
    Session::flash('message', 'Successfully updated');

    return redirect('asset-types');
  }
}
