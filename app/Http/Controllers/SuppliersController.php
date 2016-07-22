<?php

namespace App\Http\Controllers;

use App\Supplier;
use Session;
use App\Http\Requests\Suppliers\StoreSupplierRequest;
use App\Http\Requests\Suppliers\UpdateSupplierRequest;
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
    $pageTitle = 'View Suppliers';
    $suppliers = Supplier::all();
    return view('suppliers.index', compact('suppliers', 'pageTitle'));
  }

  public function store(StoreSupplierRequest $request)
  {
    Supplier::create($request->all());
    $supplier = Supplier::get()->last();

    Session::flash('status', 'success');
    Session::flash('title', $supplier->name);
    Session::flash('message', 'Successfully created');

    return redirect('suppliers');
  }

  public function edit(Supplier $supplier)
  {
    $pageTitle = 'Edit Supplier - ' . $supplier->name;
    return view('suppliers.edit', compact('supplier', 'pageTitle'));
  }

  public function update(UpdateSupplierRequest $request, Supplier $supplier)
  {
    $supplier->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', $supplier->name);
    Session::flash('message', 'Successfully updated');

    return redirect('suppliers');
  }
}
