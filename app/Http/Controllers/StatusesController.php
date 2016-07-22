<?php

namespace App\Http\Controllers;

use App\Status;
use Session;
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
    $pageTitle = 'Statuses';
    $statuses = Status::all();
    return view('admin.assets-statuses.index', compact('statuses', 'pageTitle'));
  }

  public function store(StoreStatusRequest $request)
  {
    Status::create($request->all());
    $status = Status::get()->last();

    Session::flash('status', 'success');
    Session::flash('title', $status->name);
    Session::flash('message', 'Successfully created');

    return redirect('admin/assets-statuses');
  }

  public function edit(Status $status)
  {
    $pageTitle = 'Edit Status - ' . $status->name;
    return view('admin.assets-statuses.edit', compact('status', 'pageTitle'));
  }

  public function update(UpdateStatusRequest $request, Status $status)
  {
    $status->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', $status->name);
    Session::flash('message', 'Successfully updated');

    return redirect('admin/assets-statuses');
  }
}
