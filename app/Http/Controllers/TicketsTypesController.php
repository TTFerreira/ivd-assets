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
    TicketsType::create($request->all());
    $ticketsType = TicketsType::get()->last();

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
    $ticketsType->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', 'Ticket Type: ' . $ticketsType->type);
    Session::flash('message', 'Successfully updated');

    return redirect('/admin/ticket-types');
  }
}
