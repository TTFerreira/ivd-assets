<?php

namespace App\Http\Controllers;

use App\AssetType;
use Illuminate\Http\Request;

use App\Http\Requests;

class AssetTypesController extends Controller
{
  public function index()
  {
    $asset_types = AssetType::paginate(2);;
    return view('asset-types.index', compact('asset_types'));
  }

  public function show(AssetType $asset_type)
  {
    //$location->load('notes.user');
    return view('asset-types.show', compact('asset_type'));
  }

  public function create()
  {
    return view('asset-types.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'type_name' => 'required|unique:asset_types,type_name',
      'abbreviation' => 'required|unique:asset_types,abbreviation'
    ]);

    $asset_type = new AssetType();
    $asset_type->type_name = $request->type_name;
    $asset_type->abbreviation = $request->abbreviation;

    $asset_type->save();

    return redirect('asset-types');
  }

  public function edit(AssetType $asset_type)
  {
    return view('asset-types.edit', compact('asset_type'));
  }

  public function update(Request $request, AssetType $asset_type)
  {
    $this->validate($request, [
      'type_name' => 'required|unique:asset_types,type_name,'.$asset_type->id,
      'abbreviation' => 'required|unique:asset_types,abbreviation,'.$asset_type->id
    ]);

    $asset_type->update($request->all());

    return redirect('asset-types');
  }
}
