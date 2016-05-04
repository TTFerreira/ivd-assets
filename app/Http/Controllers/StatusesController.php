<?php

namespace App\Http\Controllers;

use App\Status;
use App\Http\Requests\Statuses\StoreStatusRequest;
use App\Http\Requests\Statuses\UpdateStatusRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class StatusesController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'View Statuses';
    $statuses = Status::all();
    return view('statuses.index', compact('statuses', 'pageTitle'));
  }

  public function show(Status $status)
  {
    return view('statuses.show', compact('status'));
  }

  public function create()
  {
    $pageTitle = 'Create New Status';
    return view('statuses.create', compact('pageTitle'));
  }

  public function store(StoreStatusRequest $request)
  {
    $status = new Status();
    $status->name = $request->name;

    $status->save();

    return redirect('statuses');
  }

  public function edit(Status $status)
  {
    $pageTitle = 'Edit Status - ' . $status->name;
    return view('statuses.edit', compact('status', 'pageTitle'));
  }

  public function update(UpdateStatusRequest $request, Status $status)
  {
    $status->update($request->all());

    return redirect('statuses');
  }
}
