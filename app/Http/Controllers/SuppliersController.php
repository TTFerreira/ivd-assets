<?php

namespace App\Http\Controllers;

use App\Supplier;
use Illuminate\Http\Request;

use App\Http\Requests;

class SuppliersController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $suppliers = Supplier::all();
    return view('suppliers.index', compact('suppliers'));
  }

  public function show(Supplier $supplier)
  {
    //$location->load('notes.user');
    return view('suppliers.show', compact('supplier'));
  }

  public function create()
  {
    return view('suppliers.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|unique:suppliers,name'
    ]);

    $supplier = new Supplier();
    $supplier->name = $request->name;

    $supplier->save();

    return redirect('suppliers');
  }

  public function edit(Supplier $supplier)
  {
    return view('suppliers.edit', compact('supplier'));
  }

  public function update(Request $request, Supplier $supplier)
  {
    $this->validate($request, [
      'name' => 'required|unique:suppliers,name,'.$supplier->id
    ]);

    $supplier->update($request->all());

    return redirect('suppliers');
  }
}
