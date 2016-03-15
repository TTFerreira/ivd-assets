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
    $invoices = Invoice::orderBy('created_at', 'desc')->paginate(10);
    return view('invoices.index', compact('invoices'));
  }

  public function show(Invoice $invoice)
  {
    $filepath = storage_path() . "/app/invoices/" . $invoice->invoice_number . ".pdf";
    return response()->file($filepath);
    // return view('invoices.show', compact('invoice', 'filepath'));
  }

  public function create()
  {
    $suppliers = Supplier::all();
    $divisions = Division::all();
    return view('invoices.create', compact('suppliers', 'divisions'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'invoice_number' => 'required|unique:invoices,invoice_number',
      'order_number' => 'required',
      'division_id' => 'required',
      'supplier_id' => 'required',
      'invoiced_date' => 'required'
    ]);

    $invoice = new Invoice();
    $invoice->invoice_number = $request->invoice_number;
    $invoice->order_number = $request->order_number;
    $invoice->division_id = $request->division_id;
    $invoice->supplier_id = $request->supplier_id;
    $invoice->invoiced_date = $request->invoiced_date;
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
    $suppliers = Supplier::all();
    return view('invoices.edit', compact('invoice', 'suppliers'));
  }

  public function update(Request $request, Invoice $invoice)
  {
    $this->validate($request, [
      'invoice_number' => 'required|unique:invoices,invoice_number,'.$invoice->id,
      'order_number' => 'required',
      'division_id' => 'required',
      'supplier_id' => 'required',
      'invoiced_date' => 'required'
    ]);

    $invoice->update($request->all());

    return redirect('invoices');
  }
}
