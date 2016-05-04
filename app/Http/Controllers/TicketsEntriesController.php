<?php

namespace App\Http\Controllers;

use Mail;
use App\Ticket;
use App\TicketsEntry;
use App\User;
use Auth;
use Session;
use Illuminate\Http\Request;
use App\Http\Requests\Tickets\StoreNoteForTicketRequest;

use App\Http\Requests;

class TicketsEntriesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function store(StoreNoteForTicketRequest $request, Ticket $ticket)
  {
    $ticketEntry = new TicketsEntry();
    $ticketEntry->ticket_id = $ticket->id;
    $ticketEntry->user_id = Auth::user()->id;
    $ticketEntry->note = $request->note;

    $ticketEntry->save();

    $user = User::findOrFail($ticket->user_id);

    Mail::send('emails.new-ticket-note', ['user' => $user, 'ticket' => $ticket, 'ticketEntry' => $ticketEntry], function ($m) use ($user, $ticket, $ticketEntry) {
      $m->to($user->email, $user->name)->subject('New Note for Ticket #' . $ticket->id . ' - ' . $ticket->subject);
    });

    Session::flash('status', 'success');
    Session::flash('title', 'Ticket #' . $ticket->id);
    Session::flash('message', 'New Note Added');

    return redirect('tickets/' . $ticket->id);
  }
}
