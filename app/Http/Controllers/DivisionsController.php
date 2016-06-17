<?php

namespace App\Http\Controllers;

use App\Division;
use Session;
use App\Http\Requests\Divisions\StoreDivisionRequest;
use App\Http\Requests\Divisions\UpdateDivisionRequest;
use Illuminate\Http\Request;

use App\Http\Requests;

class DivisionsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'Divisions';
    $divisions = Division::all();
    return view('divisions.index', compact('divisions', 'pageTitle'));
  }

  public function store(StoreDivisionRequest $request)
  {
    $division = new Division();
    $division->name = $request->name;

    $division->save();

    Session::flash('status', 'success');
    Session::flash('title', $division->name);
    Session::flash('message', 'Successfully created');

    return redirect('divisions');
  }

  public function edit(Division $division)
  {
    $pageTitle = 'Edit Division - ' . $division->name;
    return view('divisions.edit', compact('division', 'pageTitle'));
  }

  public function update(UpdateDivisionRequest $request, Division $division)
  {
    $division->update($request->all());

    Session::flash('status', 'success');
    Session::flash('title', $division->name);
    Session::flash('message', 'Successfully updated');

    return redirect('divisions');
  }
}
