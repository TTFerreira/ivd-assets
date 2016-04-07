<?php

namespace App\Http\Controllers;

use App\Status;
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

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|unique:statuses,name'
    ]);

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

  public function update(Request $request, Status $status)
  {
    $this->validate($request, [
      'name' => 'required|unique:statuses,name,'.$status->id
    ]);

    $status->update($request->all());

    return redirect('statuses');
  }
}
