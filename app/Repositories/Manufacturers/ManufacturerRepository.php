<?php

namespace App\Repositories\Manufacturers;

use App\Manufacturer;
use Session;
use Slack;

class ManufacturerRepository implements ManufacturerRepositoryInterface {
  public function getAll()
  {
    return Manufacturer::all();
  }

  public function getLatest()
  {
    return Manufacturer::get()->last();
  }

  public function find($id)
  {
    return Manufacturer::findOrFail($id);
  }

  public function store($request)
  {
    Manufacturer::create($request->all());
  }

  public function update($request, $model)
  {
    $model->update($request->all());
  }

  public function flashSuccessCreate($title)
  {
    Session::flash('status', 'success');
    Session::flash('title', $title);
    Session::flash('message', 'Successfully created');
  }

  public function flashSuccessUpdate($title)
  {
    Session::flash('status', 'success');
    Session::flash('title', $title);
    Session::flash('message', 'Successfully updated');
  }
}
