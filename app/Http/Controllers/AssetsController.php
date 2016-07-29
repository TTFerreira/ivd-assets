<?php

namespace App\Http\Controllers;

use App\Asset;
use App\Http\Requests\Assets\StoreAssetRequest;
use App\Repositories\Assets\AssetRepositoryInterface;

class AssetsController extends Controller
{
  public function __construct(AssetRepositoryInterface $asset)
  {
      $this->middleware('auth');
      $this->asset = $asset;
  }

  public function index()
  {
    return $this->asset->index();
  }

  public function create()
  {
    return $this->asset->create();
  }

  public function store(StoreAssetRequest $request)
  {
    return $this->asset->store($request);
  }

  public function edit(Asset $asset)
  {
    return $this->asset->edit($asset);
  }

  public function update(StoreAssetRequest $request, Asset $asset)
  {
    return $this->asset->update($request, $asset);
  }
}
