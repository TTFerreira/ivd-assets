<?php

namespace App\Http\Controllers;

use App\TicketsType;
use Session;
use App\Http\Requests\TicketsTypes\StoreTicketsTypeRequest;
use App\Http\Requests\TicketsTypes\UpdateTicketsTypeRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class TicketsTypesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Ticket Types';
    $ticketsTypes = TicketsType::all();
    return view('admin.ticket-types.index', compact('pageTitle', 'ticketsTypes'));
  }

  public function store(StoreTicketsTypeRequest $request)
  {
    $this->validate($request, [
      'type' => 'required|unique:tickets_types,type'
    ]);

    $ticketsType = new TicketsType();
    $ticketsType->type = $request->type;

    $ticketsType->save();

    Session::flash('status', 'success');
    Session::flash('title', 'Ticket Type: ' . $ticketsType->type);
    Session::flash('message', 'Successfully created');

    return redirect('admin/ticket-types');
  }

  public function edit(TicketsType $ticketsType)
  {
    $pageTitle = 'Edit Ticket Type - ' . $ticketsType->type;
    $ticketsTypes = TicketsType::all();
    return view('admin.ticket-types.edit', compact('pageTitle', 'ticketsTypes', 'ticketsType'));
  }

  public function update(UpdateTicketsTypeRequest $request, TicketsType $ticketsType)
  {
    $this->validate($request, [
      'type' => 'required|unique:tickets_types,type'
    ]);

    $ticketsType->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', 'Ticket Type: ' . $ticketsType->type);
    Session::flash('message', 'Successfully updated');

    return redirect('/admin/ticket-types');
  }
}
