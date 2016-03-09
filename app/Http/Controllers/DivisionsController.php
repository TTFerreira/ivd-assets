<?php

namespace App\Http\Controllers;

use App\Division;
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
    $divisions = Division::paginate(10);;
    return view('divisions.index', compact('divisions'));
  }

  public function show(Division $division)
  {
    //$location->load('notes.user');
    return view('divisions.show', compact('division'));
  }

  public function create()
  {
    return view('divisions.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'name' => 'required|unique:divisions,name'
    ]);

    $division = new Division();
    $division->name = $request->name;

    $division->save();

    return redirect('divisions');
  }

  public function edit(Division $division)
  {
    return view('divisions.edit', compact('division'));
  }

  public function update(Request $request, Division $division)
  {
    $this->validate($request, [
      'name' => 'required|unique:divisions,name,'.$division->id
    ]);

    $division->update($request->all());

    return redirect('divisions');
  }
}
