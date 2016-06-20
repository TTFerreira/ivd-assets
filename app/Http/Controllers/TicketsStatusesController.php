<?php

namespace App\Http\Controllers;

use App\TicketsStatus;
use Session;
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

  public function store(StoreTicketsStatusRequest $request)
  {
    $ticketsStatus = new TicketsStatus();
    $ticketsStatus->status = $request->status;

    $ticketsStatus->save();

    Session::flash('status', 'success');
    Session::flash('title', 'Canned Ticket Fields');
    Session::flash('message', 'Successfully created');

    return redirect('admin/ticket-statuses');
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

    Session::flash('status', 'success');
    Session::flash('title', 'Canned Ticket Fields');
    Session::flash('message', 'Successfully updated');

    return redirect('/admin/ticket-statuses');
  }
}
