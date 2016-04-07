<?php

namespace App\Http\Controllers;

use App\Budget;
use App\Division;
use Illuminate\Http\Request;

use App\Http\Requests;

class BudgetsController extends Controller
{
  public function __construct()
  {
      $this->middleware('auth');
  }

  public function index()
  {
    $pageTitle = 'View Budgets';
    $budgets = Budget::all();
    return view('budgets.index', compact('budgets', 'pageTitle'));
  }

  public function show(Budget $budget)
  {
    return view('budgets.show', compact('budget'));
  }

  public function create()
  {
    $pageTitle = 'Create New Budget';
    $divisions = Division::all();
    return view('budgets.create', compact('divisions', 'pageTitle'));
  }

  public function store(Request $request)
  {
    $this->validate($request, [
      'division_id' => 'required',
      'year' => 'required',
      'total' => 'required|numeric|between:0, 99999999.99'
    ]);

    $budget = new Budget();
    $budget->division_id = $request->division_id;
    $budget->year = $request->year;
    $budget->total = $request->total;

    $budget->save();

    return redirect('budgets');
  }

  public function edit(Budget $budget)
  {
    $pageTitle = 'Edit Budget - ' . $budget->division->name . ' ' . $budget->year;
    $divisions = Division::all();
    return view('budgets.edit', compact('budget', 'divisions', 'pageTitle'));
  }

  public function update(Request $request, Budget $budget)
  {
    $this->validate($request, [
      'division_id' => 'required',
      'year' => 'required',
      'total' => 'required|numeric|between:0, 99999999.99'
    ]);

    $budget->update($request->all());

    return redirect('budgets');
  }
}
