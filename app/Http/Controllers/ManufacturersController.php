<?php

namespace App\Http\Controllers;

use App\Manufacturer;
use App\Http\Requests\Manufacturers\StoreManufacturerRequest;
use App\Http\Requests\Manufacturers\UpdateManufacturerRequest;
use Illuminate\Http\Request;
use App\Repositories\Manufacturers\ManufacturerRepositoryInterface;

use App\Http\Requests;

class ManufacturersController extends Controller
{
  public function __construct(ManufacturerRepositoryInterface $manufacturer)
  {
      $this->middleware('auth');
      $this->manufacturer = $manufacturer;
  }

  public function index()
  {
    $pageTitle = 'Manufacturers';
    $manufacturers = $this->manufacturer->getAll();
    return view('manufacturers.index', compact('manufacturers', 'pageTitle'));
  }

  public function store(StoreManufacturerRequest $request)
  {
    $this->manufacturer->store($request);

    $this->manufacturer->flashSuccessCreate($this->manufacturer->getLatest()->name);

    return redirect()->route('manufacturers.index');
  }

  public function edit(Manufacturer $manufacturer)
  {
    $pageTitle = 'Edit Manufacturer - ' . $manufacturer->name;
    return view('manufacturers.edit', compact('manufacturer', 'pageTitle'));
  }

  public function update(UpdateManufacturerRequest $request, Manufacturer $manufacturer)
  {
    $this->manufacturer->update($request, $manufacturer);

    $this->manufacturer->flashSuccessUpdate($this->manufacturer->find($manufacturer->id)->name);

    return redirect()->route('manufacturers.index');
  }
}
