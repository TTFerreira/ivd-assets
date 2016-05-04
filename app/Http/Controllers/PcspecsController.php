<?php

namespace App\Http\Controllers;

use App\Pcspec;
use App\Http\Requests\Pcspecs\StorePcspecRequest;
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
    $pageTitle = 'View PC Specifications';
    $pcspecs = Pcspec::all();
    return view('pcspecs.index', compact('pcspecs', 'pageTitle'));
  }

  public function show(Pcspec $pcspec)
  {
    return view('pcspecs.show', compact('pcspec'));
  }

  public function create()
  {
    $pageTitle = 'Create New PC Specification';
    return view('pcspecs.create', compact('pageTitle'));
  }

  public function store(StorePcspecRequest $request)
  {
    $pcspec = new Pcspec();
    $pcspec->cpu = $request->cpu;
    $pcspec->ram = $request->ram;
    $pcspec->hdd = $request->hdd;

    $pcspec->save();

    return redirect('pcspecs');
  }

  public function edit(Pcspec $pcspec)
  {
    $pageTitle = 'Edit PC Specification - ' . $pcspec->cpu . ', ' . $pcspec->ram . ', ' . $pcspec->hdd;
    return view('pcspecs.edit', compact('pcspec', 'pageTitle'));
  }

  public function update(StorePcspecRequest $request, Pcspec $pcspec)
  {
    $pcspec->update($request->all());

    return redirect('pcspecs');
  }
}
