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
    TicketsCannedField::create($request->all());
    $ticketsCannedField = TicketsCannedField::get()->last();

    Session::flash('status', 'success');
    Session::flash('title', 'Canned Ticket Fields: ' . $ticketsCannedField->subject);
    Session::flash('message', 'Successfully created');

    return redirect()->route('admin.ticket-canned-fields.index');
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
    $ticketsCannedField->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', 'Canned Ticket Fields: ' . $ticketsCannedField->subject);
    Session::flash('message', 'Successfully updated');

    return redirect()->route('admin.ticket-canned-fields.index');
  }
}
