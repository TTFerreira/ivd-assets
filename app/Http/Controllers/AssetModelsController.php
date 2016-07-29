<?php

namespace App\Http\Controllers;

use App\AssetModel;
use App\Manufacturer;
use App\AssetType;
use App\Pcspec;
use Illuminate\Http\Request;
use App\Http\Requests\AssetModels\StoreAssetModelRequest;
use App\Http\Requests\AssetModels\UpdateAssetModelRequest;
use App\Repositories\AssetModels\AssetModelRepositoryInterface;

use App\Http\Requests;

class AssetModelsController extends Controller
{
  public function __construct(AssetModelRepositoryInterface $assetModel)
  {
      $this->middleware('auth');
      $this->assetModel = $assetModel;
  }

  public function index()
  {
    $pageTitle = 'View Models';
    $asset_models = $this->assetModel->getAll();
    $manufacturers = $this->assetModel->getAllOrderBy('App\Manufacturer', 'name');
    $asset_types = $this->assetModel->getAllOrderBy('App\AssetType', 'type_name');
    $pcspecs = $this->assetModel->getAllOrderBy('App\Pcspec', 'cpu');
    return view('models.index', compact('asset_models', 'pageTitle', 'manufacturers', 'asset_types', 'pcspecs'));
  }

  public function store(StoreAssetModelRequest $request)
  {
    $this->assetModel->store($request);

    $this->assetModel->flashSuccessCreate($this->assetModel->getLatest()->manufacturer->name . ' - ' . $this->assetModel->getLatest()->asset_model);

    return redirect()->route('models.index');
  }

  public function edit(AssetModel $asset_model)
  {
    $pageTitle = 'Edit Model - ' . $asset_model->manufacturer->name .  ' ' . $asset_model->asset_model;
    $manufacturers = $this->assetModel->getAllOrderBy('App\Manufacturer', 'name');
    $asset_types = $this->assetModel->getAllOrderBy('App\AssetType', 'type_name');
    $pcspecs = $this->assetModel->getAllOrderBy('App\Pcspec', 'cpu');
    return view('models.edit', compact('asset_model', 'manufacturers', 'asset_types', 'pcspecs', 'pageTitle'));
  }

  public function update(UpdateAssetModelRequest $request, AssetModel $asset_model)
  {
    $this->assetModel->update($request, $asset_model);

    $this->assetModel->flashSuccessUpdate($this->assetModel->find($asset_model->id)->manufacturer->name . ' - ' . $this->assetModel->find($asset_model->id)->asset_model);

    return redirect()->route('models.index');
  }
}
