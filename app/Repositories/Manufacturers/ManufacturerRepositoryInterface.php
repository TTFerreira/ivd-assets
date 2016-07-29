<?php

namespace App\Repositories\Manufacturers;

interface ManufacturerRepositoryInterface {
  public function getAll();
  public function getLatest();
  public function find($id);
  public function store($request);
  public function update($request, $model);
  public function flashSuccessCreate($title);
  public function flashSuccessUpdate($title);
}
