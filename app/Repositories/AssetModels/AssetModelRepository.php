<?php

namespace App\Repositories\AssetModels;

use App\AssetModel;
use Session;
use Slack;

class AssetModelRepository implements AssetModelRepositoryInterface {

  public function getAll()
  {
    return AssetModel::all();
  }

  public function getAllOrderBy($class, $column)
  {
    return $class::orderBy($column)->get();
  }

  public function getLatest()
  {
    return AssetModel::get()->last();
  }

  public function find($id)
  {
    return AssetModel::findOrFail($id);
  }

  public function store($request)
  {
    AssetModel::create($request->all());
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
