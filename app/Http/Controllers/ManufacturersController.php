<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use Session;
use App\Http\Requests\Manufacturers\StoreManufacturerRequest;
use App\Http\Requests\Manufacturers\UpdateManufacturerRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class ManufacturersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Manufacturers';
    $manufacturers = Manufacturer::all();
    return view('manufacturers.index', compact('manufacturers', 'pageTitle'));
  }

  public function store(StoreManufacturerRequest $request)
  {
    Manufacturer::create($request->all());
    $manufacturer = Manufacturer::get()->last();

    Session::flash('status', 'success');
    Session::flash('title', $manufacturer->name);
    Session::flash('message', 'Successfully created');

    return redirect()->route('manufacturers.index');
  }

  public function edit(Manufacturer $manufacturer)
  {
    $pageTitle = 'Edit Manufacturer - ' . $manufacturer->name;
    return view('manufacturers.edit', compact('manufacturer', 'pageTitle'));
  }

  public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
  {
    $manufacturer->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', $manufacturer->name);
    Session::flash('message', 'Successfully updated');

    return redirect()->route('manufacturers.index');
  }
}
