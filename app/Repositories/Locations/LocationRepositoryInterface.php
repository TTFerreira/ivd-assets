<?php

namespace App\Repositories\Locations;

interface LocationRepositoryInterface {
  public function getAll();
  public function getLatest();
  public function find($id);
  public function store($request);
  public function update($request, $model);
  public function flashSuccessCreate($title);
  public function flashSuccessUpdate($title);
  public function slackCreate();
  public function slackUpdate($id);
}
