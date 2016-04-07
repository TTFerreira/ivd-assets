<?php

/*
 * Taken from
 * https://github.com/laravel/framework/blob/5.2/src/Illuminate/Auth/Console/stubs/make/controllers/HomeController.stub
 */

namespace App\Http\Controllers;

use App\Movement;
use App\Asset;
use App\Location;
use App\Status;
use App\Budget;
use App\Invoice;
use App\Division;
use App\Http\Requests;
use Illuminate\Http\Request;

/**
 * Class HomeController
 * @package App\Http\Controllers
 */
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return Response
     */
    public function index()
    {
      $pageTitle = 'Dashboard';
      $assets = Asset::all();
      $locations = Location::all();
      $statuses = Status::all();
      $budgets = Budget::all();
      $invoices = Invoice::all();
      $divisions = Division::all();
      $year = \Carbon\Carbon::now()->year;
      $movements = Movement::orderBy('created_at', 'desc')->take(5)->get();
      return view('home', compact('assets', 'movements', 'locations', 'statuses', 'budgets', 'invoices', 'divisions', 'year', 'pageTitle'));
    }
}
