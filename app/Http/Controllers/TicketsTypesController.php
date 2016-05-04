<?php

namespace App\Http\Controllers;

use App\TicketsType;
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

  public function create()
  {
    $pageTitle = 'Create New Ticket Type';
    $ticketsTypes = TicketsType::all();
    return view('admin.ticket-types.create', compact('pageTitle', 'ticketsTypes'));
  }

  public function store(StoreTicketsTypeRequest $request)
  {
    $this->validate($request, [
      'type' => 'required|unique:tickets_types,type'
    ]);

    $ticketsType = new TicketsType();
    $ticketsType->type = $request->type;

    $ticketsType->save();

    return redirect('admin/ticket-types/create');
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

    return redirect('/admin/ticket-types');
  }
}
