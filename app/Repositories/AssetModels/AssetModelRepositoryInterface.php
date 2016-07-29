<?php

namespace App\Repositories\AssetModels;

interface AssetModelRepositoryInterface {
  public function getAll();
  public function getAllOrderBy($class, $column);
  public function getLatest();
  public function find($id);
  public function store($request);
  public function update($request, $model);
  public function flashSuccessCreate($title);
  public function flashSuccessUpdate($title);
}
