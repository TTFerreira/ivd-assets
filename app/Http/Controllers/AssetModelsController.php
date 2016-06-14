<?php

namespace App\Http\Controllers;

use App\AssetModel;
use App\Manufacturer;
use App\AssetType;
use App\Pcspec;
use Illuminate\Http\Request;
use App\Http\Requests\AssetModels\StoreAssetModelRequest;
use App\Http\Requests\AssetModels\UpdateAssetModelRequest;

use App\Http\Requests;

class AssetModelsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'View Models';
    $asset_models = AssetModel::all();
    $manufacturers = Manufacturer::all();
    $asset_types = AssetType::all();
    $pcspecs = Pcspec::all();
    return view('models.index', compact('asset_models', 'pageTitle', 'manufacturers', 'asset_types', 'pcspecs'));
  }

  public function store(StoreAssetModelRequest $request)
  {
    $asset_model = new AssetModel();
    $asset_model->manufacturer_id = $request->manufacturer_id;
    $asset_model->asset_type_id = $request->asset_type_id;
    $asset_model->pcspec_id = $request->pcspec_id;
    $asset_model->asset_model = $request->asset_model;
    $asset_model->part_number = $request->part_number;

    $asset_model->save();

    return redirect('models');
  }

  public function edit(AssetModel $asset_model)
  {
    $pageTitle = 'Edit Model - ' . $asset_model->manufacturer->name .  ' ' . $asset_model->asset_model;
    $manufacturers = Manufacturer::all();
    $asset_types = AssetType::all();
    $pcspecs = Pcspec::all();
    return view('models.edit', compact('asset_model', 'manufacturers', 'asset_types', 'pcspecs', 'pageTitle'));
  }

  public function update(UpdateAssetModelRequest $request, AssetModel $asset_model)
  {
    $asset_model->update($request->all());

    return redirect('models');
  }
}
