<?php

namespace App\Http\Controllers;

use App\TicketsStatus;
use App\Http\Requests\TicketsStatuses\StoreTicketsStatusRequest;
use App\Http\Requests\TicketsStatuses\UpdateTicketsStatusRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class TicketsStatusesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Ticket Statuses';
    $ticketsStatuses = TicketsStatus::all();
    return view('admin.ticket-statuses.index', compact('pageTitle', 'ticketsStatuses'));
  }

  public function create()
  {
    $pageTitle = 'Create New Ticket Status';
    $ticketsStatuses = TicketsStatus::all();
    return view('admin.ticket-statuses.create', compact('pageTitle', 'ticketsStatuses'));
  }

  public function store(StoreTicketsStatusRequest $request)
  {
    $ticketsStatus = new TicketsStatus();
    $ticketsStatus->status = $request->status;

    $ticketsStatus->save();

    return redirect('admin/ticket-statuses/create');
  }

  public function edit(TicketsStatus $ticketsStatus)
  {
    $pageTitle = 'Edit Ticket Status - ' . $ticketsStatus->status;
    $ticketsStatuses = TicketsStatus::all();
    return view('admin.ticket-statuses.edit', compact('pageTitle', 'ticketsStatuses', 'ticketsStatus'));
  }

  public function update(UpdateTicketsStatusRequest $request, TicketsStatus $ticketsStatus)
  {
    $ticketsStatus->update($request->all());

    return redirect('/admin/ticket-statuses');
  }
}
