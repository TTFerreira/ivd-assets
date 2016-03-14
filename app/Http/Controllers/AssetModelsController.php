<?php

namespace App\Http\Controllers;

use App\AssetModel;
use App\Manufacturer;
use App\AssetType;
use App\Pcspec;
use Illuminate\Http\Request;

use App\Http\Requests;

class AssetModelsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $asset_models = AssetModel::paginate(10);;
    return view('models.index', compact('asset_models'));
  }

  public function show(AssetModel $asset_model)
  {
    //$location->load('notes.user');
    return view('models.show', compact('asset_model'));
  }

  public function create()
  {
    $manufacturers = Manufacturer::all();
    $asset_types = AssetType::all();
    $pcspecs = Pcspec::all();
    return view('models.create', compact('manufacturers', 'asset_types', 'pcspecs'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'manufacturer_id' => 'required',
      'asset_type_id' => 'required',
      'asset_model' => 'required'
    ]);

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
    $manufacturers = Manufacturer::all();
    $asset_types = AssetType::all();
    $pcspecs = Pcspec::all();
    return view('models.edit', compact('asset_model', 'manufacturers', 'asset_types', 'pcspecs'));
  }

  public function update(Request $request, AssetModel $asset_model)
  {
    $this->validate($request, [
      'manufacturer_id' => 'required',
      'asset_type_id' => 'required',
      'asset_model' => 'required'
    ]);

    $asset_model->update($request->all());

    return redirect('models');
  }
}
