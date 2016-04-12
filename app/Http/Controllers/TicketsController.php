<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketsPriority;
use App\TicketsStatus;
use App\TicketsType;
use App\Location;
use App\User;
use Illuminate\Http\Request;

use App\Http\Requests;

class TicketsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'View Tickets';
    $tickets = Ticket::all();
    return view('tickets.index', compact('tickets', 'pageTitle'));
  }

  public function show(Ticket $ticket)
  {
    $pageTitle = 'View Ticket';
    return view('tickets.show', compact('ticket', 'pageTitle'));
  }

  public function create()
  {
    $pageTitle = 'Create New Ticket';
    $ticketsPriorities = TicketsPriority::all();
    $ticketsStatuses = TicketsStatus::all();
    $ticketsTypes = TicketsType::all();
    $locations = Location::all();
    $users = User::all();
    return view('tickets.create', compact('ticketsPriorities', 'ticketsStatuses', 'ticketsTypes', 'locations', 'users', 'pageTitle'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'user_id' => 'required',
      'location_id' => 'required',
      'ticket_status_id' => 'required',
      'ticket_type_id' => 'required',
      'ticket_priority_id' => 'required',
      'subject' => 'required',
      'description' => 'required'
    ]);

    $ticket = new Ticket();
    $ticket->user_id = $request->user_id;
    $ticket->location_id = $request->location_id;
    $ticket->ticket_status_id = $request->ticket_status_id;
    $ticket->ticket_type_id = $request->ticket_type_id;
    $ticket->ticket_priority_id = $request->ticket_priority_id;
    $ticket->subject = $request->subject;
    $ticket->description = $request->description;

    $ticket->save();

    return redirect('tickets');
  }

  public function edit(Manufacturer $manufacturer)
  {
    $pageTitle = 'Edit Manufacturer - ' . $manufacturer->name;
    return view('manufacturers.edit', compact('manufacturer', 'pageTitle'));
  }

  public function update(Request $request, Manufacturer $manufacturer)
  {
    $this->validate($request, [
      'name' => 'required|unique:manufacturers,name,'.$manufacturer->id
    ]);

    $manufacturer->update($request->all());

    return redirect('manufacturers');
  }
}
