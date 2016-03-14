<?php

namespace App\Http\Controllers;

use App\Asset;
use App\AssetModel;
use App\Division;
use App\Supplier;
use App\Movement;
use App\Manufacturer;
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
    $assets = Asset::paginate(10);;
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
    return view('assets.create', compact('asset_models', 'divisions', 'suppliers', 'movements', 'manufacturers'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'serial_number' => 'required',
      'asset_model_id' => 'required',
      'division_id' => 'required',
      'supplier_id' => 'required'
    ]);

    $asset = new Asset();
    $asset->serial_number = $request->serial_number;
    $asset->model_id = $request->asset_model_id;
    $asset->division_id = $request->division_id;
    $asset->supplier_id = $request->supplier_id;
    $asset->purchase_date = $request->purchase_date;
    $asset->warranty_months = $request->warranty_months;
    $asset->warranty_type = $request->warranty_type;

    $asset->save();

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
      'serial_number' => 'required',
      'asset_model_id' => 'required',
      'division_id' => 'required',
      'supplier_id' => 'required'
    ]);

    $asset->update($request->all());

    return redirect('assets');
  }
}
