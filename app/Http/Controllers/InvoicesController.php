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
use Slack;

class InvoicesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Invoices';
    $invoices = Invoice::all()->sortByDesc('invoiced_date');
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

    if (env('SLACK_ENABLED')) {
      Slack::attach([
        'title' => 'New Invoice Created',
        'title_link' => url('invoices/' . $invoice->id),
        'fallback' => 'New Invoice Created',
        'color' => 'good',
        'fields' => [
          [
            'title' => 'Invoice Number',
            'value' => $invoice->invoice_number,
            'short' => true
          ],
          [
            'title' => 'Order Number',
            'value' => $invoice->order_number,
            'short' => true
          ],
          [
            'title' => 'Division',
            'value' => $invoice->division->name,
            'short' => true
          ],
          [
            'title' => 'Supplier',
            'value' => $invoice->supplier->name,
            'short' => true
          ],
          [
            'title' => 'Invoice Date',
            'value' => $invoice->invoiced_date,
            'short' => true
          ],
          [
            'title' => 'Total',
            'value' => $invoice->total,
            'short' => true
          ],
        ]
      ])->send();
    }

    return redirect()->route('invoices.index');
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

    return redirect()->route('invoices.index');
  }
}
