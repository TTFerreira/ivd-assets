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
    $statuses = Status::paginate(10);;
    return view('statuses.index', compact('statuses'));
  }

  public function show(Status $status)
  {
    //$location->load('notes.user');
    return view('statuses.show', compact('status'));
  }

  public function create()
  {
    return view('statuses.create');
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
    return view('statuses.edit', compact('status'));
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
