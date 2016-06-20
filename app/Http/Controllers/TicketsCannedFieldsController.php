<?php

namespace App\Http\Controllers;

use App\TicketsCannedField;
use App\TicketsEntry;
use App\TicketsPriority;
use App\TicketsStatus;
use App\TicketsType;
use App\Location;
use App\User;
use App\Ticket;
use Session;
use App\Http\Requests\TicketsCannedFields\StoreTicketsCannedFieldRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class TicketsCannedFieldsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Canned Ticket Fields';
    $ticketsCannedFields = TicketsCannedField::all();
    $ticketsPriorities = TicketsPriority::all();
    $ticketsStatuses = TicketsStatus::all();
    $ticketsTypes = TicketsType::all();
    $locations = Location::all();
    $users = User::all();
    return view('admin.ticket-canned-fields.index', compact('pageTitle', 'ticketsCannedFields', 'ticketsPriorities', 'ticketsStatuses', 'ticketsTypes', 'locations', 'users'));
  }

  public function store(StoreTicketsCannedFieldRequest $request)
  {
    $ticket = new TicketsCannedField();
    $ticket->user_id = $request->user_id;
    $ticket->location_id = $request->location_id;
    $ticket->ticket_status_id = $request->ticket_status_id;
    $ticket->ticket_type_id = $request->ticket_type_id;
    $ticket->ticket_priority_id = $request->ticket_priority_id;
    $ticket->subject = $request->subject;
    $ticket->description = $request->description;

    $ticket->save();

    Session::flash('status', 'success');
    Session::flash('title', 'Canned Ticket Fields');
    Session::flash('message', 'Successfully created');

    return redirect('admin/ticket-canned-fields');
  }

  public function canned(Request $request)
  {
    $pageTitle = 'Create New Ticket';
    $ticketsPriorities = TicketsPriority::all();
    $ticketsStatuses = TicketsStatus::all();
    $ticketsTypes = TicketsType::all();
    $locations = Location::all();
    $users = User::all();

    $ticketsCannedField = TicketsCannedField::where('id', $request->subject)->first();

    return view('tickets.create-with-canned-fields', compact('ticketsPriorities', 'ticketsStatuses', 'ticketsTypes', 'locations', 'users', 'ticketsCannedFields', 'ticketsCannedField', 'pageTitle'));
  }

  public function edit(TicketsCannedField $ticketsCannedField)
  {
    $pageTitle = 'Edit Ticket Canned Fields - ' . $ticketsCannedField->subject;
    $ticketsPriorities = TicketsPriority::all();
    $ticketsStatuses = TicketsStatus::all();
    $ticketsTypes = TicketsType::all();
    $locations = Location::all();
    $users = User::all();
    return view('admin.ticket-canned-fields.edit', compact('ticketsCannedField', 'ticketsPriorities', 'ticketsStatuses', 'ticketsTypes', 'locations', 'users', 'pageTitle'));
  }

  public function update(StoreTicketsCannedFieldRequest $request, TicketsCannedField $ticketsCannedField)
  {
    $ticketsCannedField->user_id = $request->user_id;
    $ticketsCannedField->location_id = $request->location_id;
    $ticketsCannedField->ticket_status_id = $request->ticket_status_id;
    $ticketsCannedField->ticket_type_id = $request->ticket_type_id;
    $ticketsCannedField->ticket_priority_id = $request->ticket_priority_id;
    $ticketsCannedField->subject = $request->subject;
    $ticketsCannedField->description = $request->description;

    $ticketsCannedField->update();

    Session::flash('status', 'success');
    Session::flash('title', 'Canned Ticket Fields');
    Session::flash('message', 'Successfully updated');

    return redirect('admin/ticket-canned-fields');
  }
}
