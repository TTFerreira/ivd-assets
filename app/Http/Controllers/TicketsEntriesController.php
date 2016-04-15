<?php

namespace App\Http\Controllers;

use App\Ticket;
use App\TicketsEntry;
use Auth;
use Illuminate\Http\Request;

use App\Http\Requests;

class TicketsEntriesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function store(Request $request, Ticket $ticket)
  {
    $this->validate($request, [
      'note' => 'required'
    ]);

    $ticketEntry = new TicketsEntry();
    $ticketEntry->ticket_id = $ticket->id;
    $ticketEntry->user_id = Auth::user()->id;
    $ticketEntry->note = $request->note;

    $ticketEntry->save();

    return redirect('tickets/' . $ticket->id);
  }
}
