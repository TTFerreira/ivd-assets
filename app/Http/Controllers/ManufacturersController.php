<?php

namespace App\Http\Controllers;

use App\Manufacturer;
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
    $manufacturers = Manufacturer::all();
    return view('manufacturers.index', compact('manufacturers'));
  }

  public function show(Manufacturer $manufacturer)
  {
    //$location->load('notes.user');
    return view('manufacturers.show', compact('manufacturer'));
  }

  public function create()
  {
    return view('manufacturers.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|unique:manufacturers,name'
    ]);

    $manufacturer = new Manufacturer();
    $manufacturer->name = $request->name;

    $manufacturer->save();

    return redirect('manufacturers');
  }

  public function edit(Manufacturer $manufacturer)
  {
    return view('manufacturers.edit', compact('manufacturer'));
  }

  public function update(Request $request, Manufacturer $manufacturer)
  {
    $this->validate($request, [
      'name' => 'required|unique:manufacturers,name,'.$manufacturer->id
    ]);

    $manufacturer->update($request->all());

    return redirect('manufacturers');
  }
}
