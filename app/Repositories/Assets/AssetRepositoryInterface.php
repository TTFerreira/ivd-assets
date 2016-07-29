<?php

namespace App\Repositories\Assets;

interface AssetRepositoryInterface {
  public function index();
  public function create();
  public function store($request);
  public function edit($asset);
  public function update($request, $model);
  public function getAll($class);
  public function getLatest();
  public function find($id);
  public function count();
  public function deployedCount();
  public function readyToDeployCount();
  public function repairsCount();
  public function flashSuccessCreate($title);
  public function flashSuccessUpdate($title);
  public function slackCreate();
  public function slackUpdate($id);
}
