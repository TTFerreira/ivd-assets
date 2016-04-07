<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Invoice;
use App\Supplier;
use App\Division;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;

class InvoicesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'View Invoices';
    $invoices = Invoice::all();
    return view('invoices.index', compact('invoices', 'pageTitle'));
  }

  public function show(Invoice $invoice)
  {
    $filepath = storage_path() . "/app/invoices/" . $invoice->invoice_number . ".pdf";
    return response()->file($filepath);
    // return view('invoices.show', compact('invoice', 'filepath'));
  }

  public function create()
  {
    $pageTitle = 'Create New Invoice';
    $suppliers = Supplier::all();
    $divisions = Division::all();
    return view('invoices.create', compact('suppliers', 'divisions', 'pageTitle'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'invoice_number' => 'required|unique:invoices,invoice_number',
      'order_number' => 'required|unique:invoices,order_number',
      'division_id' => 'required',
      'supplier_id' => 'required',
      'invoiced_date' => 'required',
      'total' => 'required|numeric|between:0, 99999999.99'
    ]);

    $invoice = new Invoice();
    $invoice->invoice_number = $request->invoice_number;
    $invoice->order_number = $request->order_number;
    $invoice->division_id = $request->division_id;
    $invoice->supplier_id = $request->supplier_id;
    $invoice->invoiced_date = $request->invoiced_date;
    $invoice->total = $request->total;
    $filename = "invoices/" . $invoice->invoice_number . '.pdf';
    $file = $request->file('file');
    if ($file) {
      Storage::disk('local')->put($filename, File::get($file));
    }

    $invoice->save();

    return redirect('invoices');
  }

  public function edit(Invoice $invoice)
  {
    $pageTitle = 'Edit Invoice - ' . $invoice->invoice_number;
    $suppliers = Supplier::all();
    $divisions = Division::all();
    return view('invoices.edit', compact('invoice', 'suppliers', 'divisions', 'pageTitle'));
  }

  public function update(Request $request, Invoice $invoice)
  {
    $this->validate($request, [
      'invoice_number' => 'required|unique:invoices,invoice_number,'.$invoice->id,
      'order_number' => 'required|unique:invoices,order_number,'.$invoice->id,
      'division_id' => 'required',
      'supplier_id' => 'required',
      'invoiced_date' => 'required',
      'total' => 'required|numeric|between:0, 99999999.99'
    ]);

    if ($request->invoice_number != $invoice->invoice_number) {
      Storage::move('invoices/' . $invoice->invoice_number . '.pdf', 'invoices/' . $request->invoice_number  . '.pdf');
    }

    $filename = "invoices/" . $request->invoice_number . '.pdf';
    $file = $request->file('file');
    if ($file) {
      Storage::disk('local')->put($filename, File::get($file));
    }

    $invoice->update($request->all());



    return redirect('invoices');
  }
}
