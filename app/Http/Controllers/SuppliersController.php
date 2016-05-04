<?php

namespace App\Http\Controllers;

use App\Supplier;
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

  public function show(Supplier $supplier)
  {
    //$location->load('notes.user');
    return view('suppliers.show', compact('supplier'));
  }

  public function create()
  {
    $pageTitle = 'Create New Supplier';
    return view('suppliers.create', compact('pageTitle'));
  }

  public function store(StoreSupplierRequest $request)
  {
    $supplier = new Supplier();
    $supplier->name = $request->name;

    $supplier->save();

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

    return redirect('suppliers');
  }
}
