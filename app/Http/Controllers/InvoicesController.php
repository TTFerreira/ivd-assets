<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Invoice;
use App\Supplier;
use App\Division;
use Session;
use App\Http\Requests;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\Invoices\StoreInvoiceRequest;
use App\Http\Requests\Invoices\UpdateInvoiceRequest;
use Illuminate\Http\Response;

class InvoicesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Invoices';
    $invoices = Invoice::all();
    $suppliers = Supplier::all();
    $divisions = Division::all();
    return view('invoices.index', compact('invoices', 'suppliers', 'divisions', 'pageTitle'));
  }

  public function show(Invoice $invoice)
  {
    $filepath = storage_path() . "/app/invoices/" . $invoice->invoice_number . ".pdf";
    return response()->file($filepath);
  }

  public function store(StoreInvoiceRequest $request)
  {
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

    Session::flash('status', 'success');
    Session::flash('title', 'Invoice ' . $invoice->invoice_number);
    Session::flash('message', 'Successfully created');

    return redirect('invoices');
  }

  public function edit(Invoice $invoice)
  {
    $pageTitle = 'Edit Invoice - ' . $invoice->invoice_number;
    $suppliers = Supplier::all();
    $divisions = Division::all();
    return view('invoices.edit', compact('invoice', 'suppliers', 'divisions', 'pageTitle'));
  }

  public function update(UpdateInvoiceRequest $request, Invoice $invoice)
  {
    if ($request->invoice_number != $invoice->invoice_number) {
      Storage::move('invoices/' . $invoice->invoice_number . '.pdf', 'invoices/' . $request->invoice_number  . '.pdf');
    }

    $filename = "invoices/" . $request->invoice_number . '.pdf';
    $file = $request->file('file');
    if ($file) {
      Storage::disk('local')->put($filename, File::get($file));
    }

    $invoice->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', 'Invoice ' . $invoice->invoice_number);
    Session::flash('message', 'Successfully updated');

    return redirect('invoices');
  }
}
