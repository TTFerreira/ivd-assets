<?php

namespace App\Http\Controllers;

use App\TicketsStatus;
use App\TicketsPriority;
use App\TicketsType;
use Illuminate\Http\Request;

use App\Http\Requests;

class PagesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function getTicketConfig()
  {
    $pageTitle = 'Admin Configurations';
    return view('admin.admin', compact('pageTitle'));
  }

  public function getTicketStatuses()
  {
    $pageTitle = 'Ticket Statuses';
    $ticketsStatuses = TicketsStatus::all();
    return view('admin.ticket-statuses.index', compact('pageTitle', 'ticketsStatuses'));
  }

  public function createTicketStatus()
  {
    $pageTitle = 'Create New Ticket Status';
    $ticketsStatuses = TicketsStatus::all();
    return view('admin.ticket-statuses.create', compact('pageTitle', 'ticketsStatuses'));
  }

  public function storeTicketStatus(Request $request)
  {
    $this->validate($request, [
      'status' => 'required|unique:tickets_statuses,status'
    ]);

    $ticketsStatus = new TicketsStatus();
    $ticketsStatus->status = $request->status;

    $ticketsStatus->save();

    return redirect('admin/ticket-statuses/create');
  }

  public function editTicketStatus(TicketsStatus $ticketsStatus)
  {
    $pageTitle = 'Edit Ticket Status - ' . $ticketsStatus->status;
    $ticketsStatuses = TicketsStatus::all();
    return view('admin.ticket-statuses.edit', compact('pageTitle', 'ticketsStatuses', 'ticketsStatus'));
  }

  public function updateTicketStatus(Request $request, TicketsStatus $ticketsStatus)
  {
    $this->validate($request, [
      'status' => 'required|unique:tickets_statuses,status'
    ]);

    $ticketsStatus->update($request->all());

    return redirect('/admin/ticket-statuses');
  }

  public function getTicketPriorities()
  {
    $pageTitle = 'Ticket Priorities';
    $ticketsPriorities = TicketsPriority::all();
    return view('admin.ticket-priorities.index', compact('pageTitle', 'ticketsPriorities'));
  }

  public function createTicketPriority()
  {
    $pageTitle = 'Create New Ticket Priority';
    $ticketsPriorities = TicketsPriority::all();
    return view('admin.ticket-priorities.create', compact('pageTitle', 'ticketsPriorities'));
  }

  public function storeTicketPriority(Request $request)
  {
    $this->validate($request, [
      'priority' => 'required|unique:tickets_priorities,priority'
    ]);

    $ticketsPriority = new TicketsPriority();
    $ticketsPriority->priority = $request->priority;

    $ticketsPriority->save();

    return redirect('admin/ticket-priorities/create');
  }

  public function editTicketPriority(TicketsPriority $ticketsPriority)
  {
    $pageTitle = 'Edit Ticket Priority - ' . $ticketsPriority->priority;
    $ticketsPriorities = TicketsPriority::all();
    return view('admin.ticket-priorities.edit', compact('pageTitle', 'ticketsPriorities', 'ticketsPriority'));
  }

  public function updateTicketPriority(Request $request, TicketsPriority $ticketsPriority)
  {
    $this->validate($request, [
      'priority' => 'required|unique:tickets_priorities,priority'
    ]);

    $ticketsPriority->update($request->all());

    return redirect('/admin/ticket-priorities');
  }

  public function getTicketTypes()
  {
    $pageTitle = 'Ticket Types';
    $ticketsTypes = TicketsType::all();
    return view('admin.ticket-types.index', compact('pageTitle', 'ticketsTypes'));
  }

  public function createTicketType()
  {
    $pageTitle = 'Create New Ticket Type';
    $ticketsTypes = TicketsType::all();
    return view('admin.ticket-types.create', compact('pageTitle', 'ticketsTypes'));
  }

  public function storeTicketType(Request $request)
  {
    $this->validate($request, [
      'type' => 'required|unique:tickets_types,type'
    ]);

    $ticketsType = new TicketsType();
    $ticketsType->type = $request->type;

    $ticketsType->save();

    return redirect('admin/ticket-types/create');
  }

  public function editTicketType(TicketsType $ticketsType)
  {
    $pageTitle = 'Edit Ticket Type - ' . $ticketsType->type;
    $ticketsTypes = TicketsType::all();
    return view('admin.ticket-types.edit', compact('pageTitle', 'ticketsTypes', 'ticketsType'));
  }

  public function updateTicketType(Request $request, TicketsType $ticketsType)
  {
    $this->validate($request, [
      'type' => 'required|unique:tickets_types,type'
    ]);

    $ticketsType->update($request->all());

    return redirect('/admin/ticket-types');
  }
}
