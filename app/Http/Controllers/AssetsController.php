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
use App\Invoice;
use Carbon\Carbon;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\Assets\StoreAssetRequest;
use DB;
use Auth;

use App\Http\Requests;

class AssetsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'View Assets';
    $totalAssets = DB::table('assets')->count();
    $deployed = DB::table('assets')
                        ->join('movements', function ($join) {
                          $join->on('assets.movement_id', '=', 'movements.id')
                               ->where('movements.status_id', '=', 2);
                        })
                        ->count();
    $readyToDeploy = DB::table('assets')
                        ->join('movements', function ($join) {
                          $join->on('assets.movement_id', '=', 'movements.id')
                               ->where('movements.status_id', '=', 1);
                        })
                        ->count();
    $repairsThree = DB::table('assets')
                        ->join('movements', function ($join) {
                          $join->on('assets.movement_id', '=', 'movements.id')
                               ->where('movements.status_id', '=', 3);
                        })
                        ->count();
    $repairsFour = DB::table('assets')
                        ->join('movements', function ($join) {
                          $join->on('assets.movement_id', '=', 'movements.id')
                               ->where('movements.status_id', '=', 4);
                        })
                        ->count();
    $repairs = $repairsThree + $repairsFour;

    $assets = Asset::all();
    return view('assets.index', compact('assets', 'pageTitle', 'totalAssets', 'deployed', 'readyToDeploy', 'repairs'));
  }

  public function show(Asset $asset)
  {
    return view('assets.show', compact('asset'));
  }

  public function create()
  {
    $pageTitle = 'Create New Asset';
    $asset_models = AssetModel::all();
    $divisions = Division::all();
    $suppliers = Supplier::all();
    $movements = Movement::all();
    $manufacturers = Manufacturer::all();
    $warranty_types = WarrantyType::all();
    $invoices = Invoice::all();
    $storeroom = Location::where('storeroom', 1)->first();

    if(isset($storeroom))
    {
      return view('assets.create', compact('asset_models', 'divisions', 'suppliers', 'movements', 'manufacturers', 'warranty_types', 'invoices', 'pageTitle'));
    }
    else
    {
      $pageTitle = 'Default Storeroom';
      $locations = Location::all();

      Session::flash('status', 'warning');
      Session::flash('title', 'No Default Storeroom Set');
      Session::flash('message', 'You must select a Default Storeroom before creating Assets.');

      return view('admin.storeroom.index', compact('locations', 'pageTitle'));
    }
  }

  public function store(StoreAssetRequest $request)
  {
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
    $asset->warranty_type_id = $request->warranty_type_id;
    $asset->invoice_id = $request->invoice_id;

    $asset->save();

    $user = Auth::user()->id;

    $storeroom = Location::where('storeroom', '=', 1)->first();
    $status = Status::where('name', '=', 'Ready to Deploy')->first();

    $movement = new Movement();
    $movement->asset_id = $asset->id;
    $movement->location_id = $storeroom->id;
    $movement->status_id = $status->id;
    $movement->user_id = $user;
    $movement->save();

    $asset->movement_id = $movement->id;

    $asset->update();

    return redirect('assets');
  }

  public function edit(Asset $asset)
  {
    $pageTitle = 'Edit Asset - ' . $asset->asset_tag;
    $asset_models = AssetModel::all();
    $divisions = Division::all();
    $suppliers = Supplier::all();
    $movements = Movement::all();
    $manufacturers = Manufacturer::all();
    $warranty_types = WarrantyType::all();
    $invoices = Invoice::all();
    return view('assets.edit', compact('asset', 'asset_models', 'divisions', 'suppliers', 'movements', 'manufacturers', 'invoices', 'warranty_types', 'pageTitle'));
  }

  public function update(StoreAssetRequest $request, Asset $asset)
  {
    $this->validate($request, [
      'asset_model_id' => 'required',
      'division_id' => 'required',
      'supplier_id' => 'required',
      'warranty_type_id' => 'required'
    ]);

    $asset->update($request->all());

    return redirect('assets');
  }
}
