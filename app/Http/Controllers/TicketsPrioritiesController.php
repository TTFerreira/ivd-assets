<?php

namespace App\Http\Controllers;

use App\TicketsPriority;
use Session;
use App\Http\Requests\TicketsPriorities\StoreTicketsPriorityRequest;
use App\Http\Requests\TicketsPriorities\UpdateTicketsPriorityRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class TicketsPrioritiesController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Ticket Priorities';
    $ticketsPriorities = TicketsPriority::all();
    return view('admin.ticket-priorities.index', compact('pageTitle', 'ticketsPriorities'));
  }

  public function store(StoreTicketsPriorityRequest $request)
  {
    TicketsPriority::create($request->all());
    $ticketsPriority = TicketsPriority::get()->last();

    Session::flash('status', 'success');
    Session::flash('title', 'Ticket Priority: ' . $ticketsPriority->priority);
    Session::flash('message', 'Successfully created');

    return redirect('admin/ticket-priorities');
  }

  public function edit(TicketsPriority $ticketsPriority)
  {
    $pageTitle = 'Edit Ticket Priority - ' . $ticketsPriority->priority;
    $ticketsPriorities = TicketsPriority::all();
    return view('admin.ticket-priorities.edit', compact('pageTitle', 'ticketsPriorities', 'ticketsPriority'));
  }

  public function update(UpdateTicketsPriorityRequest $request, TicketsPriority $ticketsPriority)
  {
    $ticketsPriority->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', 'Ticket Priority: ' . $ticketsPriority->priority);
    Session::flash('message', 'Successfully updated');

    return redirect('/admin/ticket-priorities');
  }
}
