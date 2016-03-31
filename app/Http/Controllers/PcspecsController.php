<?php

namespace App\Http\Controllers;

use App\Pcspec;
use Illuminate\Http\Request;

use App\Http\Requests;

class PcspecsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pcspecs = Pcspec::all();
    return view('pcspecs.index', compact('pcspecs'));
  }

  public function show(Pcspec $pcspec)
  {
    //$location->load('notes.user');
    return view('pcspecs.show', compact('pcspec'));
  }

  public function create()
  {
    return view('pcspecs.create');
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'cpu' => 'required|unique:pcspecs,cpu',
      'ram' => 'required',
      'hdd' => 'required'
    ]);

    $pcspec = new Pcspec();
    $pcspec->cpu = $request->cpu;
    $pcspec->ram = $request->ram;
    $pcspec->hdd = $request->hdd;

    $pcspec->save();

    return redirect('pcspecs');
  }

  public function edit(Pcspec $pcspec)
  {
    return view('pcspecs.edit', compact('pcspec'));
  }

  public function update(Request $request, Pcspec $pcspec)
  {
    $this->validate($request, [
      'cpu' => 'required|unique:pcspecs,cpu,'.$pcspec->id,
      'ram' => 'required',
      'hdd' => 'required'
    ]);

    $pcspec->update($request->all());

    return redirect('pcspecs');
  }
}
