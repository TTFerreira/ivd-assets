<?php

namespace App\Http\Controllers;

use App\Manufacturer;
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
    $pageTitle = 'View Manufacturers';
    $manufacturers = Manufacturer::all();
    return view('manufacturers.index', compact('manufacturers', 'pageTitle'));
  }

  public function show(Manufacturer $manufacturer)
  {
    return view('manufacturers.show', compact('manufacturer'));
  }

  public function create()
  {
    $pageTitle = 'Create New Manufacturer';
    return view('manufacturers.create', compact('pageTitle'));
  }

  public function store(StoreManufacturerRequest $request)
  {
    $manufacturer = new Manufacturer();
    $manufacturer->name = $request->name;

    $manufacturer->save();

    return redirect('manufacturers');
  }

  public function edit(Manufacturer $manufacturer)
  {
    $pageTitle = 'Edit Manufacturer - ' . $manufacturer->name;
    return view('manufacturers.edit', compact('manufacturer', 'pageTitle'));
  }

  public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
  {
    $manufacturer->update($request->all());

    return redirect('manufacturers');
  }
}
