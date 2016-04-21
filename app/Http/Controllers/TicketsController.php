<?php

namespace App\Http\Controllers;

use Mail;
use App\Ticket;
use App\TicketsEntry;
use App\TicketsPriority;
use App\TicketsStatus;
use App\TicketsType;
use App\Location;
use App\User;
use Carbon\Carbon;
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
    $pageTitle = 'Viewing Ticket #' . $ticket->id;
    $ticketsPriorities = TicketsPriority::all();
    $ticketsStatuses = TicketsStatus::all();
    $ticketsTypes = TicketsType::all();
    $locations = Location::all();
    $users = User::all();
    $now = new Carbon();
    $ticketEntries = TicketsEntry::where('ticket_id', $ticket->id)->orderBy('created_at', 'asc')->get();
    return view('tickets.show', compact('ticket', 'ticketEntries', 'pageTitle', 'ticketsPriorities', 'ticketsStatuses', 'ticketsTypes', 'locations', 'users', 'now'));
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

    $user = User::findOrFail($ticket->user_id);

    Mail::send('emails.new-ticket', ['user' => $user, 'ticket' => $ticket], function ($m) use ($user, $ticket) {
      $m->to($user->email, $user->name)->subject('New Ticket: #' . $ticket->id . ' - ' . $ticket->subject);
    });

    return redirect('tickets/' . $ticket->id);
  }

  public function edit(Ticket $ticket)
  {
    $pageTitle = 'Edit Ticket - ' . $ticket->id;
    return view('tickets.edit', compact('ticket', 'pageTitle'));
  }

  public function update(Request $request, Ticket $ticket)
  {
    $this->validate($request, [
      'user_id' => 'required',
      'location_id' => 'required',
      'ticket_status_id' => 'required',
      'ticket_type_id' => 'required',
      'ticket_priority_id' => 'required'
    ]);

    $ticket->user_id = $request->user_id;
    $ticket->location_id = $request->location_id;
    $ticket->ticket_status_id = $request->ticket_status_id;
    $ticket->ticket_type_id = $request->ticket_type_id;
    $ticket->ticket_priority_id = $request->ticket_priority_id;

    $ticket->update();

    return redirect('tickets/' . $ticket->id);
  }
}
