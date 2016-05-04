<?php

namespace App\Http\Controllers;

use App\Division;
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
    $pageTitle = 'View Divisions';
    $divisions = Division::all();
    return view('divisions.index', compact('divisions', 'pageTitle'));
  }

  public function show(Division $division)
  {
    //$location->load('notes.user');
    return view('divisions.show', compact('division'));
  }

  public function create()
  {
    $pageTitle = 'Create New Division';
    return view('divisions.create', compact('pageTitle'));
  }

  public function store(StoreDivisionRequest $request)
  {
    $division = new Division();
    $division->name = $request->name;

    $division->save();

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

    return redirect('divisions');
  }
}
