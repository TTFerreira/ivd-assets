<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetModel;
use App\Division;
use App\Supplier;
use App\Movement;
use App\Manufacturer;
use App\Location;
use App\Status;
use App\WarrantyType;
use Illuminate\Http\Request;

use App\Http\Requests;

class AssetsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $assets = Asset::orderBy('created_at', 'desc')->paginate(10);
    return view('assets.index', compact('assets'));
  }

  public function show(Asset $asset)
  {
    //$location->load('notes.user');
    return view('assets.show', compact('asset'));
  }

  public function create()
  {
    $asset_models = AssetModel::all();
    $divisions = Division::all();
    $suppliers = Supplier::all();
    $movements = Movement::all();
    $manufacturers = Manufacturer::all();
    $warranty_types = WarrantyType::all();
    return view('assets.create', compact('asset_models', 'divisions', 'suppliers', 'movements', 'manufacturers', 'warranty_types'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'asset_model_id' => 'required',
      'division_id' => 'required',
      'supplier_id' => 'required'
    ]);
    $count = \DB::table('assets')->count() + 1;
    $asset = new Asset();
    $asset->serial_number = $request->serial_number;
    $asset->model_id = $request->asset_model_id;
    $tag = $asset->model->asset_type->abbreviation;
    $tag = $tag . sprintf('%05d', $count);;
    $asset->asset_tag = $tag;
    $asset->division_id = $request->division_id;
    $asset->supplier_id = $request->supplier_id;
    $asset->purchase_date = $request->purchase_date;
    $asset->warranty_months = $request->warranty_months;
    $asset->warranty_type = $request->warranty_type_id;

    $asset->save();

    $movement = new Movement();
    $movement->asset_id = $asset->id;
    $movement->location_id = 1;
    $movement->status_id = 1;

    $movement->save();

    $asset->movement_id = $movement->id;

    $asset->update();

    return redirect('assets');
  }

  public function edit(Asset $asset)
  {
    $asset_models = AssetModel::all();
    $divisions = Division::all();
    $suppliers = Supplier::all();
    $movements = Movement::all();
    $manufacturers = Manufacturer::all();
    return view('assets.edit', compact('asset', 'asset_models', 'divisions', 'suppliers', 'movements', 'manufacturers'));
  }

  public function update(Request $request, Asset $asset)
  {
    $this->validate($request, [
      'asset_model_id' => 'required',
      'division_id' => 'required',
      'supplier_id' => 'required'
    ]);

    $asset->update($request->all());

    return redirect('assets');
  }
}
